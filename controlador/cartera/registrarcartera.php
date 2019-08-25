<?php 

$id= $_POST['id'];

// echo ($id);
include '../../conexion.php';

if (isset($_POST['btn-guardar-cartera'])) {
	$cartera=$cn->query("INSERT INTO cartera (id_acreedor,fecha) VALUES ('$id','$_POST[fecha]')") OR DIE(mysqli_error($cn));
	
}


 ?>