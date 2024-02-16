<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {

    $fk_id_estudio_ori=$_GET['fk_id_estudio_ori'];
    
	  $_SESSION['fk_id_estudio_ori']=$fk_id_estudio_ori;

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Areas</title> <!-- CAMBIO  Titulo de la forma -->
  <link rel="icon" type="image/png" href="../imagenes/ico/red.png" />
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
   // include("../includes/barra.php");
    include("formularios/formularios_productos.php"); // CAMBIO programa de la forma
  ?>

  <div class="container">
    <h1 style="text-align: center;">Tabla Areas<!-- CAMBIO Se cambia el titulo de la tabla -->
      <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nueva Area</button> <!-- CAMBIO Se cambia el boton de altas -->
    </h1>

    <h3>Areas a la que pertenece el estudio: <br>
      <?php 
							$desc_estudio='';
							$sql="select desc_estudio FROM km_estudios where id_estudio=".$fk_id_estudio_ori;
 							if ($result = mysqli_query($conexion, $sql)) {
								while($row = $result->fetch_assoc())
								{
								    $desc_estudio=$row['desc_estudio'];
								}
								}
							echo  '<b>('.$fk_id_estudio_ori.') '.$desc_estudio
						?>
        <!--
          <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Estudio </button>
        -->
    </h3>
    
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
            <th>ID</th>
            <th>Clave</th>
            <th>Area</th>
            <th>Editar</th>
            <th>Eliminar</th>
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
