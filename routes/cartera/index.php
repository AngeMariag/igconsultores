<?php

$app->group('/cartera', function () use ($app) {

    // vista para retorna al crear cartera 
    $app->get('/new', function ($request, $response) {
        return $this->view->render($response, 'cartera/new.html');
    })->setName('cartera_new_get');
})->add($checkUserNotAuthenticated);
