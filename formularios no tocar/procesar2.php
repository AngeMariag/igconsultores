<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
include '../conexion.php';
$cn->query("SET NAMES 'utf8'");

	if(isset($_POST['btn-enviar'])){
		$sql=$cn->query("INSERT INTO acreedor (acreedor) VALUES ('$_POST[acreedor]')")OR DIE(mysqli_error($cn));
			
			if ($sql)
				// AGREGO DEUDOR
			{
				$sql1= $cn->query("SELECT id_acreedor from acreedor ORDER BY id_acreedor DESC LIMIT 0,1");

				if ($q =mysqli_fetch_array($sql1)) {

					$acreedor = $q['id_acreedor'];

					$acreedor=$cn->query("INSERT INTO deudor (id_acreedor, nombre_deudor, apellido_deudor,tipodocumento_deudor, documento_deudor, telefono_deudor, direccion_deudor ) VALUES('$acreedor','$_POST[nombre_deudor]', '$_POST[apellido_deudor]','$_POST[tipodocumento_deudor]','$_POST[documento_deudor]','$_POST[telefono_deudor]','$_POST[direccion_deudor]')");

					$id_deudor=mysqli_insert_id($cn);


					$codeudor=$cn->query("INSERT INTO codeudor(nombre_codeudor, apellido_codeudor,tipodocumento_codeudor, documento_codeudor, telefono_codeudor, direccion_codeudor,id_deudor ) VALUES('$_POST[nombre_codeudor]', '$_POST[apellido_codeudor]','$_POST[tipodocumento_codeudor]','$_POST[documento_codeudor]','$_POST[telefono_codeudor]','$_POST[direccion_codeudor]', '$id_deudor')");

					$fac=$cn->query("INSERT INTO ficha (titulo_ficha, capital_ficha,interes, honorarios, gastos, descuento, sancion, total,id_deudor) VALUES ('$_POST[titulo_ficha]', '$_POST[capital_ficha]','$_POST[interes]','$_POST[honorarios]','$_POST[gastos]', '$_POST[descuento]', '$_POST[sancion]', '$_POST[gastos]', '$id_deudor')")OR DIE(mysqli_error($cn));

					// AQUI ESTOY AGREGANDO LAS OBSERVACIONES
					$id_ficha=mysqli_insert_id($cn);

					foreach($_POST['observacion'] as $observacion) 
							$sql2=$cn->query("INSERT INTO observaciones_ficha(id_ficha, observacion) VALUES ('$id_ficha', '$observacion')");
					
					
				}



					echo '<script type="text/javascript">
		           alert("DATOS INSERTADOS CORRECTAMENTE");
		           window.location.href = "../menuinterno.php";
		           </script>';		
         }else{
         	echo "error";

	}

}

// el radio va tener un valor de 20%, si lo selecciona se suma y si no lo tiene entonces que precione no y ese va tener un value de 0
 ?>