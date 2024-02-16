<?php
	include '../controladores/conex.php';
  
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Contaduria</title> <!-- CAMBIO  Titulo de la forma -->
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
		 <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
	.card .row  .md-form label, label{
		font-weight: 900;
		color: black;
	}

.breadcrumb {
    background-color: rgba(0,0,0,.03);
    border: 1px solid rgba(0,0,0,.125);
}

#content {
    margin-bottom: 25px;
}

.adsbygoogle {
    margin-bottom: 15px;
}

.footer-content {
    padding-top: 20px;
    padding-bottom: 20px;
}

.footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    line-height: 60px;
    background-color: #f5f5f5;
    text-align: center;
}

.footer a {
    color: rgba(255,255,255,.5);
    text-decoration: none;
}

.footer a:hover {
    color: #fff;
}

#content {
    text-align: center;
}

.loading {
    text-align: center;
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


	<?php
  	//	include("forms/forms.php"); // CAMBIO programa de la forma
  	//	include("prueba.php");
  	?>

  	<div class="container" style="margin-top: 30px;">
      	<h1 style="text-align: center;">Tabla Contaduría
      	</h1>
  	</div>

		<div class="" id="mostrar" style="height: 700px !important;">
			<div style="padding: 15px; background: rgb(188,224,246);">
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="md-form">
							<p style="font-weight: 900">Tipo</p>
		  					<select class="form-control" name="tipo" id="tipo" style="font-weight: 900;">
		  						<option value="">Seleccione</option>
		  						<option value="1">Ingresos</option>
		  					</select>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="md-form">
							<p style="font-weight: 900">Fecha inicio</p>
							<input type="date" name="f_inicio" id="f_inicio">
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="md-form">
							<p style="font-weight: 900">Fecha final</p>
							<input type="date" name="f_final" id="f_final">
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="md-form">
							<p style="font-weight: 900">Grupo</p>
							<select class="form-control" name="grupo" id="grupo" style="font-weight: 900">
								<option value="">Seleccione</option>
								<?php
									$stmt = $conexion->prepare("SELECT id_grupo, desc_grupo FROM kg_grupos WHERE estado = 'A'");
									$stmt->execute();
									$stmt->bind_result($id_grupo,$desc_grupo);
									while($stmt->fetch())
									{
										echo '<option value="'.$id_grupo.'">'.$desc_grupo.'</option>';
									}
								 ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-3 label-wi">
						<div class="md-form">
						  <input type="text" id="total_banco" class="form-control" readonly>
						  <label for="total_banco">Total en Banco</label>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-3 label-wi">
						<div class="md-form">
						  <input type="text" id="total_efectivo" class="form-control" readonly>
						  <label for="total_efectivo">Total en Efectivo</label>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-3 label-wi">
						<div class="md-form">
						  <input type="text" id="total_t" class="form-control">
						  <label for="total_t">Total</label>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-3 label-wi">
						<div class="md-form">
						  <input type="text" class="form-control" min="0.01" step="0.01" name="cantidad" id="cantidad" value="00.00">
						  <label for="cantidad">Cantidad a Buscar</label>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-sm-12 col-md-12 col-lg-12 label-wi d-flex justify-content-center">
						<div class="md-form">
						  <button class="btn btn-primary btn-md" name="buscar_sucursal" id="buscar_sucursal"><i class="fas fa-calculator"></i></button>
						</div>
						<div class="md-form">
						  <button class="btn btn-primary btn-md" name="btn-bancos" id="btn-bancos">
						  	Folios Bancos
						  </button>
						</div>
						<div class="md-form">
						  <button class="btn btn-primary btn-md" name="btn-folios" id="btn-folios"> Folios Efectivo</button>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table id="dt_contador" class="table table-bordered table-hover" cellspacing="1" width="100%">
			      	<thead>
			         	<tr>
			         		<th>Id Sucursal</th>
					        <th>Sucursal</th>
					        <th>Porcentaje</th>
					        <th>Cantidad x Porcentaje</th>
					        <th>Banco Folios</th>
				         	<th>Banco Importe</th>
				         	<th>Efectivo #Folios</th>
				         	<th>Efectivo Importe</th>
				         	<th>Cantidad Requerida en Efectiv</th>
			          </tr>
			        </thead>
			      </table>
			</div>
		</div>

		<?php 
		include "forms/form_loading.php";
		include "forms/form_tabla.php";
		include "forms/form_folio.php";
		include "forms/form_banco.php";
		?>

	
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
	<script language="javascript" src="js/app_1.js"></script>


</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
