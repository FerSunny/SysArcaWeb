<?php
session_start();
date_default_timezone_set('America/Mexico_City');


$fecha=date("d/m/Y H:i:s");
$hora=date("H:i:s");
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Administracion de Pacientes</title>
	<link rel="stylesheet" href="../media/css/bootstrap.min.css">
	<link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="../media/css/estilos.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="../media/css/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="../media/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jspdf.min.js"></script>
    <script src="js/tabla_orden.js"></script>
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
  include("../includes/barra.php");
  include("formularios/form.php");
    ?>

  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Tabla Notas
      
      </h1>
  </div>
		<div class="row">
			<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
				<div class="col-sm-offset-2 col-sm-8">
					<h3 class="text-center"> <small class="mensaje"></small></h3>
				</div>
				<div class="table-responsive col-sm-12">
					<table id="dt_detalle" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>ID Solicitud</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Fecha</th>
								<th>Editar Solcitud</th>
								<th>Editar Costos</th>
								<th>Editar Estudios</th>
								<th>PDF</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Tabla Estudios
      
      </h1>
  </div>
		<div class="row">
			<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
				<div class="col-sm-offset-2 col-sm-8">
					<h3 class="text-center"> <small class="mensaje"></small></h3>
				</div>
				<div class="table-responsive col-sm-12">
					<table id="dt_estudios" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>ID Solicitud</th>
								<th>Id Del Estudio</th>
								<th>Estudio</th>
								<th>Precio</th>
								<th>Editar Solcitud</th>
								<th>Editar Costos</th>
								<th>Editar Estudios</th>
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
	<script language="javascript" src="js/solicitud.js"></script>
    <script src="js/detalle.js"></script>
    <script>
	$(document).ready(function(){
	    $("#myBtn").click(function(){
	        $("#myModal").modal();
	    });
         $("#myBtn1").click(function(){
	        $("#miModal").modal();
	    });
	});
        
	</script>
	<script type="text/javascript">
function calcular_total() {
	importe1 = 0;
    importe2=0;
    importe3=0;
    importe4=0;
    importe5=0;
    des=0;
    total=0;
    cuenta=0;
     $(".cuenta").each(
		function(index, value) {
			cuenta =eval($(this).val());
		}
	);
     $(".descuento").each(
		function(index, value) {
			desc =eval($(this).val());
            porciento = desc / 100;
            alert(porciento);
		}
	);
     $(".importe").each(
		function(index, value) {
			total =eval($(this).val());
            res1=total * porciento;
            res2=total-res1;
           alert(res2);
		}
	);
    $("#ttotal").val(res2);
    total=parseFloat((res2)-cuenta);
    total=total.toFixed(1)
    $("#resta").val(total);
}
 
</script>
</body>
</html>
<?php

  }
  else
  {
    header("location: ../index.html");
  }
 ?>
