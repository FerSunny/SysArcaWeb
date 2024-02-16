<?php include("../controladores/conex.php") ?>
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasEstudio" action="controladores/registro_ruta.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nueva Ruta</h2>
    <!--      <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5> -->
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id medico -->
  <!--            <tr>
                <td class="renglon_titulo"> Id Zona: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_medico" id="fi_id_medico" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>  -->
                <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">
                      <td><label>Nombre </label></td>
                      <td>
                        <select class="form-control" name="fn_nombre" id="fn_nombre"> 
                          <option value="0">Seleccione: </option>
                          <?php 
                            $sql = "SELECT * FROM se_usuarios WHERE activo = 'A'";

                            $query = $conexion->query($sql);

                            while ($valores = mysqli_fetch_array($query))
                            {
                              echo '<option value="'.$valores['id_usuario'].'">
                                      '.$valores['nombre'].'  '.$valores['a_paterno'].' '.$valores['a_materno'].'
                                    </option>';
                            }

                           ?>
                        </select>
                      </td>
                    </div>
                  </div>
            </tr>
              <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">
                      <td><label>Sucursal</label></td>
                      <td>
                        <select class="form-control" name="fn_sucursal" id="fi_sucursal" required> 
                          <option value="0">Seleccione: </option>
                          <?php 
                            $sql = "SELECT * FROM kg_sucursales WHERE estado = 'A'";

                            $query = $conexion->query($sql);

                            while ($valores = mysqli_fetch_array($query))
                            {
                              echo '<option value="'.$valores['id_sucursal'].'">
                                      '.$valores['desc_sucursal'].'
                                    </option>';
                            }

                           ?>
                        </select>
                      </td>
                    </div>
                  </div>
            </tr>

            <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">

                      <td><label>Orden  </label></td>
                      <td>
                       <select name="fn_orden" class="selector" id="fi_orden">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                          <option>9</option>
                          <option>10</option>
                        </select>
                      </td>
                    </div>
                  </div>
            </tr>
 <!--           <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Porcentaje:</label></td>
                <td><input type="number" class="form-control" id="edit1" required name="edit1"  maxlength="50" size="40" placeholder="Porcentaje del Descuento"></td>
              </div>
            </div>
            </tr>  -->
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

<!--Editar Participacion-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
<div class="row">
  <div id="cuadro1" class="col-sm-8 col-md-8 col-lg-8 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar ruta</h4>
            </div>
            <div class="modal-body">

            <input type="hidden" id="idruta" name="idruta" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                   <div class="form-group row" align="">
                    <div class="col-xs-6">
                      <label>Nombre </label>
                      <td>
                        <select class="form-control" name="fn_nombre" id="fi_nombre"> 
                          <option value="0">Seleccione: </option>
                          <?php 
                            $sql = "SELECT * FROM se_usuarios WHERE activo = 'A'";

                            $query = $conexion->query($sql);

                            while ($valores = mysqli_fetch_array($query))
                            {
                              echo '<option value="'.$valores['id_usuario'].'">
                                      '.$valores['nombre'].'  '.$valores['a_paterno'].' '.$valores['a_materno'].'
                                    </option>';
                            }

                           ?>
                        </select>
                      </td>
                    </div>
                  </div>
           
                    <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">
                      <td><label>Sucursal</label></td>
                      <td>
                        <select class="form-control" name="fn_sucursal" id="fi_sucursal"> 
                          <option value="0">Seleccione: </option>
                          <?php 
                            $sql = "SELECT * FROM kg_sucursales WHERE estado = 'A'";

                            $query = $conexion->query($sql);

                            while ($valores = mysqli_fetch_array($query))
                            {
                              echo '<option value="'.$valores['id_sucursal'].'">
                                      '.$valores['desc_sucursal'].'
                                    </option>';
                            }

                           ?>
                        </select>
                      </td>
                    </div>
                  </div>
            </tr>

                    <tr>
                  <div class="form-group row" align="">
                    <div class="col-xs-8">

                      <td><label>Orden  </label></td>
                      <td>
                       <select name="fn_orden" class="selector" id="fi_orden">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                          <option>9</option>
                          <option>10</option>
                        </select>
                      </td>
                    </div>
                  </div>
            </tr>
            <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">

          </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
    </div>
  </div>
</div>
</form>

<!-- Modal Eliminar-->
<form id="frmEliminaredocivil" action="controladores/eliminar_ruta.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Ruta</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar ruta?<strong data-name=""></strong>
                    <input type="hidden" id="id_ruta" name="id_ruta" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="fi_ruta" name="fn_ruta" type="text" class="form-control" maxlength="8" >
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
