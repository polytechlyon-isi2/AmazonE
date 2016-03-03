<?php

namespace AmazonE\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{
    /**
     * Get categories menus.
     *
     * @param Application $app Silex application
     */
    public static function getCategoriesMenus(Application $app) {
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
        	'categoriesMenus' => HomeController::getCategoriesMenus($app),
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
            'categoriesMenus' => HomeController::getCategoriesMenus($app),
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
            'categoriesMenus' => HomeController::getCategoriesMenus($app),
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
        return $app['twig']->render('login.html.twig', array(
            'categoriesMenus' => HomeController::getCategoriesMenus($app),
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }
}