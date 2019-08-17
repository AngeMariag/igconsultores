<?php

namespace models;

use utils\bd\bd\Model;

class GestorModel extends Model
{
    protected static $table = "gestor";

    public function getDataTableGestor($codigo)
    {   
        $table = static::$table;
        $query = "SELECT ficha.id, gestor.codigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social FROM {$table}
            LEFT JOIN cartera_deudor_codeudor as car
            ON car.id_gestor=gestor.id
            LEFT JOIN deudor 
            ON car.id_deudor=deudor.id
            LEFT JOIN cartera
            ON cartera.id=car.id_cartera
            LEFT JOIN acreedor
            ON acreedor.id=cartera.id_acreedor
            LEFT JOIN ficha
            ON ficha.id_cartera=cartera.id and ficha.id_deudor=deudor.id
            WHERE codigo = {$codigo}";
        return $this->execute_query($query);
    }

    public function getDataSearchGestorByDocumentDeudor($documento)
    {   
        $table = static::$table;
        $query = "SELECT ficha.id, gestor.codigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social FROM {$table}
            LEFT JOIN cartera_deudor_codeudor as car
            ON car.id_gestor=gestor.id
            LEFT JOIN deudor 
            ON car.id_deudor=deudor.id
            LEFT JOIN cartera
            ON cartera.id=car.id_cartera
            LEFT JOIN acreedor
            ON acreedor.id=cartera.id_acreedor
            LEFT JOIN ficha
            ON ficha.id_cartera=cartera.id and ficha.id_deudor=deudor.id
            WHERE deudor.documento LIKE '{$documento}%' OR deudor.nombre LIKE '{$documento}%'";
        return $this->execute_query($query);
    }

    public function getDataSearchGestorByNameAcreedor($name)
    {   
        $table = static::$table;
        $query = "SELECT ficha.id, gestor.codigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social FROM {$table}
            LEFT JOIN cartera_deudor_codeudor as car
            ON car.id_gestor=gestor.id
            LEFT JOIN deudor 
            ON car.id_deudor=deudor.id
            LEFT JOIN cartera
            ON cartera.id=car.id_cartera
            LEFT JOIN acreedor
            ON acreedor.id=cartera.id_acreedor
            LEFT JOIN ficha
            ON ficha.id_cartera=cartera.id and ficha.id_deudor=deudor.id
            WHERE acreedor.razon_social LIKE '{$name}%'";
        return $this->execute_query($query);
    }
}


class GestionModel extends Model
{
    protected static $table = "gestion";

    public function allGestion()
    {
        $query = "SELECT  gestion.id, gestion.acuerdo, gestion.gestion, gestion.fecha, gestion.monto, gestion.estado, ficha.total FROM gestion 
        LEFT JOIN ficha
        ON ficha.id = gestion.id_ficha";
        return $this->execute_query($query);
    }
}

class RecordatoriosModel extends Model
{
    protected static $table = "recordatorios";

    public function allRecordatorios()
    {
        $query = "SELECT recordatorios.recordatorio, recordatorios.fecha, recordatorios.id, deudor.nombre, deudor.apellido, deudor.telefono, deudor.tipodocumento, deudor.documento FROM recordatorios
        LEFT JOIN ficha
        ON ficha.id=recordatorios.id_ficha
        LEFT JOIN deudor
        ON deudor.id=ficha.id_deudor";
        return $this->execute_query($query);
    }
}