<?php
session_start();
include "../conexion.php";
$usuario = $_POST['username'];
$clave = $_POST['password'];
$sql = $cn->query("SELECT * FROM usuario WHERE username='$usuario'");
$row = mysqli_fetch_assoc($sql);
if ($row > 0) {
    if ($row['password'] == $clave) {
        unset($row['password']);
        $_SESSION['user'] = $row;
        $resul = array(
            0 => true
        );
        echo json_encode($resul);
    } else {
        $resul = array(
            0 => false,
            1 => "Clave Incorrecta"
        );
        echo json_encode($resul);
    }
} else {
    $resul = array(
        0 => false,
        1 => "Usuario No Existe"
    );
    echo json_encode($resul);
}
