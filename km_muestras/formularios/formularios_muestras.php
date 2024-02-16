
<!-- Modal Agregar Usuario -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Muestra</h4>
        </div>
        <div class="modal-body">
          <table>
            <form id="login-form" class="text-left" action="controladores/registro_muestras.php" method="post">

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-6">
                <td><label>Id Muestra:</label></td>
                <td><input type="text" class="form-control" id="edit1" name="edit1" placeholder="ID" autofocus disabled></td>
              </div>
            </div>
            </tr>
            <tr>
            <div class="form-group row">
              <div class="col-xs-6">
              <td><label for="sel1">Muestra:</label></td>
              <td colspan="2"><input type="text" size="20" class="form-control" id="edit2" name="edit2" placeholder="Muestra" maxlength="20"></td>
              </div>
            </div>
          </tr>
          <tr>
            <div class="form-group row" align="left">
                <td><label>Recoleccion</label></td>
              <td colspan="2"><input type="text" class="form-control" id="lg_password" id="edit3" name="edit3" placeholder="Recoleccion" maxlength="20"></td>
            </div>
            </tr>
            <tr>
            <div class="form-group row">
              <td><label for="sel1">Cantidad:</label></td>
              <td colspan="2"><input type="text" class="form-control" id="lg_password" id="edit4" name="edit4" placeholder="Cantidad" max="20"></td>
            </div>
          </tr>
          <tr>
            <td><label for="sel1">Estatus:</label></td>
            <td>
                <select class="" id="edit5" name="edit5">
                  <option value="A">Activo</option>
                  <option value="S">Suspendido</option>
                </select>
            </td>
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
 <form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
<div class="row">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Muestra</h4>
            </div>
            <div class="modal-body">

             
                <input type="hidden" id="idusuario" name="idusuario" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Id Muestra</label>
                      <div class="col-sm-8"><input id="edit1" name="edit1" type="text" class="form-control"   disabled></div>
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Muestra</label>
                        <div class="col-sm-8"><input id="edit2" name="edit2" type="text" class="form-control"  ></div>
                      </div>
                      <div class="form-group">
                          <label for="apellidos" class="col-sm-2 control-label">Recoleccion</label>
                          <div class="col-sm-8"><input id="edit3" name="edit3" type="text" class="form-control" ></div>
                      </div>
                      <div class="form-group">
                          <label for="apellidos" class="col-sm-2 control-label">Cantidad</label>
                          <div class="col-sm-8"><input id="edit4" name="edit4" type="text" class="form-control" ></div>
                      </div>
                      <tr>
                        <td><label for="sel1">Estatus:</label></td>
                        <td>
                            <select class="" id="edit5" name="edit5">
                              <option value="A">Activo</option>
                              <option value="S">Suspendido</option>
                            </select>
                        </td>
                      </tr>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>

    </div>

  </div>
</div>
    </div>
  s

  </div>
</div>
</form>


      <!-- Modal Eliminar-->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Muestra</h4>
            </div>
            <div class="modal-body">
              <form id="frmEliminarUsuario" action="controladores/eliminar_muestras.php" method="POST">
                ¿Está seguro de eliminar la muestra?<strong data-name=""></strong>
                    <input type="hidden" id="idusuario" name="idusuario" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="usuario" name="usuario" type="text" class="form-control">
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
