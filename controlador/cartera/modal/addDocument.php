<div class="modal fade bd-insert-document" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container my-3">
                <form action="controlador/cartera/registrarcartera.php" enctype="multipart/form-data" method="post" class="m-auto  my-2 col-lg-12 col-md-10 text-center text-uppercase border">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <p class="my-5">POR FAVOR INSERTER LA FECHA DE REGISTRO DE LA CARTERA</p>
                    <div class="form-inline my-5">
                        <label class="col-md-5"><b style="color: red;">(*)</b>INTRODUZCA LA FECHA DE INGRESO DE LA CARTERA</label>
                        <input type="date" name="fecha" class="form-control col-md-7">
                    </div>
                    <!-- FIELD DONDE CREO DOCUMENTOS -->
                    <!-- <p class=" text-center alert alert-primary alert-large my-2" role="alert">
                        ADJUNTE DOCUMENTOS DE RESPALDO DE LA CARTERA
                        <button type="button" class="btn btn-success pull-right btn-sm" onclick="mostrar_mas()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </p> -->
                    <!-- <div id="field" class=""></div> -->

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

<!-- <script>
    function mostrar_mas(obj) {
        var fila = `
            <div class="row my-2" style="justify-content: center; align-items: center; ">
                <div class="col-sm-12 col-md-5">
                    <input type="text" required class="form-control form-control-sm " name="ndocumento[]" placeholder="NOMBRE DEL DOCUMENTO">
                </div>
                <div class="col-sm-12 col-md-5">
                    <input type="file" required class="form-control form-control-sm" name="documentos_general[]">
                </div>
                <div class="">
                    <button class="eliminar btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `
        $('#field').append(fila);
    }
    // Evento que selecciona la fila y la elimina
    $(document).on("click", ".eliminar", function() {
        var parent = $(this).parents().get(1);
        $(parent).remove();
    });
</script> -->