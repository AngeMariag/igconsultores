<?php 
include('conexion.php');
$user = $_SESSION['user'];

// $codigo =$_POST['user'];


 $sql = $cn->query( "SELECT ficha.id, gestor.codigo, deudor.codigo as dcodigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social 
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
            WHERE gestor.codigo = $user");

 ?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header text-white bg-info ">
            SELECCIONA UNA GESTIÓN
        </div>
        <div class="card-body">
            <div class="row">
                <div class="offset-md-6 col-md-6 col-sm-12 col-12">
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input name="q" type="search" class="form-control"
                                placeholder="Buscar por Documento del Deudor o Nombre Del Acreedor">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" id="button-addon2">
                                    Buscar
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if (mysqli_num_rows($consulta) != 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código Deudor</th>
                            <th>Código GESTOR</th>
                            <th>Documento Deudor</th>
                            <th>Deudor</th>
                            <th>Acreedor</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                          <?php while ($f = mysqli_fetch_assoc($consulta)) { ?>
                        <tr>
                            <td><?= utf8_encode(strtoupper($f["codigo"])) ?></td>
                            <td>{{ data.dcodigo }}</td>
                            <td><?= utf8_encode(strtoupper($user)) ?></td>
                             <td>
                              <?= utf8_encode(strtoupper($f["tipo_documento"])) ?>
                              <span class="badge badge-<?= utf8_encode($f['tipo_documento']) == 'nit' ? 'warning' : 'primary' ?>">
                                <?= utf8_encode($f["tipo_documento"]) == 'nit' ? 'Jurídica' : 'Natural' ?>
                                <?php utf8_encode(strtoupper($f["tipo_documento"])) ?>
                              </span>
                            </td>
                            <td><?utf8_encode(strtoupper($f["nombre"])). <?utf8_encode(strtoupper($f["apellido"]))?></td>
                            <td><?utf8_encode(strtoupper($f["razon_social"]))?></td>
                            <td></td>
                            <td>
                                <a href="#" onclick="modalShow1()" class="btn btn-info btn-sm text-white"
                                    title="Ver" data-toggle="modal" data-target="#vista">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" onclick="modalShow()" class="btn btn-warning btn-sm text-white"
                                    title="Editar" data-toggle="modal" data-target="#exampleModal3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- <a href="#" class="btn btn-danger btn-sm text-white" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                  <div class="alert alert-danger text-center">
                <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
              </div>
               <?php } ?>
            </div>
        </div>
    </div>
</div> <!-- container-->


<!-- Modal -->
<form action="{{ path_for('gestion_add_post') }}" method="post">
    <input type="hidden" name="{{csrf.keys.name}}" value="{{csrf.name}}">
    <input type="hidden" name="{{csrf.keys.value}}" value="{{csrf.value}}">
    <input type="hidden" name="id" value="" id="id_name_input_hidden_id">
    <div class="modal fade bg " id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-white bg-info">
                    <h5 class="modal-title text-center" id="exampleModal3Label">REGISTRO DE GESTIÓN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group col-sm-12">
                                <h4 for="" class="text-center my3">DATOS DEL DEUDOR</h4>
                                <div id="set_deudor"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group col-sm-12">
                                <h4 for="" class="text-center my3">DATOS DEL CODEUDOR</h4>
                                <div id="set_codeudor"></div>
                            </div>
                        </div>
                        

                        <div class="col-12">
                            <div class="form-group col-sm-12">
                                <h3 for="">Deuda Total: <b><span id="id_total"></span></b></h3>
                                <div id="set_total"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group col-sm-12">
                                <label for="">ACUERDO</label>
                                <textarea rows="1" name="acuerdo" placeholder="Detalle el acuerdo"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-info m-2 " onclick="pago(this)">AGREGAR PAGOS</button>
                        </div>
                        <div class="col-12 mb-3" id="pagos"></div>
                        <div class="col-12  text-center">
                            <h2>AGREGAR RECORDATORIO</h2>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">FECHA DE RECORDATORIO</label>
                                <input type="date" class="form-control form-control-sm" id="" placeholder=""
                                    name="fecha_gestion">
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="">MOTIVO</label>
                                <input type="text" class="form-control form-control-sm" id="" placeholder=""
                                    name="gestion">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    <button type="submit" class="btn btn-success">AGREGAR</button>
                </div>
            </div>
        </div>
    </div>
</form>



<!-- modal para visualizar los datos agg del deudor con su respectiv gestión -->
<div class="modal fade bg " id="vista" tabindex="-1" role="dialog" aria-labelledby="vistaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h5 class="modal-title text-center" id="vistaLabel">GESTIÓN DEL DEUDOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-12">
                            <div class="form-group col-sm-12">
                                <h3 for="">Deudor</h3>
                                <div id="set_deudor"></div>
                            </div>
                        </div>
                <div class="row">

                  <!-- <div class="col-12 form-row form-inline">
                    <label class=" col-md-3">Deudor:</label>
                    <input type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                  </div>
=======
                    <div class="col-12 form-row form-inline">
                        <label class=" col-md-3">Deudor:</label>
                        <input id="input_deudor" type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                    </div>
>>>>>>> 4a1a279dc1c2d6de8a40d8b380bb05d18e976400

                    <div class="col-12 form-row form-inline">
                        <label class="col-md-3">Fecha de Registro:</label>
                        <input id="input_fecha" type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                    </div>

<<<<<<< HEAD
                  <div class="col-12 form-row form-inline">
                  <label class="col-md-3">Deuda Total:</label>
                  <input type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                </div>
                <div class="col-12 form-row form-inline">
                  <label class="col-md-3">Acreedor:</label>
                  <input type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                </div> -->
                <div class="col-12 form-row form-inline">
                  <label for="" class="col-md-3 col-sm-12">Acuerdo</label>
                    <textarea placeholder="Detalles del acuerdo" class="form-control col-md-9 my-2" readonly id="input_acuerdo"></textarea>
                 </div>
                      <!-- <div class="col-12">
                        <div class="form-group">
                            <label for="" class="col-md-2 col-sm-12">ACUERDO</label>
                            <textarea placeholder="Detalle el acuerdo" class="form-control" readonly id="input_acuerdo"></textarea>
                        </div>
                    </div> -->

                 <div class="col-12 my-3">
                  <h3 class="text-center my2">PAGOS ACORDADOS</h3>
                  <div id="infoPagos"></div>
                </div>
                   <!--  <div class="col-12">
                        <h3>ACUERDO DE PAGOS</h3>
                        
                    </div> -->
                    <div class="col-12">
                        <h3 class="text-center my2">RECORDATORIOS</h3>
                        <div id="infoRecordatorios"></div>
                    </div>
                    <!-- <div class="col-12">
                        
                        <h3>PAGOS AGREGADOS</h3>
                    </div> -->
                    <div class="col-12 my-3">
                      <h3 class="text-center my2">OBSERVACIONES DE LA FICHA:</h3>
                      <!-- AQUI SE DEBERIA DE MOSTRAR LOS PAGOS QUE SE ACORDARON EN EL MOMENTO DE LA GESTION LOS CAMPOS SERIAN GESTION, MONTO, FECHA Y ESTATUS -->
                   </div>

                    <div class="col-12 form-row form-inline">
                        <label class="col-md-3">Deuda Total:</label>
                        <input id="input_total" type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                    </div>
                    <div class="col-12 form-row form-inline">
                        <label class="col-md-3">Acreedor:</label>
                        <input id="input_acreedor" type="text" name="nombre_deudor" readonly="" class="form-control col-md-9 my-2">
                    </div>
                    <div class="col-12 form-row form-inline">
                        <label for="" class="col-md-3 col-sm-12">Acuerdo</label>
                        <textarea placeholder="Detalle el acuerdo" class="form-control col-md-9 my-2" readonly
                            id="input_acuerdo"></textarea>
                    </div>

                    <div class="col-12 my-3">
                        <h3 class="text-center">PAGOS ACORDADOS</h3>
                        <!-- AQUI SE DEBERIA DE MOSTRAR LOS PAGOS QUE SE ACORDARON EN EL MOMENTO DE LA GESTION LOS CAMPOS SERIAN GESTION, MONTO, FECHA Y ESTATUS -->
                        <div id="infoPagos"></div>
                    </div>

                    <div class="col-12 my-3">
                        <h3 class="text-center">OBSERVACIONES DE LA FICHA:</h3>
                        <!-- AQUI SE DEBERIA DE MOSTRAR LOS PAGOS QUE SE ACORDARON EN EL MOMENTO DE LA GESTION LOS CAMPOS SERIAN GESTION, MONTO, FECHA Y ESTATUS -->
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
