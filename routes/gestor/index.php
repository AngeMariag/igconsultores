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

use models\{FacturaModel, GestionModel, RecordatoriosModel};

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
    $id = (isset($post['id'])) ? $post['id'] : '';
    $acuerdo = (isset($post['acuerdo'])) ? $post['acuerdo'] : '';
    $observaciones = (isset($post['observacion'])) ? $post['observacion'] : [];
    $monto = (isset($post['monto'])) ? $post['monto'] : [];
    $fecha_pago = (isset($post['fecha_pago'])) ? $post['fecha_pago'] : [];
    $estatus = (isset($post['estatus'])) ? $post['estatus'] : [];
    $fecha_gestion = (isset($post['fecha_gestion'])) ? $post['fecha_gestion'] : '';
    $gestion = (isset($post['gestion'])) ? $post['gestion'] : '';

    $count_total = count($observaciones);
    if (
        count($observaciones) == $count_total || count($monto) == $count_total ||
        count($fecha_pago) == $count_total || count($estatus) == $count_total
    ) {
        $gestion_array = [];
        for ($i=0; $i < $count_total; $i++) { 
            array_push($gestion_array, [
                'acuerdo' => $acuerdo,
                'observacion' => $observaciones[$i],
                'monto' => $monto[$i],
                'fecha' => $fecha_pago[$i],
                'estatus' => $estatus[$i]
            ]);
        }
        foreach ($gestion_array as $gestions) {
            $gestionModel = new GestionModel;
            $gestionModel->acuerdo = $gestions['acuerdo'];
            $gestionModel->gestion = $gestions['observacion'];
            $gestionModel->fecha = $gestions['fecha'];
            $gestionModel->monto = $gestions['monto'];
            $gestionModel->estado = $gestions['estatus'];
            $gestionModel->id_ficha = $id;
            $gestionModel->save();
        }
    }

    if ($fecha_gestion != '' && $gestion != ''){
        $recordatoriosModel = new RecordatoriosModel;
        $recordatoriosModel->fecha = $fecha_gestion;
        $recordatoriosModel->recordatorio = $gestion;
        $recordatoriosModel->id_ficha = $id;
        $recordatoriosModel->save();

    }
    return $res->withRedirect($this->router->pathFor('dashboard'));
})->setName('gestion_add_post');
