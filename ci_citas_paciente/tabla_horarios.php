<?php
  include ("../controladores/conex.php");
  session_start();

  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
    $cliente=$_GET['cliente'];
    $_SESSION['cliente_ser']=$cliente;

    // **** el nombre del paciente  *** 
    $query = "
      SELECT  CONCAT(cl.`nombre`,' ',
              cl.`a_paterno`,' ',
              cl.`a_materno`) AS paciente
      FROM so_clientes cl
      WHERE cl.activo = 'A'
      AND cl.id_cliente = $cliente
    ";
    $result = $conexion -> query($query);
    $row = mysqli_fetch_array($result);
    $paciente = $row['paciente'];


?>

<!DOCTYPE html>

<html lang="es">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">

  <title>Citas</title> <!-- CAMBIO  Titulo de la forma -->

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

    <!-- Columnas heder de busqueda  -->
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
    <style>
      /*estilos para la tabla*/
      table th {
      background-color: #2E9AFE;
      color: white;   
      }
    </style>
  

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

  <?php

    //include("../includes/barra.php");

    include("formularios/formularios_productos.php"); // CAMBIO programa de la forma

  ?>



  <div class="container" style="margin-top: 30px;">

    <h2 style="text-align: center;">Agendar cita  a <?php echo $paciente; ?> <!-- CAMBIO Se cambia el titulo de la tabla -->

      <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Crear Dia</button> <!-- CAMBIO Se cambia el boton de altas -->

    </h2>

  </div>



  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->

    <div class="col-sm-offset-2 col-sm-8">

      <h3 class="text-center">

        <small class="mensaje"></small>

      </h3>

    </div>

    <div class="container table-responsive">

      <table id="dt_productos" class="table table-bordered table-hover" cellspacing="1" width="100%">

        <thead>

          <tr>

            <!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->

            <th>Id </th>
            <th>Servicio</th>
            <th>Origen</th>
            <th>Dia</th>
            <th>Hora</th>
            <th>Paciente</th>
            <th>Estudio</th>
            <th>Tiempo</th>
            <th>Estado</th>
            
            <th>Cancelar</th>
            
          </tr>

        </thead>

      </table>

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

  <script language="javascript" src="js/tabla_productos.js"></script>

  <!-- habilitanmos la busqueda en las ciolumnas  -->
  <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script> 

  <script>
    /*
  $(document).ready(function(){
      var table = $('#dt_productos').DataTable({
        orderCellsTop: true,
        fixedHeader: true 
      });

      //Creamos una fila en el head de la tabla y lo clonamos para cada columna
      $('#dt_productos thead tr').clone(true).appendTo( '#dt_productos thead' );

      $('#dt_productos thead tr:eq(1) th').each( function (i) {
          var title = $(this).text(); //es el nombre de la columna
          $(this).html( '<input type="text" placeholder="Search..." />' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      } );   
  });
*/
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

