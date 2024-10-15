<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
	$studio=$_GET['studio'];
	$_SESSION['studio']=$studio;
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"">
	
	<title>Plantilla Uno</title> <!-- CAMBIO  Titulo de la forma -->
	<!-- Bootstrap 4.1 14/03/2019-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- DataTable 1.10.19 14/03/2019-->
 	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.css"/>
 	
 	<link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
 	
	<!-- FontAwesome 5 14/03/2019-->
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<style>
	.modal-md
	{
		width: auto !important;
		height: auto !important;
	}
</style>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
  include("../includes/barra.php");
  include("formularios/formularios_plantilla_1.php"); // CAMBIO programa de la forma
  ?>

  	<div class="container" style="margin-top: 20px;">
      	<h1>Tabla de Plantilla Cultivos  <!-- CAMBIO Se cambia el titulo de la tabla -->
          	<button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals" style="float: right;"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Concepto</button> <!-- CAMBIO Se cambia el boton de altas -->
      	</h1>
  	</div>

	<div class="container">
		<h3 class="text-center"> <small class="mensaje"></small></h3>
	</div>
	<div class="container table-responsive">
	<!-- REVISAR -->
		<table id="dt_plantilla_1" class="table-striped cell-border compact stripe" cellspacing="1" width="100%" >
			<thead>
				<tr>
					<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
					<th>ID.</th>
					<th>Orden</th>
    				<th>Estudio</th>
    				<th>Tipo</th>
					<!--
    				<th>Interface - 240</th>
    				<th>Interface - 680</th>
					-->
    				<th>Concepto</th>
					<!--
    				<th>Valor Referencia</th>
    				<th>U. Medida</th>
					-->
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
		</table>
	</div>




	<script src="../media/js/jquery-1.12.3.js"></script>
	<script src="../media/alert/dist/sweetalert2.js"></script>
	<!-- Bootstrap 4.1 14/03/2019-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<!-- DataTable 1.10.19 14/03/2019-->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>


	<script language="javascript" src="js/tabla_plantilla_1.js"></script> <!-- CAMBIO este JS -->
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
