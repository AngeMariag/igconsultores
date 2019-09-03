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
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
      <h2 class="text-center bold  card-header bg-default" style="color:#000080;">DATOS DEL DEUDOR</h2>
      <div class="container">
        <form action="" method="POST" id="modalvermas" class="text-center m-auto">
          
          <input type="hidden" required="required" readonly="readonly" id="id_ficha1" readonly="readonly"/>
           
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

                <div class="card-header text-white bg-info my-3">
            REGISTRAR GESTIÓN
        </div>

        <div class="container-fluid">
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="inputCity">GESTIÓN</label>
                  <textarea class="form-control" name="gestion"></textarea>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputZip">FECHA</label>
                  <input type="date" class="form-control" id="" name="fecha">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">MONTO</label>
                  <input type="text" class="form-control" id="" name="monto">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputState">ESTADO</label>
                  <select id="inputState" class="form-control" name="estado">
                    <option selected>SELECCIONA</option>
                    <option value="0">EN ACUERDO</option>
                    <option value="1">RENUENTE</option>
                    <option value="2">INSOLVENTE</option>
                    <option value="3">INCUMPLIMIENTO</option>
                    <option value="4">ILOCALIZADO</option>
                    <option value="5">VOLVAR A LLAMAR</option>
                    <option value="6">AUDITORIA</option>
                    <option value="7">FRAUDE</option>

                  </select>
                </div>
                
              </div>
             
        </div>
        <div class="card-header text-white bg-info my-3">
            REGISTRAR ACUERDO
        </div>
          <div class=" container-fluid row">
            <div class="form-group col-md-3">
              <label>TOTAL</label>
              <input type="" name="" id="totalficha" readonly="" class="form-control ">
            </div>
            <div class="form-group col-md-3">
              <label>PORCENTAJE</label>
              <input type="number" name="porcentaje" id="porcentaje"  class="form-control " value="0">
            </div>
            <div class="form-group col-md-6">
              <label>ACUERDO</label>
              <textarea class="form-control"></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <button type="button" name="btn-total" class="btn btn-primary d-flex justify-content-sm-end my-2" id="btn_get_total2">CALCULAR TOTAL
            </button>
        </div>
        <div class="col-12">
            <div id="set_total2" class="mb-5 mt-3 text-center"></div>
        </div>
          
          <br>
        

   
         <!-- SAVE ACUERDO -->
            <div class="card-body text-center">
                <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                    <button type="submit" name="btn-enviar" class="btn btn-success">
                        <i class="far fa-save"></i>
                        GUARDAR
                    </button>
                    <a href="javascript:window.location.reload()" class="btn btn-danger">
                        <i class="fas fa-window-close"></i>
                        Cerrar
                    </a>
                </div>
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
         $('#VERMAS').modal({
            show:true,
            backdrop:'static'
          });
        return false;
      }
    });
    return false;
  }

  // FUNCIÓN PARA VER MI TOTAL A COBRAR GESTOR
  function set_total2(obj) {
        var html = `<div class="table-responsive col-md-8 m-auto">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class=" bg-info text-white">TOTAL INICIAL</th>
            <th class="bg-info text-white">VALOR PORCENTAJE</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${obj.totalficha}</td>
            
            <td>${obj.get_porcentaje}</td>
          </tr>
        </tbody>
      </table>
      <div class="row class = "col-md-6">
        <div class="col-md-4  col-sm-12 my-2" style="display: flex;">
          <label class ="col-md-12"><b>TOTAL A PAGAR: </b></label>
        </div><input required type="text" name="total" readonly class="form-control col-md-4" value="${obj.total.toFixed(2)}">

      </div>
      
    </div>`
        document.getElementById('set_total2').innerHTML = html
    }

    function get_total2() {
        var state = {}
        var btn_total = document.getElementById('btn_get_total2')


        if (btn_total) {
            btn_total.addEventListener('click', function(e) {
                // obteniendo input a traves del id
                var $totalficha = document.getElementById('totalficha')
                var $porcentaje = document.getElementById('porcentaje')
                
                var totalficha = 0
                var por_porcentaje = 0
                
                var get_porcentaje = 0
                var total = 0
                var obj = {}

                totalficha = $totalficha.value
                por_porcentaje = $porcentaje.value
                
                if (!totalficha) {
                    alert("SE REQUIERE EL VALOR TOTAL INICIAL")
                    return false
                }

                //  parseando los datos a flotante
                totalficha = parseFloat(totalficha.split(".").join(""))
                por_porcentaje = parseFloat(por_porcentaje)
                
                get_porcentaje = (totalficha * por_porcentaje) /100
                
                total = totalficha + get_porcentaje 

                obj = {
                    get_porcentaje: get_porcentaje,
                    total: total,
                    // sub_total: sub_total,
                    totalficha: totalficha,
                    
                }
                return set_total2(obj)
            })
        }
    }

    get_total2()
</script>

