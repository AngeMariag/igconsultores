<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
$op = "";
if(isset($_GET['op'])){
$op = $_GET['op'];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
 <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
 <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>  

 <script src="../../js/jquery-3.4.1.min.js"></script>

  </head>
  <body>
    <!-- INICIO CON UN MENU -->
    <nav class="navbar navbar-expand-lg navbar navbar-light bg-light sticky-top">
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      
      <a class="navbar-brand" href="#">
        <img src="images/icono.png" width="60" height="40" class="d-inline-block align-top" alt="">
        
        IG CONSULTORES
      </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <div class="navbar-nav mr-auto ml-auto text-center">
          <a class="nav-item nav-link active" href="?op=inicio">INICIO</a>
          <!-- observar pantalla principal -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              REGISTROS
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="registro.php">CARTERA</a>
              <a class="dropdown-item" href="?op=pago">GESTORES</a>
              <a class="dropdown-item" href="#">EJECUTIVO</a>
              <a class="dropdown-item" href="#">ACREEDOR</a>
              <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
          </li>

          <!-- <a class="nav-item nav-link" href="?op=formulario" >REGISTRO</a> -->
          <a class="nav-item nav-link" href="#">CONFIGURACIÓN</a>
          <a class="nav-item nav-link" href="#">AYUDA</a>
          <a class="nav-item nav-link" href="../../index.php" >SALIR</a>
          
        </div>
        <div class="d-flex flex-row justify-content-center">
          <a href="#" class="btn btn-outline-info mr-2">F</a>
          <a href="#" class="btn btn-outline-danger">Y</a>
        </div>
      </div>
    </nav>

   
    <!-- IMAGEN PARA EL BODY -->
    <div class="container-fluid">
    <?php 
        include ("../contenido.php");
     ?>
    </div>
     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>