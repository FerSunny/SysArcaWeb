<?php
include("../controladores/conex.php");
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Almacén Central</title>
  <link rel="icon" type="image/png" href="../imagenes/ico/almacen.png" />
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
<body background="../imagenes/logo_arca_sys_web.jpg">
  
  <?php
  include("../includes/barra.php");
  //include("forms/modal_productos.php");
  include("forms/forms.php"); 
  ?>


  <div class="container" style="margin-top: 20px; text-align: center;font-size: 24px ;font-weight: 900 !important;">
      Productos en Almacén<br>
      Almacén Central: TULYEHUALCO  <!-- CAMBIO Se cambia el titulo de la tabla -->
        </h1>
  </div>  

    <div class="">
        <table id="dt_almacen" class="table table-bordered table-hover" cellspacing="1" width="100%">
            <thead>
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Proveedor</th>
                <th>Fecha de actualizaci&oacute;n</th>
                <th>Existencias</th>
                <th>Mínimo</th>
                <th>Máximo</th>
                <th>Editar</th>
              </tr>
            </thead>
        </table>
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
  <script language="javascript" src="js/tb_almacen.js"></script>
</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
