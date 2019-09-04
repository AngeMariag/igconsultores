<section>
	<form class="" action="controlador/gestor/registrar_gestion.php" method="POST">
	<div class="card-header text-white my-3" style=" background:#003380;">
            REGISTRAR GESTIÓN
     </div>
 <input type="hidden" required="required" readonly="readonly" id="id_ficha1" readonly="readonly" name="id">
        <div class="container-fluid">
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="inputCity">GESTIÓN</label>
                  <textarea class="form-control" name="gestion" required=""></textarea>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputZip">FECHA</label>
                  <input type="date" class="form-control" id=""  required="" name="fecha" min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">MONTO</label>
                  <input type="text" class="form-control" id="" name="monto" placeholder="Monto" value="0">
                </div>
                <div class="form-group col-md-2">
                  <label for="">ESTADO</label>
                  <select id="" class="form-control" name="estado" required="requerido">
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
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                <button type="submit" name="btn-save" class="btn btn-success btn lg p-2 bd-highlight">
                    <i class="fas fa-check-circle"></i></button>
             </div>
         </div>
    </form>
</section>