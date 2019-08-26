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
                     $sql = $cn->query("SELECT * FROM acreedor  ORDER BY id ASC LIMIT $limit, $nroLotes");
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

                                  <a href="javascript:leermas('.$f['id'].');" class="btn btn-sm btn-info" title="Leer Mas"><i class="fas fa-search"></i></a>
                                   <a href="javascript:agregarotrosi('.$f['id'].');" class="btn btn-warning btn-sm" title="EDITAR"><i class="fas fa-edit"></i></a>
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



/**************************************************EDITAR******************************/

	
	default:
		# code...
		break;
}
 ?>