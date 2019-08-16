<?php

use Slim\Http\Request;
use Slim\Http\Response;

use models\GestorModel;

function gestorView($req, $res, $app)
{
    $user = sessionLocal('user');
    $ctx = [];
    $gestorModel = new GestorModel;
    $datas = $gestorModel->getDataTableGestor($user['username']);
    $ctx['datas'] = $datas;
    return $app->view->render($res, 'gestor/gestor.html', $ctx);
}

$app->get('/dashboard', function (Request $req, Response $res) {
    $user = sessionLocal('user');
    if ($user['nivel'] === 3) {
        return gestorView($req, $res, $this);
    }
    return $this->view->render($res, 'dashboard.html');
    // print_r($request->getQueryParams());

})->setName('dashboard')->add($checkUserNotAuthenticated);

