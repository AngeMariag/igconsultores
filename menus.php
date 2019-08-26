<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
</head>

<body>
	<?php 
	function redirect($route){
		return header("Location: menu.php?op={$route}");
	}
	?>
	<?php require('./menuinterno.php');  ?>
	<div class="container-fluid">
		<?php
			include("contenido.php");
		?>
	</div>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>