<?php

use\models\{
    CarteraModel,
    DeudorModel,
    CoDeudorModel,
    CarteraDeudorCoDeudor
};

use Slim\Http\Request;
use Slim\Http\Response;
// use Slim\Http\UploadedFile;
// use Ramsey\Uuid\Uuid;

$app->group('/cartera', function () use ($app) {

    $app->get('/{token}/deudor/add', function (Request $req, Response $res, $args) {
        $carteraModel = new CarteraModel;
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
        return $this->view->render($res, 'deudor/add.html', ['object' => $cartera]);
    })->setName('deudor_add_get');

    $app->post('/{token}/deudor/add', function (Request $req, Response $res, $args) {
        $carteraModel = new CarteraModel;
        $deudorModel = new DeudorModel;
        $carteDeudorModel = new CarteraDeudorCoDeudor;
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));

        $post = $req->getParsedBody();
        // var_dump($post);
        // die();
        $typedocument = (isset($post['typedocument'])) ? $post['typedocument'] : '';
        $document = (isset($post['document'])) ? $post['document'] : '';
        $name = (isset($post['name'])) ? $post['name'] : '';
        $last_name = (isset($post['last_name'])) ? $post['last_name'] : '';
        $tlf = (isset($post['tlf'])) ? $post['tlf'] : '';
        $address = (isset($post['address'])) ? $post['address'] : '';

        if (
            !$typedocument || !$document || !$name ||
            !$last_name || !$tlf || !$address
        ) {
            return $this->view->render($res, 'deudor/add.html', [
                'object' => $cartera,
                'deudor' => $post,
                'msg' => "Algunos Campos Son Requeridos"
            ]);
        }

        $find_deudor = $deudorModel->find('documento', '=', $document);
        if ($find_deudor){
            $exist_deudor_on_cartera = $deudorModel->findDeudorOnCartera(
                $cartera['id'], $find_deudor['id']);
            if ($exist_deudor_on_cartera){
                return $this->view->render($res, 'deudor/add.html', [
                    'object' => $cartera,
                    'deudor' => $post,
                    'msg' => "Deudor Ya Esta Registrado Con Este Acreedor"
                ]);
            }
            $save_id = $find_deudor['id'];
        } else {
            $deudorModel->tipodocumento = $typedocument;
            $deudorModel->documento = $document;
            $deudorModel->nombre = $name;
            $deudorModel->apellido = $last_name;
            $deudorModel->telefono = $tlf;
            $deudorModel->direccion = $address;
            $save_id = $deudorModel->save();
        }
        $carteDeudorModel->id_cartera = $cartera['id'];
        $carteDeudorModel->id_deudor = $save_id;
        $carteDeudorModel->save();
        return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
    });
})->add($checkUserNotAuthenticated);
