<?php 

require ("../../conexion.php");
$cn->query("SET NAMES 'utf8'");


if (isset($_POST['btn-save'])) {


    $gestion = $_POST['gestion'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $id = $_POST['id'];
    
	$sql=$cn->query("INSERT INTO gestion (gestion, monto, fecha, estado, id_ficha) VALUES ('$gestion','$monto', '$fecha', 'estado', '$id')")OR DIE(mysqli_error($cn));
	$cn->query($sql) or die(mysqli_error($cn));
	
	// header("Location: listgestion.php");
}else{
	echo "algo pasa";
}


 ?>