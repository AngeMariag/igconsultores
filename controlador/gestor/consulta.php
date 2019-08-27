<?php 

include '../../conexion.php';

$cn->query("SET NAMES 'utf8'");

if (isset($_GET['tp'])) {
	$tp = $_GET['tp'];
}

switch ($tp)

 //SEGUN EL NUMERO DE TIPO QUE RECIBA PARA PROCESAR 
  {
	case '1':
	$verdeudor="";
	 $idficha = $_POST['id'];

	 $sql = $cn->query(" SELECT * FROM cartera_deudor_codeudor inner join ficha on cartera_deudor_codeudor.id_cartera=ficha.id_cartera INNER join deudor on cartera_deudor_codeudor.id_deudor=deudor.id where ficha.id = '$idficha'");
	

	 $valores = mysqli_fetch_array($sql);

	 if (mysqli_num_rows($sql) !=0) {
	 	$verdeudor=$verdeudor. '<table class="table table-bordered table-sm text-center">
                <thead class="table-info">
                  <tr>
                    <th>CÓDIGO</th>
                    <th>DOCUMENTO</th>
                    <th>NOMBRE Y APELLIDO</th>
                    <th>TELEFONO</th>
                  </tr>
                  </thead>';
            // while ($f = mysqli_fetch_assoc($sql)) {
           $verdeudor=$verdeudor.'<tbody>
                  <tr>
                    <td>'.utf8_encode(strtoupper($valores["codigo"])).'</td>
                    <td>'.utf8_encode(strtoupper($valores["documento"])).'</td>
                     <td align="center">
                      '.utf8_encode(strtoupper($valores["nombre"])).' '.utf8_encode(strtoupper($valores["apellido"])).' 
                  </td>
                    <td>'.$valores['telefono'].'></td>
                  </tr>
                </tbody>';
            // }
              $verdeudor=$verdeudor.'</table>
           ';
	 
	 }else{
        $verdeudor=$verdeudor.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros De Objetivos Específicos  para este contrato...</strong>
                        </div>';
    }
    // consulta para ver mi codeudor
    // $sql2 = $cn->query(" SELECT * FROM cartera_deudor_codeudor inner join ficha on cartera_deudor_codeudor.id_cartera=ficha.id_cartera INNER join codeudor on cartera_deudor_codeudor.id_codeudor=codeudor.id_deudor.id where ficha.id = '$idficha'");
	 $datos = array(
	 	0 => $verdeudor,
	 );
	 echo json_encode($datos);
     break;



/**************************************************EDITAR******************************/

	
	default:
		
	break;
}
 ?>