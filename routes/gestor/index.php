<?php

// use\models\{
//     AcreedorModel,
//     CarteraModel,
//     DocumentoCarteraModel,
//     DeudorModel,
//     CoDeudorModel,
//     GestorModel,
//     FacturaModel,
//     CarteraDeudorCoDeudor,
//     ObservacionesFacturaModel
// };

use Slim\Http\Request;
use Slim\Http\Response;

use models\FacturaModel;

$app->get('/gestion/ficha', function(Request $req, Response $res) {
    $ficha_id = $req->getQueryParams();
    if (!isset($ficha_id['id'])){
        return $res->withRedirect($this->router->pathFor('dashboard'));
    }

    $fichaModel = new FacturaModel;
    $ficha = $fichaModel->find('id', '=', $ficha_id['id']);
    if (!$ficha){
        return $res->withRedirect($this->router->pathFor('dashboard'));
    }
    return json_encode($ficha);
});

$app->post('/gestion/new', function (Request $req, Response $res) {
    $post = $req->getParsedBody();
    $acuerdo = (isset($post['acuerdo'])) ? $post['acuerdo'] : '';
    $observacion = (isset($post['observacion'])) ? $post['observacion'] : [];
    $monto = (isset($post['monto'])) ? $post['monto'] : [];
    $fecha_pago = (isset($post['fecha_pago'])) ? $post['fecha_pago'] : [];
    $estatus = (isset($post['estatus'])) ? $post['estatus'] : [];
    $fecha_gestion = (isset($post['fecha_gestion'])) ? $post['fecha_gestion'] : '';
    $gestion = (isset($post['gestion'])) ? $post['gestion'] : '';

    $count_total = count($observacion);
    if (
        count($observacion) != $count_total || count($monto) != $count_total ||
        count($fecha_pago) != $count_total || count($estatus) != $count_total
    ) {
        
     }
});
