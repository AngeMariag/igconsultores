<section class="container mt-5">
  <h3 class="text-uppercase text-center">REGISTRO DE CARTERA</h3>
  
 <!-- Agregar datos de registro para acreedor  -->
 
<form  action="formularios/procesar2.php" method="POST" class="m-auto  my-2 col-lg-12 col-md-10 text-center text-uppercase border" name="form">
 <div class="form-inline form-row my-3 col-12 col-md-12" >
                
    <label class="col-form-label col-lg-12">ACREEDOR</label>
      <div class="input-group col-lg-12">
        <input type="text" class="form-control" name="buscador">
         <span class="input-group-btn">
         <a class="btn btn-primary">BUSCAR</a>
         <a class="btn btn-success">AGREGAR</a>
        </span>
      </div>

   <div id="tabacreedor"></div>
      <ul id="pgacreedor" class="pagination pull-right"></ul>

  </div>

 
 <p class=" text-center alert alert-primary alert-sm" role="alert">DATOS DEL ACREEDOR </p>
 


   <div class="form-row">

    <div class="form-group col-md-4">
      <label for="">Tipo de Documento</label>
      <select id="tipoacreedor" class="form-control form-control-sm" name="tipo_documento">
        <option selected>Seleccione</option>
        <option></option>
        <option value="cc">CC</option>
        <option value="ce">CE</option>
        <option value="nit">NIT</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="">Documento</label>
      <input type="text" class="form-control form-control-sm" id="">
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputZip">Razón Social/Nombre</label>
      <input type="text" class="form-control form-control-sm" id="inputZip" name="razon_social">
    </div>
  </div>

<!-- carga de documentos de la cartera -->
  <p class=" text-center alert alert-primary alert-large" role="alert">ADJUNTE DOCUMENTOS DE RESPALDO DE LA CARTERA <input type="button" class="btn btn-success pull-right"  value="+"  onclick="mostrar_mas(this)">
   </p>

    <div id="field" class="">
                        
    </div>

   <p class=" text-center alert alert-primary alert-large" role="alert">AGREGAR DEUDORES <input type="button" class="btn btn-success pull-right"  value="+"  onclick="creardeu(this)">
   </p>

   <div id="tabladeudores" class=" ">
     
   </div>
   
   <!-- <div id="codeudores" class=" ">  
  </div>
    -->
 
</form>

</section>




<!-- FUNCIONES DE MI FORMULARIO  -->
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


   //para agregardocumentos
 incremento =0;
    function mostrar_mas(obj) 
    {
        incremento++;

        var fila= `
    <div class="row my-2" style="justify-content: center; align-items: center; ">
      <div class="col-sm-12 col-md-4">
        <input type="text" required class="form-control form-control-sm " name="ndocumento[]" maxlength=""
          placeholder="NOMBRE DEL DOCUMENTO">
      </div>
      <div class="col-sm-12 col-md-4">
        <input type="file" required class="form-control form-control-sm " name="documentos_general[] placeholder=""
          maxlength="">
      </div>
      <div class="">
        <button class="eliminar btn btn-danger btn-sm">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    </div>
    `
        $('#field').append(fila);

        // Evento que selecciona la fila y la elimina
    $(document).on("click", ".eliminar", function () {
      var parent = $(this).parents().get(1);
      $(parent).remove();
    });
    }      


  incremento =0;
  function crearnp(obj) {
                     
  incremento++;
      var fila='<tr><td>&nbsp;</td>'+
  '<td style="width:100%;"><input type="text" class="form-control col-md-12 col-lg-12 my-2" name="observacion[]" placeholder="OBSERVACIONES" aria-describedby="inputGroup-sizing-sm"></td>'+
  '<td input type="submit" class="eliminar btn-md btn btn-danger rounded-circle"><i class="fas fa-eraser"></i></td></tr>';
  
      $('#tablanp').append(fila);

        // Evento que selecciona la fila y la elimina 
  $(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
  });
            
       }


// funcion donde creare mi formulario de registro








    </script>








