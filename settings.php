<?php
use Slim\Views\PhpRenderer;
// get env
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$template = new PhpRenderer("./templates");

// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
    'view' => $template
    // 'mode' => 'development'
]];
$app = new \Slim\App($config);