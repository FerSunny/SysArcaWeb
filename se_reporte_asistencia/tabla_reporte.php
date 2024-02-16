<?php

  include "../controladores/conex.php";
  date_default_timezone_set('America/Mexico_City');
  session_start();
  $fecha = date("Y-m-d");
  $dias = array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO');
  $numero = date("w")-1;
  switch ($numero) {
    case '0':
          $i = $fecha;
          $f= date("Y-m-d", strtotime("$fecha   6 day"));
      break;
    case '1':
          $i= date("Y-m-d", strtotime("$fecha   -1 day"));
          $f= date("Y-m-d", strtotime("$fecha   5 day"));
      break;
    case '2':
          $i= date("Y-m-d", strtotime("$fecha   -2 day"));
          $f= date("Y-m-d", strtotime("$fecha   4 day"));
      break;
    case '3':
          $i= date("Y-m-d", strtotime("$fecha   -3 day"));
          $f= date("Y-m-d", strtotime("$fecha   3 day"));
      break;
    case '4':
          $i= date("Y-m-d", strtotime("$fecha   -4 day"));
          $f= date("Y-m-d", strtotime("$fecha   2 day"));
      break;
    case '5':
          $i= date("Y-m-d", strtotime("$fecha   -5 day"));
          $f= date("Y-m-d", strtotime("$fecha   1 day"));
      break;
    case '6':
          $i= date("Y-m-d", strtotime("$fecha   -6 day"));
          $f= date("Y-m-d", strtotime("$fecha   0 day"));
      break;
    default:
      // code...
      break;
  }
  $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre' ,'Noviembre' ,'Diciembre' );

  $i_dia = date("d", strtotime($i));
  $i_mes = date("n", strtotime($i));
  $i_mes-=1;
  $i_año = date("Y", strtotime($i));
  $inicia = $i_dia." de ".$meses[$i_mes]." de ".$i_año;
  //Fina de semana
  $f_dia = date("d", strtotime($f));
  $f_mes = date("n", strtotime($f));
  $f_mes-=1;
  $f_año = date("Y", strtotime($f));
  $final = $f_dia." de ".$meses[$f_mes]." de ".$f_año;

  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Reporte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <!-- DataTable 1.10.19 14/03/2019-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    .ver_detalles:hover{
      cursor: pointer;
    }
    .detalle_asistencia{
      display: none; 
    }
  </style>
  <body background="../imagenes/logo_arca_sys_web.jpg">
  	<?php
      include("../includes/barra.php");
    	include("forms/forms.php");
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
    <input type="hidden" id="fecha_inicio" value="<?php echo $i; ?>">
    <input type="hidden" id="fecha_final" value="<?php echo $f; ?>">
    <div class="container ver_detalles" id="detalles" style="text-align:center; font-weight: 900;">
      <h1 style="font-weight: 900;">Reporte Asistencias</h1>
    </div>
    <div class="container verificar"  style="text-align:center; font-weight: 900;">
      <h3 class="" style="font-weight:800">Semana Actual: <?php echo date("W");?></h3>
      <h5 class="" style="font-weight:800">Del <?php echo $inicia; ?> al <?php echo $final; ?></h5>
      <select class="form-control form-sm" name="id_sucursal" id="id_sucursal" style="width: 30%; margin-left: auto; margin-right: auto;">
        <option value="10">Todas</option>
        <?php 

          $query = "SELECT * FROM kg_sucursales where estado = 'A'";
          $stmt = $conexion->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();

          while ($row = $result->fetch_assoc())
          {
            echo "<option value='".$row['id_sucursal']."'>".$row['desc_sucursal']."</option>";
          }

        ?>
      </select>
      <button type="button" class=" btn btn-danger btn-lg" id="reporte"><i class="fas fa-file-pdf" style="font-size: 20px;"></i>  Detalle</button>
      <button type="button" class=" btn btn-danger btn-lg" id="reporte_r"><i class="fas fa-file-pdf" style="font-size: 20px;"></i>  Resumen</button>
    </div>
		<div class="container table-responsive">
			<table id="dt_reportes" class="table table-bordered table-hover" cellspacing="1" width="100%" >
				<thead>
					<tr>
            <th>No</th>
						<th>Nombre</th>
						<th>Fecha Asistencia</th>
            <th>Horario</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Observaciones</th>
            <th>Acceso</th>
					</tr>
				</thead>
			</table>
		</div>
    <script src="../media/js/jquery-1.12.3.js"></script>
    <script src="../media/alert/dist/sweetalert2.js"></script>
  	<!-- JQuery -->
   	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  	<!-- Bootstrap tooltips -->
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  	<!-- Bootstrap core JavaScript -->
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  	<!-- MDB core JavaScript -->
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>

    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
  	<script language="javascript" src="js/tabla_reporte.js"></script>
  </body>
</html>
  <?php

    }
    else
    {
      header("location: index.html");
    }
   ?>
