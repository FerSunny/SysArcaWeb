<?php
session_start();
date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
    /*-------------------------
    Autor: Obed Alvarado
    Web: obedalvarado.pw
    Mail: info@obedalvarado.pw
    ---------------------------*/
    $active_facturas="active";
    $active_productos="";
    $active_clientes="";
    $active_usuarios="";
    $title="Nueva Factura";

    /* Connect To Database*/
    require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

//session_start();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include("head.php");
            if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
          {
    ?>
    <style>
        .box_check .section_box
        {
            display: inline-block;
            background-color:powderblue; 
            border-radius: 20px;
        }
        .box_check .section_box:hover
        {
            background-color: #eee;
        }
    </style>
  </head>
      <body background="../imagenes/logo_arca_sys_web.jpg">
    <?php
        include("../includes/barra.php");
        include("create-cliente.php");
        include("create-factura.php");
    ?>
    
  <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4><i class='glyphicon glyphicon-edit'></i> Version 3.4.2  Nueva Factura <?php echo $_SESSION['fk_id_sucursal']?>
                </h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="form-factura" action="">
                    
                    <div class="form-group row">
                        <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
                        <!-- Cliente -->
                        <div class="col-md-3">
                                <select id="nombre_cliente" name="nombre_cliente" class="js-data-example-ajax col-md-12">
                                </select>
                        </div>

                            <!-- telefono  -->
                        <label for="tel1" class="col-md-1 control-label">Teléf Fi.</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" >
                        </div>

                        <!-- Mail (fecha nacimiento) -->
                        <label for="mail" class="col-md-1 control-label">Fecha N</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control input-sm" id="mail"  >
                        </div>

                       
                    </div>

                    <!-- Renglon 2 -->
                    <div class="form-group row">
                <!-- VENDEDEDOR -->
                        <label for="empresa" class="col-md-1 control-label">Vendedor
                        </label>
                        <div class="col-md-3">
                            <select class="form-control input-sm" id="id_vendedor">
                                <option disabled selected value> -- selecciona una opción -- </option>
                                    <?php
                                        $sql_vendedor=mysqli_query($con,"select * from se_usuarios WHERE activo = 'A' and fk_id_sucursal = ".$fk_id_sucursal." UNION
SELECT * FROM se_usuarios WHERE activo = 'A' AND id_usuario = 19");
                                        while ($rw=mysqli_fetch_array($sql_vendedor)){
                                            $id_vendedor=$rw["id_usuario"];
                                            $nombre_vendedor=$rw["nombre"]." ".$rw["a_paterno"];
                                            if ($id_vendedor==$_SESSION['id_usuario']){
                                                $selected="selected";
                                            } else {
                                                $selected="";
                                            }
                                        ?>
                                <option value="<?php echo $id_vendedor?>"
                                    <?php echo $selected;?>><?php echo $nombre_vendedor?>
                                    
                                </option>
                                    <?php
                                        }
                                    ?>
                            </select>
                        </div>
                        <!-- FECHA -->
                        <label for="tel2" class="col-md-1 control-label">Fecha</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
                        </div>
                        <!-- fecha de entrega -->
                        <label  class="control-label pull-left">Fecha de entrega</label>
                        <div class="col-md-2">
                            <input type="datetime-local" name="fechaentrega" class="form-control " id="fechaentrega" style="width:145%;">
                        </div>
                    </div>
                    <!-- Renglon 3 -->
                    
                    <div class="form-group row">
                        <!-- MEDICO -->
                        
                        <label for="f_medico" class="col-md-1 control-label">Medico</label>


                    <div class="col-md-3">
                                <select id="fi_medico" name="fi_medico" class="js-data-example-ajax-m col-md-12">
                                </select>
                    </div>


                        <!-- AFECTA COMISION -->
                        <label class="col-md-1 control-label">Comision</label>
                        <div class="col-md-2">
                            <select class='form-control ' id="fi_comision" name="fi_comision">
                            <!-- <option disabled selected value> -- selecciona una opción -- </option> -->
                                <option value="0">No</option>
                                <option value="1">Si</option>
                                
                            </select>
                        </div>
                        <!-- Pago -->
                        <label for="condiciones" class="col-md-1 control-label ">Pago</label>
                        <div class="col-md-3 ">
                            <select class='form-control input-sm  col-md-pull-1' id="condiciones">
                               <!--  <option disabled selected value> -- selecciona una opción -- </option>  -->
                                <?php
                                    $sql="SELECT * FROM kg_tipo_pago where estado = 'A' ORDER BY id_tipo_pago ";
                                    $rec=mysqli_query($con,$sql);
                                        while ($row=mysqli_fetch_array($rec))
                                            {
                                                echo "<option value='".$row['id_tipo_pago']."' >";
                                                echo $row['desc_tipo_pago'];
                                                echo "</option>";
                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- Botones  -->
                    <div class="form-group row">
                        <label  class="col-md-1 control-label">Medico O</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control col-md-1" id="medico_aux" name="medico_aux" placeholder="Doctor ocasional" >
                        </div>

                        <label  class="col-md-1 control-label">Diagnostico</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control col-md-1" id="diagnostico" name="diagnostico"  required>
                        </div>

                        <!-- mail  -->
                        <label for="correo" class="col-md-1 control-label">Mail</label>
                        <div class="col-md-2">
                            <input type="mail" class="form-control input-sm" id="correo" placeholder="Mail" >
                        </div>

                        <div class="col-md-3">
                          <input type="hidden" class="form-control col-md-1" id="idfacturacion" name="idfacturacion"  required>
                        </div>
                    </div>

                    <div class="form-group row box_check">
                        <div class="col-md-7 section_box" style="">
                            <div style="display: inline-block; margin-right: 30px;">
                                <label for="" >Email Medico</label>
                                <input type="checkbox" class="custom-control-input" name="box_medico" id="box_medico" value="1">
                            </div>
                            <div style="display: inline-block; margin-right: 30px;">
                                <label for="">Email Paciente</label>
                                <input type="checkbox" name="box_paciente" id="box_paciente" value="1">
                            </div>
                            <div style="display: inline-block;">
                                <label for="">Requiere Factura</label>
                                <input type="checkbox" name="req_factura" id="req_factura" value="1">
                            </div>
                            <div style="display: inline-block;">
                                <label for="">Desea Publicidad</label>
                                <input type="checkbox" name="acepta_p" id="acepta_p" value="1">
                            </div>
                            <div style="display: inline-block;">
                                <label for="">Urgente</label>
                                <input type="checkbox" name="urgente_p" id="urgente_p" value="1">
                            </div>
                            <div style="display: inline-block;">
                                <label for="">Pendiente</label>
                                <input type="checkbox" name="pendiente_p" id="pendiente_p" value="1">
                            </div>

                            <div style="display: inline-block;">
                                <label for="">Whatsapp</label>
                                <input type="checkbox" name="whatsapp_p" id="whatsapp_p" value="1">
                            </div>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div>
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                          <span class="glyphicon glyphicon-search"></span> Agregar Estudios
                      </button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalClientes">
                                    <span class="glyphicon glyphicon-plus"></span> Agregar Clientes
                                </button>          
                            </div>
                        </div>
                    </div>

<!-- lina de direccion de cliente -->
                    <div class="form-group row">
                        <label  class="col-md-1 control-label">Colonia</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control col-md-1" id="colonia" name="Colonia" placeholder="Colonia" >
                        </div>

                        <label  class="col-md-1 control-label">CP</label>
                        <div class="col-md-1">
                          <input type="text" class="form-control col-md-1" id="cp" name="cp"  placeholder="CP">
                        </div>

                        <!-- mail  -->
                        <label for="correo" class="col-md-1 control-label">Calle</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control input-sm" id="calle" placeholder="Calle" >
                        </div>

                        <!-- mail  -->
                        <label for="correo" class="col-md-1 control-label">Numero</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control input-sm" id="numero_exterior" placeholder="Numero_exterior" >
                        </div>
                    </div>

<!-- lina de tel celular -->
                    <div class="form-group row">
                        <label  class="col-md-1 control-label">Telef. Ce.</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control col-md-1" id="celular" name="celular" placeholder="T. Celular" >
                        </div>

                        <label  class="col-md-1 control-label">Turno</label>
                        <div class="col-md-1">
                            <input type="number" class="form-control col-md-1" id="numturno" name="numturno" placeholder="No. Turno" >
                        </div>

                        <label for="conocio" class="col-md-1 control-label ">Conoce?</label>
                        <div class="col-md-3 ">
                            <select class='form-control input-sm  col-md-pull-1' id="conocio">
                               <!--  <option disabled selected value> -- selecciona una opción -- </option>  -->
                                <?php
                                    $sql="SELECT * FROM so_conocio where estado = 'A' ORDER BY id_conocio ";
                                    $rec=mysqli_query($con,$sql);
                                        while ($row=mysqli_fetch_array($rec))
                                            {
                                                echo "<option value='".$row['id_conocio']."' >";
                                                echo $row['desc_conocio'];
                                                echo "</option>";
                                            }
                                ?>
                            </select>
                        </div>
<!-- se incluyen estos campos para control de notas, por la acreditacion 
                        <div style="display: inline-block;">
                            <label for="">Urgente?</label>
                            <input type="checkbox" name="urgente_p" id="urgente_p" value="1">
                        </div>

                        <div style="display: inline-block;">
                            <label for="">Muestra Pendiente?</label>
                            <input type="checkbox" name="pendiente_p" id="pendiente_p" value="1">
                        </div>
-->


                    </div>


                </form>
                <div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
                <table id="data_facturacion" class="table table-bordered table-hover datatable-generated" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>Código</th>
              <th>Cant</th>
              <th>Descripción</th>
              <th>Precio</th>
                            <th >Operación</th>
            </tr>
            </thead>
                </table>
                <div class="container">
            <div class="row">
                    <div class="col-md-4" well tal>
                        <textarea id="observaciones" name="textarea" rows="8" cols="50" placeholder="Observaciones" style = "resize:none"></textarea>
                        <label  class="control-label">Estado de la factura</label>
                        <select class='form-control input-sm' id="estadoFactura">
                            <option value="2">Terminada</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label class="col-md-6">Subtotal:</label>
                            </div>
                            <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3 col-centered">
                                    <label  id="subtotal" >0</label>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>% Descuento:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="descuento" class="col-centered">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 col-centered">
                                <label  id="subtotalDescuento">0</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>% Incremento:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="incremento" class="col-centered">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 col-centered">
                                <label  id="subtotalIncremento">0</label>
                            </div>
                      </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label class="col-md-6">Total:</label>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 col-centered">
                                <label  id="total" >0</label>
                            </div>
                      </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label class="col-md-6">a/cuenta:</label>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 col-centered">
                                <input type="number" id="acuenta" class="col-centered">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label class="col-md-6">Saldo:</label>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 col-centered">
                                <label  id="saldo" >0</label>
                            </div>
                        </div>
                        <div class="offset-md-3 col-md-9">
                            <button type="button" class="btn btn-default" id="recalculate">
                             <span class="fa fa-calculator" aria-hidden="true"></span> Recalcular
                            </button>
                      </div>
                    </div>
                </div>
            </div>
            <button id="btnSaveBill" type="button" class="btn btn-success btn-lg pull-right" id="recalculate">
                 <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar Factura
            </button>
            <div class="row-fluid">
                <div class="col-md-12">
                </div>
            </div>
            </div>
        </div> 
    </div><!--  fin del metodo container -->
    <hr>

    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
                </div>
                <div class="modal-body">
                    <table id="data_productos" class="table table-bordered table-hover datatable-generated" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>Precio</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">             Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("footer.php");
    ?>

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="js/nueva_factura.js"></script>
    <script>
        /*$("#box_medico").click(function () {
        var p1 = parseInt($('input:checkbox[name=box_medico]:checked').val())    
        alert(p1 + 1);
        //$("#formulario").submit();
    });*/
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
