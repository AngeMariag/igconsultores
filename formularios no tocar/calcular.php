	<?php 

	if(isset($_GET['tp'])){
	    $tp = $_GET['tp'];
	}



	switch ($tp) {
		case '1':

			$capital= $_POS['capital_ficha'];
			$interes= $_POS['interes'];
			$honorarios= $_POS['honorarios'];
			$gastos= $_POS['gastos'];
			$sancion= $_POS['sancion'];

			$total= $capital+$interes+$honorarios*$gastos+$sancion

			$date = array(0=>$total);
			echo json_encode($datos);



			break;
		
		default:
			# code...
			break;
	}

	 ?>