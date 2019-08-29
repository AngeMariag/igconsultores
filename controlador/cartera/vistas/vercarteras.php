<?php 

include ('conexion.php');

$vercarteras = $cn->query("SELECT * FROM cartera  inner join acreedor on cartera.id_acreedor=acreedor.id");

 ?>
<section class="form-inline m-3 col-12">
	
 <?php if (mysqli_num_rows($vercarteras) != 0) {

    while ($ver = mysqli_fetch_assoc($vercarteras)) { ?>

    <div class="card border-dark mb-3 m-2" style="max-width: 18rem;">
    <div class="card-header">
    	<div class="mb-0">
        <button class="btn btn-link btn-sm">
            CARTERA: <?= $ver['token'] ?>
        </button>

      </div>
    </div>
    <div class="card-body text-dark">
      <h5 class="card-title text-center"><?= utf8_encode($ver['razon_social']) ?></h5>
      <p class="card-text">FECHA DE REGISTRO: <?= $ver['fecha'] ?></p>
      <!-- <button class="btn btn-md m-auto btn-primary"  onclick="mostrar()"></a>VER MÁS</button> -->
    </div>
    </div>	
    <?php }

    }else{ ?>

    <div class="card m-auto mb-0">
    <div class="alert alert-danger  my-5">
          <strong>Lo Sentimos No Se Encontraron Registros</strong>
    </div>
    </div>
    <?php  } ?>	

</section>