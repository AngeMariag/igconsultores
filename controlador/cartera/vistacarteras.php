<?php 
include ('conexion.php');

$acreedor=$_GET['id'];

// echo $acreedor;

$cartera=$cn->query("SELECT * FROM cartera inner join acreedor on cartera.id_acreedor=acreedor.id WHERE id_acreedor = '$acreedor'");

//$cartera = mysqli_fetch_assoc($cartera);
 ?>
<section class="mt-5  m-auto form-inline">

<?php if (mysqli_num_rows($cartera) != 0) {

// echo "hola";
	while ($ver = mysqli_fetch_assoc($cartera)) { ?>

<div class="card border-dark mb-3 m-3" style="max-width: 18rem;">
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
    <button class="btn btn-md m-auto btn-primary">VER MÁS</button>
  </div>
</div>	
<?php }

}else{ ?>

	div class="alert alert-danger text-center">
        <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
      </div>

<?php  } ?>	



<!-- 


	<div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success">Header</div>
  <div class="card-body text-success">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <div class="card-footer bg-transparent border-success">Footer</div>
 --></div>
</section>