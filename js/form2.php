<p class="lead text-center alert alert-primary alert-sm" role="alert">DATOS DEL DEUDOR</p>
 
  
  <div class="form-row">
    <label>Acreedor:</label>
    <input type="text" name="acreedor" class="form-control text-uppercase" id="" placeholder="Acreedor">
  </div>

  <div class="form-row">
    
    <div class="form-group col-md-6 my-2">
      <label for="inputState">Tipo de Documento</label>
      <select id="" class="form-control" name="tipodocumento_deudor">
        <option selected>Selecciona...</option>
        <option value="cc">CC</option>
        <option value="ce">CE</option>
        <option value="nit">NIT</option>

      </select>
    </div>
    <div class="form-group col-md-6 my-2">
      <label for="inputCity">Nro. Documento</label>
      <input type="text" class="form-control" id="" name="documento_deudor">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6 my-2">
      <label for="inputEmail4">NOMBRE</label>
      <input type="text" class="form-control text-uppercase" id="inputEmail4" placeholder="Nombre" name="nombre_deudor">
    </div>
    <div class="form-group col-md-6 my-2">
      <label for="inputPassword4">APELLIDO</label>
      <input type="text" class="form-control" id="" placeholder="Apellido" name="apellido_deudor">
    </div>
  </div>

    <div class="form-row">
    <div class="form-group col-md-4 my-2">
      <label for="inputEmail4">TELEFONO</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" name="telefono_deudor">
    </div>
    <div class="form-group col-md-8 my-2">
      <label for="inputPassword4">DIRECCIÓN</label>
      <input type="text" class="form-control" id="" placeholder="Apellido" name="direccion_deudor">
    </div>
  </div>

   <p class="lead text-center alert alert-primary " role="alert">DATOS DEL CODEUDOR</p>
  <div class="form-row">
    <div class="form-group col-md-6 my-2">
      <label for="inputState">Tipo de Documento</label>
      <select id="inputState" class="form-control" name="tipodocumento_codeudor" >
        <option selected>...</option>
        <option value="cc">CÉDULA DE CIUDADANIA</option>
        <option value="ce">CÉDULA DE EXTRANJERIA</option>
        <option value="nit">NIT</option>
      </select>
    </div>
    <div class="form-group col-md-6 my-2">
      <label for="inputCity">Nro. Documento</label>
      <input type="text" class="form-control" id="" name="documento_codeudor">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6 my-2">
      <label for="inputEmail4">NOMBRE</label>
      <input type="text" class="form-control" id="" placeholder="Nombre" name="nombre_codeudor">
    </div>
    <div class="form-group col-md-6 my-2">
      <label for="inputPassword4">APELLIDO</label>
      <input type="text" class="form-control" id="" placeholder="Apellido" name="apellido_codeudor">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4 my-2">
      <label for="inputEmail4">TELEFONO</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Npombre" name="telefono_codeudor">
    </div>
    <div class="form-group col-md-8 my-2">
      <label for="inputPassword4">DIRECCIÓN</label>
      <input type="text" class="form-control" id="" placeholder="Dirección" name="direccion_codeudor">
    </div>
  </div>

  <p class="lead text-center alert alert-primary" role="alert">FACTURA</p>

  <div class="form-row">
    <div class="form-group col-md-6 my-2">
      <label for="inputEmail4">TITULO</label>
      <input type="text" class="form-control" id="" placeholder="TITULO" name="titulo_ficha">
    </div>
    <div class="form-group col-md-6 my-2">
      <label for="inputPassword4">CAPITAL</label>
      <div class="input-group">
        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="capital_ficha" id="capital">
        <div class="input-group-append">
        <span class="input-group-text">$ PCO</span>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3 my-2">
      <label for="inputEmail4">INTERES</label>
       <div class="input-group">
        <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="interes" id="interes">
        <div class="input-group-append">
        <span class="input-group-text">%</span>
        </div>
      </div>
    </div>
    <div class="form-group col-md-3 my-2">
      <label for="inputPassword4">HONORARIOS</label>
      <input type="text" class="form-control" id="honorarios" placeholder="CAPITAL" name="honorarios"  value="23%" readonly>
    </div>
    <div class="form-group col-md-3 my-2">
      <label for="inputPassword4">GASTOS</label>
      <input type="text" class="form-control" id="gastos" placeholder="CAPITAL" name="gastos" readonly="" value="12%">
    </div>
    <div class="form-group col-md-3 my-2">
      <label for="" class="">DESCUENTOS</label>
      <div class="input-group">
        <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="descuento" id="descuento">
        <div class="input-group-append">
        <span class="input-group-text">%</span>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row ">
      <div class="form-group my-2">
      <label for="">POR FAVOR SELECCIONA ESTA OPCIÓN SOLO SI APLICA SANCIÓN (CHEQUE)</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sancion" id="sancion" value="20%">
          <label class="form-check-label" for="inlineRadio1"> SI </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sancion" id="sancion" value="0">
          <label class="form-check-label" for="inlineRadio2">NO </label>
        </div>
      </div>
  </div>
     <button type="button" name="btn-total" class="btn btn-primary d-flex justify-content-sm-end my-2"  onclick="calcular(this)">SACAR TOTAL</button>

     <div class="" id="vista"></div>
    

<!-- <p class="lead text-center alert alert-primary" role="alert">AGREGAR OBSERVACIONES</p> -->

    <div class="form-group">
      <label class="col-md-6 control-label" for="nombres">OBSERVACIONES:</label>  
          <input type="button" class="btn btn-success pull-right"  value="+"  onclick="crearnp(this)" >
    <center>
      <div id="tablanp" class=""></div>
    </center>
    <span class="help-block right"></span>
    </div>

  <!-- <div class=" form-row"> -->
   <label>REPARTO</label>
   <input type="text-center" name="reparto" placeholder="CORRESPONDE A NUMERACIÓN" class="form-control">
 <!-- </div> -->
<div class="btn-group btn-group-lg my-5" role="group" aria-label="Basic example">
      <button type="submit" name="btn-enviar" class="btn btn-success"><i class="far fa-save"></i>
   GUARDAR</button> 
    <button type="button" class="btn btn-warning" name=""><i class="fas fa-eraser"></i>



    RESET</button>
    <button type="button" class="btn btn-danger"><i class="fas fa-eraser"></i>ATRAS</button>
 </div>

