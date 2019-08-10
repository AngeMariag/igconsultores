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


    // vista para retorna al crear cartera 
    $app->get('/new', function ($request, $response) {
        return $this->view->render($response, 'cartera/new.html');
    })->setName('cartera_new_get');
})->add($checkUserNotAuthenticated);
