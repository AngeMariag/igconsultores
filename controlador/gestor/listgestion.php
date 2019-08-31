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
    WHERE gestor.codigo = '{$user['username']}'");

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
                                      <a href="#" onclick="modalShow1(<?= utf8_decode(strtoupper($f['id'])) ?>)" class="btn btn-info btn-sm text-white"
                                    title="Ver" data-toggle="modal" data-target="#vista">
                                    <i class="fas fa-eye"></i>
                                </a>
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
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="container">
        <form action="" method="POST" id="modalvermas" class="text-center m-auto">
          
          <input type="hidden" required="required" readonly="readonly" id="id_ficha1" readonly="readonly"/>
           <div   style="height: 0%;" class="container-fluid my-3">
            <h2 class="text-center bold my-4 table-sm">DATOS DEL DEUDOR</h2>
             </div>

         
          <div class="container-fluid">
            <div class="table table-responsive m-auto table-sm" id="verdeudor">
              
            </div>
          </div>
          
         <h3 class="text-center bold my-4">DATOS DEL CODEUDOR</h3>
          <div class=" container-fluid">
            <div class="table table-responsive m-auto table-sm" id="vercodeudores2">
              
            </div>
          </div>

           
         <h3 class="text-center bold my-4">FICHA - CUENTA</h3>
          <div class="container-fluid">
            <div class="table table-responsive m-auto table-sm" id="verficha2">
              
            </div>
          </div>

          <h2 class="text-center bold my-4">OBSERVACIONES DE CUENTA</h2>
          <div class="">
            <div class="table table-responsive m-auto table-sm" id="verobservaciones">
           </div>
          </div>


          <div class="card">
            <h3 class="text-center"> REGISTRAR ACUERDO</h3>
          </div>
          <div class="row my-2">
            <div class="form-group col-md-4">
              <label>TOTAL</label>
              <input type="" name="" id="totalficha" readonly="" class="form-control ">
            </div>
            <div class="form-group col-md-4">
              <label>PORCENTAJE</label>
              <input type="" name="" id="porcentaje"  class="form-control ">
            </div>
            <div class="form-group col-md-4">
              <label>MONTO TOTAL</label>
              <input type="" name="" id="montototal"  class="form-control ">
            </div>
          </div>

          
          <br>
          <div class="row col-sm-12 col-md-12 col-lg-12">
            <div class="form-inline col-lg-12">
              <label class="col-md-4">ACUERDO:</label>
              <textarea class="form-control col-md-6"></textarea>
            </div>
          </div>
          <div class="btn-group btn-group-sm my-5" style="">
                        
                        <a href="javascript:window.location.reload()" class="btn btn-danger"><i class="fas fa-trash-alt"></i>CERRAR</a>
                    </div>


          
        </form>
      </div>
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
//       
        // $("#verdeudor").html(datos[6]);
         // $("#vergestiones2").html(datos[7]);
         // $("#verpagos2").html(datos[8]);
//          $('#fecha_inicio3').val(datos[4]);
            // $('#objetivo_contrato3').val(datos[6]);
//          //$('#objetivo_especificos3').val(datos[7]);
//          $('#valor_facturado3').val(datos[7]);
//          $('#valor_facturado3').val(datos[8]);

//          $("#vertablas2").html(datos[10]);
//          $("#vertablas3").html(datos[11]);
//          $("#vertablas").html(datos[12]);
//          $("#vertablas1").html(datos[13]);//objetivosespecificos
//          $('#fecha_registro').val(datos[14]);
//          $('#fecha_modificacion').val(datos[15]);
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




<!-- VENTANA DE VISTA DE GESTIONES DE PAGO -->
<!-- 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">
  Huge modal
</button> -->

<!-- <div id="aggacuerdo" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
     aria-labelledby="myHugeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
     <H2>PRUEBA</H2>
     <div class=" container">
     <form action="" id="acuerdogestion">
       <input type="text" required="required" readonly="readonly" id="iddeudor" name="id" readonly="readonly"/>

       <div class="table-responsive">
         <div id="tabladeudores" class="" style="width: 75%;">  </div>
       </div>
     </form>
     </div>
    </div>
  </div>
</div>
 -->
<!-- 
<script type="text/javascript">


  // NUEVA FUNCIÓN PARA MI INSERTAR GESTIONES DE PAGO

function agregar(id)
  {
    $('#acuerdogestion')[0].reset();
    var url = 'controlador/gestor/consulta.php?tp=1';
      $.ajax({
      type:'POST',
      url:url,
      data:'tp=1&id='+id,
      success: function(valores){
          var datos = eval(valores);
         $('#iddeudor').val(id);
           $('#tabladeudores').html(datos[0]);
         $('#aggacuerdo').modal({
            show:true,
            backdrop:'static'
          });
        return false;
      }
    });
    return false;
  } 

 
</script> -->
