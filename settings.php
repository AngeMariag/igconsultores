<?php
session_cache_limiter(false);
session_start();

// get env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
    'debug' => false
]];
$app = new \Slim\App($config);

// get container on slim
$container = $app->getContainer();

// set template view
require_once('./utils/csrf_extension.php');
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('templates', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
    $view->addExtension(
        new CsrfExtension
    );

    return $view;
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// set middleware global
$app->add($container->get('csrf'));

