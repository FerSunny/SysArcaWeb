<?php
	include '../controladores/conex.php';
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')

  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Cantaduría</title> <!-- CAMBIO  Titulo de la forma -->
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
		<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
		 <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
  		include("forms/forms.php"); // CAMBIO programa de la forma
  	?>

  	<div class="container" style="margin-top: 30px;">
      	<h1 style="text-align: center;">Tabla Contaduría
      	</h1>
  	</div>
  	<div class="container filtros">
		<div class="row">
			<div class="col">
				<div class="md-form">
					<p style="font-weight: 900">Tipo</p>
  					<select class="form-control" name="tipo" id="tipo" style="font-weight: 900;">
  						<option value="">Seleccione</option>
  						<option value="1">Ingresos</option>
  						<option value="2">Egresos</option>
  						<option value="3">Facturas</option>
  					</select>
  					<p id="tipo_info"></p>
				</div>
			</div>
			<div class="col">
				<div class="md-form">
					<p style="font-weight: 900">Fecha inicio</p>
					<input type="date" name="f_inicio" id="f_inicio">
				</div>
			</div>
			<div class="col">
				<div class="md-form">
					<p style="font-weight: 900">Fecha final</p>
					<input type="date" name="f_final" id="f_final" disabled>
				</div>
			</div>
			<div class="col">
				<div class="md-form">
					<p style="font-weight: 900">Grupo</p>
					<select class="form-control" name="grupo" id="grupo" style="font-weight: 900">
						<option value="">Seleccione</option>
						<?php
							$stmt = $conexion->prepare("SELECT clave_grupo, desc_grupo FROM kg_grupos WHERE estado = 'A'");
							$stmt->execute();
							$stmt->bind_result($clave_grupo,$desc_grupo);
							while($stmt->fetch())
							{
								echo '<option value="'.$clave_grupo.'">'.$desc_grupo.'</option>';
							}
						 ?>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="md-form">
					<p style="font-weight: 900">Buscar</p>
					<button class="btn btn-primary btn-md" name="buscar_facturas" id="buscar_facturas"><i class="fas fa-search"></i></button>
				</div>
			</div>
			<div class="col">
				<div class="md-form">
					<p style="font-weight: 900">Imprimir</p>
					<button type="button" id="imprimir_pdf" class="btn btn-danger btn-md"><i class="fas fa-file-pdf"></i></button>
				</div>
			</div>
		</div>
  	</div>
	<div class="container table-responsive">
		<table id="dt_contador" class="table table-bordered table-hover" cellspacing="1" width="100%">
			<thead>
				<tr>
					<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
					<th>Tipo</th>
					<th>Tipo de Pago</th>
    				<th># Folios</th>
    				<th>Importe</th>
    				<th>Ver</th>
    				<th>PDF</th>
				</tr>
			</thead>
		</table>
	</div>
	<!--
	<section style="margin-top: 50px;">
		<div class="mask rgba-black-light">
			<div class="container-fluid d-flex justify-content-center align-items-center">
				<div class="row">
					<div class="col-md-12">
						<div class="">
							<h3>Reporte por razon social</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section style="margin-top: 30px;">
		<div class="card card-cascade wider reverse">
		  <div class="card-body card-body-cascade text-center">
		  	<div class="row">
		  		<div class="col">
		  			<div class="md-form">
						<p style="font-weight: 900">Fecha inicio</p>
						<input type="date" name="f_inicio" id="f_inicio">
					</div>
					<div class="md-form">
						<p style="font-weight: 900">Fecha final</p>
						<input type="date" name="f_final" id="f_final" disabled>
					</div>
					<div class="md-form">
						<p style="font-weight: 900">Grupo</p>
						<select class="form-control" name="grupo" id="grupo" style="font-weight: 900">
							<option value="">Seleccione</option>
							<?php
								$stmt = $conexion->prepare("SELECT clave_grupo, desc_grupo FROM kg_grupos WHERE estado = 'A'");
								$stmt->execute();
								$stmt->bind_result($clave_grupo,$desc_grupo);
								while($stmt->fetch())
								{
									echo '<option value="'.$clave_grupo.'">'.$desc_grupo.'</option>';
								}
							 ?>
						</select>
					</div>
		  		</div>
		  		<div class="col">
		  			<div class="custom-control custom-checkbox">
					    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
					    <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label>
					</div>
					<div class="custom-control custom-checkbox">
					    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
					    <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label>
					</div>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col"></div>
		  		<div class="col"><button>Imprimir</button></div>
		  	</div>
		  </div>
		</div>
	</section>-->

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../media/alert/dist/sweetalert2.js"></script>
	<!-- JQuery -->
 	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>

    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
	<script language="javascript" src="js/app.js"></script>


</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
