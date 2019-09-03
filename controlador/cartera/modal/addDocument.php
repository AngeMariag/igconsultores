<div class="modal fade bd-insert-document" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container my-3">
                <form action="controlador/cartera/registrarcartera.php" enctype="multipart/form-data" method="post" class="m-auto  my-2 col-lg-12 col-md-10 text-center text-uppercase border">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <p class="my-5">POR FAVOR INSERTER LA FECHA DE REGISTRO DE LA CARTERA</p>
                    <div class="form-inline my-5">
                        <label class="col-md-5"><b style="color: red;">(*)</b>INTRODUZCA LA FECHA DE INGRESO DE LA CARTERA</label>
                        <input type="date" name="fecha" class="form-control col-md-7" required="">
                    </div>
                    <div class="btn-group btn-group-lg my-5" style="display: flex; justify-content: center;">
                        <button type="submit" name="btn-guardar-cartera" class="btn btn-success"><i class="far fa-save"></i>
                            GUARDAR</button>
                        <a href="javascript:window.location.reload()" class="btn btn-danger"><i class="fas fa-eraser"></i>CERRAR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>