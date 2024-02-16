<?php include("../controladores/conex.php") ?>
<!-- Modal Agregar participaciones -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Promocion</h4>
        </div>
        <div class="modal-body">
          <table>
            <form id="login-form" class="text-left" action="controladores/registro_promociones.php" method="post">

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Promociones:</label></td>
                <td><input type="text" class="form-control" id="edit1" required name="edit1"  maxlength="50" size="40" placeholder="Promocion"></td>
              </div>
            </div>
            </tr>

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Porcentaje:</label></td>
                <td><input type="number" class="form-control" id="edit3" required name="edit3"  maxlength="50" size="40" placeholder="Porcentaje"></td>
              </div>
            </div>
            </tr>

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Fecha Inicio:</label></td>
                <td><input type="date" class="form-control" id="edit4" required name="edit4"  maxlength="50" size="40" placeholder="Fecha Inicio"></td>
              </div>
            </div>
            </tr>

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-8">
                <td><label>Fecha Termino:</label></td>
                <td><input type="date" class="form-control" id="edit5" required name="edit5"  maxlength="50" size="40" placeholder="Fecha Termino"></td>
              </div>
            </div>
            </tr>

            <tr>
              <table>
                <tr>Dia que aplica</tr>
                <tr>
                  <th width="50" style="text-align:center;" " ><label>Lun</label></th>
                  <th width="50" style="text-align:center;" " ><label>Mar</label></th>
                  <th width="50" style="text-align:center;" " ><label>Mie</label></th>
                  <th width="50" style="text-align:center;" " ><label>Jue</label></th>
                  <th width="50" style="text-align:center;" " ><label>Vie</label></th>
                  <th width="50" style="text-align:center;" " ><label>Sab</label></th>
                  <th width="50" style="text-align:center;" " ><label>Dom</label></th>
                </tr>
                <tr>
                  <td style="text-align:center;">
                      <select class="" name="fn_lunes" id="fi_lunes">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_martes" id="fi_martes">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_miercoles" id="fi_miercoles">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_jueves" id="fi_jueves">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_viernes" id="fi_viernes">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_sabado" id="fi_sabado">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_domingo" id="fi_domingo">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>                                                      
                </tr>
              </table>
              <br>
            </tr>
<!-- sucursal --> 
              <table>
                <tr>Sucursal que aplica</tr>
                <tr>
                  <th width="50" style="text-align:center;" " ><label>Tul</label></th>
                  <th width="50" style="text-align:center;" " ><label>Tu2</label></th>
                  <th width="50" style="text-align:center;" " ><label>Gre</label></th>
                  <th width="50" style="text-align:center;" " ><label>Xoc</label></th>
                  <th width="50" style="text-align:center;" " ><label>San</label></th>
                  <th width="50" style="text-align:center;" " ><label>Pab</label></th>
                  <th width="50" style="text-align:center;" " ><label>Ped</label></th>
                  <th width="50" style="text-align:center;" " ><label>Tec</label></th>
                  <th width="50" style="text-align:center;" " ><label>Tet</label></th>
                </tr>
                <tr>
                  <td style="text-align:center;">
                      <select class="" name="fn_tul" id="fi_tul">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_tu2" id="fi_tu2">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_gre" id="fi_gre">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_xoc" id="fi_xoc">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_san" id="fi_san">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_pab" id="fi_pab">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_ped" id="fi_ped">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td> 
                  <td style="text-align:center;">
                      <select class="" name="fn_tec" id="fi_tec">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td> 
                  <td style="text-align:center;">
                      <select class="" name="fn_tet" id="fi_tet">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>                                                      
                </tr>
              </table>
              <br>

<!-- fin sucursales -->


<!-- estado -->
            <tr>
              <td>  <label for="" class="col-sm-2 control-label">Estado:</label></td>
              <td>

                  <select class="col-sm-3 selectpicker" name="edit2" id="edit2">
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

