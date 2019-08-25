<?php 

include '../../conexion.php';


if(isset($_POST['btn-save-acre'])){
	
$sql=$cn->query("INSERT INTO acreedor (tipo_documento,documento,razon_social) VALUES ('$_POST[tipo_documento]','$_POST[documento]', '$_POST[razon_social]')")OR DIE(mysqli_error($cn));
		
echo '<script type="text/javascript">
		           alert("DATOS INSERTADOS CORRECTAMENTE");
		            window.location.href = "registro.php";
		           </script>';
}
else{
	echo "HUBO UN PROBLEMA AL INSERTAR LOS DATOS, POR FAVOR VUELVE A REGISTRAR EL ACREEDOR";
}


 ?>