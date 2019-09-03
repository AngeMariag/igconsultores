<?php
include '../../conexion.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$cn->query("SET NAMES 'utf8'");

if (isset($_POST['btn-enviar'])) {
    $id = $_POST['id'];
    $token = $_POST['token'];

    $query_find_cartera = "SELECT * FROM cartera WHERE token='{$token}' and id_acreedor={$id}";
    $cartera = mysqli_fetch_assoc($cn->query($query_find_cartera));

    if (!$cartera) {
        return header("Location: ../../menus.php?op=aggdatos&id={$id}&cartera={$token}");
    }

    // deudor
    $codigo_deudor = $_POST['codigo_deudor'];
    $tipodocumento_deudor = $_POST['tipodocumento_deudor'];
    $documento_deudor = $_POST['documento_deudor'];
    $nombre_deudor = $_POST['nombre_deudor'];
    $apellido_deudor = $_POST['apellido_deudor'];
    $telefono_deudor = $_POST['telefono_deudor'];
    $direccion_deudor = $_POST['direccion_deudor'];

    // codeudor 1
    $tipodocumento_codeudor_1 = $_POST['tipodocumento_codeudor_1'];
    $documento_codeudor_1 = $_POST['documento_codeudor_1'];
    $nombre_codeudor_1 = $_POST['nombre_codeudor_1'];
    $apellido_codeudor_1 = $_POST['apellido_codeudor_1'];
    $telefono_codeudor_1 = $_POST['telefono_codeudor_1'];
    $direccion_codeudor_1 = $_POST['direccion_codeudor_1'];

    // codeudor 2
    $tipodocumento_codeudor_2 = $_POST['tipodocumento_codeudor_2'];
    $documento_codeudor_2 = $_POST['documento_codeudor_2'];
    $nombre_codeudor_2 = $_POST['nombre_codeudor_2'];
    $apellido_codeudor_2 = $_POST['apellido_codeudor_2'];
    $telefono_codeudor_2 = $_POST['telefono_codeudor_2'];
    $direccion_codeudor_2 = $_POST['direccion_codeudor_2'];

    // ficha 
    $titulo = $_POST['titulo'];
    $capital = $_POST['capital'];
    $interes = $_POST['interes'];
    $honorarios = $_POST['honorarios'];
    $gastos = $_POST['gastos'];
    $descuento = $_POST['descuento'];
    $sancion = $_POST['sancion'];
    $total = $_POST['total'];

    // gestor
    $gestor = $_POST['gestor'];

    // obsevaciones
    $observaciones = isset($_POST['observacion']) ? $_POST['observacion'] : [];

    $query_find_deudor = "SELECT * FROM deudor WHERE codigo='{$codigo_deudor}' and documento='{$documento_deudor}'";
    $query_find_codeudor1 = "SELECT * FROM codeudor WHERE documento='{$documento_codeudor_1}'";
    $query_find_codeudor2 = "SELECT * FROM codeudor WHERE documento='{$documento_codeudor_2}'";

    $query_deudor = "INSERT INTO 
                    deudor(codigo, tipodocumento, documento, nombre, apellido, telefono, direccion) 
                    VALUES ('{$codigo_deudor}','{$tipodocumento_deudor}','{$documento_deudor}','{$nombre_deudor}','{$apellido_deudor}','{$telefono_deudor}','{$direccion_deudor}')";

    // vamos a ver si funciona
    // $id_d = mysqli_insert_id($cn);
    $query_codeudor1 = "INSERT INTO 
                    codeudor(tipodocumento, documento, nombre, apellido, telefono, direccion) 
                    VALUES ('{$tipodocumento_codeudor_1}','{$documento_codeudor_1}','{$nombre_codeudor_1}','{$apellido_codeudor_1}','{$telefono_codeudor_1}','{$direccion_codeudor_1}')";
    $query_codeudor2 = "INSERT INTO 
                    codeudor(tipodocumento, documento, nombre, apellido, telefono, direccion) 
                    VALUES ('{$tipodocumento_codeudor_2}','{$documento_codeudor_2}','{$nombre_codeudor_2}','{$apellido_codeudor_2}','{$telefono_codeudor_2}','{$direccion_codeudor_2}')";

    $deudor = mysqli_fetch_assoc($cn->query($query_find_deudor));
    if ($deudor) {
        $deudor_id = $deudor['id'];
    } else {
        $cn->query($query_deudor) or die(mysqli_error($cn));
        $deudor_id = $cn->insert_id;
    }

    $query_car_deudor = "INSERT INTO cartera_deudor_codeudor(id_cartera, id_deudor, id_gestor) 
                    VALUES ('{$cartera["id"]}', '{$deudor_id}', '{$gestor}')";

    $query_ficha = $cn->query("INSERT INTO 
                    ficha(titulo, capital, interes, honorarios, gastos, descuento, sancion, total, id_deudor, id_cartera, estado) 
                    VALUES ('{$titulo}','{$capital}','{$interes}','{$honorarios}','{$gastos}','{$descuento}','{$sancion}','{$total}','{$deudor_id}','{$cartera["id"]}', '1')");


    $id_ficha = mysqli_insert_id($cn);  
    // INSERTO FICHA
    foreach($_POST['observacion'] as $observaciones) 
                    $sql2=$cn->query("INSERT INTO  observaciones_ficha (id_ficha, observacion) VALUES ('$id_ficha', '$observaciones')");
    
   // INSERTO DOCUMENTOS 
    $dgenerales = explode(".",$_FILES['documentos_general']['name']);

        for($i = 0; $i < count($_POST['ndocumento']); $i++)
    {
    $documentoa=$cn->query("INSERT INTO documentos_cartera (nombre, ruta, ubicacion_documento, id_ficha) VALUES ('" . $_POST['ndocumento'][$i] . "','documentos/".$_FILES['documentos_general']['name'][$i]."','" . $_POST['ubicacion_documento'][$i] . "', '$id_ficha')")or die(mysqli_error($cn));  
    move_uploaded_file($_FILES['documentos_general']['tmp_name'][$i],"../../documentos/".$_FILES['documentos_general']['name'][$i]);
    }

    $cn->query($query_car_deudor) or die(mysqli_error($cn));
    if (
        $tipodocumento_codeudor_1 &&
        $documento_codeudor_1 &&
        $nombre_codeudor_1 &&
        $apellido_codeudor_1 &&
        $telefono_codeudor_1 &&
        $direccion_codeudor_1
    ) {
        $codeudor1 = mysqli_fetch_assoc($cn->query($query_find_codeudor1));
        if ($codeudor1) {
            $codeudor1_id = $codeudor1['id'];
        } else {
            $cn->query($query_codeudor1) or die(mysqli_error($cn));
            $codeudor1_id = $cn->insert_id;
        }
        $query_car_codeudor1 = "INSERT INTO cartera_deudor_codeudor(id_cartera, id_deudor, id_codeudor) 
                    VALUES ('{$cartera["id"]}', '{$deudor_id}', '{$codeudor1_id}')";
        $cn->query($query_car_codeudor1) or die(mysqli_error($cn));
    }
    if (
        $tipodocumento_codeudor_2 &&
        $documento_codeudor_2 &&
        $nombre_codeudor_2 &&
        $apellido_codeudor_2 &&
        $telefono_codeudor_2 &&
        $direccion_codeudor_2
    ) {
        $codeudor2 = mysqli_fetch_assoc($cn->query($query_find_codeudor2));
        if ($codeudor2) {
            $codeudor2_id = $codeudor2['id'];
        } else {
            $cn->query($query_codeudor2) or die(mysqli_error($cn));
            $codeudor2_id = $cn->insert_id;
        }
        $query_car_codeudor2 = "INSERT INTO cartera_deudor_codeudor(id_cartera, id_deudor, id_codeudor) 
                    VALUES ('{$cartera["id"]}', '{$deudor_id}', '{$codeudor2_id}')";
        $cn->query($query_car_codeudor2) or die(mysqli_error($cn));
    }
   
    return header("Location: ../../menus.php?op=aggdatos&id={$id}&cartera={$token}");
}
