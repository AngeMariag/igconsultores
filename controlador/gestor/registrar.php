<?php 

require('../../conexion.php');

// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
// $cn->query("SET NAMES 'utf8'");


if (isset($_POST['btn-save'])) {
	$gestion = $_POST['gestion'];
    $monto = $_POST['monto'];
   $fecha = date("y-m-d");
    $id = $_POST['id'];
    
	$sql=$cn->query("INSERT INTO gestion (gestion, monto, fecha, estado, id_ficha) VALUES ('$gestion','$monto', '$fecha', '" . $_POST['estado'] . "', '$id')")OR DIE(mysqli_error($cn));
	$cn->query($sql) or die(mysqli_error($cn));
	
	echo "okis";
}else{
	echo "HUBO UN PROBLEMA AL INSERTAR LOS DATOS, POR FAVOR VUELVE A REGISTRAR LA GESTIÓN";
}


 ?>