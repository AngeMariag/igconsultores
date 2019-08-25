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
 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

   <!-- ESTILO DE IMAGEN BODY -->
   <style type="text/css">
    .slider{
      background: url("images/consultoria.jpg");
      height: 100vh;
      background-size: cover;
      background-position: center;
    }
  </style>
   </head>
  <body>
    <!-- INICIO CON UN MENU -->
    
    <section class="container-fluid slider d-flex justify-content-center align-items-center">
      <h1 class="display-1 text-white ">IG CONSULTORES</h1>
      
    </section>
    
  </body>
</html>