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
</script>



