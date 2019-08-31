<div class="" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container my-3">
                <form action="controlador/cartera/registroficha2.php" enctype="multipart/form-data" method="post">
                    <div class="card">


                        <!-- DATOS FACTURA  -->
                        <div class="card-header bg-primary text-white text-center">
                            FACTURA
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail4">TITULO</label>
                                        <input required type="text" value="" class="form-control" id="" placeholder="TITULO" name="titulo">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputPassword4">CAPITAL</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="capital" id="capital" value="" onkeyup="format(this);" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">$ PCO</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail4">INTERES</label>
                                        <div class="input-group">
                                            <input required type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="interes" id="interes" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputPassword4">HONORARIOS</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" id="honorarios" placeholder="CAPITAL" name="honorarios" value="23" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputPassword4">GASTOS</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" id="gastos" placeholder="CAPITAL" name="gastos" readonly="" value="12">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-justify">
                                    <div class="form-group">
                                        <label for="">POR FAVOR SELECCIONA ESTA OPCIÓN SOLO SI APLICA SANCIÓN
                                            (CHEQUE)</label>
                                        <div class="form-check form-check-inline">
                                            <input required class="form-check-input" type="radio" name="sancion" id="sancion" value="20">
                                            <label class="form-check-label" for="inlineRadio1"> SI </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input required class="form-check-input" checked type="radio" name="sancion" id="sancion" value="0">
                                            <label class="form-check-label" for="inlineRadio2">NO </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" name="btn-total" class="btn btn-primary d-flex justify-content-sm-end my-2" id="btn_get_total">SACAR
                                        TOTAL
                                    </button>
                                </div>
                                <div class="col-12">
                                    <div id="set_total" class="mb-5 mt-3 text-center"></div>
                                </div>

                            </div>
                        </div>
                        <!-- END DATOS FACTURA  -->
                        <div class="card-body text-center">
                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                <button type="submit" name="btn-enviar" class="btn btn-success">
                                    <i class="far fa-save"></i>
                                    GUARDAR
                                </button>
                                <a href="javascript:window.location.reload()" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i>
                                    Cerrar
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //FUNCION PARA CALCULAR TOTAL

    function set_total(obj) {
        var html = `<div class="table-responsive col-md-11">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>CAPITAL</th>
            <th>INTERES</th>
            <th>HONORARIOS</th>
            <th>GASTOS</th>
            <th>SANCION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${obj.capital}</td>
            <td>${obj.get_interes}</td>
            <td>${obj.get_honorarios}</td>
            <td>${obj.get_gastos}</td>
            <td>${obj.get_sancion}</td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-4 offset-md-8 col-sm-12 my-2" style="display: flex;">
          <label class ="col-md-6">Sub-Total: </label>
          <input required type="text" name="total1" readonly class="form-control" value="${obj.total}">
        </div>
      </div>
       <div class="row">
        <div class="col-md-4 offset-md-8 col-sm-12 my-2" style="display: flex;">
          <label class ="col-md-6">Total: </label>
          <input required type="text" name="total" readonly class="form-control" value="${obj.total}">
        </div>
      </div>
    </div>`
        document.getElementById('set_total').innerHTML = html
    }

    function get_total() {
        var state = {}
        var btn_total = document.getElementById('btn_get_total')


        if (btn_total) {
            btn_total.addEventListener('click', function(e) {
                // obteniendo input a traves del id
                var $capital = document.getElementById('capital')
                var $interes = document.getElementById('interes')
                var $honorarios = document.getElementById('honorarios')
                var $gastos = document.getElementById('gastos')
                var $sancion = document.querySelector('input[name="sancion"]:checked')

                var capital = 0
                var por_interes = 0
                var por_honorarios = 0
                var por_gastos = 0
                var por_sancion = 0

                var get_interes = 0
                var get_honorarios = 0
                var get_gastos = 0
                var get_sancion = 0
                var total = 0
                var obj = {}

                capital = $capital.value
                por_interes = $interes.value
                por_honorarios = $honorarios.value
                por_gastos = $gastos.value
                por_sancion = $sancion.value

                if (!capital) {
                    alert("SE REQUIERE EL VALOR CAPITAL")
                    return false
                }

                //  parseando los datos a flotante
                // capital = (capital) 
                // por_interes = (por_interes)
                // por_honorarios = (por_honorarios)
                // por_gastos = (por_gastos)
                // por_sancion = (por_sancion)

                get_interes = (capital * por_interes) / 100
                // get_honorarios = (capital * por_honorarios) / 100
                // get_gastos = (capital * por_gastos) / 100
                // get_descuento = (capital * por_descuento) / 100
                // get_sancion = (capital * por_sancion) / 100

                total = capital + get_interes 

                // get_descuento = (total * por_descuento) / 100

                // sub_total = total - get_descuento
                obj = {
                    get_interes: get_interes,
                    get_honorarios: get_honorarios,
                    get_gastos: get_gastos,
                    total: total,
                    // sub_total: sub_total,
                    capital: capital,
                    get_sancion: get_sancion
                }
                return set_total(obj)
            })
        }
    }

    get_total()

    function crearnp(obj) {

        var fila = `
        <div style="display: flex; align-items: center;">
            <div style="width:100%;">
                <input required type="text" class="form-control col-md-12 col-lg-12 my-2"
                    name="observacion[]" placeholder="OBSERVACIONES"
                    aria-describedby="inputGroup-sizing-sm" />
            </div>
            <div>
                <button type="button" class="eliminar btn-md btn btn-danger">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>
        </div>
        `
        $(document).on("click", ".eliminar", function() {
            var parent = $(this).parents().get(1);
            $(parent).remove();
        });
        $('#tablanp').append(fila);
    }


    // FUNCION PARA AGG DOCUMENTOS

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
    function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
  
else{ alert('TIPEA SOLO NÚMEROS');
input.value = input.value.replace(/[^\d\.]*/g,'');
}
}
</script> 