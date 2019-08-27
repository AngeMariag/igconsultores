<?php
require("conexion.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';
$cartera_token = isset($_GET['cartera']) ? $_GET['cartera'] : '';
$acreedor = $cn->query("SELECT * FROM acreedor WHERE id = $id");

if ($cartera_token != '') {
  $cartera = $cn->query("SELECT * FROM cartera WHERE id_acreedor={$id} and token='{$cartera_token}'");

  if (mysqli_num_rows($cartera) == 0) {
    return header("Location: menus.php?op=registro_cartera");
  }

  $cartera = mysqli_fetch_assoc($cartera);
  $doc_cartera = $cn->query("SELECT * FROM documentos_cartera WHERE id_cartera={$cartera['id']}");
  
  $query_ficha = "SELECT deudor.codigo, CONCAT(UPPER(deudor.tipodocumento), '-', deudor.documento) as documento,
    CONCAT(deudor.nombre, ' ', deudor.apellido) as deudor,
    deudor.telefono, CONCAT(gestor.nombre, ' ', gestor.apellido) as gestor
    FROM cartera_deudor_codeudor as car
    LEFT JOIN deudor
    ON deudor.id=car.id_deudor
    LEFT JOIN gestor
    ON gestor.id=car.id_gestor
    WHERE car.id_cartera='{$cartera["id"]}' and car.id_codeudor is NULL";
  
  $fichas = $cn->query($query_ficha);
}


?>
<div class="container my-3">
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
  <?php if (mysqli_num_rows($acreedor) != 0) { ?>

  <?php if ($cartera_token == '') { ?>
  <p class=" text-center alert alert-primary alert-large" role="alert">
    ADJUNTE FECHA Y DOCUMENTOS DE RESPALDO DE LA CARTERA
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-insert-document">
      AÑADIR
    </button>
  </p>
  <?php } ?>
  <!-- VENTANA PARA AGG DOCUMENTOS  -->
  <?php require('controlador/cartera/modal/addDocument.php') ?>

  <!-- AGG OTRA VENTANA -->
  <?php if ($cartera_token != '') {  ?>
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th class="text-white" style="background:#000080;">NOMBRE DOCUMENTO</th>
          <th class="text-white" style="background:#000080;">DOCUMENTO</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($doc = mysqli_fetch_assoc($doc_cartera)) { ?>
        <tr>
          <td><?= $doc['nombre'] ?></td>
          <td><a href="<?= $doc['ruta'] ?>" target="_blank"><i class="far fa-file-pdf"></i>Descargar</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>


  <p class=" text-center alert alert-primary alert-large" role="alert">
    REGISTRE FICHAS
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-insert-ficha">
      AÑADIR
    </button>
  </p>
  <?php require('controlador/cartera/modal/addficha.php') ?>

  <?php if (mysqli_num_rows($fichas) != 0) { ?>
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th class="text-white" style="background:#000080;">#</th>
          <th class="text-white" style="background:#000080;">CODIGO</th>
          <th class="text-white" style="background:#000080;">DOCUMENTO</th>
          <th class="text-white" style="background:#000080;">NOMBRE</th>
          <th class="text-white" style="background:#000080;">TELEFONO</th>
          <th class="text-white" style="background:#000080;">GESTOR ENCARGADO</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; while ($ficha = mysqli_fetch_assoc($fichas)) { ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $ficha['codigo'] ?></td>
            <td><?= $ficha['documento'] ?></td>
            <td><?= $ficha['deudor'] ?></td>
            <td><?= $ficha['telefono'] ?></td>
            <td><?= $ficha['gestor'] ?></td>
          </tr>
        <?php }  ?>
      </tbody>
    </table>
  </div>
  <?php } ?>

  <?php } ?>
</div>
<?php } else { ?>
<div class="text-center">
  <a href="javascript:window.history.back()" class="btn btn-success">
    <i class="fas fa-reply"></i>
    Regresar
  </a>
</div>
<?php }; ?>