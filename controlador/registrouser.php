<?php 
require ('../conexion.php');
$cn->query("SET NAMES 'utf8'");

$codigo = $_POST['codigo'];
$identificacion = $_POST['identificacion'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = $_POST['pass2'];
$nivel = 2;


if (isset($_POST['save-gestor'])) {
	
$sql=$cn->query("INSERT INTO gestor (codigo, identificacion, nombre, apellido) VALUES ('$codigo', '$identificacion','$nombre','$apellido')")OR DIE(mysqli_error($cn));



if ($sql) {
	$sql=$cn->query("INSERT INTO usuario (username, password, nivel) VALUES ('$codigo', '$password','$nivel')")OR DIE(mysqli_error($cn));

}
		
echo '<script type="text/javascript">
       alert("DATOS INSERTADOS CORRECTAMENTE");
        window.location.href = "../index.php";
       </script>';
}
else{
	echo "HUBO UN PROBLEMA AL INSERTAR LOS DATOS, POR FAVOR VUELVE A REGISTRAR EL GESTOR";
}
 ?>