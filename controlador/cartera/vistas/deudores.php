<section>
	<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="mt-2 table-responsive">
            <div id="tabdeudores"></div>

            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end" id="pgdeudor">

              </ul>
            </nav>
            <!-- <ul id="pgacreedor" class="pagination "></ul> -->
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- MODAL DE VISTA DE DOCUMEBTOS -->
<section>
<!-- Modal -->
<div class="modal fade" id="modal-ver"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 70% !important;">
                        <div class="modal-content">
                        <!--Header de la ventana-->
                            <div class="modal-header" style=" background:#003380;">
                                <button tyle="buttom" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title" id="myModalLabel" style="font-weight:bold; text-align:center; color:white;">DOCUMENTOS DEL DEUDOR</h3>
                            </div>

                            <!--Header del contenido-->
                           
                            <div class="modal-body">
                            
                            <form action="" method="POST" id="hola">
                  
                            <div id="verdocument">
                                
                            </div>  
                                        
                            </form>
                            
                        
                            
                            </div>
                            <!--footer-->
                            <div class="modal-footer">
                                <button type="buttom" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                
                            </div>
                        </div>
                   </div>
        </div>

</section>

<!-- visualizar datos del deudor MODAL EXTRA LARGA-->
<section>

<style type="text/css">
  label{
    
  }
</style>
<div class="modal fade bd-example-modal-xl" id="VERMAS" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="container-fluid">
        <form action="" method="POST" id="modalvermas" class="text-center m-auto">
          
          <input type="hidden" required="required" readonly="readonly" id="id_ficha1" readonly="readonly"/>
          <h1 class="text-center my-2 card-header bg-default" style="color:#000080;">INFORMACIÓN GENERAL DE CUENTA DEUDOR</h1>

          <div class="form-group  row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Código Deudor:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="codigo_deudor" placeholder="Password" readonly="">
            </div>
          </div>
          <div class="form-group  row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Identificación:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="documento_deudor" placeholder="Password" readonly="">
            </div>
          </div>
          <div class="form-group  row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Deudor:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="deudor_deudor" placeholder="Password" readonly="">
            </div>
          </div>
          <div class="form-group  row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Gestor</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="gestor_deudor" placeholder="Password" readonly="">
            </div>
          </div>

          <div class="form-group  row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Acreedor</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="acreedor_deudor" placeholder="Password" readonly="">
            </div>
          </div>

           <div class="form-group  row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Acuerdo</label>
            <div class="col-sm-6">
              <textarea type="text" class="form-control" id="acreedor_deudor" placeholder="No hay Acuerdo registrado" readonly=""></textarea>
              
            </div>
          </div>
          <h3 class="text-center my-3"> CODEUDORES ASOCIADOS</h3>
          <div class="container-fluid">
            <div class="table table-responsive m-auto" id="vercodeudores">
              
            </div>
          </div>

           <h3 class="text-center my-3"> FICHA </h3>
          <div class="container-fluid">
            <div class="table table-responsive m-auto" id="verficha">
              
            </div>
          </div>

          <h3 class="text-center my-3"> GESTIONES ACORDADAS CON EL GESTOR </h3>
          <div class="container-fluid">
            <div class="table table-responsive m-auto" id="vergestiones">
           </div>
          </div>
          <br>
          <h3 class="text-center my-3"> PAGOS REGISTRADOS EN CONTABILIDAD </h3>
          <div class="container-fluid">
            <div class="table table-responsive m-auto" id="verpagos">
              
            </div>
          </div>
          <div class="btn-group btn-group-sm my-5" style="">
                        
                        <a href="javascript:window.location.reload()" class="btn btn-danger"><i class="fas fa-eraser"></i>CERRAR</a>
                    </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

</section>

<script type="text/javascript">
	 $(document).ready(paginar_deudores(1));

    function paginar_deudores(pagina) {
      $.ajax({
        url: "controlador/cartera/consulta.php?tp=2",
        type: "POST",
        data: "pagina=" + pagina,
        success: function(rs) {
          var a = eval(rs);
          $("#tabdeudores").html(a[0]);
          $("#pgdeudor").html(a[1]);
        }
      })
    }

    function verdocumentos(id)
{       
    $.ajax({
        url:"controlador/cartera/consulta.php?tp=3",
        type:"POST",
        data:"id="+id,
        success:function(rs){
            var a = eval(rs);
            $("#verdocument").html(a[0]);
            //$("#adicionales").html(a[1]);
            $('#modal-ver').modal({
            show:true,
            backdrop:'static'
          });
        return false;
        }
    })
}
// FUNCION PARA VER MÁS

function leermas(id)
  {
    $('#modalvermas')[0].reset();
    var url = 'controlador/cartera/consulta.php?tp=4';
      $.ajax({
      type:'POST',
      url:url,
      data:'tp=4&id='+id,
      success: function(valores){
          var datos = eval(valores);
         $('#id_ficha1').val(id);
         $('#codigo_deudor').val(datos[0]);
         $('#documento_deudor').val(datos[1]);
         $('#deudor_deudor').val(datos[2]);
         $('#gestor_deudor').val(datos[3]);
        $('#acreedor_deudor').val(datos[4]);
        $("#vercodeudores").html(datos[5]);
        $("#verficha").html(datos[6]);
         $("#vergestiones").html(datos[7]);
         $("#verpagos").html(datos[8]);
//          $('#fecha_inicio3').val(datos[4]);
//          $('#fecha_fin3').val(datos[5]);
//          $('#objetivo_contrato3').val(datos[6]);
//          //$('#objetivo_especificos3').val(datos[7]);
//          $('#valor_facturado3').val(datos[7]);
//          $('#valor_facturado3').val(datos[8]);

//          $("#vertablas2").html(datos[10]);
//          $("#vertablas3").html(datos[11]);
//          $("#vertablas").html(datos[12]);
//          $("#vertablas1").html(datos[13]);//objetivosespecificos
//          $('#fecha_registro').val(datos[14]);
//          $('#fecha_modificacion').val(datos[15]);
         $('#VERMAS').modal({
            show:true,
            backdrop:'static'
          });
        return false;
      }
    });
    return false;
  }
</script>



