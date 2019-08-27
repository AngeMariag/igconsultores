<?php 
$op = isset($_GET['op']) ? $_GET['op'] : '';

$route = [
	'inicio' => "controlador/inicio.php",
	'registro_cartera' => "controlador/cartera/registro.php",
	'aggdatos' => "controlador/cartera/aggdatos.php",
	'pago' => 'formularios/pago.php',
	'reg_gestion' => "controlador/gestor/registro_gestion.php",
	'vercarteras' => "controlador/cartera/vistacarteras.php",
]; 

isset($route[$op]) ? include($route[$op]) : header("Location: menus.php?op=inicio");
