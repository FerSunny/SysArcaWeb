<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head> <!-- <meta http-equiv="Content-Type" content="text/html; charset=gb18030"> -->
	  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	
	<title>Plantilla IMG</title> <!-- CAMBIO  Titulo de la forma -->
        
	<!-- DataTable 1.10.19 14/03/2019-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/><!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

		        <!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
        <!-- FontAwesome 5 14/03/2019-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

</head>
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
  include("../includes/barra.php");
  include("formularios/formularios_plantilla_rx.php"); // CAMBIO programa de la forma
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
  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Tabla de Plantillas Rx<!-- CAMBIO Se cambia el titulo de la tabla -->
          <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>Nueva Plantilla </button>&nbsp; <!-- CAMBIO Se cambia el boton de altas -->
      </h1>
  </div>
		<div class="row">
			<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
				<div class="col-sm-offset-2 col-sm-8">
					<h3 class="text-center"> <small class="mensaje"></small></h3>
				</div>
				<div class="table-responsive col-sm-12" >
				<!-- REVISAR -->
					<table id="dt_plantilla_rx" class="table table-bordered table-hover" cellspacing="1" width="100%" >
						<thead>
							<tr>
								<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
								<th>Medico</th>
								<th>ID.</th>
								<th>Plantilla</th>
                				<th>Estudio</th>
                			
                				<th>Descripcion</th>
                			
								<th>Editar</th>
								<th>Eliminar</th>
								<th>Imprimir</th>
							</tr>
						</thead>
					</table>
				</div>
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
	<script language="javascript" src="js/tabla_plantilla_rx.js"></script>
-->
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
