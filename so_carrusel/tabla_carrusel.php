<?php
date_default_timezone_set('America/Mexico_City');
session_start();
include "../controladores/conex.php";
$perfil = $_SESSION['fk_id_perfil'];
$id_usuario = $_SESSION['id_usuario'];

 if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
{
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Imagenes Carrusel</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  </head>
  <body background="../imagenes/logo_arca_sys_web.jpg">
    <?php
      include("../includes/barra.php");
    ?>
    <section class="datos">
      <div class="container d-flex justify-content-center align-items-center" style="margin-top: 40px;margin-bottom: 30px;">
        <h2>Tabla Carrusel</h2>
        <button type="button" class="btn btn-primary btn-md" id="btn-modal">Agregar Imagen</button>
      </div>
    </section>
    <section class="tabla">
      <div class="container table-responsive">
        <table id="dt_carrucel" class="table table-bordered table-hover" cellspacing="1" width="100%" style="font-weight:900;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Ruta IMG</th>
              <th>Titulo</th>
              <th>Subtitulo</th>
              <th>Fecha</th>
              <th>Ver</th>
              <th>Editar</th>
              <th>Status</th>
            </tr>
          </thead>
        </table>
      </div>
    </section>
    <?php include "forms/forms.php" ?>
    <script src="../media/alert/dist/sweetalert2.js"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
<?php 
}else{
  header("location: ../includes/logout");
} ?>