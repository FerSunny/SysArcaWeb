<?php
   require_once ("../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
   require_once ("../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos  
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {  
  $id_doc=$_GET['id_doc'];
  $num_version=$_GET['num_version'];
  $desc_doc=$_GET['desc_doc'];

  $id_numeral_1=$_GET['fk_id_numeral_1'];
  $id_numeral_2=$_GET['fk_id_numeral_2'];

  $_SESSION['id_doc']=$id_doc;
	$_SESSION['num_version']=$num_version;
  $_SESSION['desc_doc']=$desc_doc;

  $_SESSION['id_numeral_1']=$id_numeral_1;
  $_SESSION['id_numeral_2']=$id_numeral_2;

  $_SESSION['desc_doc']=$desc_doc;

  //$fk_id_numeral_1=$_SESSION['fk_id_numeral_1']; 
  //$fk_id_numeral_2=$_SESSION['fk_id_numeral_2']; 

  // obenemos las descripcionees de los numerales
  $sql_des="
  SELECT
  a.`desc_numeral_1`,
  b.`desc_numeral_2`
  FROM 
  sgc_indice_uno a,
  sgc_indice_dos b
  WHERE a.`id_numeral_1` = $id_numeral_1
  AND b.`fk_id_numeral_1` = a.`id_numeral_1`
  AND b.`id_numeral_2`  = $id_numeral_2
  AND a.`estado` = 'A'
  AND b.`estado` = 'A'
  ";
  //echo $sql_des;
  if ($result = mysqli_query($con, $sql_des)) {
    while($row = $result->fetch_assoc())
    {
        $desc_numeral_1=$row['desc_numeral_1'];
        $desc_numeral_2=$row['desc_numeral_2'];
    }
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Documentos</title> <!-- CAMBIO  Titulo de la forma -->
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
    include("formularios/formularios_ficheros.php"); // CAMBIO programa de la forma
   // include("formularios/formularios_imagenes.php");
  ?>

  <div class="container" style="margin-top: 30px;">
    <h1 style="text-align: center;">Control de versiones  <!-- CAMBIO Se cambia el titulo de la tabla -->
      <button type="button" <?php if($id_usuario > 0 ){ }else {?> disabled <?php } ?> class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Nueva Version</button> <!-- CAMBIO Se cambia el boton de altas -->
      <h2>Ficheros para el documento: <br>
          <?php
            echo  '<b>';
            echo '('.$id_numeral_1.') '.$desc_numeral_1;
            echo  '<br>';
            echo '('.$id_numeral_2.') '.$desc_numeral_2;
            echo  '<br>';
            echo '('.$desc_doc.') ';
            

          ?>
    </h1>
  </div>
  

  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
    <div class="col-sm-offset-2 col-sm-8">
      <h3 class="text-center">
        <small class="mensaje"></small>
      </h3>
    </div>
    <div class="container table-responsive">
      <table id="dt_imagenes" class="table table-bordered table-hover" cellspacing="1" width="100%">
        <thead>
          <tr>
            <!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
            <th>Id Doc</th>
            <th>Id fichero</th>
            <th>Usuario Publico Inicial</th>
            <th>Fecha Publico Inicial</th>
            <th>Nombre </th>
            <th>ruta</th>
            <th>Tipo</th>
            <th>Version</th>
            <th>Revision</th>
            <th>Estatus</th>
            <th>Usuario estatus</th>
            <th>Fecha estatus</th>
            <th>Descargar</th>
            <th>Actualizar version</th>
            <th>Eliminar</th>
            <!--
            <th>Ver</th>
            <th>Descargarlo</th>
-->
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
  <script language="javascript" src="js/tabla_ficheros.js"></script>
</body>
</html>
<?php

  }
  else
  {
  header("location: index.html");
  }
 ?>
