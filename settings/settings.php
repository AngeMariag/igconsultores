<?php
session_cache_limiter(false);
session_start();
ini_set('session_save_path', "../tmp");

// get env
$dotenv = Dotenv\Dotenv::create(__DIR__, '../.env');
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
        new CsrfExtension($container)
    );
    $assetManager = new LoveCoding\TwigAsset\TwigAssetManagement([
        'verion' => '1'
    ]);

    $assetManager->addPath('static', '/static');
    $view->addExtension($assetManager->getAssetExtension());

    return $view;
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// set middleware global
// $app->add($container->get('csrf'));
$app->add(function ($request, $response, $next) {
    $this->view->offsetSet("flash", $this->flash);
    return $next($request, $response);
});

define('DB_HOST', $_SERVER['DB_HOST']);
define('DB_USER', $_SERVER['DB_USER']);
define('DB_PASSWORD', $_SERVER['DB_PASSWORD']);
define('DB_NAME', $_SERVER['DB_NAME']);
define('SECRET_KEY', $_SERVER['SECRET_KEY']);