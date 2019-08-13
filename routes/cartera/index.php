<?php

use\models\{
    AcreedorModel,
    CarteraModel,
    DocumentoCarteraModel,
    DeudorModel,
    CoDeudorModel,
    GestorModel,
    FacturaModel,
    CarteraDeudorCoDeudor,
    ObservacionesFacturaModel
};

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

$app->group('/cartera', function () use ($app) {

    // listado de acreedores 
    $app->get('', function ($request, $response) {
        $cartera = new CarteraModel;
        $doc_cartera = new DocumentoCarteraModel;
        $acredor = new AcreedorModel();
        $arg = [];
        $re = $request->getQueryParams();
        if (isset($re['q']) && $re['q'] != '') {
            $q = $request->getQueryParams()['q'];
            $cartera_search = $cartera->find('token', '=', $q);
            if (!$cartera_search) {
                $result = $acredor->search_by_document_or_name($q)[0];
                if (!$result) {
                    $arg["msg"] = "No hay concurrencia con el dato {$q}";
                } else {
                    try {
                        $data = [];
                        $car = $cartera->find('id_acreedor', '=', $result['id']);
                        $docu_cartera = $doc_cartera->where('id_cartera', '=', $car['id']);
                        array_push(
                            $data,
                            [
                                'cartera' => $car,
                                'acreedor' => $result,
                                'docs' => $docu_cartera
                            ]
                        );
                        $arg['carteras'] = $data;
                        return $this->view->render($response, 'cartera/list.html', $arg);
                    } catch (Exception $e) {
                        $arg["msg"] = "No hay concurrencia con el dato {$q}";
                    }
                }
            } else {
                $data = [];
                $acreedor = $acredor->find('id', '=', $cartera_search['id_acreedor']);
                $docu_cartera = $doc_cartera->where('id_cartera', '=', $cartera_search['id']);
                array_push(
                    $data,
                    [
                        'cartera' => $cartera_search,
                        'acreedor' => $acreedor,
                        'docs' => $docu_cartera
                    ]
                );
                $arg['carteras'] = $data;
                return $this->view->render($response, 'cartera/list.html', $arg);
            }
        }
        // aqui en el metodo paginate puedes pasar un numero 
        // esto es para saber cuanto datos se mostraran en pantalla
        $carteras = $cartera->paginate();
        $data = [];
        if ($carteras) {
            foreach ($carteras[0] as $cartera) {
                $acreedor = $acredor->find('id', '=', $cartera['id_acreedor']);
                $docu_cartera = $doc_cartera->where('id_cartera', '=', $cartera['id']);
                array_push(
                    $data,
                    [
                        'cartera' => $cartera,
                        'acreedor' => $acreedor,
                        'docs' => $docu_cartera
                    ]
                );
            }
        }
        $arg['carteras'] = $data;
        $arg['paginate'] = $carteras[1];
        return $this->view->render($response, 'cartera/list.html', $arg);
    })->setName('cartera_list');

    // vista para ejecutar el guardado del acreedor
    $app->post('/new', function (Request $request, Response $response) {
        $files = $request->getUploadedFiles();
        $post = $request->getParsedBody();

        $typedocument = $post['typedocument'];
        $document = $post['document'];
        $name = $post['name'];
        $name_file = $post['name_file'];
        $date = $post['date'];
        if (!$date) {
            $date = date("Y-m-d");
        }

        $base_url = $request->getUri()->getBasePath() . '/media';
        $doc_cartera_array = [];
        sessionLocal('acreedor', [
            'typedocument' => $typedocument,
            'document' => $document,
            'name' => $name,
            'date' => $date,
        ]);

        if ($name_file && $files['file_upload']) {
            if (count($name_file) != count($files['file_upload'])) {
                $this->flash->addMessage('error', 'Problema en la subida de los archivos Intente de Nuevo');
                return $response->withRedirect($this->router->pathFor('cartera_list'));
            }
            for ($i = 0; $i < count($name_file); $i++) {
                array_push($doc_cartera_array, [
                    'name' => $name_file[$i],
                    'file' => $files['file_upload'][$i]
                ]);
            }
        }

        if (!$typedocument || !$document || !$name || !$date) {
            $this->flash->addMessage('error', 'Algunos Campos son Requeridos Intente de Nuevo');
            return $response->withRedirect($this->router->pathFor('cartera_list'));
        }
        $cartera = new CarteraModel;
        $acreedor = new AcreedorModel;

        $find = $acreedor->find('documento', '=', $document);
        if (!$find) {
            $acreedor->tipo_documento = $typedocument;
            $acreedor->documento = $document;
            $acreedor->razon_social = $name;
            $acredor_id = $acreedor->save();
            $acredor_find = $acredor_id;
        } else {
            $acredor_find = $find['id'];
        }
        $token = Uuid::uuid4()->toString();
        $cartera->token = $token;
        $cartera->id_acreedor = $acredor_find;
        $cartera->fecha = date("Y-m-d", strtotime($date));
        $cartera_id = $cartera->save();

        if ($name_file && $files['file_upload']) {
            $directory = $this->get('upload_directory');
            foreach ($doc_cartera_array as $doc) {
                $file = $doc['file'];
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $file);
                    $doc_cartera = new DocumentoCarteraModel;
                    $doc_cartera->nombre = $doc['name'];
                    $doc_cartera->ruta = "{$base_url}/{$filename}";
                    $doc_cartera->id_cartera = $cartera_id;
                    $doc_cartera->save();
                }
            }
        }
        unset($_SESSION['acreedor']);
        return $response->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $token]));
    })->setName('cartera_new_post');

    // get data acreedor
    $app->get('/api/get-user', function (Request $request, Response $response) {
        $re = $request->getQueryParams();
        $document = $re['document'];
        $acree = new AcreedorModel;
        $acredor = $acree->find('documento', '=', $document);
        if (!$acredor) {
            return json_encode(['status' => false]);
        }
        return json_encode([
            'status' => true,
            'user' => json_encode($acredor)
        ]);
    })->setName('cartera_api_get_user');

    // view detail of cartera
    $app->get('/{token}/detail', function (Request $request, Response $response, $args) {
        $carteraModel = new CarteraModel;
        $docCarteraModel = new DocumentoCarteraModel;
        $acreedorModel = new AcreedorModel;
        $deudorModel = new DeudorModel;
        $coDeudorModel = new CoDeudorModel;
        $gestorModel = new GestorModel;
        $ctx = [];

        // validando si el token sea correcto de lo contrario lo redirije al token
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $response->withRedirect($this->router->pathFor('dashboard'));

        $gestores = $gestorModel->all();
        $acreedor = $acreedorModel->find('id', '=', $cartera['id_acreedor']);
        $docu_cartera = $docCarteraModel->where('id_cartera', '=', $cartera['id']);
        $deudores = $deudorModel->findManyDeudor($cartera['id']);
        $data = [];

        foreach ($deudores as $deudor) {
            $coDeudor = $coDeudorModel->findManyCoDeudor($cartera['id'], $deudor['id']);
            array_push($data, [
                'deudor' => $deudor,
                'codeudores' => $coDeudor,
            ]);
        }

        $ctx['cartera'] = $cartera;
        $ctx['acreedor'] = $acreedor;
        $ctx['docs'] = $docu_cartera;
        $ctx['deudores'] = $data;
        $ctx['gestores'] = $gestores;

        return $this->view->render($response, 'cartera/detail.html', $ctx);
    })->setName('acreedor_detail_get');

    $app->post('/{token}/detail', function (Request $request, Response $response, $args) {
        $carteraModel = new CarteraModel;
        $deudorModel = new DeudorModel;
        $codeudorModel = new CoDeudorModel;
        $facturaModel = new FacturaModel;
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $response->withRedirect($this->router->pathFor('dashboard'));
        $post = $request->getParsedBody();

        // deudor
        $typedocument_deudor = (isset($post['typedocument_deudor'])) ? $post['typedocument_deudor'] : '';
        $document_deudor = (isset($post['document_deudor'])) ? $post['document_deudor'] : '';
        $name_deudor = (isset($post['name_deudor'])) ? $post['name_deudor'] : '';
        $last_name_deudor = (isset($post['last_name_deudor'])) ? $post['last_name_deudor'] : '';
        $tlf_deudor = (isset($post['tlf_deudor'])) ? $post['tlf_deudor'] : '';
        $address_deudor = (isset($post['address_deudor'])) ? $post['address_deudor'] : '';
        $gestor_deudor = (isset($post['gestor_deudor'])) ? $post['gestor_deudor'] : '';

        // codeudor 1
        $typedocument_codeudor_1 = (isset($post['typedocument_codeudor_1'])) ? $post['typedocument_codeudor_1'] : '';
        $document_codeudor_1 = (isset($post['document_codeudor_1'])) ? $post['document_codeudor_1'] : '';
        $name_codeudor_1 = (isset($post['name_codeudor_1'])) ? $post['name_codeudor_1'] : '';
        $last_name_codeudor_1 = (isset($post['last_name_codeudor_1'])) ? $post['last_name_codeudor_1'] : '';
        $tlf_codeudor_1 = (isset($post['tlf_codeudor_1'])) ? $post['tlf_codeudor_1'] : '';
        $address_codeudor_1 = (isset($post['address_codeudor_1'])) ? $post['address_codeudor_1'] : '';

        // codeudor 2
        $typedocument_codeudor_2 = (isset($post['typedocument_codeudor_2'])) ? $post['typedocument_codeudor_2'] : '';
        $document_codeudor_2 = (isset($post['document_codeudor_2'])) ? $post['document_codeudor_2'] : '';
        $name_codeudor_2 = (isset($post['name_codeudor_2'])) ? $post['name_codeudor_2'] : '';
        $last_name_codeudor_2 = (isset($post['last_name_codeudor_2'])) ? $post['last_name_codeudor_2'] : '';
        $tlf_codeudor_2 = (isset($post['tlf_codeudor_2'])) ? $post['tlf_codeudor_2'] : '';
        $address_codeudor_2 = (isset($post['address_codeudor_2'])) ? $post['address_codeudor_2'] : '';

        // ficha
        $titulo = (isset($post['titulo'])) ? $post['titulo'] : '';
        $capital = (isset($post['capital'])) ? $post['capital'] : 0;
        $interes = (isset($post['interes'])) ? $post['interes'] : 0;
        $honorarios = (isset($post['honorarios'])) ? $post['honorarios'] : 0;
        $gastos = (isset($post['gastos'])) ? $post['gastos'] : 0;
        $descuento = (isset($post['descuento'])) ? $post['descuento'] : 0;
        $sancion = (isset($post['sancion'])) ? $post['sancion'] : 0;

        // observaciones
        $observaciones = (isset($post['observacion'])) ? $post['observacion'] : [];

        // var_dump($post);
        // die();
        // if (
        //     !$typedocument_deudor || !$document_deudor || !$name_deudor || !$last_name_deudor ||
        //     !$tlf_deudor || !$address_deudor || !$gestor_deudor || !$typedocument_codeudor_1 ||
        //     !$document_codeudor_1 || !$name_codeudor_1 || !$last_name_codeudor_1 || !$tlf_codeudor_1 ||
        //     !$address_codeudor_1 || !$titulo || !$capital || !$interes || !$honorarios || !$gastos ||
        //     !$descuento || !$sancion
        // ) {
        //     sessionLocal('ficha', $post);
        //     $this->flash->addMessage('error', 'Algunos Campos son Requeridos Intente de Nuevo');
        //     return $response->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $cartera['token']]));
        // }


        // sacar total de los porcentajes :D
        $per_capital = floatval($capital);
        $per_interes = ($capital * floatval($interes)) / 100;
        $per_honorarios = ($capital * floatval($honorarios)) / 100;
        $per_gastos = ($capital * floatval($gastos)) / 100;
        $per_descuento = ($capital * floatval($descuento)) / 100;
        $per_sancion = ($capital * floatval($sancion)) / 100;
        $total = $per_capital + $per_interes + $per_honorarios + $per_gastos + $per_descuento + $per_sancion;

        $find_deudor = $deudorModel->find('documento', '=', $document_deudor);
        if ($find_deudor) {
            $exist_deudor_on_cartera = $deudorModel->findDeudorOnCartera(
                $cartera['id'],
                $find_deudor['id']
            );
            if ($exist_deudor_on_cartera) {
                sessionLocal('ficha', $post);
                $this->flash->addMessage('error', 'Deudor Ya Esta Registrado Con Este Acreedor');
                return $response->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $cartera['token']]));
            }
            $save_id_deudor = $find_deudor['id'];
        } else {
            $deudorModel->tipodocumento = $typedocument_deudor;
            $deudorModel->documento = $document_deudor;
            $deudorModel->nombre = $name_deudor;
            $deudorModel->apellido = $last_name_deudor;
            $deudorModel->telefono = $tlf_deudor;
            $deudorModel->direccion = $address_deudor;
            $save_id_deudor = $deudorModel->save();
        }
        $carteDeudorModel = new CarteraDeudorCoDeudor;
        $carteDeudorModel->id_cartera = $cartera['id'];
        $carteDeudorModel->id_deudor = $save_id_deudor;
        $carteDeudorModel->id_gestor = $gestor_deudor;
        $carteDeudorModel->save();

        $find_codeudor = $codeudorModel->find('documento', '=', $document_codeudor_1);
        if ($find_codeudor) {
            $save_id_codeudor_1 = $find_codeudor['id'];
        } else {
            $codeudorModel->tipodocumento = $typedocument_codeudor_1;
            $codeudorModel->documento = $document_codeudor_1;
            $codeudorModel->nombre = $name_codeudor_1;
            $codeudorModel->apellido = $last_name_codeudor_1;
            $codeudorModel->telefono = $tlf_codeudor_1;
            $codeudorModel->direccion = $address_codeudor_1;
            $save_id_codeudor_1 = $codeudorModel->save();
        }
        $carteDeudorModel = new CarteraDeudorCoDeudor;
        $carteDeudorModel->id_cartera = $cartera['id'];
        $carteDeudorModel->id_deudor = $save_id_deudor['id'];
        $carteDeudorModel->id_codeudor = $save_id_codeudor_1;
        $carteDeudorModel->save();

        if (
            $typedocument_codeudor_2 && $document_codeudor_2 && $name_codeudor_2 &&
            $last_name_codeudor_2 && $tlf_codeudor_2 && $address_codeudor_2

        ) {
            $codeudorModel2 = new CoDeudorModel;
            $find_codeudor2 = $codeudorModel2->find('documento', '=', $document_codeudor_2);
            if ($find_codeudor2) {
                $save_id_codeudor_2 = $find_codeudor2['id'];
            } else {
                $codeudorModel->tipodocumento = $typedocument_codeudor_2;
                $codeudorModel->documento = $document_codeudor_2;
                $codeudorModel->nombre = $name_codeudor_2;
                $codeudorModel->apellido = $last_name_codeudor_2;
                $codeudorModel->telefono = $tlf_codeudor_2;
                $codeudorModel->direccion = $address_codeudor_2;
                $save_id_codeudor_2 = $codeudorModel->save();
            }
            $carteDeudorModel = new CarteraDeudorCoDeudor;
            $carteDeudorModel->id_cartera = $cartera['id'];
            $carteDeudorModel->id_deudor = $save_id_deudor['id'];
            $carteDeudorModel->id_codeudor = $save_id_codeudor_2;
            $carteDeudorModel->save();
        }

        $facturaModel->titulo = $titulo;
        $facturaModel->capital = $capital;
        $facturaModel->interes = $interes;
        $facturaModel->honorarios = $honorarios;
        $facturaModel->gastos = $gastos;
        $facturaModel->descuento = $descuento;
        $facturaModel->sancion = $sancion;
        $facturaModel->total = $total;
        $facturaModel->id_deudor = $save_id_deudor;
        $facturaModel->id_cartera = $cartera['id'];
        $facturaModel->estado = 0;
        $save_id_factura = $facturaModel->save();

        if ($observaciones) {
            foreach ($observaciones as $observacion) {
                $observacionesFacturaModel = new ObservacionesFacturaModel;
                $observacionesFacturaModel->id_ficha = $save_id_factura;
                $observacionesFacturaModel->observacion = $observacion;
                $observacionesFacturaModel->save();
            }
        }
        unset($_SESSION['ficha']);
        return $response->withRedirect($this->router->pathFor('acreedor_detail_get', ['token' => $cartera['token']]));
    });
})->add($checkUserNotAuthenticated);
