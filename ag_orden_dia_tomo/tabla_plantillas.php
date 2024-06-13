<?php
	session_start();
	date_default_timezone_set('America/Chihuahua');
	include ("../controladores/conex.php");


	if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
	{
	$numero_factura=$_GET['numero_factura'];
	$studio=$_GET['studio'];

	$_SESSION['studio']=$studio;
	$_SESSION['numero_factura']=$numero_factura;

	$id_usuario= $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Plantilla RX</title>
		<!-- DataTable 1.10.19 14/03/2019-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/><!-- Font Awesome -->
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
		<!-- sweetalert2 -->
		<link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">

	    	<!-- Buttons DataTables -->
	    <link rel="stylesheet" href="../resources/css/buttons.bootstrap.min.css">
	    <link rel="stylesheet" href="../resources/css/font-awesome.css">
	    <link href="../resources/css/sweetalert2.css" rel="stylesheet" type="text/css">

		<link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">
			<style>
				.error {
				color: #c00;
				border-color: #ebccd1;
				padding:1px 20px 1px 20px;
				}
			</style>
		
	</head>
	<?php
		include("formularios/formularios_ekg.php")
	?>

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



		<div class="panel panel-info">
			<div class="panel-heading">
					<h4>Plantillas disponibles para el estudio:  
						<?php 
							$desc_estudio='';
							$sql="select desc_estudio FROM km_estudios where id_estudio=".$studio;
 							if ($result = mysqli_query($conexion, $sql)) {
								while($row = $result->fetch_assoc())
								{
								    $desc_estudio=$row['desc_estudio'];
								}
								}
							echo  '<b>('.$studio.') '.$desc_estudio
						?>  
					</h4>					
			</div>
	
			<div class="panel-heading">	
					<h4>Paciente:
					<label for="" style="font-size: 24px; font-weight: 900"><?php echo $nombre; ?></label>
					<input type="hidden" id="factura_get" name="factura_get" value="<?php echo $_GET['numero_factura']?>" readonly>
					</h4>		
			</div>	
		</div>	
							

		<div class="container table-responsive">						
			<table id="dt_agenda_p" class="table table-bordered table-hover  datatable-generated" cellspacing="0" width="100%" >
				<thead>
					<tr>
						<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
						<th>ID</th>
						<th>Nombre</th>
						<th>Titulo</th>
						<th>Descripcion</th>
						<th>Utilizar</th>								
					</tr>
				</thead>
			</table>
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
 		<script type="text/javascript" src="./js/tabla_plantilla.js"></script>
  </body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>