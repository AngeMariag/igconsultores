<?php

use\models\{
    CarteraModel,
    DeudorModel,
    CoDeudorModel,
    CarteraDeudorCoDeudor,
    GestorModel,
    FacturaModel,
    ObservacionesFacturaModel
};

use Slim\Http\Request;
use Slim\Http\Response;
// use Slim\Http\UploadedFile;
// use Ramsey\Uuid\Uuid;

$app->group('/cartera/{token}', function () use ($app) {

    $app->get('/deu', function (Request $req, Response $res) {
        $ficha_id = $req->getQueryParams();
        if (!isset($deudor_id['id'])) {
            return $res->withRedirect($this->router->pathFor('dashboard'));
        }

        $deuModel = new DeudorModel;
        $deudor = $deuModel->find('id', '=', $deudor['id_deudor']);
        if (!$deudor) {
            return $res->withRedirect($this->router->pathFor('dashboard'));
        }
        $ctx = [
        
            'deudor' => $deudor
        ];
        return json_encode($ctx);
    });


    $app->get('/deudor/add', function (Request $req, Response $res, $args) {
        $carteraModel = new CarteraModel;
        $gestorModel = new GestorModel;
        $gestores = $gestorModel->all();
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
        return $this->view->render($res, 'deudor/add.html', [
            'object' => $cartera,
            'gestores' => $gestores
        ]);
    })->setName('deudor_add_get');

    $app->post('/deudor/add', function (Request $req, Response $res, $args) {
        $carteraModel = new CarteraModel;
        $deudorModel = new DeudorModel;
        $carteDeudorModel = new CarteraDeudorCoDeudor;
        $gestorModel = new GestorModel;
        $gestores = $gestorModel->all();
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));

        $post = $req->getParsedBody();
        $codigo = (isset($post['codigo'])) ? $post['codigo'] : '';
        $typedocument = (isset($post['typedocument'])) ? $post['typedocument'] : '';
        $document = (isset($post['document'])) ? $post['document'] : '';
        $name = (isset($post['name'])) ? $post['name'] : '';
        $last_name = (isset($post['last_name'])) ? $post['last_name'] : '';
        $tlf = (isset($post['tlf'])) ? $post['tlf'] : '';
        $address = (isset($post['address'])) ? $post['address'] : '';
        $gestor = (isset($post['gestor'])) ? $post['gestor'] : '';

        if (
            !$codigo || !$typedocument || !$document || !$name ||
            !$last_name || !$tlf || !$address || !$gestor
        ) {
            return $this->view->render($res, 'deudor/add.html', [
                'object' => $cartera,
                'deudor' => $post,
                'msg' => "Algunos Campos Son Requeridos",
                'gestores' => $gestores
            ]);
        }

        $find_deudor = $deudorModel->find('documento', '=', $document);
        if ($find_deudor) {
            $exist_deudor_on_cartera = $deudorModel->findDeudorOnCartera(
                $cartera['id'],
                $find_deudor['id']
            );
            if ($exist_deudor_on_cartera) {
                return $this->view->render($res, 'deudor/add.html', [
                    'object' => $cartera,
                    'deudor' => $post,
                    'msg' => "Deudor Ya Esta Registrado Con Este Acreedor",
                    'gestores' => $gestores
                ]);
            }
            $save_id = $find_deudor['id'];
        } else {
            $deudorModel->codigo_deudor = $codigo;
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
        $carteDeudorModel->id_gestor = $gestor;
        $carteDeudorModel->save();
        return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
    });

    $app->map(['GET', 'POST'], '/{id}/codeudor/add', function (Request $req, Response $res, $args) {
        $method = $this->request->getMethod();
        $carteraModel = new CarteraModel;
        $deudorModel = new DeudorModel;
        $codeudorModel = new CoDeudorModel;
        $carteDeudorModel = new CarteraDeudorCoDeudor;
        $cartera = $carteraModel->find('token', '=', $args['token']);
        $deudor = $deudorModel->find('id', '=', $args['id']);
        if (!$cartera || !$deudor) return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
        $ctx = [];
        $ctx['cartera'] = $cartera;
        $ctx['deudor'] = $deudor;

        if ($method == 'GET') {
            return $this->view->render($res, 'deudor/co_add.html', $ctx);
        }

        $post = $req->getParsedBody();
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
            $ctx['codeudor'] = $post;
            $ctx['msg'] = "Algunos Campos Son Requeridos";
            return $this->view->render($res, 'deudor/co_add.html', $ctx);
        }

        $find_codeudor = $codeudorModel->find('documento', '=', $document);
        if ($find_codeudor) {
            $exist_deudor_on_cartera = $codeudorModel->findCoDeudorOnCartera(
                $cartera['id'],
                $deudor['id'],
                $find_codeudor['id']
            );
            if ($exist_deudor_on_cartera) {
                $ctx['codeudor'] = $post;
                $ctx['msg'] = "CoDeudor Ya Esta Registrado Con Este Deudor";
                return $this->view->render($res, 'deudor/co_add.html', $ctx);
            }
            $save_id = $find_codeudor['id'];
        } else {
            $codeudorModel->tipodocumento = $typedocument;
            $codeudorModel->documento = $document;
            $codeudorModel->nombre = $name;
            $codeudorModel->apellido = $last_name;
            $codeudorModel->telefono = $tlf;
            $codeudorModel->direccion = $address;
            $save_id = $codeudorModel->save();
        }
        $carteDeudorModel->id_cartera = $cartera['id'];
        $carteDeudorModel->id_deudor = $deudor['id'];
        $carteDeudorModel->id_codeudor = $save_id;
        $carteDeudorModel->save();
        return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
    })->setName('codeudor_add');

    $app->map(['GET', 'POST'], '/{id}/factura/add', function (Request $req, Response $res, $args) {
        $method = $this->request->getMethod();
        $carteraModel = new CarteraModel;
        $deudorModel = new DeudorModel;
        $facturaModel = new FacturaModel;

        $cartera = $carteraModel->find('token', '=', $args['token']);
        $deudor = $deudorModel->find('id', '=', $args['id']);
        if (!$cartera || !$deudor) return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));

        $ctx = [];
        $ctx['cartera'] = $cartera;
        $ctx['deudor'] = $deudor;

        if ($method == 'GET') {
            return $this->view->render($res, 'deudor/factura_add.html', $ctx);
        }

        $post = $req->getParsedBody();
        $titulo = (isset($post['titulo'])) ? $post['titulo'] : '';
        $capital = (isset($post['capital'])) ? $post['capital'] : 0;
        $interes = (isset($post['interes'])) ? $post['interes'] : 0;
        $honorarios = (isset($post['honorarios'])) ? $post['honorarios'] : 0;
        $gastos = (isset($post['gastos'])) ? $post['gastos'] : 0;
        $descuento = (isset($post['descuento'])) ? $post['descuento'] : 0;
        $sancion = (isset($post['sancion'])) ? $post['sancion'] : 0;
        $observaciones = (isset($post['observacion'])) ? $post['observacion'] : '';

        // var_dump($post);
        // die();

        if (
            !$titulo || !$capital || !$interes || !$honorarios ||
            !$gastos || !$descuento || !$sancion
        ) {
            $ctx['factura'] = $post;
            $ctx['msg'] = "Algunos Campos Requerido";
            return $this->view->render($res, 'deudor/factura_add.html', $ctx);
        }


        $per_capital = floatval($capital);
        $per_interes = ($capital * floatval($interes)) / 100;
        $per_honorarios = ($capital * floatval($honorarios)) / 100;
        $per_gastos = ($capital * floatval($gastos)) / 100;
        $per_descuento = ($capital * floatval($descuento)) / 100;
        $per_sancion = ($capital * floatval($sancion)) / 100;
        $total = $per_capital + $per_interes + $per_honorarios + $per_gastos + $per_descuento + $per_sancion;
    
        $facturaModel->titulo = $titulo;
        $facturaModel->capital = $capital;
        $facturaModel->interes = $interes;
        $facturaModel->honorarios = $honorarios;
        $facturaModel->gastos = $gastos;
        $facturaModel->descuento = $descuento;
        $facturaModel->sancion = $sancion;
        $facturaModel->total = $total;
        $facturaModel->id_deudor = $deudor['id'];
        $facturaModel->id_cartera = $cartera['id'];
        $facturaModel->estado = 0;
        $save_id = $facturaModel->save();

        if ($observaciones){
            foreach ($observaciones as $observacion) {
                $observacionesFacturaModel = new ObservacionesFacturaModel;
                $observacionesFacturaModel->id_ficha = $save_id;
                $observacionesFacturaModel->observacion = $observacion;
                $observacionesFacturaModel->save();          
            }
        }
        return $res->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $args['token']]));
    })->setName('factura_add');
})->add($checkUserNotAuthenticated);
