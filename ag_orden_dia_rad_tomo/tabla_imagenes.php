<?php
  include ("../controladores/conex.php");
session_start();
  date_default_timezone_set('America/Mexico_City');

  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
	$numero_factura=$_GET['numero_factura'];
	$studio=$_GET['studio'];

	$_SESSION['studio']=$studio;
	$_SESSION['numero_factura']=$numero_factura;

	$id_usuario= $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Administracion de Imagenes</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="stylesheet" href="css/estilos.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<link rel="stylesheet" href="../media/css/bootstrap.min.css">
	<link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="../media/css/estilos.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="../media/css/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="../media/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
  include("../includes/barra.php");
  include("formularios/formularios_imagenes.php");
  ?>

  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Tabla de Imagenes
          <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nueva Imagen</button>
      </h1>
  </div>
		<div class="row">
			<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
				<div class="col-sm-offset-2 col-sm-8">
					<h3 class="text-center"> <small class="mensaje"></small></h3>
				</div>
				<div class="table-responsive col-sm-12">
					<table id="dt_imagenes" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nota</th>
								<th>Paciente</th>
								<th>Estudio</th>
								<th>Imagen</th>
								<th>Ruta</th>
								<th>Ver</th>
								<th>Eliminar</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

	<script src="../media/js/jquery-1.12.3.js"></script>
	<script src="../media/js/bootstrap.min.js"></script>
	<script src="../media/js/jquery.dataTables.min.js"></script>
	<script src="../media/js/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->
	<script src="../media/js/dataTables.buttons.min.js"></script>
	<script src="../media/js/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="../media/js/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="../media/js/pdfmake.min.js"></script>
	<script src="../media/js/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="../media/js/buttons.html5.min.js"></script>
	<script language="javascript" src="js/tabla_imagenes.js"></script>
	<script>
	$(document).ready(function(){
	    $("#myBtn").click(function(){
	        $("#myModal").modal();
	    });
	});
	</script>
</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>