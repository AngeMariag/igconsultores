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


     // caso para visualizar y cargar gestión

case '2':
// id de la fecha
$id = $_POST['id'];
$tablad = '';
$tabla = ''; //ver codeudor
$tabla2 = ''; //verficha
$tabla3 = ''; //tabla de gestiones
$tabla4 = ''; //tabla de pagos
 
 $valor = $cn->query("SELECT * FROM ficha where id = '$id' ");
  
  $valores = mysqli_fetch_array($valor);

  $vercodeudor = $cn->query("SELECT * from  ficha inner join cartera_deudor_codeudor on ficha.id_cartera=cartera_deudor_codeudor.id_cartera inner join codeudor on cartera_deudor_codeudor.id_codeudor=codeudor.id WHERE ficha.id = '$id'");

 $verficha = $cn->query("SELECT * FROM ficha where id = '$id'");
  // $valores2 = mysqli_fetch_array($vercodeudor);

 $verobservaciones = $cn->query("SELECT * FROM observaciones_ficha where id = '$id'");
  // $valores2 = mysqli_fetch_array($vercodeudor);

// ver deudor

$verdatos = $cn->query("SELECT ficha.id, ficha.total, deudor.codigo, deudor.telefono, deudor.direccion, CONCAT(UPPER(deudor.tipodocumento), '-', deudor.documento) as documento, CONCAT(deudor.nombre, ' ', deudor.apellido) as deudor, CONCAT(gestor.codigo) as gestor, acreedor.razon_social from ficha inner join cartera on ficha.id_cartera=cartera.id INNER JOIN cartera_deudor_codeudor on cartera.id=cartera_deudor_codeudor.id_cartera INNER join acreedor on cartera.id_acreedor=acreedor.id inner join deudor on ficha.id_deudor=deudor.id INNER join gestor on cartera_deudor_codeudor.id_gestor=gestor.id WHERE ficha.id= '$id' GROUP BY ficha.id_deudor");
 
  $i =1;
  if (mysqli_num_rows($verdatos) != 0) {
    
    $tablad=$tablad.'<table class="table table-bordered table-hover table-condensed"> 
                    <tr class=" info"> 
                      
                        <th class="text-white" style="background:#000080;">CÓDIGO</th>
                        <th class="text-white" style="background:#000080;">IDENTIFICACIÓN</th>
                        <th class="text-white" style="background:#000080;">DEUDOR</th> 
                         <th class="text-white" style="background:#000080;">ACREEDOR</th>
                         <th class="text-white" style="background:#000080;">TELÉFONO</th>
                         <th class="text-white" style="background:#000080;">DIRECCIÓN</th>
                       
                    </tr>';
            while($v = mysqli_fetch_assoc($verdatos)){
              $tablad=$tablad.'<tr class="default">

                                 
                                    <td>
                                          '.$v["codigo"].'
                                    </td>
                                    <td>
                                          '.$v["documento"].'
                                    </td>

                                    <td>
                                          '.$v["deudor"].'
                                    </td>
                                         

                                    <td>
                                          '.$v["razon_social"].'
                                    </td> 
                                    <td>
                                          '.$v["telefono"].'
                                    </td> 
                                    <td>
                                          '.$v["direccion"].'
                                    </td> 
                                   
                                </tr>';

            }
            $tablad=$tablad.'</table>';

  }else{
        $tablad=$tablad.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                        </div>';
    }


  $i =1;
  if (mysqli_num_rows($vercodeudor) != 0) {
    
    $tabla=$tabla.'<table class="table table-bordered table-hover table-condensed"> 
                    <tr class=" info"> 
                      
                        <th class="text-white" style="background:#000080;">IDENTIFICACIÓN</th>
                        <th class="text-white" style="background:#000080;">NOMBRE</th> 
                         <th class="text-white" style="background:#000080;">APELLIDO</th>
                         <th class="text-white" style="background:#000080;">TELÉFONO</th>
                       
                    </tr>';
            while($c = mysqli_fetch_assoc($vercodeudor)){
              $tabla=$tabla.'<tr class="default">

                                 
                                    <td>
                                          '.$c["tipodocumento"].' - '.$c["documento"].'
                                    </td>

                                    <td>
                                          '.$c["nombre"].'
                                    </td>
                                         

                                    <td>
                                          '.$c["apellido"].'
                                    </td> 
                                    <td>
                                          '.$c["telefono"].'
                                    </td>
                                   
                                </tr>';

            }
            $tabla=$tabla.'</table>';

  }else{
        $tabla=$tabla.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                        </div>';
    }



// TABLA DE FICHA

  if (mysqli_num_rows($verobservaciones) != 0) {
    
    $tabla3=$tabla3 .'<table class="table table-bordered table-hover table-condensed"> 
                    <tr class=" head-info"> 
                      
                        <th class="text-white" style="background:#000080;">OBSERVACIÓN</th>
                        
                       
                    </tr>';
            while($f = mysqli_fetch_assoc($verobservaciones)){
              $tabla3=$tabla3.'<tr class="default">

                                 
                                    <td>
                                          (*) '.$f["observacion"].'
                                    </td>

                                  
                                </tr>';

            }
            $tabla3=$tabla3.'</table>';

  }else{
        $tabla3=$tabla3.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                        </div>';
    }

// VER observaciones

 if (mysqli_num_rows($verficha) != 0) {
    
    $tabla2=$tabla2 .'<table class="table table-bordered table-hover table-condensed"> 
                    <tr class=" info"> 
                      
                        <th class="text-white" style="background:#000080;">TÍTULO</th>
                        <th class="text-white" style="background:#000080;">CAPITAL</th> 
                         <th class="text-white" style="background:#000080;">INTERÉS</th>
                         <th class="text-white" style="background:#000080;">HONORARIOS</th>
                         <th class="text-white" style="background:#000080;">GASTOS</th>
                         <th class="text-white" style="background:#000080;">SANCIÓN</th>
                         <th class="text-white" style="background:#000080;">TOTAL</th>
                       
                    </tr>';
            while($f = mysqli_fetch_assoc($verficha)){
              $tabla2=$tabla2.'<tr class="default">

                                 
                                    <td>
                                          '.$f["titulo"].'
                                    </td>

                                    <td>
                                          '.$f["capital"].'
                                    </td>
                                         

                                    <td>
                                          '.$f["interes"].' %
                                    </td> 
                                    <td>
                                          '.$f["honorarios"].' %
                                    </td>
                                   
                                    <td>
                                          '.$f["gastos"].' %
                                    </td>
                                    <td>
                                          '.$f["sancion"].' %
                                    </td>
                                    <td>
                                          '.$f["total"].'
                                    </td>
                                   
                                </tr>';

            }
            $tabla2=$tabla2.'</table>';

  }else{
        $tabla2=$tabla2.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                        </div>';
    }
 




  $datos = array(

     
      // 0 => $valores['razon_social'],
      0 => $tablad,
      1 => $tabla,
      2 => $tabla2,
      3 => $tabla3,
      4 => $valores['total'],
      // 7 => $tabla3,
      // 8 => $tabla4,
  );
  echo json_encode($datos);
   


  break;
 
     break;



/**************************************************EDITAR******************************/

	
	default:
		
	break;
}
 ?>