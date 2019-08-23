<?php

use models\{AuthModel, GestorModel};
use Slim\Http\{Request, Response};

// vista para ejecutar el guardado del gestor
$app->post('/signup', function (Request $request, Response $response) {
    $post = $request->getParsedBody();

    $codigo = $post['codigo'];
    $identificacion = $post['identificacion'];
    $nombre = $post['nombre_gestor'];
    $apellido = $post['apellido_gestor'];
    $pass1 = $post['pass1'];
    $pass2 = $post['pass2'];


    sessionLocal('signup', $post);
    unset($post['pass1']);
    unset($post['pass2']);
    if (!$codigo || !$identificacion || !$nombre || !$apellido || !$pass1 || !$pass2) {
        $this->flash->addMessage('error1', 'Algunos Campos son Requeridos Intente de Nuevo');
        return $response->withRedirect($this->router->pathFor('login_get'));
    }

    if ($pass1 != $pass2) {
        $this->flash->addMessage('error1', 'Contraseña No Coinciden');
        return $response->withRedirect($this->router->pathFor('login_get'));
    }

    $authModel = new AuthModel;
    $gestorModel = new GestorModel;
    $find_gestor = $gestorModel->find('codigo', '=', $codigo);
    if ($find_gestor) {
        $this->flash->addMessage('error1', 'Gestor ya existe');
        return $response->withRedirect($this->router->pathFor('login_get'));
    }

    $gestorModel->codigo = $codigo;
    $gestorModel->identificacion = $identificacion;
    $gestorModel->nombre = $nombre;
    $gestorModel->apellido = $apellido;
    $gestorModel->save();


    $authModel->username = $codigo;
    $authModel->password = $pass1;
    $authModel->nivel = 3;
    $authModel->save();
    unset($_SESSION['signup']);
    return $response->withRedirect($this->router->pathFor('login_get'));
})->setName('getor_new_post');
