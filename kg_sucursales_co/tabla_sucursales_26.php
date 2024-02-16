<?php
	session_start();
	if(isset($_SESSION['nombre']) && $_SESSION['ingreso']== 'YES')
	{
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Sucursales</title>
	
	<link rel="icon" type="image/png" href="../imagenes/ico/capital.png" />

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">




</head>



<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
	include("../includes/barra.php");
	//include("formularios/formulario_sucursales.php");
	?>

	<div class="col-sm-12 col-md-12 col-lg-12">
		<h1>Tabla de Sucursales

			<button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nueva Sucursal</button>
		</h1>
	</div>

	   <div class="row">
	   		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
	   			<div class="col-sm-offset-2 col-sm-8">
	   				<h3 class="text-center"> <small class="mensaje"></small></h3>
	   			</div>
	   			<div class="table-responsive col-sm-12">
	   				<table id="dt_sucursales" class="table table-bordered table-hover" cellspacing="0" width="100%">
	   					<thead>
	   						<tr>
	
		   						<th>Id</th>
		   						<th>Descripcion sucursal</th>
		   						<th>Usuario</th>
		   						<th>Telefono</th>
		   						<th>Telefono 2</th>
		   						<th>Celular</th>
		   						<th>Horario habil Apertura</th>
		   						<th>Horario habil Cierre</th>
		   						<th>Horario Sabado Apertura</th>
		   						<th>Horario Sabado Cierre</th>
		   						<th>Horario Domingo Apertura</th>
		   						<th>Horario Domingo Cierre</th>
		   						<th>Horario festivo Apertura</th>
		   						<th>Horario festivo Cierre</th>
		   						<th>Descuento</th>
		   						<th>Skype</th>
		   						<th>Mail</th>
		   						<th>Estado</th>
		   						<th>Municipio</th>
		   						<th>Localidad</th>
		   						<th>CP</th>
		   						<th>Colonia</th>
		   						<th>Calle</th>
		   						<th>Numero</th>
		   						<th>Estado</th>
		   						<th>Descripcion</th>
		   						<th>Dias Laboral</th>
		   						<th>Editar</th>
		   						<th>Eliminar</th>
	   						</tr>
	   					</thead>
	   				</table>
	   			</div>
	   		</div>
		</div>

	<script src="../media/js/jquery-1.12.3.js"></script>
	<script src="../media/alert/dist/sweetalert2.js"></script>	

	<script type="tex/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

	<script type="tex/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

	<script language="javascript" src="js/tabla_sucursales.js"></script>
	<script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
			});
		});


		$("select[name=fn_est]").change(function()
		{
			select = $('select[name=fn_est]').val();
			var parametros=
			{
				"id_estado" : select
			}

			$.ajax({
				type: "POST",
				url: "../../select/select_estado.php?val=1",
				data:parametros,
				beforeSend: function(){
				},
				succes: function(data)
					{
						$("#fi_municipio").html(data);
						$('select').selectpicker('refresh');
						console.log(data)
					}
				});
			});

		$("select[name=fn_municipio]").change(function()
		{
			select1 = $('select[name=fn_municipio]').val();
			select2 = $('select[name=fn_est]').val();

			var parametros = 
			{
				"id_municipio" : select1, "id_estado" : select2
			}
			$.ajax({
				type: "POST",
				url: "../../select/select_estado.php?val=2",
				data:parametros,
				beforeSend: function(){
				},
				succes: function(data)
					{
						$("#fi_localidad").html(data);
						$('select').selectpiker('refresh');
						console.log(data)
					}
			});
		});

		$("#frmedit select[name=fn_est]").change(function()
			{
				select = $('#frmedit select[name=fn_est]').val();
				var parametros = 
				{
					"id_estado": select
				}
				$.ajax({
					type: "POST",
					url: "../../select/select_estado.php?val=1",
					data:parametros,
					beforeSend: function(){
					},
					succes: function(data)
					{
						$("frmedit #fi_municipio").html(data);
						$('select').selectpicker('refresh');
						console.log(data)
					}
				});
			});

		$("#frmedit select[name=fn_municipio]").change(function()
		{
			select1 = $('#frmedit select[name=fn_municipio]').val();
			select2 = $('#frmedit select[name=fn_est]').val();

			var parametros = 
			{
				"id_municipio" : select1, "id_estado" : select2
			}
			$.ajax({
				type: "POST",
				url: "../../select/select_estado?val=2",
				data: parametros,
				beforeSend: function(){
				},
				succes: function(data)
					{
						$("frmedit #fi_localidad").html(data);
						$('select').selectpicker('refresh');
						console.log(data)
					}
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