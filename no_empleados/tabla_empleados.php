<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Empleados</title>
	<!-- DataTable 1.10.19 14/03/2019
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.css"/>
	-->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

	<link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
	include "../includes/barra.php";
	include("formularios/formularios_clientes.php");
	?>
	<div class="container" style="margin-top: 30px;">
		<h1 style="text-align: center;">Tabla de Empleados <!-- CAMBIO Se cambia el titulo de la tabla -->
			<button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo empleado</button> <!-- CAMBIO Se cambia el boton de altas -->
		</h1>
	</div>

	<div class="container">
		<div class="row">
			<div class="form-group col-md-2">
				<label for="nameSearch">Nombre:</label>
				<input type="text" class="form-control parameter" id="nombreBusqueda">
			</div>
			<div class="form-group col-md-2">
				<label for="firstname">Apellido Paterno:</label>
				<input type="text" class="form-control parameter" id="apellidoPaterno">
			</div>

			<div class="form-group col-md-2">
				<label for="lastname">Apellido Materno:</label>
				<input type="text" class="form-control parameter" id="apellidoMaterno">
			</div>

			<div class="form-group col-md-2">
				<label for="" buscar style="visibility:hidden;"></label>
				<input id="btnFilter" type="button" class="form-control btn btn-warning" value="Buscar style="margin-top: 20px;>			
			</div>

			<div class="form-group col-md-1">
				<label for="" style="visibility:hidden;"></label>
				<button id="btnClear" type='button' class='form-control btn btn-danger'> <i class="fas fa-sync-alt"></i> </button>
			</div>
		</div>
	</div>
	
	
	
	<div class="container table-responsive">
		<table id="dt_clientes" class="table table-bordered table-hover" cellspacing="1" width="100%" style="font-weight:900;">
			<thead>
				<tr>
						<th>ID </th>
						<th>Nombre</th>
						<th>A.paterno</th>
						<th>A.materno</th>
						<th>Edad</th>
						<th>Sexo</th>
						<th>Edo. Civil</th>
						<th>Telefono</th>
						<th>Movil</th>
						<th>Editar</th>
						<th>Eliminar</th>
				</tr>
			</thead>
		</table>
	</div>
<script src="../media/alert/dist/sweetalert2.js"></script>
<script type="text/javascript" src="../media/js/jquery-1.12.3.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
<!-- DataTable 1.10.19 14/03/2019-->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.js"></script>
<script language="javascript" src="js/tabla_clientes.js"></script> <!-- CAMBIO este JS -->
<script language="javascript" src="../searchFilter/js/filter.js"></script>

		<script>
		$(document).ready(function(){
				$("#myBtn").click(function(){
						$("#myModal").modal();
				});
		});
		</script>
</body>
</html>
