<?php

  session_start();
  include ("../controladores/conex.php");
  $id_usuario = $_SESSION['id_usuario'];
  $query = "
  SELECT 
  CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) AS usuario,
  se.`desc_servicio`
  FROM 
  se_usuarios us
  LEFT OUTER JOIN cr_firmas fi ON (fi.fk_id_usuario = us.id_usuario)
  LEFT OUTER JOIN km_servicios se ON (se.`id_servicio` = us.`fk_id_servicio`)
  WHERE us.`id_usuario` = $id_usuario
";
// echo $query;
  $result = $conexion -> query($query);
  $row = mysqli_fetch_array($result);

  $nombre_usuario = $row['usuario'];
  $nombre_area = $row['desc_servicio'];


  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {

    $clave=$_GET['clave'];
    $desc_area=$_GET['desc_area'];
    $fecha=$_GET['fecha'];

    $_SESSION['clave']=$clave;
    $_SESSION['desc_area']=$desc_area;
    $_SESSION['fecha']=$fecha;
?>

<!DOCTYPE html>

<html lang="es">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">

  <title>Check-in Muestras</title> <!-- CAMBIO  Titulo de la forma -->

  <link rel="icon" type="image/png" href="../imagenes/ico/sol.png" />

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

    <h1 style="text-align: center;">Muestras (CHECK-IN AREA) <!-- CAMBIO Se cambia el titulo de la tabla -->

       

      <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" 
      data-target="#myModals"><i class="fa fa-sort" aria-hidden="true"></i>&nbsp;Ordenar Sucursales</button> 

      <button type="button" onclick="location.href='./reports/list_work.php';" class="btn btn-primary pull-right menu" ><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Imprimir Hoja de trabajo</button>
      <button type="button" onclick="location.href='./reports/list_work_reimprime.php';" class="btn btn-danger pull-right menu" ><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Re-imprimir Hoja de trabajo</button>
    </h1>

    <p class="lead"></p>
    <div class="row detalle_sesion" style="text-align: center;">
      <div class="col-md-6">
        <div class="form-group">
          <label class="font-weight-bold lead">Servicio:</label>
          <label class="font-weight-normal lead"><?php echo $nombre_area?></label>
          <label class="font-weight-bold lead">Area:</label>
          <label class="font-weight-normal lead"><?php echo $desc_area?></label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label class="font-weight-bold lead">En turno:</label>
          <label class="font-weight-normal lead"><?php echo $nombre_usuario?></label>
        </div>
      </div>
    </div>



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
            <th>Id </th>
            <th>Sucursal </th>
            <th>OT </th>
            <th>Estudio </th>

            <th>Fecha Toma</th>

            <th>Paciente</th>
            <th>Muestra</th>
            <th>Estatus</th>

            <th>Rechazar</th>

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

  <script language="javascript" src="js/tabla_productos_revisa.js"></script>

</body>

</html>

<?php



  }

  else

  {

  header("location: index.html");

  }

 ?>

