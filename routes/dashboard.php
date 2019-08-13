<?php
$app->get('/dashboard', function ($request, $response) {
    // print_r($request->getQueryParams());
    return $this->view->render($response, 'dashboard.html');
})->setName('dashboard')->add($checkUserNotAuthenticated);

