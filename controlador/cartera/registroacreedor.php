<?php
include '../../conexion.php';

if (isset($_POST['btn-save-acre'])) {
	$type_document = $_POST['tipo_documento'];
	$document = $_POST['documento'];
	$name = $_POST['razon_social'];

	$sql = "INSERT INTO acreedor (tipo_documento,documento,razon_social)
			VALUE ('{$type_document}', '{$document}', '{$name}')";
	$cn->query($sql) or die(mysqli_error($cn));
	return header("Location: ../../menus.php?op=registro_cartera");
	
} else {
	echo "HUBO UN PROBLEMA AL INSERTAR LOS DATOS, POR FAVOR VUELVE A REGISTRAR EL ACREEDOR";
}
