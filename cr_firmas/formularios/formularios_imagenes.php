<?php 
  //session_start();
  include("../controladores/conex.php");
  $numero_factura= $_SESSION['numero_factura'];
  $studio= $_SESSION['studio'];

  $nombre='0';

  $sql="SELECT  ui.id_imagen,ui.nombre FROM cr_plantilla_esp_img ui
        WHERE ui.fk_id_factura = ".$numero_factura."
        AND ui.fk_id_estudio =".$studio;
//echo $sql;

  if ($result = mysqli_query($conexion, $sql)) {
    while($row = $result->fetch_assoc())
    {
        $nombre=$row['nombre'];
    }
  }

  $imagen='img_usg/'.$numero_factura.'/'.$nombre;

?>
<link rel="stylesheet" href="../css/estilos.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">


      <!-- Modal content-->
   <form name="AltasEstudio" action="controladores/registro_imagenes.php" method="post" enctype="multipart/form-data" id="fileForms" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nueva Firma</h2>
    <!--      <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5> -->
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
      
             <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">
                      <td><label>Seleccione:</label></td>
                      <td><input type="file" class="form-control" id="fn_archivo" required name="fn_archivo[]" multiple ></td>
                    </div>
                  </div>
            </tr>
            <br>
              <tr>
                <td class="renglon_titulo">Servicio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="servicio" >
                    <?php
                      $sql="SELECT se.`id_servicio`, se.`desc_servicio` FROM km_servicios se
                            WHERE se.`estado` = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_servicio']."' >";
                          echo $row['desc_servicio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
              <br>

              <tr>
                <td class="renglon_titulo">Area: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="area" >
                    <?php
                      $sql="SELECT se.`id_area`, se.`desc_area` FROM km_areas se
                            WHERE se.`estado` = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_area']."' >";
                          echo $row['desc_area'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td class="renglon_titulo">usuario </td>
                <td class="renglon_valor" class="form-control">
                  <select name="usuario" >
                    <?php
                      $sql="SELECT us.id_usuario, CONCAT(us.nombre,' ',us.`a_paterno`,' ',us.`a_materno`) AS nombre FROM se_usuarios us
                        WHERE us.`activo` = 'A'
                        AND us.`fk_id_servicio` NOT IN (1,9,13,14,15)";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>



            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Alto</label></td>
              <td>  <div class="form-group">

                  <input type="number" name="alto" id="alto" maxlength="2" size="3"/>
                </div></td>
            </tr>

            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Ancho</label></td>
              <td>  <div class="form-group">

                  <input type="number" name="ancho" id="ancho" maxlength="2" size="3"/>
                </div></td>
            </tr>

           </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
        </form>
      </div>

    </div>
  </div>
<!--</div> -->

<!--Editar imagenes-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Ver Firma</h4>
            </div>
            <div class="modal-body">

              <input type="hidden" id="idimagen" name="idimagen" value="0">
              <input type="hidden" id="opcion" name="opcion" value="modificar">
<!-- Nota -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">usuario</label>
                <div class="col-sm-8">
                  <input id="edit1" name="edit1" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>

<!-- Esudio -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Firma</label>
                <div class="col-sm-8">
                  <input id="fi_desc_estudio" name="fn_desc_estudio" maxkength="50"  type="text" class="form-control" readonly="readonly">
                 </div>
              </div>

<!-- nomb imagen -->              
              <div class="form-group">
                <label for="nombre_img" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-8">
                  <input id="fi_nombre" name="fn_nombre" maxkength="50" required="no entry" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>
<!-- Imagen -->  
              <div class="form-group">
                <!--
                  <label for="descripcion" class="col-sm-2 control-label">Estudio</label>
                -->
                <div class="col-sm-8">

    

                  
                  <img src="" id="fi_imagen" alt="" width="500" >

                  <!--
                  <input id="fi_desc_estudio" name="fn_desc_estudio" maxkength="50" required type="text" class="form-control" >
                -->
                 </div>
              </div>


              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8"></div>
              </div>

              <div class="modal-footer">
                <!--
                  <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Eliminar-->
<form id="frmEliminarzona" action="controladores/eliminar_imagenes.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Imagenes</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar la imagen?<strong data-name=""></strong>
                    <input type="hidden" id="idimagen" name="idimagen" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="zona" name="zona" type="text" class="form-control" maxlength="8" >
                      </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
           
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
