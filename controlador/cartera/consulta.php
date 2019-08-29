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

                                  
                                   <a href="?op=aggdatos&id='.$f['id'].'"  class="btn btn-success btn-sm" title="NUEVA CARTERA"><i class="fas fa-search"></i></a>
                                    
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
                      
                      <th>DOCUMENTO</th>
                      
                      <th>ARCHIVO</th>
                      
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

	default:
		# code...
		break;
}
 ?>