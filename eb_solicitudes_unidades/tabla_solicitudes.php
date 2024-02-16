<?php
include("../controladores/conex.php");

    session_start();
    $sucursal =$_SESSION['fk_id_sucursal'];

  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Listar Solcitudes</title>
	<link rel="icon" type="image/png" href="../imagenes/ico/orden.png" />
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
	.mensaje_bien, .mensaje_error
	{
		display: none;
		
	}
</style>
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
  include("../includes/barra.php");
  include("forms/modal_productos.php");
  include("forms/forms.php"); 
  ?>

  	<div class="" style="margin-top: 20px; text-align: center;">
      	<h2>Lista de Solicitudes 
      	</h2>
  	</div>

	<div class="container table-responsive">
        <table id="dt_lista" class="table">
            <thead>
				<tr>
					<th>Folio</th>
					<th>Unidad</th>
					<th>Nombre</th>
					<th>Estatus</th>
					<th>Fecha</th>
					<th>Acciones</th>
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

	<script language="javascript" src="js/tb_solicitudes2.js"></script>
</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
