<?php 

include '../../conexion.php';
// $mysqli->set_charset('utf8');
header("Content-Type: text/html;charset=utf-8"); 
$cn->query("SET NAMES 'utf8'");

if (isset($_GET['tp'])) {
	$tp = $_GET['tp'];
}

switch ($tp)

 //SEGUN EL NUMERO DE TIPO QUE RECIBA PARA PROCESAR 
  {
	case '1':
		
//MI PRIMERA CONSULTA VISTA DE ACREEDORES

        $paginaActual=$_POST['pagina'];
        $nroRegistro = mysqli_num_rows(mysqli_query($cn,"SELECT * FROM acreedor"));
                    $nroLotes = 6;
                    $nroPaginas = ceil($nroRegistro/$nroLotes);
                    $lista = '';
                    $tabla = '';
                    
                    if($paginaActual > 1){
                        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:paginar_resultados('.($paginaActual-1).');">Anterior</a></li>';
                    }
                    for($i=1; $i<=$nroPaginas; $i++){
                        if($i == $paginaActual){
                            $lista = $lista.'<li class="active"><a class="page-link"  href="javascript:paginar_resultados('.$i.');">'.$i.'</a></li>';
                        }else{
                            $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:paginar_resultados('.$i.');">'.$i.'</a></li>';
                        }
                    }
                    
                    if($paginaActual < $nroPaginas){
                        $lista = $lista.'<li  class="page-item"><a class="page-link" href="javascript:paginar_resultados('.($paginaActual+1).');">Siguiente</a></li>';
                    }
                    
                    if($paginaActual <= 1){
                        $limit = 0;
                    }else{
                        $limit = $nroLotes*($paginaActual-1);
                    }
                     $sql = $cn->query("SELECT * FROM acreedor  ORDER BY id DESC LIMIT $limit, $nroLotes");
                      $i=1;
                      if(mysqli_num_rows($sql) != 0){

                    $tabla=$tabla.'<table class="table table-bordered table-hover table-condensed" >

                    <tr class=""> 
                      
                      <th class="text-white" style="background:#000080;">TIPO DE DOCUMENTO</th>
                      <th class="text-white" style="background:#000080;">DOCUMENTO</th>
                      <th class="text-white" style="background:#000080;">RAZÓN SOCIAL / NOMBRE</th>
                      <th class="text-white" style="background:#000080;">OPCIONES</th>
                    </tr>';

                    while ($f = mysqli_fetch_assoc($sql)) {
                            $tabla=$tabla.'<tr class="default">

                            <td style=text-align: justify;>
                                        '.utf8_encode($f["tipo_documento"]).'<input type="hidden" name="id" id="id_acreedor" style="width: 50px;">
                                    ';

                            if ($f["tipo_documento"] == "nit") {
                            	$tabla=$tabla.'<span class="badge badge-warning">Jurídica</span>';
                            }else {
                            	$tabla=$tabla.'<span class="badge badge-primary">Natural</span>';
                            };
                            '</td>';
                                   $tabla=$tabla.'<td  style=text-align: center;>
                                        '.$f["documento"].'
                                    </td>
                                    <td  style="text-align: center";>
                                        '.$f["razon_social"].'
                                    </td>
                                    
                                   <td align="center">

                                  
                                   <a href="?op=aggdatos&id='.$f['id'].'"  class="btn btn-success btn-sm" title="NUEVA CARTERA"><i class="fas fa-plus"></i></a>
                                    
                                    </td>
                                    

                                </tr>';

                                
                            }
            $tabla=$tabla.'</table>';

    }else{
        $tabla=$tabla.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
                        </div>';
    }
      $array = array(0=>$tabla,1=>$lista);
      echo json_encode($array);

     break;



/**************************************************VER DEUDORES******************************/
case '2':
 $paginaActual=$_POST['pagina'];
        $nroRegistro = mysqli_num_rows(mysqli_query($cn,"SELECT * FROM deudor"));
                    $nroLotes = 6;
                    $nroPaginas = ceil($nroRegistro/$nroLotes);
                    $lista = '';
                    $tabla = '';
                    
                    if($paginaActual > 1){
                        $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:paginar_deudores('.($paginaActual-1).');">Anterior</a></li>';
                    }
                    for($i=1; $i<=$nroPaginas; $i++){
                        if($i == $paginaActual){
                            $lista = $lista.'<li class="active"><a class="page-link"  href="javascript:paginar_deudores('.$i.');">'.$i.'</a></li>';
                        }else{
                            $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:paginar_deudores('.$i.');">'.$i.'</a></li>';
                        }
                    }
                    
                    if($paginaActual < $nroPaginas){
                        $lista = $lista.'<li  class="page-item"><a class="page-link" href="javascript:paginar_deudores('.($paginaActual+1).');">Siguiente</a></li>';
                    }
                    
                    if($paginaActual <= 1){
                        $limit = 0;
                    }else{
                        $limit = $nroLotes*($paginaActual-1);
                    }

                    
                    $sql = $cn->query("SELECT ficha.id, ficha.total, deudor.codigo, CONCAT(UPPER(deudor.tipodocumento), '-', deudor.documento) as documento, CONCAT(deudor.nombre, ' ', deudor.apellido) as deudor, CONCAT(gestor.codigo) as gestor, acreedor.razon_social from ficha inner join cartera on ficha.id_cartera=cartera.id INNER JOIN cartera_deudor_codeudor on cartera.id=cartera_deudor_codeudor.id_cartera INNER join acreedor on cartera.id_acreedor=acreedor.id inner join deudor on ficha.id_deudor=deudor.id INNER join gestor on cartera_deudor_codeudor.id_gestor=gestor.id GROUP BY ficha.id_deudor");
                    
                      $i=1;
                      if(mysqli_num_rows($sql) != 0){

                    $tabla=$tabla.'<table class="table table-bordered table-hover table-condensed" >

                    <tr class="text-center"> 
                      
                      <th class="text-white" style="background:#000080;">CÓDIGO</th>
                      <th class="text-white" style="background:#000080;">IDENTIFICACIÓN</th>
                      <th class="text-white" style="background:#000080;">DEUDOR</th>
                      <th class="text-white" style="background:#000080;">DEUDA</th>
                      <th class="text-white" style="background:#000080;"> CÓDIGO GESTOR</th>
                      <th class="text-white" style="background:#000080;"> ACREEDOR </th>
                      <th class="text-white" style="background:#000080;"> DOCUMENTOS</th>
                      <th class="text-white" style="background:#000080;">OPCIONES</th>
                    </tr>';

                    while ($f = mysqli_fetch_assoc($sql)) {
                            $tabla=$tabla.'<tr class="default">

                            <td  style="text-align: center";>
                                        '.$f["codigo"].'
                                    </td>

                            <td style=text-align: justify;>
                                        '.utf8_encode($f["documento"]).'<input type="hidden" name="id" id="id_acreedor" style="width: 50px;">
                                    ';
                            '</td>';
                                   $tabla=$tabla.'<td  style=text-align: center;>
                                        '.$f["deudor"].'
                                    </td>
                                   
                                   <td  style=text-align: center;>
                                        '.$f["total"].'
                                    </td>
                                    <td  style="text-align: center";>
                                        '.$f["gestor"].'
                                    </td>
                                     <td  style="text-align: center";>
                                        '.$f["razon_social"].'
                                    </td>
                                    <td align="center">

                                  
                                   <a href="javascript:verdocumentos('.$f['id'].');"  class="btn btn-danger btn-sm" title="VER DOCUMENTOS"><i class="fas fa-file-pdf"></i></a>
                                    
                                    </td>
                                   <td align="center">

                                  
                                   <a href="javascript:leermas('.$f['id'].');"  class="btn btn-success btn-sm" title="NUEVA CARTERA"><i class="fas fa-search"></i></a>
                                    
                                    </td>
                                    

                                </tr>';

                                
                            }
            $tabla=$tabla.'</table>';

    }else{
        $tabla=$tabla.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
                        </div>';
    }
      $array = array(0=>$tabla,1=>$lista);
      echo json_encode($array);
  
break;


	case '3':
      $id = $_POST['id'];
      $tabla = '';

      $sql = $cn->query("SELECT * FROM documentos_cartera WHERE id_ficha='$id'");

                           


                            if(mysqli_num_rows($sql) != 0){
      //DOCUMENTOS GENERALES
                          $tabla=$tabla.'<table class="table table-bordered table-hover table-condensed " >

                          <tr class="info"> 
                            
                            <th class="text-white" style="background:#000080;">DOCUMENTO</th>
                            
                            <th class="text-white" style="background:#000080;">ARCHIVO</th>
                            
                          </tr>';

                          while ($f = mysqli_fetch_assoc($sql)) {
                                  $tabla=$tabla.'<tr class="default">
                                               <td style=font-size:10px;>
                                              '.$f["nombre"].'
                                          </td> 

                                          <td align="center" style=font-size:12px;>
                       
                                           <a href="' .$f['ruta'].'" target="_blank" class="btn btn-xs btn-danger"  title="IMPRIMIR"><i class="fas fa-file-pdf"></i></a>

                            
                                          </td>

                                      </tr>';

                                      
                                  }
                  $tabla=$tabla.'</table>';



          }else{
              $tabla=$tabla.'<div class="alert alert-danger text-center">
                                  <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                              </div>';
          }
            $array = array(0=>$tabla);
            echo json_encode($array);
break;

case '4':
// id de la fecha
  $id = $_POST['id'];
$tabla = ''; //ver codeudor
$tabla2 = ''; //verficha
$tabla3 = ''; //tabla de gestiones
$tabla4 = ''; //tabla de pagos

$verdatos = $cn->query("SELECT ficha.id, ficha.total, deudor.codigo, CONCAT(UPPER(deudor.tipodocumento), '-', deudor.documento) as documento, CONCAT(deudor.nombre, ' ', deudor.apellido) as deudor, CONCAT(gestor.codigo) as gestor, acreedor.razon_social from ficha inner join cartera on ficha.id_cartera=cartera.id INNER JOIN cartera_deudor_codeudor on cartera.id=cartera_deudor_codeudor.id_cartera INNER join acreedor on cartera.id_acreedor=acreedor.id inner join deudor on ficha.id_deudor=deudor.id INNER join gestor on cartera_deudor_codeudor.id_gestor=gestor.id WHERE ficha.id= '$id' GROUP BY ficha.id_deudor");
  
  
  $valores = mysqli_fetch_array($verdatos);

  $vercodeudor = $cn->query("SELECT * from  ficha inner join cartera_deudor_codeudor on ficha.id_cartera=cartera_deudor_codeudor.id_cartera inner join codeudor on cartera_deudor_codeudor.id_codeudor=codeudor.id WHERE ficha.id = '$id'");

 $verficha = $cn->query("SELECT * FROM ficha where id = '$id'");
  // $valores2 = mysqli_fetch_array($vercodeudor);

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

// VER GESTIONES


 $vergestion = $cn->query("SELECT * FROM gestion where id_ficha = '$id'");
  
  $i =1;
  if (mysqli_num_rows($vergestion) != 0) {
    
    $tabla3=$tabla3.'<table class="table table-bordered table-hover table-condensed"> 
                    <tr class=" info"> 
                      
                        <th class="text-white" style="background:#000080;">GESTIÓN</th>
                        <th class="text-white" style="background:#000080;">FECHA</th> 
                         <th class="text-white" style="background:#000080;">MONTO</th>
                         <th class="text-white" style="background:#000080;">ESATUS</th>
                       
                    </tr>';
            while($c = mysqli_fetch_assoc($vergestion)){
              $tabla3=$tabla3.'<tr class="default">

                                 
                                    <td>
                                          '.$c["gestion"].'
                                    </td>

                                    <td>
                                          '.$c["fecha"].'
                                    </td>
                                         

                                    <td>
                                          '.$c["monto"].'
                                    </td> 
                                    <td>
                                          '.$c["estado"].'
                                    </td>
                                   
                                </tr>';

            }
            $tabla3=$tabla3.'</table>';

  }else{
        $tabla3=$tabla3.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                        </div>';
    }



// VER PAGOS


 $verpagos = $cn->query("SELECT * FROM pagos_contabilidad where id_ficha = '$id'");
  
  $i =1;
  if (mysqli_num_rows($vergestion) != 0) {
    
    $tabla4=$tabla4.'<table class="table table-bordered table-hover table-condensed"> 
                    <tr class=" info"> 
                      
                        <th class="text-white" style="background:#000080;">FECHA</th>
                        <th class="text-white" style="background:#000080;">NRO RECIBO</th> 
                         <th class="text-white" style="background:#000080;">VALOR</th>
                         <th class="text-white" style="background:#000080;">SALDO</th>
                         <th class="text-white" style="background:#000080;">OBSERVACIONE</th>
                         <th class="text-white" style="background:#000080;">ESTATUS</th>
                       
                    </tr>';
            while($c = mysqli_fetch_assoc($vergestion)){
              $tabla4=$tabla4.'<tr class="default">

                                 
                                    <td>
                                          '.$c["fecha"].'
                                    </td>

                                    <td>
                                          '.$c["numero_recibo"].'
                                    </td>
                                         

                                    <td>
                                          '.$c["valor"].'
                                    </td> 
                                    <td>
                                          '.$c["saldo"].'
                                    </td>
                                     <td>
                                          '.$c["observaciones_pago"].'
                                    </td>
                                     <td>
                                          '.$c["estado_pago"].'
                                    </td>
                                   
                                </tr>';

            }
            $tabla4=$tabla4.'</table>';

  }else{
        $tabla4=$tabla4.'<div class="alert alert-danger text-center">
                            <strong>Lo Sentimos No Se Encontraron Registros...</strong>
                        </div>';
    }




  $datos = array(

      0 => $valores['codigo'],
      1 => $valores['documento'],
      2 => $valores['deudor'],
      3 => $valores['gestor'],
      4 => $valores['razon_social'],
      5 => $tabla,
      6 => $tabla2,
      7 => $tabla3,
      8 => $tabla4,
  );
  echo json_encode($datos);
   


  break;
	default:
		# code...
		break;
}
 ?>