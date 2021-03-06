<?php

// Home page
$app->get('/', "AmazonE\Controller\HomeController::indexAction")->bind('home');

// Listed all items for a sub category
$app->match('/subCategory/{id}', "AmazonE\Controller\HomeController::subCategoryAction")->bind('subCategory');

// Detailed info about an item
$app->match('/item/{id}', "AmazonE\Controller\HomeController::itemAction")->bind('item');

// Login form
$app->match('/login', "AmazonE\Controller\HomeController::loginAction")->bind('login');

// Edit a user
$app->match('/user/edit', "AmazonE\Controller\HomeController::editUserAction")->bind('editUser');

// Listed all article
$app->match('/cart', "AmazonE\Controller\HomeController::cartAction")->bind('cart');

// Add an article
$app->match('/cart/add/{id}', "AmazonE\Controller\HomeController::addArticleAction")->bind('addArticle');