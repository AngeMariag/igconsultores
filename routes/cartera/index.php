<?php

use\models\{AcreedorModel, CarteraModel, DocumentoCarteraModel,
            DeudorModel, CoDeudorModel};

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
        $ctx = [];

        // validando si el token sea correcto de lo contrario lo redirije al token
        $cartera = $carteraModel->find('token', '=', $args['token']);
        if (!$cartera) return $response->withRedirect($this->router->pathFor('dashboard'));

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



        // var_dump($ctx[0]);
        // die();
        return $this->view->render($response, 'cartera/detail.html', $ctx);
    })->setName('acreedor_detail_get');
})->add($checkUserNotAuthenticated);
