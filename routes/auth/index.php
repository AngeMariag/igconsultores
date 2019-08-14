<?php 

use\models\{
    AuthModel,
    GestorModel
};

// vista para ejecutar el guardado del acreedor
    $app->post('/signup', function (Request $request, Response $response) {
        $post = $request->getParsedBody();

        $codigo = $post['codigo'];
        $identificacion = $post['identificacion'];
        $nombre = $post['nombre'];
        $apellido = $post['apellido'];
        $pass = $post['password'];
        
        if (!$codigo || !$identificacion || !$name || !$apellido|| !$pass) {
            $this->flash->addMessage('error', 'Algunos Campos son Requeridos Intente de Nuevo');
            return $response->withRedirect($this->router->pathFor('cartera_list'));
        }
       	$authModel = new AuthModel
		$gestorModel = new GestorModel
        
            $authModel->codigo = $typedocument;
            $authModel->identificacion = $document;
            $authModel->nombre = $name;
            $authModel->apellido = $name;
            $save_id = $authModel->save();
            
        
        // unset($_SESSION['gestor']);
        // return $response->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $token]));
    })->setName('getor_new_post');
 ?> --> 