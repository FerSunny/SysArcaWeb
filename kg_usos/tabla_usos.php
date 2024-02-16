<?php
  session_start();
    include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  	
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Usos</title> <!-- CAMBIO  Titulo de la forma -->
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
		.error {
		color: #c00;
		border-color: #ebccd1;
		padding:1px 20px 1px 20px;
		}
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
	<body background="../imagenes/logo_arca_sys_web.jpg">
		<?php
	  		include("../includes/barra.php"); // CAMBIO programa de la forma
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
  	<div class="container" style="margin-top: 30px;">
    	<h1 style="text-align: center;">Tabla de Usos  <!-- CAMBIO Se cambia el titulo de la tabla -->
        <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals">
        		<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Uso
        </button> <!-- CAMBIO Se cambia el boton de altas -->
    	</h1>
  	</div>

		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center">
					<small class="mensaje"></small>
				</h3>
			</div>
			<div class="container table-responsive">
				<table id="dt_usos" class="table table-bordered table-hover" cellspacing="1" width="100%">
					<thead>
						<tr>
							<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
							<th>Clave de Uso </th>
							<th>Descripci&oacute;n de Uso</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>

	<?php
		include("forms/forms.php")
	?>
    
	<!-- JQuery -->
	<script src="../media/js/jquery-1.12.3.js"></script>
  <script src="../media/alert/dist/sweetalert2.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
  <!-- DataTable 1.10.19 14/03/2019-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
	<script language="javascript" src="js/tb_usos.js"></script>
</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
