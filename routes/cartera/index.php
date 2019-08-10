<?php
use \models\AcreedorModel;


$app->group('/cartera', function () use ($app) {

    // listado de acreedores 
    $app->get('', function($request, $response){
        $model = new AcreedorModel;
        $arg = [];
        $re = $request->getQueryParams();
        if (isset($re['q']) && $re['q'] != ''){
            $q = $request->getQueryParams()['q'];
            $result = $model->search_by_document_or_name($q);
            if(!$result){
                $arg["msg"] = "No hay concurrencia con el dato {$q}";
            } else {
                $arg['acreedores'] = $result;
                return $this->view->render($response, 'cartera/list.html', $arg);
            }
        }
        // aqui en el metodo paginate puedes pasar un numero 
        // esto es para saber cuanto datos se mostraran en pantalla
        $acreedores = $model->paginate();
        $arg['acreedores'] = $acreedores[0];
        $arg['paginate'] = $acreedores[1];
        return $this->view->render($response, 'cartera/list.html', $arg);
    })->setName('cartera_list');

    // vista para ejecutar el guardado del acreedor
    $app->post('/new', function ($request, $response) {
        $post = $request->getParsedBody();

        $typedocument = $post['typedocument'];
        $document = $post['document'];
        $name = $post['name'];

        sessionLocal('acreedor', [
            'typedocument' => $typedocument,
            'document' => $document,
            'name' => $name,
        ]);
        if (!$typedocument || !$document || !$name) {
            $this->flash->addMessage('error', 'Algunos Campos son Requeridos');
            return $response->withRedirect($this->router->pathFor('cartera_list'));
        }
        $acreedor = new AcreedorModel;
        $find = $acreedor->find('documento', '=', $document);
        if ($find) {
            $this->flash->addMessage('error', 'Acreedor Ya Esta Registrado');
            return $response->withRedirect($this->router->pathFor('cartera_list'));
        }

        $acreedor->tipo_documento = $typedocument;
        $acreedor->documento = $document;
        $acreedor->razon_social = $name;
        $acreedor->save();
        return $response->withRedirect($this->router->pathFor('cartera_list'));
    })->setName('cartera_new_post');
})->add($checkUserNotAuthenticated);
