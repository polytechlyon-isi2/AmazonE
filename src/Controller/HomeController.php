<?php

namespace AmazonE\Controller;

use Silex\Application;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Request;
use AmazonE\Domain\User;
use AmazonE\Form\Type\UserType;


class HomeController
{
    /**
     * Get categories menus.
     *
     * @param Application $app Silex application
     */
    private function getCategoriesMenus(Application $app) {
        $categoriesMenus = array();
        $categories = $app['dao.category']->findAll();
        foreach ($categories as $category) {
            $subCategories = $app['dao.subCategory']->findByCategory($category->getId());
            $categoriesMenus[] = array($category, $subCategories);
        }
        return $categoriesMenus;
    }

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        return $app['twig']->render('index.html.twig', array(
        	'categoriesMenus' => $this->getCategoriesMenus($app),
        	));
    }

    /**
     * Sub category items list controller.
     *
     * @param integer $id Sub category id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function subCategoryAction($id, Request $request, Application $app) {
        $subCategory = $app['dao.subCategory']->find($id);
        $items = $app['dao.item']->findBySubCategory($id);
        return $app['twig']->render('subCategory.html.twig', array(
            'categoriesMenus' => $this->getCategoriesMenus($app),
            'subCategory' => $subCategory,
            'items' => $items,
            ));
    }

    /**
     * Item details controller.
     *
     * @param integer $id Item id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function itemAction($id, Request $request, Application $app) {
        $item = $app['dao.item']->find($id);
        return $app['twig']->render('item.html.twig', array(
            'categoriesMenus' => $this->getCategoriesMenus($app),
            'item' => $item,
            ));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        $panelMustBeActive = 'connection';
        $user = new User();
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted()) {
            $panelMustBeActive = 'inscription';
            if ($userForm->isValid()) {
                // set the salt value
                $salt = '%qUgq3NAYfC1MKwrW?yevbE';
                $user->setSalt($salt);
                // find the default encoder
                $encoder = $app['security.encoder.digest'];
                // compute the encoded password
                $plainPassword = $user->getPassword();
                $password = $encoder->encodePassword($plainPassword, $user->getSalt());
                $user->setPassword($password);
                $user->setRole('ROLE_USER');
                try {
                    // check there is no integrity exception (i.e. duplicate emails addresses)
                    $app['dao.user']->save($user);
                    $app['session']->getFlashBag()->add('success', 'L\'utilisateur a été ajouté avec succès !');
                } catch (DBALException $e) {
                    $app['session']->getFlashBag()->add('error', 'L\'adresse email est déjà existante...');
                }
            }
        }
        return $app['twig']->render('login.html.twig', array(
            'categoriesMenus' => $this->getCategoriesMenus($app),
            'userForm' => $userForm->createView(),
            'panelMustBeActive' => $panelMustBeActive,
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }

    /**
     * Edit user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction(Request $request, Application $app) {
        $user = $app['user'];
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // find the default encoder
            $encoder = $app['security.encoder.digest'];
            // compute the encoded password
            $plainPassword = $user->getPassword();
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            try {
                // check there is no integrity exception (i.e. duplicate email addresses)
                $app['dao.user']->save($user);
                $app['session']->getFlashBag()->add('success', 'Les informations personnelles ont été mises à jour avec succès !');
            } catch (DBALException $e) {
                $app['session']->getFlashBag()->add('error', 'L\'adresse email est déjà existante...');
            }
        }
        return $app['twig']->render('userPrivateInformation.html.twig', array(
            'categoriesMenus' => $this->getCategoriesMenus($app),
            'userForm' => $userForm->createView(),
            'error' => $app['security.last_error']($request)));
    }

    /**
     * Listed cart items controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function cartAction(Request $request, Application $app) {
        $totalPrice = 0;
        $itemsWithQuantity = array();
        $cart = $app['session']->get('cart');
        if (isset($cart)) {
            foreach ($cart as $itemId => $itemQuantity) {
                $item = $app['dao.item']->find($itemId);
                $itemsWithQuantity[] = array($item, $itemQuantity);
                $totalPrice = $totalPrice + ($item->getPrice() * $itemQuantity);
            }
        }
        return $app['twig']->render('cart.html.twig', array(
            'categoriesMenus' => $this->getCategoriesMenus($app),
            'itemsWithQuantity' => $itemsWithQuantity,
            'totalPrice' => $totalPrice,
            ));
    }

    /**
     * Add an article controller.
     *
     * @param integer $id Item id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addArticleAction($id, Request $request, Application $app) {
        $articles = $app["session"]->get('cart');
        if (!isset($articles)) {
            $articles = array();
        }
        $articles[$id] = (isset($articles[$id]) ? $articles[$id] : 0) + 1;
        $app["session"]->set('cart', $articles);
        return $this->cartAction($request, $app);
    }
}