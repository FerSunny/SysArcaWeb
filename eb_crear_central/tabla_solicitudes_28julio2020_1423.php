<?php
  session_start();
   include ("../controladores/conex.php");
  $sucursal = $_SESSION['fk_id_sucursal'];
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Solicitudes</title>
  <link rel="icon" type="image/png" href="../imagenes/ico/sol.png" />
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
  .table_pago
  {
    background-color:#58ACFA;
  }
  .btn_pago
  {
    height: 50px;
    width: 200px;
    font-size: 1.5em;
  }
  .title_table{
        background-color: #58ACFA;
    }
    .form-control{
      margin-bottom:15px;
    }
    .btn-productos{
      margin-top:18px;
      margin-right:195px;
    }
    .buscar{
      margin-top:24px;
      margin-right:15px;
    }itle_table{
        background-color: #58ACFA;
    }
</style>
<body background="../imagenes/logo_arca_sys_web.jpg">
  <?php
      include("../includes/barra.php");
    ?>

    <div class="" style="margin-top: 20px">
        <h2 style="text-align: center;">Solicitudes</h2>
    </div>

  <div>
    <input type="text" class="" style="float: right; padding-right: 50px;" placeholder="Buscar">

    <button type="button" style="float: right; padding-right: 50px;" class="btn-productos btn btn-primary pull-right menu" data-toggle="modal" data-target="#modal_productos">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
              &nbsp;Agregar Productos
        </button> 
        
        <label for="">Proveedor</label>
     <select class="form-control form-control-sm" name="proveedor" id="proveedor"  style="width:300px" required>
                  <option value="0" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_proveedor'].">
                                ".$res['razon_social']."
                                </option>";
                        }
                    ?>
                </select>
      
  </div>
  <div class="table-responsive">
  <!-- REVISAR -->
    <table id="dt_sol" class="table" cellspacing="1" width="100%">
      <thead class="title_table">
        <tr>
          <!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
          <th>ID Proveedor</th>
          <th>ID Producto</th>
          <th>Código</th>
          <th>Producto</th>
          <th>Proveedor habitual</th>
          <th>Cantidad</th>
          <th>Costo</th>
          <th>Importe</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th style="display: none"></th>
          <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="table_pago">Importe Total</th>
            <th class="table_pago"><input type="text" name="btn_importe" id="btn_importe" value="0.00" readonly></th>
            <th class="table_pago"></th>
        </tr>
        <tr>
          <th style="display: none"></th>
          <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="table_pago"></th>
            <th colspan="2" class="table_pago"><button type="button" class="btn btn-success btn_pago" onclick="guardar()">Generar</button></th>
          
        </tr>
        <tr>
          <th style="display: none"></th>
          <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="table_pago" style="text-align: center; font-size: 2em;">Folio:</th>
            <th colspan="2" class="table_pago"><input type="text" class="form-control mb-2" style="width: 150px; height: auto; color: red; font-size: 2em;" id="folio" readonly></th>
          
        </tr>
      </tfoot>
    </table>
  </div>

  <?php 
    include './forms/forms.php';
   ?>
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


  <script language="javascript" src="./js/tb_solicitudes.js"></script> <!-- CAMBIO este JS -->
</body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
