<?php
session_start();
include ("../controladores/conex.php");
$id_usuario = $_SESSION['id_usuario'];
$query = "
SELECT 
CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) AS usuario,
se.`desc_servicio`
FROM 
se_usuarios us
LEFT OUTER JOIN cr_firmas fi ON (fi.fk_id_usuario = us.id_usuario)
LEFT OUTER JOIN km_servicios se ON (se.`id_servicio` = us.`fk_id_servicio`)
WHERE us.`id_usuario` = $id_usuario
";
// echo $query;
$result = $conexion -> query($query);
$row = mysqli_fetch_array($result);

$nombre_usuario = $row['usuario'];
$nombre_area = $row['desc_servicio'];
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Check-in area</title>
    <link rel="stylesheet" href="../media/css/bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/estilos.css">
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="../media/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</link>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
    <?php
  include("../includes/barra.php");
  //include("formularios/formularios_estudios.php");
  ?>

  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Menu princial de CHECK_IN por area
        <!--
          <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Estudio </button>
        -->
      </h1>

      <p class="lead"></p>
    <div class="row detalle_sesion" style="text-align: center;">
      <div class="col-md-6">
        <div class="form-group">
          <label class="font-weight-bold lead">Area:</label>
          <label class="font-weight-normal lead"><?php echo $nombre_area?></label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="font-weight-bold lead">En turno:</label>
          <label class="font-weight-normal lead"><?php echo $nombre_usuario?></label>
        </div>
      </div>
    </div>


  </div>
        <div class="row">
            <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
                <div class="col-sm-offset-2 col-sm-8">
                    <h3 class="text-center"> <small class="mensaje"></small></h3>
                </div>
                <div class="table-responsive col-sm-12">
                    <table id="dt_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Clave area</th> 
                                <th>Nombre del area</th>           
                                <th>OT</th>
                                <th>estudios</th>
                                <th>Muestras</th>
                                <th>Check-in</th>
                            </tr>
                        </thead>
        <tbody>
        </tbody>
                            <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Clave area</th> 
                                <th>Nombre del area</th>           
                                <th>OT</th>
                                <th>estudios</th>
                                <th>Muestras</th>
                                <th>Check-in</th>
                            </tr>
                            </tfoot>
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
    <script language="javascript" src="js/tablamenu.js"></script>
    <script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
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
