<?php

namespace models;

use utils\bd\bd\Model;

class GestorModel extends Model
{
    protected static $table = "gestor";

    public function getDataTableGestor($codigo)
    {   
        $table = static::$table;
        $query = "SELECT gestor.codigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social FROM {$table}
            LEFT JOIN cartera_deudor_codeudor as car
            ON car.id_gestor=gestor.id
            LEFT JOIN deudor 
            ON car.id_deudor=deudor.id
            LEFT JOIN cartera
            ON cartera.id=car.id_cartera
            LEFT JOIN acreedor
            ON acreedor.id=cartera.id_acreedor
            WHERE codigo = {$codigo}";
        return $this->execute_query($query);


     
    }
}
