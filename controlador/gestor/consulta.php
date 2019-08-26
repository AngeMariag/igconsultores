<?php 


include '../../conexion.php';

$id = $_GET['id'];


$query = "SELECT  gestion.id, gestion.acuerdo, gestion.gestion, gestion.fecha, gestion.monto, gestion.estado, ficha.total FROM gestion 
        LEFT JOIN ficha
        ON ficha.id = gestion.id_ficha";
        return $this->execute_query($query);



 // $ficha_id = $req->getQueryParams();
        if (!isset($ficha_id['id'])) {
            return $res->withRedirect($this->router->pathFor('dashboard'));
        }

        $fichaModel = new FacturaModel;
        $ficha = $fichaModel->find('id', '=', $ficha_id['id']);
        if (!$ficha) {
            return $res->withRedirect($this->router->pathFor('dashboard'));
        }
        $deudorModel = new DeudorModel;
        $deudor = $deudorModel->find('id', '=', $ficha['id_deudor']);
        if (!$deudor) {
            return $res->withRedirect($this->router->pathFor('dashboard'));
        }
        $ctx = [
            'ficha' => $ficha,
            'deudor' => $deudor
        ];
        return json_encode($ctx);
    // });
	
 ?>