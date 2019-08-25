<?php 
	// setlocale(LC_TIME, 'es_VE'); # Localiza en español es_Venezuela
	// date_default_timezone_set('America/Caracas');
	$fecha = date("Y-m-d");
	$hora = date("g:i:s");
	
	$host="localhost";
	$user ="root";
	$pass = "";
	$bd = "igconsultores";
	
	$cn = new mysqli($host,$user,$pass,$bd) or die("error ".mysqli_error($cn));
	
?>
