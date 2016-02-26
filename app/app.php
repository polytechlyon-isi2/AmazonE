<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register error handler
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 403:
            $message = 'Accès refusé.';
            break;
        case 404:
            $message = 'La ressource demandée n\'a pas pu être trouvée.';
            break;
        default:
            $message = "Quelque chose s'est mal passé...";
    }
    return $app['twig']->render('error.html.twig', array('message' => $message));
});

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());

//TODO REGISTER SECURITY

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/amazone.log',
    'monolog.name' => 'AmazonE',
    'monolog.level' => $app['monolog.level']
));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
if (isset($app['debug']) && $app['debug']) {
    $app->register(new Silex\Provider\HttpFragmentServiceProvider());
    $app->register(new Silex\Provider\WebProfilerServiceProvider(), array(
        'profiler.cache_dir' => __DIR__.'/../var/cache/profiler'
    ));
}

// Register services
$app['dao.category'] = $app->share(function ($app) {
    return new AmazonE\DAO\CategoryDAO($app['db']);
});
$app['dao.subCategory'] = $app->share(function ($app) {
    $subCategoryDAO = new AmazonE\DAO\SubCategoryDAO($app['db']);
    $subCategoryDAO->setCategoryDAO($app['dao.category']);
    return $subCategoryDAO;
});
$app['dao.item'] = $app->share(function ($app) {
    $itemDAO = new AmazonE\DAO\ItemDAO($app['db']);
    $itemDAO->setSubCategoryDAO($app['dao.subCategory']);
    return $itemDAO;
});