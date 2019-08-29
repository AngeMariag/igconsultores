<?php
session_start();
if (!isset($_SESSION['user'])) {
  return header("Location: index.php");
}
$user = $_SESSION['user'];
?>

<nav class="navbar navbar-expand-lg navbar navbar-light bg-light sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand" href="#">
    <img src="images/icono.png" width="60" height="40" class="d-inline-block align-top" alt="">
    IG CONSULTORES LEGALES S.A.S
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
          <?php if ($user['nivel'] == 1 || $user['nivel'] == 0) { ?>
          <a class="dropdown-item" href="?op=registro_cartera">CARTERA</a>
          <!-- <a class="dropdown-item" href="?op=pago">GESTORES</a> -->
          <!-- <a class="dropdown-item" href="#">EJECUTIVO</a> -->
          <!-- <a class="dropdown-item" href="#">ACREEDOR</a> -->
          <?php } if ($user['nivel'] == 2 || $user['nivel'] == 0) { ?>
          <a class="dropdown-item" href="?op=reg_gestion">GESTIONES</a>
          <a class="dropdown-item" href="?op=registro_cartera">PAGOS</a>
          <?php } if ($user['nivel'] == 3 || $user['nivel'] == 0) { ?>
          <a class="dropdown-item" href="?op=registro_cartera">VERIFICACION DE PAGOS</a>
          <?php } ?>
          <!-- <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>
      <?php if ($user['nivel'] == 1 || $user['nivel'] == 0) { ?>
          <a class="nav-item nav-link active" href="?op=vercarteras">VISUALIZAR</a>
          <?php } ?>

      <!-- <a class="nav-item nav-link" href="?op=formulario" >REGISTRO</a> -->
      <a class="nav-item nav-link" href="#">CONFIGURACIÓN</a>
      <a class="nav-item nav-link" href="#">AYUDA</a>
      <a class="nav-item nav-link" href="index.php">SALIR</a>

    </div>
    <div class="d-flex flex-row justify-content-center">
      <a href="#" class="btn btn-outline-info mr-2">F</a>
      <a href="#" class="btn btn-outline-danger">Y</a>
    </div>
  </div>
</nav>