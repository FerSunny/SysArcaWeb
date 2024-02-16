


<?php
	session_start();
	date_default_timezone_set('America/Mexico_City');
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--	
	<link rel="stylesheet" href="../resources/css/bootstrap.min.css">
-->    
    <link  id="styloRemove" rel="stylesheet" href="../resources/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
  <body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
	include("../includes/barra.php");
	include("formularios/formularios_colpo.php"); // CAMBIO programa de la forma
	?>
    <div class="container">
	<div class="jumbotron">
  <h2 class="display-3"><script languaje="JavaScript"> 
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
				document.write("<font class='font-weight-normal' >"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font>") 
			</script></h2>
  <p class="lead"></p>
  <div class="row">
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
					    <div class="btn-group pull-right">

						</div>
						<h4><i class='glyphicon glyphicon-search'></i> - Plantillas disponibles para el estudio:  
							
							<?php 
								$desc_estudio='';
								$sql="select desc_estudio FROM km_estudios
									 where id_estudio=".$studio;
 								if ($result = mysqli_query($conexion, $sql)) {
								  while($row = $result->fetch_assoc())
								  {
								      $desc_estudio=$row['desc_estudio'];
								  }
								}

							echo '('.$studio.') '.$desc_estudio;
							?> 
 
						</h4>
					</div>





					<div class="panel-body">
					 <div id="row"> 
						<div class='outer_div'></div>

						<div class="table-responsive col-sm-12 col-md-12 col-lg-12">
					
							<table id="dt_agenda_p" class="table table-bordered table-hover  datatable-generated" cellspacing="0" width="100%" >
								<thead>
									<tr>
										
										<th>ID</th>
										<th>Nombre</th>
										<th>Titulo</th>
										<th>Descripcion</th>
										<th>Utilizar</th>
								
									</tr>
								</thead>
							</table>
						</div>
						</div>
					</div>


			</div>

		</div>

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 	
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
  	<!--
	<script type="text/javascript" src="../resources/js/jquery-1.12.3.js"></script>

	<script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>
	-->	
	<script type="text/javascript" src="../resources/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../resources/js/dataTables.bootstrap.js"></script>
 	<script type="text/javascript" src="../resources/js/sweetalert2.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	
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