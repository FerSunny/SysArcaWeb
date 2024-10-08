<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
   $id_usuario=$_SESSION['id_usuario']; 

   $id_numeral_1=$_GET['id_numeral_1'];
   $id_numeral_2=$_GET['id_numeral_2']; 
   
   $desc_numeral_1=$_GET['desc_numeral_1'];
   $desc_numeral_2=$_GET['desc_numeral_2'];
 
   $_SESSION['id_numeral_1']=$id_numeral_1;
   $_SESSION['id_numeral_2']=$id_numeral_2;




?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Lista Maestra</title> <!-- CAMBIO  Titulo de la forma -->
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
    include("formularios/formularios_documentos.php"); // CAMBIO programa de la forma
   // include("formularios/formularios_imagenes.php");
  ?>

  <div class="container" style="margin-top: 30px;">
    <h1 style="text-align: center;">Lista Maestra  <!-- CAMBIO Se cambia el titulo de la tabla -->
      <button type="button" <?php if($id_usuario == 1 or $id_usuario == 2 or $id_usuario == 114  or $id_usuario == 30){ }else {?> disabled <?php }  ?> class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Crear Documento</button> <!-- CAMBIO Se cambia el boton de altas -->
    </h1>
    <h2>Ficheros para el documento: <br>
          <?php
            echo  '<b>';
            echo  '('.$id_numeral_1.') '.$desc_numeral_1;
            echo '<br>';
            echo  '('.$id_numeral_2.') '.$desc_numeral_2
          ?>
    </h2>
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
            <th>Tipo </th>
            <th>Grupo</th>
            <th>Clave</th>
            <th>Documento</th>
            <th># Copias Elec</th>
            <th>Ubicacion Elec</th>
            <th># Copias Fisico</th>
            <th>Ubicacion Fisico</th>
            <th># Revision</th>
            <th># Version</th>
            <th>Fecha Emision</th>
            <th>Fecha Prox. Revision</th>
            <th>Editar</th>
            <th>Eliminar</th>
            <th>Ficheros</th>

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
  <script language="javascript" src="js/tabla_lista.js"></script>
</body>
</html>
<?php

  }
  else
  {
  header("location: index.html");
  }
 ?>
