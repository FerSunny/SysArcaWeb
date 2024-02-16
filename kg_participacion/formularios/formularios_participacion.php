<?php include("../controladores/conex.php") ?>
<!-- Modal Agregar Usuario -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Usuario</h4>
        </div>
        <div class="modal-body">
          <table>
            <form id="login-form" class="text-left" action="controladores/registrousuario.php" method="post">

            <tr>
            <div class="form-group row" align="">
              <div class="col-xs-6">
                <td><label>Nombre Usuario:</label></td>
                <td><input type="text" class="form-control" id="lg_password" name="e2" placeholder="usuario@mail.com"></td>
              </div>
            </div>
            </tr>
            <tr>
            <div class="form-group row">
              <div class="col-xs-6">
              <td><label for="sel1">Sucursal:</label></td>
              <td><select name="e3" >
                                 <?php
                                    $sql="SELECT * FROM kg_sucursales";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_sucursal']."' >";
                                      echo $row['des_sucursal'];
                                      echo "</option>";
                                    }
                                 ?>
              </select></td>
              </div>
            </div>
          </tr>
          <tr>
            <div class="form-group row" align="left">
                <td><label>Contraseña</label></td>
              <td><input type="text" class="form-control" id="lg_password" name="e4" placeholder="contraseña"></td>
            </div>
            </tr>
            <tr>
            <div class="form-group row">
              <td><label for="sel1">Activo:</label></td>
              <td><select class="form-control" id="sel1" name="e5">
                <option value="A">A</option>
                <option value="S">S</option>
              </select></td>
            </div>
          </tr>
          <tr>
            <div class="form-group">
              <td><label for="sel1">Perfil:</label></td>
              <td><select name="e6" >
                                 <?php
                                    $sql="SELECT * FROM se_perfiles";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_perfil']."' >";
                                      echo $row['id_perfil'];
                                      echo "</option>";
                                    }
                                 ?>
              </select></td>
            </div>
          </tr>
          <tr>
            <div class="form-group" align="left">
                <td><label>Nombre</label></td>
                <td><input type="text" class="form-control" id="lg_password" name="e7" placeholder="nombre"></td>
            </div>
          </tr>
          <tr>
            <div class="form-group" align="left">
              <td>  <label>Apellido Paterno</label></td>
              <td>  <input type="text" class="form-control" id="lg_password" name="e8" placeholder="paterno"></td>
            </div>
          </tr>
          <tr>
            <div class="form-group" align="left">
                <td><label>Apellido Materno</label></td>
                <td><input type="text" class="form-control" id="lg_password" name="e9" placeholder="materno"></td>
            </div>
          </tr>
          <tr>
            <div class="form-group" align="left">
                <td><label>Telefono Fijo</label></td>
                <td><input type="text" class="form-control" id="lg_password" name="e10" placeholder="fijo"></td>
            </div>
          </tr>
          <tr>
            <div class="form-group" align="left">
                <td><label>Telefono Movil</label></td>
                <td><input type="text" class="form-control" id="lg_password" name="e11" placeholder="movil"></td>
            </div>
          </tr>
            <tr>
            <div class="form-group" align="left">
                <td><label>Direccion</label></td>
                <td><input type="text" class="form-control" id="lg_password" name="e12" placeholder="direccion"></td>
            </div>
          </tr>
          <tr>
            <div class="form-group" align="left">
                <td><label>Email</label></td>
                <td><input type="email" class="form-control" id="lg_password" name="e13" placeholder="email"></td>
            </div>
          </tr>

            </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
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
              <h4 class="modal-title" id="modalEliminarLabel">Editar Usuario</h4>
            </div>
            <div class="modal-body">

              <form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
                <input type="hidden" id="idusuario" name="idusuario" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Usuario</label>
                      <div class="col-sm-8"><input id="edit1" name="edit1" type="text" class="form-control"  autofocus></div>
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Sucursal</label>
                          <select name="edit2" id="edit2" >
                              <?php
                                 $sql="SELECT * FROM kg_sucursales";
                                 $rec=mysqli_query($conexion,$sql);
                                 while ($row=mysqli_fetch_array($rec))
                                 {
                                   echo "<option value='".$row['id_sucursal']."' >";
                                   echo $row['des_sucursal'];
                                   echo "</option>";
                                 }
                                 ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="apellidos" class="col-sm-2 control-label">Contraseña</label>
                          <div class="col-sm-8"><input id="edit3" name="edit3" type="text" class="form-control" ></div>
                      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Estado: A=Activo   S=Suspendido</label>
        <select class="col-sm-3 selectpicker" name="edit4" id="edit4">
          <option value="A">A</option>
          <option value="S">S</option>
        </select>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-8"><input id="edit5" name="edit5" type="text" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Apellido Paterno</label>
        <div class="col-sm-8"><input id="edit6" name="edit6" type="edit5" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Apellido Materno</label>
        <div class="col-sm-8"><input id="edit7" name="edit7" type="edit7" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Telefono Fijo</label>
        <div class="col-sm-8"><input id="edit8" name="edit8" type="edit7" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">telefono Movil</label>
        <div class="col-sm-8"><input id="edit9" name="edit9" type="edit7" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Direccion</label>
        <div class="col-sm-8"><input id="edit10" name="edit10" type="edit7" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-8"><input id="edit11" name="edit11" type="edit7" class="form-control" maxlength="8" ></div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">

            <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
            </form>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>

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
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">
              ¿Está seguro de eliminar al usuario?<strong data-name=""></strong>
              <form id="frmEliminarUsuario" action="controladores/eliminar_usuario.php" method="POST">
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
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
