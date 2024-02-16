<?php
	session_start();
	date_default_timezone_set('America/Mexico_City');
	include ("../../controladores/conex.php");
	$query = "SELECT CONCAT(nombre,' ',a_paterno,' ',a_materno) nombre FROM so_clientes WHERE id_cliente =".$_GET['paciente'];

	$result = $conexion -> query($query);
	$row = mysqli_fetch_array($result);

	$nombre = $row['nombre'];
	if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
	{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  		<title>Agenda P1</title>
  		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap 4.1 14/03/2019-->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    	<!-- DataTable 1.10.19 14/03/2019-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

		<link rel="stylesheet" type="text/css" href="../../media/alert/dist/sweetalert2.css">
		<!-- FontAwesome 5 14/03/2019-->
	 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<style>
.error {
color: #c00;
border-color: #ebccd1;
padding:1px 20px 1px 20px;
}

@media only screen and (max-width: 780px) {
  .detalle_sesion {
    display: none;
  }

  .jumbotron h2
  {
  	margin-top: -30;
  }
}
@media only screen and (max-width: 575) {
  .date_center
  {
  	margin-top: -30 !important;
  }
}

</style>

  </head>
  <body background="../../imagenes/logo_arca_sys_web.jpg">
	<?php
	include("../../includes/barra.php");
	?>
	<div class="jumbotron" style="height: 100px !important;">
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



	<div class="panel-heading">
	  <div class="btn-group pull-right">
	  	<label for="">Paciente: </label>
	  	<label for="" style="font-weight: 900"><?php echo $nombre; ?></label>
	  	<input type="hidden" id="factura_get" name="factura_get" value="<?php echo $_GET['factura']?>" readonly>
		</div>
		<h2><i class="fas fa-search">Estudios</i></h2>
	</div>
	<table id="dt_agenda" class="compact cell-border hover table-responsive" style="width:100%">
		<thead>
			<tr>
				<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
				<th>ID</th>

				<th>Solicitada</th>
				
				<th>Sucursal</th>
				<th>Paciente</th>
				<th>Estudio</th>
				<th>Reg</th>
				<th>Fecha</th>
        <th>Imp</th>
				<th>Fecha</th>
				<th>Capturar</th>
				<th>Modificar</th>
				<th>Eliminar</th>
				<th>Imprimir</th>
				<th>Email</th>
			</tr>
		</thead>
	</table>


	<script src="../../media/js/jquery-1.12.3.js"></script>
	<script src="../../media/alert/dist/sweetalert2.js"></script>

	<!-- Bootstrap 4.1 14/03/2019-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<!-- DataTable 1.10.19 14/03/2019-->
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

 	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	
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