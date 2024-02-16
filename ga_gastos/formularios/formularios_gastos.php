<?php include("../controladores/conex.php") ?>
<!-- Modal Agregar clasificaciones -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Concepto</h4>
        </div>
        <div class="modal-body">
          <table>
            <form id="login-form" class="text-left" action="controladores/registro_gastos.php" method="post">

              <tr>
                <td class="col-sm-2 control-label">Clasificacion: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_clasifica" id="fi_clasifica">
                    <?php
                      $sql="SELECT * FROM ga_clasifica where estado = 'A' order by desc_clasifica";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_clasifica']."' >";
                          echo $row['desc_clasifica'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td class="col-sm-2 control-label">Tipo: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_tipo" id="fi_tipo">
                    <?php
                      $sql="SELECT * FROM ga_tipo_gasto where estado = 'A' order by desc_tipo_gasto";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_tipo_gasto']."' >";
                          echo $row['desc_tipo_gasto'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td> <label>Concepto:</label></td>
                <td><input type="text" class="form-control" id="gasto" required name="gasto"  maxlength="50" size="40" placeholder="Gasto"></td>
              </div>
            </div>
            </tr>

            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Estado:</label></td>
              <td>  <div class="form-group">
                  <select class="col-sm-3 selectpicker" name="estado" id="estado">
                    <option value="A">Activo</option>
                    <option value="S">Suspendido</option>
                  </select>
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
</div>

<!--Editar clasificaciones-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
<div class="row">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Concepto</h4>
            </div>
            <div class="modal-body">
<table>
  
              <tr>
                <td class="col-sm-2 control-label">Clasificacion: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_clasifica" id="fi_clasifica">
                    <?php
                      $sql="SELECT * FROM ga_clasifica where estado = 'A' order by desc_clasifica";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_clasifica']."' >";
                          echo $row['desc_clasifica'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td class="col-sm-2 control-label">Tipo: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_tipo" id="fi_tipo">
                    <?php
                      $sql="SELECT * FROM ga_tipo_gasto where estado = 'A' order by desc_tipo_gasto";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_tipo_gasto']."' >";
                          echo $row['desc_tipo_gasto'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

<tr>
                <input type="hidden" id="idgasto" name="idgasto" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Concepto</label>
                      <div class="col-sm-8"><input id="gasto" name="gasto" maxkength="50" required type="text" class="form-control" ></div>
                    </div>
</tr>

<tr>
                    <div class="form-group">
                      <label for="estado" class="col-sm-2 control-label">Estado:</label>
                      <select class="col-sm-3 selectpicker" name="estado" id="estado">
                        <option value="A">Activo</option>
                        <option value="S">Suspendido</option>
                      </select>
                    </div>
</tr>
</table>
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
<form id="frmEliminarGasto" action="controladores/eliminar_gastos.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Gasto</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar el gasto?<strong data-name=""></strong>
                    <input type="hidden" id="idgasto" name="idgasto" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="gasto" name="gasto" type="text" class="form-control" maxlength="8" >
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
