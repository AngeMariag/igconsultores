<?php
include('conexion.php');
$user = $_SESSION['user'];

$sql = $cn->query("SELECT ficha.id, gestor.codigo, deudor.codigo as dcodigo, deudor.tipodocumento, deudor.documento, deudor.nombre, deudor.apellido, acreedor.razon_social 
    FROM gestor LEFT JOIN cartera_deudor_codeudor as car
    ON car.id_gestor=gestor.id
    LEFT JOIN deudor 
    ON car.id_deudor=deudor.id
    LEFT JOIN cartera
    ON cartera.id=car.id_cartera
    LEFT JOIN acreedor
    ON acreedor.id=cartera.id_acreedor
    LEFT JOIN ficha
    ON ficha.id_cartera=cartera.id and ficha.id_deudor=deudor.id
    WHERE gestor.codigo = {$user['username']}");

?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header text-white bg-info ">
            SELECCIONA UNA GESTIÓN
        </div>
        <div class="card-body">
            <div class="row">
                <?php if (mysqli_num_rows($sql) != 0) { ?>
                <div class="offset-md-6 col-md-6 col-sm-12 col-12">
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input name="q" type="search" class="form-control" placeholder="Buscar por Documento del Deudor o Nombre Del Acreedor">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit" id="button-addon2">
                                    Buscar
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código Deudor</th>
                                <th>Código GESTOR</th>
                                <th>Documento Deudor</th>
                                <th>Deudor</th>
                                <th>Acreedor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($f = mysqli_fetch_assoc($sql)) { ?>
                                <tr>
                                <td><?= utf8_encode(strtoupper($f["codigo"])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        <strong>
                            Lo Sentimos No Se Encontraron Registros, Por favor Presional el botón Agregar para realizar tu primer REGISTRO...
                        </strong>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>