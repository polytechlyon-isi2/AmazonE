<?php

namespace AmazonE\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{
    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $categories = $app['dao.category']->findAll();
        $subCategories = $app['dao.subCategory']->findAll();
        return $app['twig']->render('index.html.twig', array(
        	'categories' => $categories,
        	'subCategories' => $subCategories,
        	));
    }

    /**
     * Sub category items list controller.
     *
     * @param integer $id Sub category id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function subCategoryItemsAction($id, Request $request, Application $app) {
        $categories = $app['dao.category']->findAll();
        $subCategories = $app['dao.subCategory']->findAll();
        $subCategory = $app['dao.subCategory']->find($id);
        $items = $app['dao.item']->findBySubCategory($id);
        return $app['twig']->render('subCategoryItems.html.twig', array(
            'categories' => $categories,
            'subCategories' => $subCategories,
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
        $categories = $app['dao.category']->findAll();
        $subCategories = $app['dao.subCategory']->findAll();
        $item = $app['dao.item']->find($id);
        return $app['twig']->render('item.html.twig', array(
            'categories' => $categories,
            'subCategories' => $subCategories,
            'item' => $item,
            ));
    }
}