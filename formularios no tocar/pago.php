<div class="container">
  <p class=" text-center alert alert-primary my-5" role="alert">SELECCIONA UNA GESTIÓN</p>


  <div class="card">
                  <div class="table-responsive">
                      <table class="table table-hover">

                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Código</th>
                                  <th>Documento Deudor</th>
                                  <th>Deudor</th>
                                  <th>Acreedor</th>
                                  <th>Opciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td> 
                                  <td>
                                      <a href="#" class="btn btn-info btn-sm text-white" title="Ver">
                                          <i class="fas fa-eye"></i>
                                      </a>
                                      <a href="#" class="btn btn-warning btn-sm text-white" title="Editar" data-toggle="modal" data-target="#exampleModal3">
                                          <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="#" class="btn btn-success btn-sm text-white" title="REGISTRAR GESTION" data-toggle="modal" data-target=".bd-example-modal-lg">
                                          <i class="fas fa-plus"></i>
                                      </a>
                                      <a href="#" class="btn btn-danger btn-sm text-white" title="Eliminar">
                                          <i class="fas fa-trash"></i>
                                      </a>
                                  </td>
                              </tr>
                              <tr>
                                  
                              </tr>
                          </tbody>
                      </table>
                      
                  </div>
  </div>
</div>   <!-- container-->


<!-- Modal -->
<div class="modal fade bg " id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" style="">
        <div class="modal-content">
          <div class="modal-header head-info">
            <h5 class="modal-title text-center" id="exampleModal3Label">REGISTRO DE GESTIÓN Y PAGOS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
     

      <div class="modal-body">
        <div class="tabladeudor">
          <table class="table table-hover">

                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Código</th>
                                  <th>Documento Deudor</th>
                                  <th>Deudor</th>
                                  <th>Acreedor</th>
                                  <th>Opciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td> 
                                  <td>
                                      <a href="#" class="btn btn-info btn-sm text-white" title="Ver">
                                          <i class="fas fa-eye"></i>
                                      </a>
                                      <a href="#" class="btn btn-warning btn-sm text-white" title="Editar" data-toggle="modal" data-target="#exampleModal3">
                                          <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="#" class="btn btn-danger btn-sm text-white" title="Eliminar">
                                          <i class="fas fa-trash"></i>
                                      </a>
                                  </td>
                              </tr>
                              <tr>
                                  
                              </tr>
                          </tbody>
        </table>
      </div>

      <div class="tablacodeudor">
      <table class="table table-hover">

                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Código</th>
                                  <th>Documento Deudor</th>
                                  <th>Deudor</th>
                                  <th>Acreedor</th>
                                  <th>Opciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td> 
                                  <td>
                                      <a href="#" class="btn btn-info btn-sm text-white" title="Ver">
                                          <i class="fas fa-eye"></i>
                                      </a>
                                      <a href="#" class="btn btn-warning btn-sm text-white" title="Editar" data-toggle="modal" data-target="#exampleModal3">
                                          <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="#" class="btn btn-danger btn-sm text-white" title="Eliminar">
                                          <i class="fas fa-trash"></i>
                                      </a>
                                  </td>
                              </tr>
                              <tr>
                                  
                              </tr>
                          </tbody>
                      </table>
                    </div>

      <div class="tabladeudor">
        <h3 class="text-center">DEUDA TOTAL 1.000.000$</h3>
      </div>
      
        <p class="alert-primary alert alert-primary-sm" style="height: 20%;"></p>
        <div class="row col-md-12 m-auto">
          <div class="col-md-3"> 
                <label> VALOR TOTAL</label>
              <input type="text" name="" class="form-control form-control-sm" readonly="">
          </div>
           <div class="col-md-3"> 
                <label>% SUMAR</label>
              <input type="text" name="" placeholder="Porcentaje a sumar" class="form-control form-control-sm">
          </div>
           <div class="col-md-2"> 
            <label>CALCULAR </label>
            <button class="btn  btn-success btn-sm">CALCULAR</button>
            </div>

            <div class="col-md-4"> 
                <label>TOTAL A COBRAR</label>
              <input type="text" name="" placeholder="" class="form-control form-control-sm">
          </div>
          </div>

        <p class="alert-primary alert alert-primary-sm my-2" style="height: 20%;"></p>
           
        <div class="form-row">
          <div class="form-inline col-sm-12 my-3">
            <label for="" class="col-md-2 col-sm-12 text-center">ACUERDO DE PAGO</label>
            <textarea name="" placeholder="Detalle el acuerdo" class="form-control col-md-10 col-sm-12"></textarea>
          </div>
 </div>

      <div class="form-row">
      <div class="form-row float-center">
          <button class="btn btn-outline-success m-2 " onclick="pago(this)">AGREGAR PAGOS</button>

      </div>

      </div>
        <div class="table-hover" id="pagos">
            
        </div>

<p class="alert-primary alert alert-primary-sm my-2" style="height: 20%;"></p>
        
      <div class="col-12 my-3 text-center">
      <h3>AGREGAR RECORDATORIO</h3>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4 my-2">
        <label for="">FECHA</label>
        <input type="date" class="form-control form-control-sm" id="" placeholder="" name="fecha_gestion">
        </div>
        <div class="form-group col-md-2 my-2">
        <label for="">HORA</label>
        <input type="time" name="hora" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-6 my-2">
        <label for="">MOTIVO</label>
        <input type="text" class="form-control form-control-sm" id="" placeholder="" name="gestion">
        </div>
         
    </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success">AGREGAR</button>
      </div>
    </div>
  </div>
</div>


<!--modal para ver mis gestiones diarias -->
<div class="modal fade bd-example-modal-lg" tabindex="-3" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="container">
                
      <div class="col-12 my-3 text-center">
      <h3>AGREGAR GESTIÓN</h3>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4 my-2">
        <label for="">FECHA</label>
        <input type="date" class="form-control form-control-sm" id="" placeholder="" name="fecha_gestion">
        </div>
        <div class="form-group col-md-2 my-2">
        <label for="">HORA</label>
        <input type="time" name="hora" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-6 my-2">
        <label for="">MOTIVO</label>
        <input type="text" class="form-control form-control-sm" id="" placeholder="" name="gestion">
        </div>
         
    </div>

    <div class=" my-5">
      <button class="btn-success btn pull-right">GUARDAR GESTÍON</button>
    </div>
      </div>
    </div>
  </div>
</div>
<!-- <div class="container-fluid text-center">
  <h>REGISTRAR GESTIÓN</h2>

    <div class="form-row">
      <div class="form-inline col-sm-12 my-3">
      <label for="" class="col-md-2 col-sm-12">DETALLES DEL ACUERDO</label>
      <textarea name="" placeholder="Detalle el acuerdo" class="form-control col-md-10 col-sm-12"></textarea>
      </div>
    </div>

    
    
    
</div> -->

