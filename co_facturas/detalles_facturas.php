<?php
  session_start();

	include 'ajax/querys.php';
	$ejecutar = new Query();

  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')

  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Productos</title> <!-- CAMBIO  Titulo de la forma -->
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

</head>
<style>
	option:hover{
        background-color:red !important;
        -webkit-box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
		-moz-box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
		box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
    }
</style>
<body background="../imagenes/logo_arca_sys_web.jpg">

  	<div class="container" style="margin-top: 30px;">
      	<h1 style="text-align: center;">Detalles por Facturas</h1>
      	<h3>Grupo:
      		<?php
      			if($_GET['grupo'] == 'A'){echo "Ayde";}else
      			if($_GET['grupo'] == 'T'){echo "Tomasa";}else{echo "No existe";} ?></h3>
  	</div>
  	<input type="hidden" id="tipo" value="<?php echo $_GET['tipo']; ?>">
  	<input type="hidden" id="tp" value="<?php echo $_GET['tp']; ?>">
  	<input type="hidden" id="fi" value="<?php echo $_GET['fi']; ?>">
  	<input type="hidden" id="ff" value="<?php echo $_GET['ff']; ?>">
  	<input type="hidden" id="grupo" value="<?php echo $_GET['grupo']; ?>">
	<div class="container table-responsive">
		<table id="dt_detalles_ingresos" class="table table-bordered table-hover" cellspacing="1" width="100%">
			<thead>
				<tr>
					<!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
					<th>Folio</th>
					<th>Sucursal</th>
    				<th>Fecha de registro</th>
    				<th>Fecha de entrega</th>
    				<th>Total</th>
    				<th>A cuenta</th>
    				<th>Resta</th>
				</tr>
			</thead>
		</table>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../media/alert/dist/sweetalert2.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>

    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

	<script>

		console.log("Inicio pagina")
		listar()


	function listar()
	 {
	 	var tipo = $("#tipo").val()
	 	var tp = $("#tp").val()
	 	var fi = $("#fi").val()
	 	var ff = $("#ff").val()
	 	var grupo = $("#grupo").val()

	 	console.log("Cargando tabla")
	  table = $('#dt_detalles_ingresos').dataTable(
	        {
	            "aProcessing" : true, //Activamos el procesamiento de datatables
	            "aServerSide" : true, //Paginacion y filtrado realizados por el servidor
	            dom: 'Bfrtip', //Definimos los elementos del control tabla
	            "ajax":
	                  {
	                    url : 'listar.php?tipo='+tipo+'&tp='+tp+'&fi='+fi+'&ff='+ff+'&grupo='+grupo,
	                    type : "GET",
	                    dataType : "json",
	                    error: function(e)
	                    {

	                    }
	                  },
	             "aoColumns": [
					{ mData: 'id_factura'},
					{ mData: 'desc_sucursal'},
					{
						render:function(data,type,row)
						{
							return row['f_factura']+' a las '+row['t_factura']
						}
					},
					{
						render:function(data,type,row)
						{
							return row['f_entrega']+' a las '+row['t_entrega']
						}
					},
					{ mData: 'imp_total'},
					{ mData: 'a_cuenta'},
					{ mData: 'resta'}
				],
	            "bDestroy" : true,
	            "iDisplayLength":10, //Paginacion
	            "order": [[0, "desc"]] //Ordernar (columna, orden)
	        }
	    ).DataTable();
	  	//view("#dt_contador tbody", table)
	}
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
