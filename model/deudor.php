<?php

namespace models;

use utils\bd\bd\Model;

class DeudorModel extends Model
{
    protected static $table = "deudor";

    public function findManyDeudor($id_cartera)
    {
        $query = "SELECT d.id, d.nombre, d.apellido, d.codigo, d.tipodocumento, 
            d.documento, d.telefono, d.direccion, g.codigo as gcodigo,
            g.nombre as gnombre, g.apellido as gapellido  FROM deudor as d
            LEFT JOIN cartera_deudor_codeudor as car
            ON d.id = car.id_deudor
            LEFT JOIN gestor as g 
            ON car.id_gestor = g.id
            WHERE car.id_cartera = {$id_cartera} AND car.id_codeudor is Null ";
        return $this->execute_query($query);
    }

    public function findDeudorOnCartera($id_cartera, $id_deudor)
    {
        $query = "SELECT * FROM cartera_deudor_codeudor 
            WHERE id_cartera = {$id_cartera} and id_deudor = {$id_deudor} and 
            id_codeudor is Null";
        return $this->execute_query($query);
    }
}


class CoDeudorModel extends Model
{
    protected static $table = "codeudor";

    public function findManyCoDeudor($id_cartera, $id_deudor)
    {
        $query = "SELECT co.id, co.nombre, co.apellido, co.tipodocumento, 
            co.documento, co.telefono, co.direccion 
            FROM codeudor as co
            LEFT JOIN cartera_deudor_codeudor as car
            ON car.id_codeudor=co.id
            WHERE car.id_cartera={$id_cartera} AND car.id_deudor={$id_deudor}";
        return $this->execute_query($query);
    }

    public function findCoDeudorOnCartera($id_cartera, $id_deudor, $id_codeudor)
    {
        $query = "SELECT * FROM cartera_deudor_codeudor 
            WHERE id_cartera = {$id_cartera} and id_deudor = {$id_deudor} and 
            id_codeudor = {$id_codeudor}";
        return $this->execute_query($query);
    }
}

class CarteraDeudorCoDeudor extends Model 
{
    protected static $table = "cartera_deudor_codeudor";
}
