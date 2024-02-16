<?php
session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
    include ("../controladores/conex.php");
	$studio=$_GET['studio'];
    $plantilla=$_GET['plantilla'];
    
	$_SESSION['studio']=$studio;
    $_SESSION['plantilla']=$plantilla;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Precios</title>
    <link rel="stylesheet" href="../media/css/bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/estilos.css">
    <!-- Buttons DataTables -->
    <link rel="stylesheet" href="../media/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../media/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
    <?php
  include("../includes/barra.php");
  //include("formularios/formularios_estudios.php");
  ?>

  <div class="col-sm-12 col-md-12 col-lg-12">
      <h1>Conceptos que integran al estudio: <br>
      <?php 
							$desc_estudio='';
							$sql="select desc_estudio FROM km_estudios where id_estudio=".$studio;
 							if ($result = mysqli_query($conexion, $sql)) {
								while($row = $result->fetch_assoc())
								{
								    $desc_estudio=$row['desc_estudio'];
								}
								}
							echo  '<b>('.$studio.') '.$desc_estudio
						?>
        <!--
          <button type="button" class="btn btn-primary pull-right menu" data-toggle="modal" data-target="#myModals"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo Estudio </button>
        -->
      </h1>
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
                                <th>Concepto</th> 
                                <th>Valor Referencia</th>           
                                <th>Unidad de medida</th>
                            </tr>
                        </thead>
        <tbody>
        </tbody>
                            <tfoot>
                            <tr>
                                <th>Concepto</th> 
                                <th>Valor Referencia</th>           
                                <th>Unidad de medida</th>
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
    <script language="javascript" src="js/tabla_concepto.js"></script>
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