<!--Editar Participacion-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
<div class="row">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Promocion</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id="idpromocion" name="idpromocion" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                    <div class="form-group">
                      <label for="promocion" class="col-sm-2 control-label">Promocion</label>
                      <div class="col-sm-8"><input id="edit1" name="edit1" maxkength="50" required type="text" class="form-control" ></div>
                    </div>

                    <div class="form-group">
                      <label for="porcentaje" class="col-sm-2 control-label">Porcentaje</label>
                      <div class="col-sm-8"><input id="edit3" name="edit3" maxkength="50" required type="number" class="form-control" ></div>
                    </div>

                    <div class="form-group">
                      <label for="FechaInicio" class="col-sm-2 control-label">Fecha Inicial</label>
                      <div class="col-sm-8"><input id="edit4" name="edit4" maxkength="50" required type="date" class="form-control" ></div>
                    </div>

                    <div class="form-group">
                      <label for="FechaFinal" class="col-sm-2 control-label">Fecha Final</label>
                      <div class="col-sm-8"><input id="edit5" name="edit5" maxkength="50" required type="date" class="form-control" ></div>
                    </div>
 
              <table>
                <tr>Dia que aplica</tr>
                <tr>
                  <th width="50" style="text-align:center;" " ><label>Lun</label></th>
                  <th width="50" style="text-align:center;" " ><label>Mar</label></th>
                  <th width="50" style="text-align:center;" " ><label>Mie</label></th>
                  <th width="50" style="text-align:center;" " ><label>Jue</label></th>
                  <th width="50" style="text-align:center;" " ><label>Vie</label></th>
                  <th width="50" style="text-align:center;" " ><label>Sab</label></th>
                  <th width="50" style="text-align:center;" " ><label>Dom</label></th>
                </tr>
                <tr>
                  <td style="text-align:center;">
                      <select class="" name="fn_lunes" id="fi_lunes" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_martes" id="fi_martes" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_miercoles" id="fi_miercoles" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_jueves" id="fi_jueves" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_viernes" id="fi_viernes" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_sabado" id="fi_sabado" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_domingo" id="fi_domingo" required="">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>                                                      
                </tr>
              </table>
              <br>
         
<!-- sucursal --> 
              <table>
                <tr>Sucursal que aplica</tr>
                <tr>
                  <th width="50" style="text-align:center;" " ><label>Tul</label></th>
                  <th width="50" style="text-align:center;" " ><label>Tu2</label></th>
                  <th width="50" style="text-align:center;" " ><label>Gre</label></th>
                  <th width="50" style="text-align:center;" " ><label>Xoc</label></th>
                  <th width="50" style="text-align:center;" " ><label>San</label></th>
                  <th width="50" style="text-align:center;" " ><label>Pab</label></th>
                  <th width="50" style="text-align:center;" " ><label>Ped</label></th>
                  <th width="50" style="text-align:center;" " ><label>Tec</label></th>
                  <th width="50" style="text-align:center;" " ><label>Tet</label></th>
                </tr>
                <tr>
                  <td style="text-align:center;">
                      <select class="" name="fn_tul" id="fi_tul">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_tu2" id="fi_tu2">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_gre" id="fi_gre">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_xoc" id="fi_xoc">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_san" id="fi_san">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_pab" id="fi_pab">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>
                  <td style="text-align:center;">
                      <select class="" name="fn_ped" id="fi_ped">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td> 
                  <td style="text-align:center;">
                      <select class="" name="fn_tec" id="fi_tec">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td> 
                  <td style="text-align:center;">
                      <select class="" name="fn_tet" id="fi_tet">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                      </select>
                  </td>                                                      
                </tr>
              </table>
              <br>

<!-- fin sucursales -->

      <div class="form-group">
        <label for="estado" class="col-sm-2 control-label">Estado:</label>
        <select class="col-sm-3 selectpicker" name="edit2" id="edit2">
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
<form id="frmEliminarPromocion" action="controladores/eliminar_promociones.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Promocion</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar la promocion?<strong data-name=""></strong>
                    <input type="hidden" id="idpromocion" name="idpromocion" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="promocion" name="promocion" type="text" class="form-control" maxlength="8" >
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
