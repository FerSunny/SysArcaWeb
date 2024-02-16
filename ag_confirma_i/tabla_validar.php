<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    
	<title>Validar Resultados</title> <!-- CAMBIO  Titulo de la forma -->
	<!-- Bootstrap 4.1 14/03/2019-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- DataTable 1.10.19 14/03/2019-->
 	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.css"/>
 	
	<!-- FontAwesome 5 14/03/2019-->
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
  include("../includes/barra.php"); // CAMBIO programa de la forma
  ?>

		<div class="container table-responsive">
		<!-- REVISAR -->
			<table id="dt_resultados" class="table-striped cell-border compact stripe" style="width:100%">
				<thead class="row-border">
					<tr>
						<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
						<th>ID Estudio</th>
						<th>id_factura</th>
						<th>Sucursal</th>
						<th>nombre</th>
						<th>desc_estudio</th>
						<th>Fecha</th>
						<th>PDF</th>
						<th>Validar</th>
						<th>Modificar</th>
					</tr>
				</thead>
			</table>
		</div>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="../media/js/jquery-1.12.3.js"></script>

	<!-- Bootstrap 4.1 14/03/2019-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<!-- DataTable 1.10.19 14/03/2019-->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>


	<script language="javascript" src="js/tb_validar.js"></script> <!-- CAMBIO este JS -->
</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
