<?php 
include("conexion.php");
session_start();
$usuario = $_SESSION['username'];
if (isset($_SESSION['username'])) {
$nivel = $_SESSION['nivel'];
$menu="";
if ($nivel == 0)
    $menu = "admin";
if ($nivel == 1)
    $menu = "secretaria";
if ($nivel == 2)
    $menu = "contabilidad";
if ($nivel == 3)
    $menu = "gestor";
?>
<!DOCTYPE html>
<html>
<head>
	
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
 <!-- <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome.min.css"> -->
 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
 <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>  
 <link rel="" type="text/css" href="js/consultores.js"> 
 <script src="js/jquery-2.1.0_1.js"></script>

</head>
<body>
<?php 
	if ($_SESSION['nivel'] == '0') { 
		include("controlador/cartera/menuinterno.php");
	}
	
	if ($_SESSION['nivel'] == '1') { 
		include("controlador/cartera/menuinterno.php");
	}
		
	if ($_SESSION['nivel'] == '2') { 
		include("permisologias.php");
	}
		
	if ($_SESSION['nivel'] == '3') { 
		include("controlador/gestor/menugestor.php");
	}
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
    <?php
} else {
    echo '<script>location.href = "index.php";</script>';
}