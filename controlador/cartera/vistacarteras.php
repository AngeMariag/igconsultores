<?php 
include ('conexion.php');

$acreedor=$_GET['id'];

// echo $acreedor;

$cartera=$cn->query("SELECT * FROM cartera inner join acreedor on cartera.id_acreedor=acreedor.id WHERE id_acreedor = '$acreedor'");

// carga de vista
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
    <button class="btn btn-md m-auto btn-primary" data-toggle="modal" data-target="#exampleModalCentered"></a>VER MÁS</button>
  </div>
</div>	
<?php }

}else{ ?>

<div class="card m-auto mb-0">
	<div class="alert alert-danger  my-5">
        <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
  </div>
</div>
<?php  } ?>	

</section>

<!-- Modal para ver cartera -->
<div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenteredLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
    $acreedor=$_GET['id'];

    $acreedor = $cn->query("SELECT * FROM acreedor WHERE id = $acreedor");?>

    <section class="mb-1">
    <?php if (mysqli_num_rows($acreedor) != 0) { ?>
    <div class="table  responsive" id="">
      <table class="table table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th class="text-white" style="background:#000080;">TIPO DE DOCUMENTO</th>
            <th class="text-white" style="background:#000080;">DOCUMENTO</th>
            <th class="text-white" style="background:#000080;">RAZÓN SOCIAL / NOMBRE</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($f = mysqli_fetch_assoc($acreedor)) { ?>
          <tr>
            <td>
              <?= utf8_encode(strtoupper($f["tipo_documento"])) ?>
              <span class="badge badge-<?= utf8_encode($f['tipo_documento']) == 'nit' ? 'warning' : 'primary' ?>">
                <?= utf8_encode($f["tipo_documento"]) == 'nit' ? 'Jurídica' : 'Natural' ?>
              </span>
            </td>
            <td><?= utf8_encode($f["documento"]) ?></td>
            <td><?= utf8_encode($f["razon_social"]) ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } else { ?>
      <div class="alert alert-danger text-center">
        <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
      </div>
    </div>
    <?php } ?>
  </section>

<section class="mb-1">
    <?php if (mysqli_num_rows($acreedor) != 0) { ?>
    <div class="table  responsive" id="">
      <table class="table table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th class="text-white" style="background:#000080;">TIPO DE DOCUMENTO</th>
            <th class="text-white" style="background:#000080;">DOCUMENTO</th>
            <th class="text-white" style="background:#000080;">RAZÓN SOCIAL / NOMBRE</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($f = mysqli_fetch_assoc($acreedor)) { ?>
          <tr>
            <td>
              <?= utf8_encode(strtoupper($f["tipo_documento"])) ?>
              <span class="badge badge-<?= utf8_encode($f['tipo_documento']) == 'nit' ? 'warning' : 'primary' ?>">
                <?= utf8_encode($f["tipo_documento"]) == 'nit' ? 'Jurídica' : 'Natural' ?>
              </span>
            </td>
            <td><?= utf8_encode($f["documento"]) ?></td>
            <td><?= utf8_encode($f["razon_social"]) ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } else { ?>
      <div class="alert alert-danger text-center">
        <strong>Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...</strong>
      </div>
    </div>
    <?php } ?>
  </section>
<!-- ver deudores -->

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


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