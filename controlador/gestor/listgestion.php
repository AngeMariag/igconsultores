<?php

include('conexion.php');

$user = $_SESSION['user'];

// include('controlador/gestor/index.php');
$sql = $cn->query("SELECT ficha.id, gestor.codigo, deudor.codigo as dcodigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social 
    FROM gestor LEFT JOIN cartera_deudor_codeudor as car
    ON car.id_gestor=gestor.id
    LEFT JOIN deudor 
    ON car.id_deudor=deudor.id
    LEFT JOIN cartera
    ON cartera.id=car.id_cartera
    LEFT JOIN acreedor
    ON acreedor.id=cartera.id_acreedor
    LEFT JOIN ficha
    ON ficha.id_cartera=cartera.id and ficha.id_deudor=deudor.id
    WHERE gestor.codigo = '{$user['username']}' ORDER BY ficha.id_deudor DESC");


?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header text-white bg-info ">
            SELECCIONA UNA GESTIÓN
        </div>
        <div class="card-body">
            <div class="row">
                <?php if (mysqli_num_rows($sql) != 0) { ?>
                <div class="offset-md-6 col-md-6 col-sm-12 col-12">
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input name="q" type="search" class="form-control" placeholder="Buscar por Documento del Deudor o Nombre Del Acreedor">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" id="button-addon2">
                                    Buscar
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código Deudor</th>
                                <th>Documento Deudor</th>
                                <th>Deudor</th>
                                <th>Acreedor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($f = mysqli_fetch_assoc($sql)) { ?>
                                <tr>
                                <td><?= utf8_encode(strtoupper($f["dcodigo"])) ?></td>
                                  <td><?= utf8_encode(strtoupper($f["tipodocumento"])) .("-"). utf8_encode(strtoupper($f["documento"])) ?></td>
                                   <td><?= utf8_encode(strtoupper($f["nombre"])) .(" "). utf8_encode(strtoupper($f["apellido"])) ?></td>
                                    <td><?= utf8_encode(strtoupper($f["razon_social"])) ?></td>
                                    <td>
                                      <!-- <a href="#" onclick="modalShow1(<?= utf8_decode(strtoupper($f['id'])) ?>)" class="btn btn-info btn-sm text-white"
                                    title="Ver" data-toggle="modal" data-target="#vista">
                                    <i class="fas fa-eye"></i>
                                </a> -->
                                <a href="javascript:leermas(<?= $f["id"] ?>);"  class="btn btn-warning btn-sm text-white" title="Editar"><i class="fas fa-edit"></i></a> 
                                
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        <strong>
                            Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...
                        </strong>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" id="VERMAS" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl " style="color:#000080;">
    <div class="modal-content">
        <div class="modal-header" style=" background:#003380;">
          <h3 class="modal-title text-center text-white" id="myModalLabel">CUENTA DEUDOR </h3> <button tyle="buttom" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
                    <!-- PANEL PARA OBSERVAR DATOS DE ACUERDO Y GESTIONES -->
          <div class="card card-header my-1 container-fluid">       
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link " id="nav-acuerdo-tab" data-toggle="tab" href="#nav-acuerdo" role="tab" aria-controls="nav-home" aria-selected="false">ACUERDO</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab " aria-controls="nav-profile" aria-selected="false">GESTIÓN</a>
              <a class="nav-item nav-link " id="nav-recordatorio-tab" data-toggle="tab" href="#nav-recordatorio" role="tab" aria-controls="nav-item" aria-selected="false">AGREGAR RECORDATORIO</a>
              
            </div>
          </nav>

        <div class="tab-content my-3" id="nav-tabContent">
          <div class="tab-pane fade " id="nav-acuerdo" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php require ("controlador/gestor/vistas/addacuerdo.php") ?>
          </div>
          <div class="tab-pane fade  show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <?php require ("controlador/gestor/vistas/addgestion.php") ?>
          </div>
          <div class="tab-pane fade " id="nav-recordatorio" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php require ("controlador/gestor/vistas/addrecordatorio.php") ?>
          </div>
       
        </div>
    </div>

    <div class="card-header text-white my-3" style=" background:#003380;">
           DATOS GENERALES
        </div>
      <div class="container-fluid card-header">
        <form action="controlador/gestor/registrar_gestion.php" method="POST" id="modalvermas" class="text-center m-auto">
          
          
          <div class="container-fluid my-3">
            <div class="table table-responsive m-auto table-sm " id="verdeudor">
              
            </div>
          </div>
          
        <h4 class="">DATOS - <span class="badge badge-secondary">CODEUDOR</span></h4>
          <div class=" container-fluid my-3">
            <div class="table table-responsive m-auto table-sm" id="vercodeudores2">
              
            </div>
          </div>
        
         <h4>FICHA - <span class="badge badge-secondary">CUENTA</span></h4>
          <div class="container-fluid my-3">
            <div class="table table-responsive m-auto table-sm" id="verficha2">
              
            </div>
          </div>

          <h4>OBSERVACIONES - <span class="badge badge-secondary">CUENTA</span></h4>
          <div class=" container-fluid my-3">
            <div class="table table-responsive m-auto table-sm" id="verobservaciones">
           </div>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  function leermas(id)
  {
    $('#modalvermas')[0].reset();
    var url = 'controlador/gestor/consulta.php?tp=2';
      $.ajax({
      type:'POST',
      url:url,
      data:'tp=2&id='+id,
      success: function(valores){
          var datos = eval(valores);
         $('#id_ficha1').val(id);
        $("#verdeudor").html(datos[0]);
        $("#vercodeudores2").html(datos[1]);
        $("#verficha2").html(datos[2]);
        $("#verobservaciones").html(datos[3]);
        $('#totalficha').val(datos[4]);
         $("#veracuerdo").html(datos[5]);
         $('#VERMAS').modal({
            show:true,
            backdrop:'static'
          });
        return false;
      }
    });
    return false;
  }

  
</script>

