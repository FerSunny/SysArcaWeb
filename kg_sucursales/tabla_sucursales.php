<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Sucursales</title> <!-- CAMBIO  Titulo de la forma -->
  <link rel="icon" type="image/png" href="../imagenes/ico/capital.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
<body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
  include("../includes/barra.php");
  include("formularios/formularios_sucursales.php"); // CAMBIO programa de la forma
  ?>

  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Tabla de Sucursales <!-- CAMBIO Se cambia el titulo de la tabla -->
          <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nueva Sucursal</button> <!-- CAMBIO Se ca,bia el boton de altas -->
      </h1>
  </div>
		<div class="row">
			<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
				<div class="col-sm-offset-2 col-sm-8">
					<h3 class="text-center"> <small class="mensaje"></small></h3>
				</div>
				<div class="table-responsive col-sm-12">
				<!-- REVISAR -->
					<table id="dt_sucursales" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
								<!--<th>Empresa</th>-->
								<th>ID </th>
								<th>Descripción Sucursal</th>
								<th>Usuario</th>
								<th>Teléfono</th>
								<th>Teléfono2</th>
								<th>Celular</th>
								<th>Horario Hábil Apertura</th>
								<th>Horario Hábil Cierre</th>
								<th>Horario Sábado Apertura</th>
								<th>Horario Sábado Cierre</th>
								<th>Horario Domingo Apertura</th>
								<th>Horario Domingo Cierre</th>

                <th>Dom</th>
                <th>Lun</th>
                <th>Mar</th>
                <th>Miér</th>
                <th>Jue</th>
                <th>Vier</th>
                <th>Sáb</th>
								<!-- <th>Horario Festivo Apertura</th>-->
								<!-- <th>Horario Festivo Cierre</th>-->
								<th>Descuento</th>
								<th>Skype</th>
								<th>Mail</th>
								<th>País</th>
								<th>Estado</th>
								<th>Municipio</th>
								<th>Localidad</th>
								<th>CP</th>
								<!-- --><th>Colonia</th>
								<th>Calle</th>
								<th>Número</th>
								<th>Estado</th>
								<th>Descripción</th>
                <th>Grupo</th>
				<th>Zonas</th>
								<!-- <th>Días laborales</th>-->
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
  <!-- JQuery -->

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
    
    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <script src="../media/js/bootstrap-select.js" type="text/javascript"></script>

	<script language="javascript" src="js/tabla_sucursales.js"></script> <!-- CAMBIO este JS -->
	<script>
	$(document).ready(function(){
	    $("#myBtn").click(function(){
	        $("#myModal").modal();
	    });
	});

	// tomar el evento de municipios
    $("#frm_add select[name=fn_est]").change(function()
    {
        select = $('#frm_add select[name=fn_est]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_estado" : select
        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=1",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#frm_add #fi_municipio").html(data);
              $('.selectpicker').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });

// tomar el evento de localidades
    $("#frm_add select[name=fn_municipio]").change(function()
    {
        select1 = $('#frm_add select[name=fn_municipio]').val();
        select2 = $('#frm_add select[name=fn_est]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_municipio" : select1,"id_estado" : select2

        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=2",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#frm_add #fi_localidad").html(data);
              $('.selectpicker').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });

    // tomar el evento de consultorio
    $("#frm_edit select[name=fn_est]").change(function()
    {
        select = $('#frm_edit select[name=fn_est]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_estado" : select
        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=1",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#frm_edit #fi_municipio").html(data);
              $('.selectpicker').selectpicker('refresh');
              //$("#res").load(" #resultado");
              console.log(data)
            }
        });
    });


    // tomar el evento de localidades
    $("#frm_edit select[name=fn_municipio]").change(function()
    {
        select1 = $('#frm_edit select[name=fn_municipio]').val();
        select2 = $('#frm_edit select[name=fn_est]').val();
        //alert(select)
        //Si form es 1 viene del form para agregar
        var parametros = 
        {
          "id_municipio" : select1,"id_estado" : select2

        }
        $.ajax({
          type: "POST",                 
          url: "../select/select_estado.php?val=2",
          data:parametros ,
          beforeSend: function(){
          },
          success: function(data)            
            {
              $("#frm_edit #fi_localidad").html(data);
              $('.selectpicker').selectpicker('refresh');
              //$("#res").load(" #resultado");
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
