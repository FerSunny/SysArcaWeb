<!-- Modal Agregar Usuario -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <form id="login-form" class="text-left" action="controladores/registrousuario.php" method="post">
            <div class="form-group">
              <label for="sel1">Empresa:</label>
              <select name="e1" >
                                 <?php
                                    $sql="SELECT * FROM km_estudios";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_estudio']."' >";
                                      echo $row['id_estudio'];
                                      echo "</option>";
                                    }
                                 ?>
              </select>
            </div>
            <div class="form-group" align="left">
                <label>Nombre Usuario</label>
                <input type="text" class="form-control" id="lg_password" name="e2" placeholder="usuario">
            </div>
            <div class="form-group">
              <label for="sel1">Sucursal:</label>
              <select name="e3" >
                                 <?php
                                    $sql="SELECT * FROM kg_sucursales";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_sucursal']."' >";
                                      echo $row['id_sucursal'];
                                      echo "</option>";
                                    }
                                 ?>
              </select>
            </div>
            <div class="form-group" align="left">
                <label>Contraseña</label>
                <input type="text" class="form-control" id="lg_password" name="e4" placeholder="contraseña">
            </div>
            <div class="form-group">
              <label for="sel1">Activo:</label>
              <select class="form-control" id="sel1" name="e5">
                <option>S</option>
                <option>N</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sel1">Perfil:</label>
              <select name="e6" >
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
              </select>
            </div>
            <div class="form-group" align="left">
                <label>Nombre</label>
                <input type="text" class="form-control" id="lg_password" name="e7" placeholder="nombre">
            </div>
            <div class="form-group" align="left">
                <label>Apellido Paterno</label>
                <input type="text" class="form-control" id="lg_password" name="e8" placeholder="paterno">
            </div>
            <div class="form-group" align="left">
                <label>Apellido Materno</label>
                <input type="text" class="form-control" id="lg_password" name="e9" placeholder="materno">
            </div>
            <div class="form-group" align="left">
                <label>Telefono Fijo</label>
                <input type="text" class="form-control" id="lg_password" name="e10" placeholder="fijo">
            </div>
            <div class="form-group" align="left">
                <label>Telefono Movil</label>
                <input type="text" class="form-control" id="lg_password" name="e11" placeholder="movil">
            </div>
            <div class="form-group" align="left">
                <label>Direccion</label>
                <input type="text" class="form-control" id="lg_password" name="e12" placeholder="direccion">
            </div>
            <div class="form-group" align="left">
                <label>Email</label>
                <input type="email" class="form-control" id="lg_password" name="e13" placeholder="email">
            </div>

                <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>

            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
        <div class="col-sm-8"><input id="nombre" name="nombre" type="mail" class="form-control"  autofocus></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Contraseña</label>
        <div class="col-sm-8"><input id="apellidos" name="apellidos" type="text" class="form-control" ></div>
      </div>
      <div class="form-group">
        <label for="apellidos" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-8"><input id="dni" name="dni" type="text" class="form-control" maxlength="8" ></div>
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
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-8">
                          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                        </div>
                    </div>
                    </form>
						</div>
						<div class="modal-footer">
							<button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
