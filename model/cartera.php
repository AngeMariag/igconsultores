<?php

namespace models;

use utils\bd\bd\Model;

class AcreedorModel extends Model
{
    protected static $table = "acreedor";

    public function search_by_document_or_name($q){
        $query = "SELECT * FROM acreedor WHERE documento = '{$q}' or razon_social LIKE '%{$q}%'";
        return $this->execute_query($query);
    }
}