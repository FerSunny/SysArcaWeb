


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
	  <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
      <link  id="styloRemove" rel="stylesheet" href="../resources/css/dataTables.bootstrap.min.css">

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
	?>
    <div class="container">
	<div class="jumbotron">
  <h6 class="display-3"><script languaje="JavaScript"> 
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
			</script></h6>
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
						<h4><i class='glyphicon glyphicon-search'></i>Estudios</h4>
					</div>
					<div class="panel-body">
						<!-- <div id="resultados"></div> -->
						<div class='outer_div'></div>

						<div class="table-responsive col-sm-12">
							<table id="dt_agenda" class="table table-bordered table-hover datatable-generated" cellspacing="0" width="100%" >
								<thead>
									<tr>
										<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
										<th>ID</th>

										<th>Solicitada</th>
										<th>Entrega</th>
										<th>Sucursal</th>
										<th>Paciente</th>
										<th>Estudio</th>
										<th>Diagnostico</th>
										<th>Atendido</th>
										<th>Registrar</th>
										<th>Imagenes</th>
										<th>Impr R</th>
										<th>Impr I</th>
									</tr>
								</thead>
							</table>
						</div>

					</div>
			</div>

		</div>
	<script type="text/javascript" src="../resources/js/jquery-1.12.3.js"></script>

	<script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../resources/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../resources/js/dataTables.bootstrap.js"></script>
 <script type="text/javascript" src="../resources/js/sweetalert2.js"></script>
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