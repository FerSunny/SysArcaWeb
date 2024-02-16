<?php include("../controladores/conex.php") ?>
<!-- Modal Agregar Usuario -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Inidicacion</h4>
        </div>
        <div class="modal-body">
          <table>
            <form id="login-form" class="text-left" action="controladores/registro_muestra.php" method="post">

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Indicacion:</label></td>
                <!--
                <td><input type="textarea" class="form-control" id="edit1" required name="edit1"  
                placeholder="Indicaciones"></td>
                -->
                <textarea class="form-control" name="edit1" id="edit1" rows="1"></textarea>
              </div>
            </div>
            </tr>
            <tr>
              <td>  <label for="apellidos" class="col-sm-2 control-label">Estado:</label></td>
              <td>  <div class="form-group">

                  <select class="col-sm-3 selectpicker" name="edit2" id="edit2">
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

<!--Editar Usuario-->
<div class="row">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Indicacion</h4>
            </div>
            <div class="modal-body">

              <form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
                <input type="hidden" id="idusuario" name="idusuario" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Indicaciones</label>
                      <div class="col-sm-8">
                        <!--
                        <input id="edit1" name="edit1" maxkength="50" required type="text" class="form-control" >
                        -->
                        <textarea class="form-control" name="edit1" id="edit1" rows="1"></textarea>
                      </div>
                    </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Estado:</label>
        <select class="col-sm-3 selectpicker" name="edit2" id="edit2">
          <option value="A">Activo</option>
          <option value="S">Suspender</option>
        </select>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">


          </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
    </div>

  </div>
</div>
    </div>
    <div class="col-sm-offset-2 col-sm-8">
      <p class="mensaje"></p>
    </div>

  </div>
</div>


      <!-- Modal Eliminar-->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Indicaciones</h4>
            </div>
            <div class="modal-body">
              <form id="frmEliminarUsuario" action="controladores/eliminar_muestra.php" method="POST">
                ¿Está seguro de eliminar al usuario?<strong data-name=""></strong>
                    <input type="hidden" id="idusuario" name="idusuario" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="usuario" name="usuario" type="text" class="form-control" maxlength="8" >
                      </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
