<?php

namespace AmazonE\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use AmazonE\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a list of all users.
     *
     * @return array A list of all users.
     */
    public function findAll() {
        $sql = "select * from t_users";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $users = array();
        foreach ($result as $row) {
            $id = $row['usr_id'];
            $users[$id] = $this->buildDomainObject($row);
        }
        return $users;
    }
    
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \AmazonE\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from t_users where usr_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * Saves a user into the database.
     *
     * @param \AmazonE\Domain\User $user The user to save
     */
    public function save(User $user) {
        $userData = array(
            'usr_lastname' => $user->getLastname(),
            'usr_firstname' => $user->getFirstname(),
            'usr_address' => $user->getAddress(),
            'usr_zipCode' => $user->getZipCode(),
            'usr_city' => $user->getCity(),
            'usr_email' => $user->getEmail(),
            'usr_password' => $user->getPassword(),
            'usr_salt' => $user->getSalt(),
            'usr_role' => $user->getRole()
            );

        if ($user->getId()) {
            // The user has already been saved : update it
            $this->getDb()->update('t_users', $userData, array('usr_id' => $user->getId()));
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('t_users', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
    }

    /**
     * Removes a user from the database.
     *
     * @param @param integer $id The user id.
     */
    public function delete($id) {
        // Delete the user
        $this->getDb()->delete('t_users', array('usr_id' => $id));
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username) {
        $sql = "select * from t_users where usr_email=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class) {
        return 'AmazonE\Domain\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \AmazonE\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setId($row['usr_id']);
        $user->setLastname($row['usr_lastname']);
        $user->setFirstname($row['usr_firstname']);
        $user->setAddress($row['usr_address']);
        $user->setZipCode($row['usr_zipCode']);
        $user->setCity($row['usr_city']);
        $user->setEmail($row['usr_email']);
        $user->setPassword($row['usr_password']);
        $user->setSalt($row['usr_salt']);
        $user->setRole($row['usr_role']);
        return $user;
    }
}