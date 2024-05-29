<?php
    session_start();
    date_default_timezone_set('America/Mexico_City');
    $active_facturas="active";
    $active_productos="";
    $active_clientes="";
    $active_usuarios="";
    $title="Facturas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>

  </head>
  <body background="../imagenes/logo_arca_sys_web.jpg">
    <?php
    include("../includes/barra.php");
    ?>
    <div class="container">
            <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="btn-group pull-right">
                            <a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a>
                        </div>
                        <h4><i class='glyphicon glyphicon-search'></i> Buscar Facturas</h4>
                    </div>
                    <div class="panel-body">
                        <!-- <div id="resultados"></div> -->
                        <div class='outer_div'></div>

                        <div class="table-responsive col-sm-12">
                            <table id="data_facturas" class="table table-bordered table-hover datatable-generated" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID factura</th>
                                        <th>Número Factura</th>
                                        <th>Fecha</th>
                                        <th>Nombre Cliente</th>
                                        <th>Diagnóstico</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Importe</th>
                                        <th>Accion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                        </div>

                    </div>
            </div>

        </div>


    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
 <script type="text/javascript" src="js/sweetalert2.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="js/facturas.js"></script>
    <!--<script type="text/javascript" src="js/nueva_factura.js"></script> -->
  </body>
</html>
