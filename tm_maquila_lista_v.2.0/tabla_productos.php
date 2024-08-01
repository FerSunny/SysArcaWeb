<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Productos</title> <!-- CAMBIO  Titulo de la forma -->
  <link rel="icon" type="image/png" href="../imagenes/ico/capital.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- DataTable 1.10.19 14/03/2019-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
  
</head>
<style>
  option:hover{
    background-color:red !important;
    -webkit-box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
    -moz-box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
    box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
  }
</style>
<body background="../imagenes/logo_arca_sys_web.jpg">
  <?php
    include("../includes/barra.php");
    include("formularios/formularios_productos.php"); // CAMBIO programa de la forma
  ?>

  <div class="container" style="margin-top: 30px;">
    <h1 style="text-align: center;">Tabla de Lotes  <!-- 
      CAMBIO Se cambia el titulo de la tabla 
      <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Producto</button> <!-- CAMBIO Se cambia el boton de altas
       -->
    </h1>
  </div>

  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
    <div class="col-sm-offset-2 col-sm-8">
      <h3 class="text-center">
        <small class="mensaje"></small>
      </h3>
    </div>
    <div class="container table-responsive">
      <table id="dt_productos" class="table table-bordered table-hover" cellspacing="1" width="100%">
        <thead>
          <tr>
            <!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
            <th>Sucursal </th>
            <th>Lote</th>
            <th># Muestras</th>

            <th>Reporte</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <script src="../media/js/jquery-1.12.3.js"></script>
  <script src="../media/alert/dist/sweetalert2.js"></script>
  <!-- JQuery -->

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
  
  <!-- DataTable 1.10.19 14/03/2019-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
  <script language="javascript" src="js/tabla_productos.js"></script>
</body>
</html>
<?php

  }
  else
  {
  header("location: index.html");
  }
 ?>
