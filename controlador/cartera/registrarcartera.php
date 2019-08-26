<?php
include '../../conexion.php';

if (isset($_POST['btn-guardar-cartera'])) {
	$uploadDirectory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR;
	$url_file = "/" . explode('/', $_SERVER['REQUEST_URI'])[1] . '/media/'; 
	$id = $_POST['id'];
	$fecha = $_POST['fecha'];
	$ndocumento = $_POST['ndocumento'];
	$documentos_general = $_FILES['documentos_general'];
	$token = md5($id . $fecha . time());
	$documents = [];

	$sql = "INSERT INTO cartera (token, id_acreedor, fecha) 
			VALUES ('{$token}', '{$id}', '{$fecha}')";

	$cn->query($sql) or die(mysqli_error($cn));
	$id_cartera = $cn->insert_id;

	if(count($ndocumento) != 0){
		for ($i = 0; $i < count($ndocumento); $i++) {
			array_push($documents, [
				'name' => $ndocumento[$i],
				'file' => [
					'name' => $documentos_general['name'][$i],
					'type' => $documentos_general['type'][$i],
					'tmp_name' => $documentos_general['tmp_name'][$i],
					'size' => $documentos_general['size'][$i],
					'error' => $documentos_general['error'][$i],
				]
			]);
		}
		$delete_file = [];
		try {
			foreach ($documents as $document) {
				$ext = pathinfo($document['file']['name'], PATHINFO_EXTENSION);
				$name = md5($document['file']['name'] . time());
				$path = "{$uploadDirectory}{$name}.{$ext}";
				$url = "{$url_file}{$name}.{$ext}";
				if (!move_uploaded_file($document['file']['tmp_name'], $path)) {
					throw new Exception('Could not move file');
				}
				array_push($delete_file, $path);
				$sql = "INSERT INTO documentos_cartera(nombre, ruta, id_cartera) 
							VALUES ('{$document["name"]}', '{$url}', '{$id_cartera}')";
				$cn->query($sql) or die(mysqli_error($cn));
			}
		} catch (Exception $th) {
			foreach ($delete_file as $df) {
				unlink($df);
			}
			$sql = "DELETE FROM cartera WHERE id={$id_cartera}";
			$cn->query($sql);
			echo "
			<script>
				alert('no se pudo guardar')
			</script>";
		}
	}
	header("Location: ../../menus.php?op=aggdatos&id={$id}&cartera={$token}");
}
