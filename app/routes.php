<?php

// Home page
$app->get('/', "AmazonE\Controller\HomeController::indexAction")->bind('home');

// Listed items for a sub category
$app->match('/subCategory/{id}', "AmazonE\Controller\HomeController::subCategoryItemsAction")->bind('subCategoryItems');

// Detailed info about an item
$app->match('/item/{id}', "AmazonE\Controller\HomeController::itemAction")->bind('item');