<?php
	session_start();
	date_default_timezone_set('America/Mexico_City');
	include ("../controladores/conex.php");
	if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
	{
?>
<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.3/css/mdb.min.css" rel="stylesheet">
		<!-- DataTable 1.10.19 14/03/2019-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

		<link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
	<style>
.hoverable
{
cursor: pointer;
}
.hoverable:hover
{
	background-color:#0d47a1;
	color: #FFF;
}
</style>
		</head>
		<body background="../imagenes/logo_arca_sys_web.jpg">
		<?php
			include("../includes/barra.php");
		?>
	<div class="jumbotron example hoverable" style="height: 100px !important;">
	<h2 class="date_center" style="text-align: center; margin-top: -50px; font-weight: 900;">
		<script languaje="JavaScript">
				var mydate=new Date()
				var year=mydate.getYear()
				if (year < 1000)
				year+=1900
				var day=mydate.getDay()
				var month=mydate.getMonth()
				var daym=mydate.getDate()
				if (daym<10)
				daym="0"+daym
				var dayarray=new Array("Domingo,","Lunes,","Martes,","Miércoles,","Jueves,","Viernes,","Sábado,")
				var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
				document.write("<font class='' >"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font>")
			</script>
		</h2>
	<p class="lead"></p>
	<div class="row detalle_sesion" style="text-align: center;">
		<div class="col-md-6">
			<div class="form-group">
			<label class="font-weight-bold lead">Servicio:</label>
			<label class="font-weight-normal lead"><?php echo $_SESSION['desc_perfil']?></label>
			</div>
		</div>
			<div class="col-md-6">
			<div class="form-group">
			<label class="font-weight-bold lead">En turno:</label>
			<label class="font-weight-normal lead"><?php echo $_SESSION['nombre_completo']?></label>
			</div>
		</div>
		</div>
	</div>


			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="btn-group pull-right"></div>
						<h4><i class='glyphicon glyphicon-search'></i>Estudios</h4>
							</div>
								 <div class="panel-body">
										<div class='outer_div'></div>
											<div class="table-responsive col-sm-12">
												<table id="dt_agenda" class="table table-bordered table-hover datatable-generated" cellspacing="0" width="100%" >
													<thead>
															<tr>
																<th>ID</th>
																<th>Solicitada</th>
																<th>Sucursal</th>
																<th>Paciente</th>
																<th>Estudio</th>
																<th>Reg</th>
																<th>Email Medico</th>
																<th>Email Paciente</th>
																<th>Whatsapp</th>
																<!-- <th>Mail</th> -->

															</tr>
														</thead>
										</table>
									</div>
								</div>
						</div>
					</div>
	<!-- Bootstrap tooltips -->
	<script src="../media/alert/dist/sweetalert2.js"></script>

	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.3/js/mdb.min.js"></script>

	<!-- DataTable 1.10.19 14/03/2019-->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="./js/tabla_agenda.js"></script>
		</body>
</html>
<?php

	}
	else
	{
		header("location: index.html");
	}
 ?>