<?php 

require('../../conexion.php');
$cn->query("SET NAMES 'utf8'");

if (isset($_POST['btn-save'])) {
	$id = $_POST['id'];
	$monto = $_POST['monto'];
	$sql = $cn->query("INSERT INTO gestion (gestion, fecha, monto, estado, id_ficha) VALUES "."('$_POST[gestion]','$_POST[fecha]', '$monto','$_POST[estado]', '$id')") OR DIE (mysqli_error($cn));	

	echo "listo";
}else{
	echo "algo esta mal";
}


 ?>