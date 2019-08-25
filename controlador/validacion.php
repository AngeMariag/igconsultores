<?php 
session_start();
include "../conexion.php";
$usuario = $_POST['username'];
$clave = $_POST['password'];
$sql = $cn->query("SELECT * FROM usuario WHERE username='$usuario'");
$row = mysqli_fetch_assoc($sql);
 if ($row > 0){
        if($row['password']==$clave){
            $_SESSION["username"]= $usuario;
            $_SESSION["nivel"]=$row['nivel'];
            // session_start();
			$_SESSION["autenticado"]= "SI";
			// header ("Location: ../menus.php");
            $resul = array(
                0=>true
                );
            echo json_encode($resul);
        }else{
            $resul = array(
                0=>false,
                1=>"Clave Incorrecta"
                );
            echo json_encode($resul);
        }
    }else{
            $resul = array(
                0=>false,
                1=>"Usuario No Existe"
                );
            echo json_encode($resul);
    }    

?>