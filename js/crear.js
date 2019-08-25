// FUNCION PARA CREAR MI TABLA DE PAGOS 
incremento=0;
function pago(obj){

  incremento++;

  var fila='<tr class="mr-5"><td></td>'+
         '<td class=""><input type="text"   class="form-control form-control-sm " name="observacion[]" maxlength="" placeholder="Observación"></td>'+
         
        '<td><input type="text"  class="form-control form-control-sm " name="monto[]"  placeholder="MONTO" maxlength=""></td>'+

        '<td><input type="date"  class="form-control form-control-sm " name="fecha_pago[]" max="<?php $hoy=date("Y-m-d"); echo $hoy;?></td>'+
        '<td><select name="estatus[]" class="form-control form-control-sm" required>'+
          '<option value="        ">     </option>'+
          '<option value="RENUENTE">RENUENTE</option>'+ 
          '<option value="EN ACUERDO">EN ACUERDO</option>'+
          '<option value="EN ACUERDO">PENDIENTE</option>'+
        '</select></td>'+
        ' <td input type="submit" class="eliminar btn btn-danger  btn-sm "><i class="fas fa-trash"></i></td></tr>';
        $('#pagos').append(fila);

        // Evento que selecciona la fila y la elimina 
        $(document).on("click",".eliminar",function(){
          var parent = $(this).parents().get(0);
          $(parent).remove();
        });
}






 incremento =0;

  function creardeu(obj) {
                     
  incremento++;
      var fila='';

  $('#tabladeudores').append(fila);

        // Evento que selecciona la fila y la elimina 
  $(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
  });
            
       }














// ------------------------------------------------------------------------------------
// FUNCIÓN PARA AGREGAR CODEUDORES AL DEUDOR



  function codeudor(obj) {
                 
  incre++;
      var fila='<div class="border border-primary my-3"><div class="form-row">'+
      '<div class="form-group col-md-6 my-2">'+
      '<label for="inputState">Tipo de Documento</label>'+
      '<select id="" class="form-control form-control-sm" name="tipodocumento_codeudor[]">'+
      '<option selected>Selecciona...</option>'+
      '<option value="cc">CC</option>'+
      '<option value="ce">CE</option>'+
      '<option value="nit">NIT</option>'+
      '</select>'+
    '</div>'+
    '<div class="form-group col-md-6 my-2">'+
    '<label for="inputCity">Nro. Documento</label>'+
    '<input type="text" class="form-control form-control-sm" id="" name="documento_codeudor[]">'+
    '</div>'+
    '</div>'+
    // segundo row
    '<div class="form-row">'+
    '<div class="form-group col-md-3 my-2">'+
    '<label for="inputEmail4">NOMBRE</label>'+
    '<input type="text" class="form-control form-control-sm text-uppercase" id="inputEmail4" placeholder="Nombre" name="nombre_codeudor[]">'+
    '</div>'+
    '<div class="form-group col-md-3 my-2">'+
    '<label for="inputPassword4">APELLIDO</label>'+
    '<input type="text" class="form-control form-control-sm" id="" placeholder="Apellido" name="apellido_codeudor[]">'+
    '</div>'+
    '<div class="form-group col-md-3 my-2">'+
    '<label for="inputEmail4">TELEFONO</label>'+
    '<input type="text" class="form-control form-control-sm" id="inputEmail4" placeholder="Nombre" name="telefono_codeudor[]">'+
    '</div>'+
    '<div class="form-group col-md-3 my-2">'+
    '<label for="inputPassword4">DIRECCIÓN</label>'+
    '<input type="text" class="form-control form-control-sm" id="" placeholder="Apellido" name="direccion_codeudor[]">'+
    '</div>'+
    '</div>';

  $('#codeudores').append(fila);

        // Evento que selecciona la fila y la elimina 
  $(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
  });
            
       }