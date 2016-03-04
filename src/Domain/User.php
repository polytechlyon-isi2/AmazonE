<?php

namespace AmazonE\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * User lastname.
     *
     * @var string
     */
    private $lastname;

    /**
     * User firstname.
     *
     * @var string
     */
    private $firstname;

    /**
     * User address.
     *
     * @var string
     */
    private $address;

    /**
     * User zip code.
     *
     * @var string
     */
    private $zipCode;

    /**
     * User city.
     *
     * @var string
     */
    private $city;

    /**
     * User email.
     *
     * @var string
     */
    private $email;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * User role.
     *
     * @var string
     */
    private $role;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->getEmail();
    }

    public function setUsername($username) {
        $this->setEmail($username);
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles() {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}