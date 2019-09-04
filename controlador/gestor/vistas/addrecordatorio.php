<section>
	<form action="controlador/gestor/registro_recordatorio.php" method="POST">
		<div class="card-header text-white my-3" style=" background:#003380;">
            AGREGAR RECORDATORIO
        </div>
       
     <div class="form-row container-fluid">
         <input type="hidden" required="required" readonly="readonly" id="id_ficha1" readonly="readonly" name="id">
     
        <div class="form-group col-md-4 my-2">
        <label for="">FECHA</label>
        <input type="date" class="form-control form-control-sm" id="" placeholder="" required="" name="fecha"  min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
        </div>
        <div class="form-group col-md-2 my-2">
        <label for="">HORA</label>
        <input type="time" name="hora" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-6 my-2">
        <label for="">MOTIVO</label>
        <textarea class="form-control" name="recordatorio" placeholder="Registra el motivo para recordar"></textarea>
        </div>
         
    </div>
    <div class="d-flex flex-row-reverse bd-highlight">
                <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                    <button type="submit" name="save-recordatorio" class="btn btn-success btn lg p-2 bd-highlight">
                        <i class="fas fa-check-circle"></i></button>
                 </div>
            </div>
    </form>
</section>