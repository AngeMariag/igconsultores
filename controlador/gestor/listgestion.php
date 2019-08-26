<?php
include('conexion.php');
$user = $_SESSION['user'];

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
    WHERE gestor.codigo = {$user['username']}");

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
                                <a href="#" onclick="modalShow(<?= utf8_decode(strtoupper($f['id'])) ?>)" class="btn btn-warning btn-sm text-white"
                                    title="Editar" data-toggle="modal" data-target="#exampleModal3">
                                    <i class="fas fa-edit"></i>
                                </a>
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

<script type="text/javascript">
   function modalShow(id) {
     var url = 'controlador/gestor/consulta.php';
      // console.log(id);
    // if (id) {


      
    //   // base_url = '{{ base_url() }}'
    //   // url = `${base_url}/gestion/ficha?id=${id}`
    //   // $.getJSON(url)
    //     .then(function (data) {
    //       capital = parseFloat(data.ficha.capital)

    //       document.getElementById('id_name_input_hidden_id').value = id
    //       document.getElementById('id_total').innerText = parseFloat(data.ficha.total).toFixed(2)
    //       document.getElementById('set_deudor').innerHTML =
    //         `<div>
    //           <table class="table table-bordered table-sm text-center">
    //             <thead class="table-info">
    //               <tr>
    //                 <th>CÓDIGO</th>
    //                 <th>DOCUMENTO</th>
    //                 <th>NOMBRE Y APELLIDO</th>
    //                 <th>TELEFONO</th>
    //               </tr>
    //             </thead>
    //             <tbody>
    //               <tr>
    //                 <td>${data.deudor.codigo_deudor.toUpperCase()}</td>
    //                 <td>${data.deudor.tipodocumento.toUpperCase()}-${data.deudor.documento}</td>
    //                 <td>${data.deudor.nombre.toUpperCase()} ${data.deudor.apellido.toUpperCase()}</td>
    //                 <td>${data.deudor.telefono}</td>
    //               </tr>
    //             </tbody>
    //           </table>
    //         </div>`
    //       document.getElementById('set_codeudor').innerHTML=
    //       // agregare mi codeudor 
    //        `<div>
    //               <table class="table table-bordered table-sm text-center">
    //                 <thead class="table-info">
    //                   <tr>
    //                     <<th>DOCUMENTO</th>
    //                     <th>NOMBRE Y APELLIDO</th>
    //                     <th>TELEFONO</th>
    //                   </tr>
    //                 </thead>
    //                 <tbody>
    //                   <tr>
    //                     <td>${data.deudor.tipodocumento.toUpperCase()}-${data.deudor.documento}</td>
    //                     <td>${data.deudor.nombre.toUpperCase()} ${data.deudor.apellido.toUpperCase()}</td>
    //                     <td>${data.deudor.telefono}</td>
    //                   </tr>
    //                 </tbody>
    //               </table>
    //             </div>`
    //           document.getElementById('set_total').innerHTML =
    //         `<div>
    //           <table class="table table-bordered table-sm text-center">
    //             <thead>
    //               <tr>
    //                 <th>CAPITAL</th>
    //                 <th>INTERES</th>
    //                 <th>HONORARIOS</th>
    //                 <th>GASTOS</th>
    //                 <th>DESCUENTOS</th>
    //                 <th>SANCION</th>
    //               </tr>
    //             </thead>
    //             <tbody>
    //               <tr>
    //                 <td>${data.ficha.capital}</td>
    //                 <td>${(capital * parseFloat(data.ficha.interes) / 100).toFixed(2)}</td>
    //                 <td>${(capital * parseFloat(data.ficha.honorarios) / 100).toFixed(2)}</td>
    //                 <td>${(capital * parseFloat(data.ficha.gastos) / 100).toFixed(2)}</td>
    //                 <td>${(capital * parseFloat(data.ficha.descuento) / 100).toFixed(2)}</td>
    //                 <td>${(capital * parseFloat(data.ficha.sancion) / 100).toFixed(2)}</td>
    //               </tr>
    //             </tbody>
    //           </table>
    //         </div>`
    //     })
    // }
  }
</script>