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

$app->post('gestion/new', function (Request $req, Response $res) {
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
