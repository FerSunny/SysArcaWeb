<?php
session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista de Notas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap 4.1 14/03/2019-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- DataTable 1.10.19 14/03/2019-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

        <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
        <!-- FontAwesome 5 14/03/2019-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
    <?php
  include("../includes/barra.php");
  //include("formularios/formularios_estudios.php");
  ?>

    <div class="">
        <h1>Lista de Notas</h1>
    </div>

    <div class="col-sm-offset-2 col-sm-8">
        <h3 class="text-center"> <small class="mensaje"></small></h3>
    </div>
    <div class="table-responsive">
        <table id="dt_cliente" class="compact cell-border hover table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Sucursal</th> 
                    <th>Id</th>
                    <th>Solicitada</th>
                    <th>Cliente</th>
                    <th>Edad</th>
                    <th>Estudio</th>
                    <th>Medico</th>
                    <th>Comision</th>
                    <th>Importe</th>
                    <th>Tipo Pago</th>
                    <th>Observaciones</th>
                    <th>Validado</th>
                    <th>PDF (Resultado)</th>
                    <th>Nota (OT)</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Sucursal</th>
                    <th>Id</th>
                    <th>Solicitada</th>
                    <th>Cliente</th>
                    <th>Edad</th>
                    <th>Estudio</th>
                    <th>Medico</th>
                    <th>Comision</th>
                    <th>Importe</th>
                    <th>Tipo Pago</th>
                    <th>Observaciones</th>
                    <th>Validado</th>
                    <th>PDF</th>
                    <th>Nota</th>
                </tr>
            </tfoot>
        </table>
    </div>


    <script src="../media/js/jquery-1.12.3.js"></script>
    <script src="../media/alert/dist/sweetalert2.js"></script>

    <!-- Bootstrap 4.1 14/03/2019-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script language="javascript" src="js/lenguajeusuario.js"></script>
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
