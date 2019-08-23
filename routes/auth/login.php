<?php

use models\AuthModel;

// Define app routes
$app->get('/', function ($request, $response) {
    return $this->view->render($response, 'auth/login.html');
})->setName('login_get')->add($checkUserAuthenticated);


$app->post('/', function ($request, $response) {
    $username = $request->getParsedBody()['username'];
    $password = $request->getParsedBody()['password'];
    if (!$username || !$password) {
        $this->flash->addMessage('error', 'Usuario y Contraseña son requeridas');
        return $response->withRedirect($this->router->pathFor('login_get'));
    }
    $model = new AuthModel;
    $user = $model->find('username', '=', $username);
    if (!$user) {
        $this->flash->addMessage('error', 'Usuario o Contraseña Invalida');
        return $response->withRedirect($this->router->pathFor('login_get'));
    }
    if ($user['password'] != $password) {
        $this->flash->addMessage('error', 'Usuario o Contraseña Invalida');
        return $response->withRedirect($this->router->pathFor('login_get'));
    }

    sessionLocal('is_authenticated', true);
    sessionLocal('user', $user);
    return $response->withRedirect($this->router->pathFor('dashboard'));
});


$app->get('/logout', function ($request, $response) {
    session_unset();
    session_destroy();
    return $response->withRedirect($this->router->pathFor('login_get'));
})->setName('logout');
