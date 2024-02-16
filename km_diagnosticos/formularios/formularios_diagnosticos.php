<?php include("../controladores/conex.php") ?>
<!-- Modal Agregar participaciones -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Diagnostico</h4>
        </div>
        <div class="modal-body">
          <table>
            <form id="login-form" class="text-left" action="controladores/registro_diagnosticos.php" method="post">

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Diagnostico</label></td>
                <td><input type="text" class="form-control" id="fi_diagnostico" required name="fn_diagnostico"  maxlength="50" size="40" placeholder="Diagnostico"></td>
              </div>
            </div>
            </tr>


            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Descripcion abreviada</label></td>
                <td><input type="text" class="form-control" id="fi_abreviada" required name="fn_abreviada"  maxlength="50" size="40" placeholder="Descripcion abreviada"></td>
              </div>
            </div>
            </tr>

            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Estado:</label></td>
              <td>  <div class="form-group">

                  <select class="col-sm-3 selectpicker" name="fn_estado" id="fi_estado">
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

<!--Editar Participacion-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
<div class="row">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Diagnostico</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id="id_diagnostico" name="id_diagnostico" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                    <div class="form-group">
                      <label for="Diagnostico" class="col-sm-2 control-label">Diagnostico</label>
                      <div class="col-sm-8"><input id="fi_diagnostico" name="fn_diagnostico" maxkength="50" required type="text" class="form-control" ></div>
                    </div>

                    <div class="form-group">
                      <label for="Descripcion Abreviada" class="col-sm-2 control-label">Descripcion Abreviada</label>
                      <div class="col-sm-8"><input id="fi_abreviada" name="fn_abreviada" maxkength="50" required type="text" class="form-control" ></div>
                    </div>

                    <div class="form-group">
                      <label for="estado" class="col-sm-2 control-label">Estado:</label>
                      <select class="col-sm-3 selectpicker" name="fn_estado" id="fi_estado">
                        <option value="A">Activo</option>
                        <option value="S">Suspendido</option>
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
    </div>

  </div>
</div>
    </div>
  </div>
</div>
</form>

<!-- Modal Eliminar-->
<form id="frmEliminaredocivil" action="controladores/eliminar_diagnostico.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Diagnostico</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar el diagnostico?<strong data-name=""></strong>
                    <input type="hidden" id="id_diagnostico" name="id_diagnostico" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="fi_diagnostico" name="fn_diagnostico" type="text" class="form-control" maxlength="8" >
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
