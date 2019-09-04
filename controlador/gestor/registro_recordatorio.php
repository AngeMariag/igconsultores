<?php 

require('../../conexion.php');

$cn->query("SET NAMES 'utf8'");


if (isset($_POST['save-recordatorio'])) {
	$id = $_POST['id'];

	echo $id;
	// $monto = $_POST['monto'];
	// $sql = $cn->query("INSERT INTO gestion (gestion, fecha, monto, estado, id_ficha) VALUES "."('$_POST[gestion]','$_POST[fecha]', '$monto','$_POST[estado]', '$id')") OR DIE (mysqli_error($cn));	

	// echo '<script type="text/javascript">
	// 	           alert("DATOS MODIFICADOS CORRECTAMENTE");
	// 	           window.location.href = "../../menus.php";
	// 	           </script>'; 
}else{
	// echo '<script type="text/javascript">
	// 	           alert("ALGO NO SALIO BIEN, VUELVE A INTENTARLO");
	// 	           window.location.href = "../../menus.php";
	// 	           </script>'; 
}
 ?>