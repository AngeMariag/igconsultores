<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
</head>

<!-- ESTILO DE IMAGEN BODY -->
<style type="text/css">
  .back {
    background: linear-gradient(rgba(10, 0, 0, 0.40), black), url("images/consultoria.jpg");
    height: 100vh;
    background-size: cover;
    background-position: center;
  }
</style>
</head>

<body>
  <div class="back">
    <div class="container">
      <div class="row">
        <div class="col-12 mt-5">
          <h2 class="text-white">
            IG CONSULTORES SOFTWARE DE REGISTRO
          </h2>
        </div>

        <div class="col-md-6 offset-md-6 col-sm-12">
          <form id="inicio_session" name="form" class="mt-5">
            <!--Header del contenido-->
            <div class="form-group">
              <label for="label" class="text-white font-weight-bold h5">USUARIO:</label>
              <div class="input-group">
                <input autofocus name="username" id="usuario" type="text" required class="form-control" autocomplete="off">
                <span class="help-block"></span>
              </div>
            </div>
    
            <div class="form-group">
              <label class=" text-white font-weight-bold h5">CONTRASE&Ntilde;A:</label>
              <div class="input-group">
                <input name="password" id="clave" type="password" required class="form-control" autocomplete="off">
    
              </div>
    
              <p class="text-center text-white col-sm-12 my-2">RECUERDA QUE TU USUARIO ES EL NUMERO DE GESTOR ASIGNADO <b style="color: red;">(EN CASO GESTOR)</b></p>
            </div>
    
    
            <div class="alert alert-danger error-sesion text-center " style="display:none; width:60%;"></div>
    
            <div class="btn-group">
              <!--para direccionar con el onclick-->
              <button type="button" name="enviar" class="btn btn-success mb-5" onclick="session();"> INGRESAR</button>
            </div>
            <button type="button" id="btn_modal" class="btn btn-danger mb-5" data-toggle="modal" data-target="#modaluser">
              REGISTRATE
            </button>
    
          </form>
        </div>
      </div>
    </div>

  </div>

  <div class="modal fade" id="modaluser" tabindex="-1" role="dialog" aria-labelledby="modalregistro" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title m-auto" id="modalregistro">NUEVO REGISTRO DE USUARIO (GESTOR)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="controlador/registrouser.php" method="POST">
          <div class="modal-body">

            <div class="container">
              <div class="form-group row">
                <label for="nombre" class="col-sm-4 form-control-label">Código de Gestor</label>
                <div class="col-sm-8">
                  <input value="" class="form-control" id="codigo" placeholder="Inserta tu código de usuario" type="text" name="codigo" required="" title="Campo requerido">
                </div>
              </div>
              <div class="form-group row">
                <label for="identificacion" class="col-sm-4 form-control-label">Identificación</label>
                <div class="col-sm-8">
                  <input value="" required class="form-control" id="identificacion" placeholder="Identificación" type="text" name="identificacion">
                </div>
              </div>
              <div class="form-group row">
                <label for="nombre" class="col-sm-4 form-control-label">Nombre</label>
                <div class="col-sm-8">
                  <input value="" required class="form-control" id="nombre_deudor" placeholder="Inserta tu código de usuario" type="text" name="nombre">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 form-control-label">Apellido</label>
                <div class="col-sm-8">
                  <input value="" required class="form-control" id="" placeholder="Apellido" type="text" name="apellido">
                </div>
              </div>
              <h4 class="alert alert-primary text-center">Datos de Usuario</h4>

              <div class="form-group row">
                <label for="nombre" class="col-sm-4 form-control-label">Contraseña</label>
                <div class="col-sm-8">
                  <input required class="form-control" id="claveprueba" placeholder="Ingrese Contraseña" type="password" name="pass1" onblur="validaregistrop()">
                </div>

              </div>
              <div class="form-group row">
                <label for="nombre" class="col-sm-4 form-control-label">Repetir Contraseña</label>
                <div class="col-sm-8">
                  <input required class="form-control" id="claveconfirmada" placeholder="Repita la Contraseña" type="password" name="pass2" onblur="validaregistrop()">
                </div>
              </div>
              <div class="alert alert-danger text-center">
              </div>

              <h5 class=" text-center"><b style="color: red;">(*)</b>Recuerda que tu código de gestor sera tu nuevo usuario</h5>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ATRAS</button>
            <button type="submit" class="btn btn-primary" name="save-gestor">REGISTRAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function session() {
      var datos = $('#inicio_session').serialize();

      $.ajax({
        url: "controlador/validacion.php",
        type: "POST",
        data: datos,
        success: function(resul) {
          var arre = eval(resul);
          if (arre[0] == true) {
            window.location = "menus.php";
          } else if (arre[0] == false) {
            $('.error-sesion').show();
            $('.error-sesion').html("<b>" + arre[1] + "</b>");
            //$('#inicio_session')[0].reset();
            setTimeout(function() {
              $('.error-sesion').hide();
            }, 1500);
          }
        }

      })
    }
  </script>

  <script src="js/bootstrap.min.js"></script>

</body>

</html>