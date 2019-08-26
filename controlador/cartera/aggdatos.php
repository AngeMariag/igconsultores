<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />

<script src="../../js/jquery-3.4.1.min.js"></script>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
require("menuinterno.php");
require_once("../../conexion.php");
$sql = $cn->query("SELECT * FROM acreedor WHERE id = $id");
?>


<div class="container my-3">
  <section class="mb-1">
    <?php if (mysqli_num_rows($sql) != 0) { ?>
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
          <?php while ($f = mysqli_fetch_assoc($sql)) { ?>
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
  <?php if (mysqli_num_rows($sql) != 0) { ?>

    <p class=" text-center alert alert-primary alert-large" role="alert">
      ADJUNTE FECHA Y DOCUMENTOS DE RESPALDO DE LA CARTERA
      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-insert-document">
        AÑADIR
      </button>
    </p>
    <!-- VENTANA PARA AGG DOCUMENTOS  -->
    <?php require('./modal/addDocument.php') ?>
    
    <!-- AGG OTRA VENTANA -->
      <form>
    <p class="lead text-center alert alert-primary alert-sm" role="alert">DATOS DEL DEUDOR</p>
    <input type="hidden" name="" value="<?= $id ?>">
    <div class="form-row ">
      <div class="form-group col-sm-12 col-md-12 my-2">
        <label for="codigo_deudor">Código</label>
        <input type="text" class="form-control text-uppercase" id="codigo_deudor" placeholder="Código" name="codigo_deudor" required="">
      </div>
    </div>
    <div class="form-row">

      <div class="form-group col-md-6 my-2">
        <label for="inputState">Tipo de Documento</label>
        <select id="" class="form-control" name="tipodocumento_deudor">
          <option selected>Selecciona...</option>
          <option value="cc">CC</option>
          <option value="ce">CE</option>
          <option value="nit">NIT</option>

        </select>
      </div>
      <div class="form-group col-md-6 my-2">
        <label for="inputCity">Nro. Documento</label>
        <input type="text" class="form-control" id="" name="documento_deudor">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6 my-2">
        <label for="inputEmail4">NOMBRE</label>
        <input type="text" class="form-control text-uppercase" id="inputEmail4" placeholder="Nombre" name="nombre_deudor">
      </div>
      <div class="form-group col-md-6 my-2">
        <label for="inputPassword4">APELLIDO</label>
        <input type="text" class="form-control" id="" placeholder="Apellido" name="apellido_deudor">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4 my-2">
        <label for="inputEmail4">TELEFONO</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" name="telefono_deudor">
      </div>
      <div class="form-group col-md-8 my-2">
        <label for="inputPassword4">DIRECCIÓN</label>
        <input type="text" class="form-control" id="" placeholder="Apellido" name="direccion_deudor">
      </div>
    </div>

    <p class="lead text-center alert alert-primary " role="alert">DATOS DEL CODEUDOR</p>
    <div class="form-row">
      <div class="form-group col-md-6 my-2">
        <label for="inputState">Tipo de Documento</label>
        <select id="inputState" class="form-control" name="tipodocumento_codeudor">
          <option selected>...</option>
          <option value="cc">CÉDULA DE CIUDADANIA</option>
          <option value="ce">CÉDULA DE EXTRANJERIA</option>
          <option value="nit">NIT</option>
        </select>
      </div>
      <div class="form-group col-md-6 my-2">
        <label for="inputCity">Nro. Documento</label>
        <input type="text" class="form-control" id="" name="documento_codeudor">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6 my-2">
        <label for="inputEmail4">NOMBRE</label>
        <input type="text" class="form-control" id="" placeholder="Nombre" name="nombre_codeudor">
      </div>
      <div class="form-group col-md-6 my-2">
        <label for="inputPassword4">APELLIDO</label>
        <input type="text" class="form-control" id="" placeholder="Apellido" name="apellido_codeudor">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4 my-2">
        <label for="inputEmail4">TELEFONO</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Npombre" name="telefono_codeudor">
      </div>
      <div class="form-group col-md-8 my-2">
        <label for="inputPassword4">DIRECCIÓN</label>
        <input type="text" class="form-control" id="" placeholder="Dirección" name="direccion_codeudor">
      </div>
    </div>

    <p class="lead text-center alert alert-primary" role="alert">FACTURA</p>

    <div class="card-body">
      <input type="hidden" name="{{csrf.keys.name}}" value="{{csrf.name}}">
      <input type="hidden" name="{{csrf.keys.value}}" value="{{csrf.value}}">

      <div class="row text-center">

        <div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for="inputEmail4">TITULO</label>
            <input required type="text" value="" class="form-control" id="" placeholder="TITULO" name="titulo">
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for="inputPassword4">CAPITAL</label>
            <div class="input-group">
              <input required type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="capital" id="capital" value="">
              <div class="input-group-append">
                <span class="input-group-text">$ PCO</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="form-group">
            <label for="inputEmail4">INTERES</label>
            <div class="input-group">
              <input required type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="interes" id="interes" value="0">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="form-group">
            <label for="inputPassword4">HONORARIOS</label>
            <div class="input-group">
              <input required type="text" class="form-control" id="honorarios" placeholder="CAPITAL" name="honorarios" value="23" readonly>
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="form-group">
            <label for="inputPassword4">GASTOS</label>
            <div class="input-group">
              <input required type="text" class="form-control" id="gastos" placeholder="CAPITAL" name="gastos" readonly="" value="12">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12">
          <div class="form-group">
            <label for="" class="">DESCUENTOS</label>
            <div class="input-group">
              <input required type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="descuento" id="descuento" value="0">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 text-justify">
          <div class="form-group">
            <label for="">POR FAVOR SELECCIONA ESTA OPCIÓN SOLO SI APLICA SANCIÓN
              (CHEQUE)</label>
            <div class="form-check form-check-inline">
              <input required class="form-check-input" type="radio" name="sancion" id="sancion" value="20">
              <label class="form-check-label" for="inlineRadio1"> SI </label>
            </div>
            <div class="form-check form-check-inline">
              <input required class="form-check-input" checked type="radio" name="sancion" id="sancion" value="0">
              <label class="form-check-label" for="inlineRadio2">NO </label>
            </div>
          </div>
        </div>
        <div class="col-12">
          <button type="button" name="btn-total" class="btn btn-primary d-flex justify-content-sm-end my-2" id="btn_get_total">SACAR
            TOTAL</button>
        </div>
        <div class="col-12">
          <div id="set_total" class="mb-5 mt-3 text-center"></div>
        </div>

      </div>
    </div>

    <div class=" form-inline my-2">
      <label class="col-md-3">SELECCIONE GESTOR </label>
      <select id="id_gestor" name="id" class="form-control col-md-9" required aria-required="true">
        <option value="-------------">-----------------------</option>
        <?php
          include('../../conexion');
          $busqueda = $cn->query("SELECT id, codigo, nombre, apellido from gestor") or die("Problemas en el select:" . mysqli_error());
          while ($row = mysqli_fetch_array($busqueda)) {
            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '' . $row['apellido'] . ' - ' . $row['codigo'] . ' </option>';
          }
          ?>
      </select>
    </div>
    <p class="lead text-center alert alert-primary" role="alert">AGREGAR OBSERVACIONES</p>

    <div class="form-group">
      <label class="col-md-6 control-label" for="nombres">OBSERVACIONES:</label>
      <input type="button" class="btn btn-success pull-right" value="+" onclick="crearnp(this)">
      <center>
        <div id="tablanp" class=""></div>
      </center>
      <span class="help-block right"></span>
    </div>

    <div class="btn-group btn-group-lg my-5" role="group" aria-label="Basic example">
      <button type="submit" name="btn-enviar" class="btn btn-success"><i class="far fa-save"></i>
        GUARDAR</button>
      <button type="button" class="btn btn-warning" name=""><i class="fas fa-eraser"></i>



        RESET</button>
      <button type="button" class="btn btn-danger"><i class="fas fa-eraser"></i>ATRAS</button>
    </div>


  </form>
</div>

<script type="text/javascript">
  //FUNCION PARA CALCULAR TOTAL

  function set_total(obj) {
    var html = `<div class="table-responsive col-md-11">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>CAPITAL</th>
            <th>INTERES</th>
            <th>HONORARIOS</th>
            <th>GASTOS</th>
            <th>DESCUENTOS</th>
            <th>SANCION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${obj.capital}</td>
            <td>${obj.get_interes}</td>
            <td>${obj.get_honorarios}</td>
            <td>${obj.get_gastos}</td>
            <td>${obj.get_descuento}</td>
            <td>${obj.get_sancion}</td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-4 offset-md-8 col-sm-12 my-2" style="display: flex;">
          <label class ="col-md-6">Sub-Total: </label>
          <input required type="text" name="total1" readonly class="form-control" value="${obj.total.toFixed(2)}">
        </div>
      </div>
       <div class="row">
        <div class="col-md-4 offset-md-8 col-sm-12 my-2" style="display: flex;">
          <label class ="col-md-6">Total: </label>
          <input required type="text" name="total" readonly class="form-control" value="${obj.sub_total.toFixed(2)}">
        </div>
      </div>
    </div>`
    document.getElementById('set_total').innerHTML = html
  }

  function get_total() {
    var state = {}
    var btn_total = document.getElementById('btn_get_total')


    if (btn_total) {
      btn_total.addEventListener('click', function(e) {
        // obteniendo input a traves del id
        var $capital = document.getElementById('capital')
        var $interes = document.getElementById('interes')
        var $honorarios = document.getElementById('honorarios')
        var $gastos = document.getElementById('gastos')
        var $descuento = document.getElementById('descuento')
        var $sancion = document.querySelector('input[name="sancion"]:checked')

        var capital = 0
        var por_interes = 0
        var por_honorarios = 0
        var por_gastos = 0
        var por_descuento = 0
        var por_sancion = 0

        var get_interes = 0
        var get_honorarios = 0
        var get_gastos = 0
        var get_descuento = 0
        var get_sancion = 0
        var total = 0
        var obj = {}

        capital = $capital.value
        por_interes = $interes.value
        por_honorarios = $honorarios.value
        por_gastos = $gastos.value
        por_descuento = $descuento.value
        por_sancion = $sancion.value

        if (!capital) {
          alert("SE REQUIERE EL VALOR CAPITAL")
          return false
        }

        //  parseando los datos a flotante
        capital = parseFloat(capital)
        por_interes = parseFloat(por_interes)
        por_honorarios = parseFloat(por_honorarios)
        por_gastos = parseFloat(por_gastos)
        por_descuento = parseFloat(por_descuento)
        por_sancion = parseFloat(por_sancion)

        get_interes = (capital * por_interes) / 100
        get_honorarios = (capital * por_honorarios) / 100
        get_gastos = (capital * por_gastos) / 100
        // get_descuento = (capital * por_descuento) / 100
        get_sancion = (capital * por_sancion) / 100

        total = capital + get_interes + get_honorarios + get_gastos + get_sancion

        get_descuento = (total * por_descuento) / 100

        sub_total = total - get_descuento
        obj = {
          get_interes: get_interes,
          get_honorarios: get_honorarios,
          get_gastos: get_gastos,
          get_descuento: get_descuento,
          total: total,
          sub_total: sub_total,
          capital: capital,
          get_sancion: get_sancion
        }
        return set_total(obj)
      })
    }
  }

  get_total()



  incremento = 0;

  function crearnp(obj) {

    var fila = `
        <div style="display: flex; align-items: center;">
            <div style="width:100%;">
                <input required type="text" class="form-control col-md-12 col-lg-12 my-2"
                    name="observacion[]" placeholder="OBSERVACIONES"
                    aria-describedby="inputGroup-sizing-sm" />
            </div>
            <div>
                <button type="button" class="eliminar btn-md btn btn-danger">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>
        </div>
        `
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(1);
      $(parent).remove();
    });
    $('#tablanp').append(fila);

    // Evento que selecciona la fila y la elimina 


  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="../../js/bootstrap.min.js"></script>

<?php } else { ?>
<div class="text-center">
  <a href="javascript:window.history.back()" class="btn btn-success">
    <i class="fas fa-reply"></i>
    Regresar
  </a>
</div>
<?php }; ?>