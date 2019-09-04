<section>
	<form action="" method="">
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

        <div class="d-flex flex-row-reverse bd-highlight">
                <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                    <button type="submit" name="btn-save" class="btn btn-success btn lg p-2 bd-highlight">
                        <i class="fas fa-check-circle"></i></button>
                 </div>
          </div>
  </form>        
</section>

<script type="text/javascript">
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