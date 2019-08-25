function session(){
	var datos = $('#inicio_session').serialize();
	
	$.ajax({
		url:"../controlador/validacion.php",
		type:"POST",
		data:datos,
		success:function(resul){
			var arre = eval(resul);
			if(arre[0]==true){
				window.location= "menuinterno.php";
			}else if(arre[0]==false){
				$('.error-sesion').show();
				$('.error-sesion').html("<b>"+arre[1]+"</b>");
				//$('#inicio_session')[0].reset();
				setTimeout(function(){
				$('.error-sesion').hide();
				},1500);


			}
		}

	})
}
