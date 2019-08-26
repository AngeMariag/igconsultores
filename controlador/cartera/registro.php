
<?php include ('controlador/cartera/menuinterno.php'); ?>

<section class="container mt-5">
  <h3 class="text-uppercase text-center alert alert-primary">REGISTRO PRINCIPAL DE CARTERA</h3>
  
 <!-- Agregar datos de registro para acreedor  -->
 
<!-- <form  action="formularios/procesar2.php" method="POST" class="m-auto  my-2 col-lg-12 col-md-10 text-center text-uppercase border" name="form"> -->
 <div class="form-inline form-row my-3 col-12 col-md-12" >
                
    <b><label class="col-form-label col-lg-12 m-auto">POR FAVOR SELECCIONA UN ACREEDOR O REGISTRA UNO NUEVO</label></b>
      <div class="input-group col-lg-12">
        <input type="text" class="form-control" name="buscador" id="buscar">
         <span class="input-group-btn">
         <a class="btn btn-primary text-white">BUSCAR</a>
         <a class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModalCenter">AGREGAR NUEVO ACREEDOR</a>
        </span>
      </div>
  </div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="mt-2 table-responsive">
          <div id="tabacreedor"></div>

            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end" id="pgacreedor">

            </ul>
          </nav>
      <!-- <ul id="pgacreedor" class="pagination "></ul> -->
        </div>
      </div>
      
    </div>
  </div>
</div>


<!-- SECTION PARA AGG UN NUEVO DEUDOR -->

<section>
  <!-- Button trigger modal -->


<!-- Modal  para nuevo acreedor-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">NUEVO ACREEDOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="controlador/cartera/registroacreedor.php" method="POST" id="formulario">
          

      <div class="form-group ">
        <label for="">Tipo de Documento</label>
          <select  id="tipoacreedor" class="form-control form-control-sm" name="tipo_documento" required>
            <option >Seleccione</option>
            <option value="cc">CC</option>
            <option value="ce">CE</option>
            <option value="nit">NIT</option>
         </select>
    </div>

    <div class="form-group ">
      <label for="">Número de Documento</label>
      <input type="text" class="form-control form-control-sm" id="" name="documento" required="">
    </div>
    
    <div class="form-group ">
      <label for="inputZip">Razón Social/Nombre</label>
      <input type="text" class="form-control form-control-sm" id="inputZip" name="razon_social" required="">
    </div>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" name="btn-save-acre" class="btn btn-info"><i class="far fa-save"></i> REGISTRAR</button> 
      </div>
      </form>
    </div>
  </div>
</div>
</section>

<!-- FUNCIONES DE MI FORMULARIO EN SCRIPT -->
<script type="text/javascript">


 //FUNCIÓN PARA CARGAR MI TABLA DE INICIO CON ACREEDORES REGISTRADOS
$(document).ready(paginar_resultados(1));
  
 function paginar_resultados(pagina)
{   
  $.ajax({
    url:"controlador/cartera/consulta.php?tp=1",
    type:"POST",
    data:"pagina="+pagina,
    success:function(rs){
      var a = eval(rs);
      $("#tabacreedor").html(a[0]);
      $("#pgacreedor").html(a[1]);
    }
  })
}




//SCRIPT QU EJECUTA BUSQUED EN MI TABLA 
            // When document is ready: this gets fired before body onload <img src="http://blogs.digitss.com/wp-includes/images/smilies/simple-smile.png" alt=":)" class="wp-smiley" style="height: 1em; max-height: 1em;" />
        $(document).ready(function () {
            // Write on keyup event of keyword input element
            $("#buscar").keyup(function () {
                // When value of the input is not blank
                if ($(this).val() != "")
                {
                    // Show only matching TR, hide rest of them
                    $("#tabacreedor tr").hide();

                    $("#tabacreedor td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                    // $("$boton").show();
                   
                }
                else
                {
                    // When there is no input or clean again, show everything back
                    $("#tabacreedor tbody>tr").show();

                }
            });
        });
        // jQuery expression for case-insensitive filter
        $.extend($.expr[":"],
                {
                    "contains-ci": function (elem, i, match, array)
                    {
                        return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });
        //SCRIPT QU EJECUTA BUSQUED EN MI TABLA 
            // When document is ready: this gets fired before body onload <img src="http://blogs.digitss.com/wp-includes/images/smilies/simple-smile.png" alt=":)" class="wp-smiley" style="height: 1em; max-height: 1em;" />
        $(document).ready(function () {
            // Write on keyup event of keyword input element
            $("#buscar").keyup(function () {
                // When value of the input is not blank
                if ($(this).val() != "")
                {
                    // Show only matching TR, hide rest of them
                    $("#tabacreedor tr").hide();

                    $("#tabacreedor td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                    // $("$boton").show();
                   
                }
                else
                {
                    // When there is no input or clean again, show everything back
                    $("#verproyectos tbody>tr").show();

                }
            });
        });
        // jQuery expression for case-insensitive filter
        $.extend($.expr[":"],
                {
                    "contains-ci": function (elem, i, match, array)
                    {
                        return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

    </script>








