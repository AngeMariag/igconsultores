<?php
include '../../conexion.php';

$cn->query("SET NAMES 'utf8'");

if (isset($_POST['btn-save-acre'])) {
	$type_document = $_POST['tipo_documento'];
	$document = $_POST['documento'];
	$name = $_POST['razon_social'];

$nuevo_acreedor= $cn->query("SELECT documento FROM acreedor where documento='$document'");

if(mysqli_num_rows($nuevo_acreedor)>0) 
{ 

echo '<script type="text/javascript">
       alert("EL ACREEDOR YA SE ENCUENTRA REGISTRADO EN LA BASE DE DATOS POR FAVOR INSERTE NUEVOS DATOS");
        window.location.href = "javascript:history.go(-1)";
       </script>';

}else{

	$sql = "INSERT INTO acreedor (tipo_documento,documento,razon_social)
			VALUE ('{$type_document}', '{$document}', '{$name}')";
	$cn->query($sql) or die(mysqli_error($cn));
	return header("Location: ../../menus.php?op=registro_cartera");
	echo '<script type="text/javascript">
       alert("DATOS INSERTADOS");
        window.location.href = "javascript:history.go(-1)";
       </script>';
}
}

?>


