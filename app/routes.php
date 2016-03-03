<?php

// Home page
$app->get('/', "AmazonE\Controller\HomeController::indexAction")->bind('home');

// Listed all items for a sub category
$app->match('/subCategory/{id}', "AmazonE\Controller\HomeController::subCategoryAction")->bind('subCategory');

// Detailed info about an item
$app->match('/item/{id}', "AmazonE\Controller\HomeController::itemAction")->bind('item');

// Login form
$app->get('/login', "AmazonE\Controller\HomeController::loginAction")->bind('login');