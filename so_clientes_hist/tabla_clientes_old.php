<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
	<title>Clientes</title> <!-- CAMBIO  Titulo de la forma -->
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
  include("formularios/formularios_clientes.php"); // CAMBIO programa de la forma
  ?>

	<div class="col-sm-12 col-md-12 col-lg-12">
	    <h2>Tabla de Clientes  <!-- CAMBIO Se cambia el titulo de la tabla -->
	        <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Cliente
	        </button> <!-- CAMBIO Se cambia el boton de altas -->
	    </h1>
	</div>
	<div class="row">
			<div class="col-md-12">
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
				<label for="" style="visibility:hidden;"></label>
				<input id="btnFilter" type="button" class="form-control btn btn-warning" value="Buscar">			
			</div>

			<div class="form-group col-md-1">
				<label for="" style="visibility:hidden;"></label>
				<button id="btnClear" type='button' class='form-control btn btn-danger'><i class='fa fa-refresh'></i></button>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">
			<!-- REVISAR -->
				<table id="dt_clientes" class="table table-bordered table-hover dt_clientes" cellspacing="1" width="100%">
					<thead>
						<tr>
							<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
							<th>ID </th>
							<th>Nombre</th>
	        				<th>A. Paterno</th>
	        				<th>A. Materno</th>
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
	<script language="javascript" src="js/tabla_clientes.js"></script> <!-- CAMBIO este JS -->
	<script language="javascript" src="../searchFilter/js/filter.js"></script> <!-- Agregar donde se requiera filtrar información-->
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
