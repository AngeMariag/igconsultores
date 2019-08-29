<?php
include '../../conexion.php';

if (isset($_POST['btn-guardar-cartera'])) {
	$uploadDirectory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR;
	$url_file = "/" . explode('/', $_SERVER['REQUEST_URI'])[1] . '/media/'; 
	$id = $_POST['id'];
	$fecha = $_POST['fecha'];
	// $ndocumento = $_POST['ndocumento'];
	// $documentos_general = $_FILES['documentos_general'];
	$token = md5($id . $fecha . time());
	// $documents = [];

	$sql = "INSERT INTO cartera (token, id_acreedor, fecha) 
			VALUES ('{$token}', '{$id}', '{$fecha}')";

	$cn->query($sql) or die(mysqli_error($cn));
	
	header("Location: ../../menus.php?op=aggdatos&id={$id}&cartera={$token}");
}
