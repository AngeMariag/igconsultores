//FUNCIÓN PARA CARGAR MI TABLA DE INICIO CON ACREEDORES REGISTRADOS


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




