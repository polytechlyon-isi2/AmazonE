<?php


namespace AmazonE\Tests;

require_once __DIR__.'/../../vendor/autoload.php';

use Silex\WebTestCase;
use AmazonE\Controller\HomeController;
use AmazonE\DAO;

class AnonymousTest extends WebTestCase{

    protected $client;
    protected $app;
    /**
     * @dataProvider provideCategories
     */
    public function testSubCategoryExists($subCategory){
        $client = $this->createClient();
        $client->request('GET', '/subCategory/'.$subCategory);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider provideItems
     */
    public function testItemExists($item){
        $client = $this->createClient();
        $client->request('GET', '/item/'.$item);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * {@inheritDoc}
     */
    public function createApplication()
    {
        $app = new \Silex\Application();

        require __DIR__.'/../../app/config/dev.php';
        require __DIR__.'/../../app/app.php';
        require __DIR__.'/../../app/routes.php';

        // Generate raw exceptions instead of HTML pages if errors occur
        $app['exception_handler']->disable();
        // Simulate sessions for testing
        $app['session.test'] = true;
        // Enable anonymous access to admin zone
        $app['security.access_rules'] = array();

        return $app;
    }

    public function provideCategories(){
        $app = $this->createApplication();
        $homeController = new HomeController();
        $categoriesMenus = array();
        $categories = $app['dao.category']->findAll();
        foreach ($categories as $category) {
            $subCategories = $app['dao.subCategory']->findByCategory($category->getId());
            $categoriesMenus[] = array($category, $subCategories);
        }
        $subCategories = array();
        for ($i = 1; $i <= count($categoriesMenus); $i++) {
            $subCategories[$i] = array($i);
        }
        return $subCategories;
    }

    public function provideItems(){
        $app = $this->createApplication();
        $categoryDAO = new DAO\CategoryDAO($app['db']);
        $subCategoryDAO = new DAO\SubCategoryDAO($app['db']);
        $subCategoryDAO->setCategoryDAO($categoryDAO);
        $itemDAO = new DAO\ItemDAO($app['db']);
        $itemDAO->setSubCategoryDAO($subCategoryDAO);
        $items = $itemDAO->findAll();

        $itemList = array();
        for ($j = 1; $j <= count($items); $j++){
            $itemList[$j] = array($items[$j]->getId());
        }
        return $itemList;
    }



}