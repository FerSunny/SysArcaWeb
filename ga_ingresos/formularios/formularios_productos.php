<?php 
	// session_start();
	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');
	$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
	$FechaHoy=date("d/m/Y : H : i : s");

?>



<form id="form_productos" action="" method="post">

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nuevo Retiro de caja

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Id</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="nota" id="nota" class="form-control" maxlength="100" required>

									<label for="producto"> Nota </label>

								</div>

							</div>

						</div>


					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number"  name="costo" id="costo" class="form-control" min="1" maxlength="5" step="0.01" required>

									<label for="costo">Costo</label>

								</div>

							</div>

						</div>


					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Tipos de Movimiento</label>

							</div>

						</div>





						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="gasto" 

								id="gasto" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT
												id_gasto,
												desc_gasto
											  FROM ga_gasto
											  WHERE fk_id_tipo_gasto = 1");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_gasto'].">

																".$res['desc_gasto']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

						

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Cajero</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="cajero" id="cajero" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT u.`id_usuario`,
												u.`id_usr`,
												u.fk_id_perfil 
												FROM se_usuarios u
												WHERE u.`activo` = 'A'
												AND u.`fk_id_sucursal` = $fk_id_sucursal
												AND u.`fk_id_perfil` = 11");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['id_usr']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

					</div>

					<br>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha" id="fecha" class="form-control" maxlength="100" required>

									<label for="producto">Fecha Movimiento</label>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="modal-footer">

						<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

				</div>

			</div>

		</div>

	</div>

</form>





<!-- Editar -->



<form id="frmedit" class="form-horizontal" method="POST">

	<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">

		<div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

							<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">

									Editar Retiro de caja

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" name="codigo" id="codigo" class="form-control" required>

							<label for="codigo">Código</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="nota" id="nota" class="form-control" required>

										<label for="producto">Nota</label>

									</div>

								</div>

							</div>



						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="costo" id="costo" class="form-control" step="0.01"  required>

										<label for="costo">Costo</label>

									</div>

								</div>

							</div>



						</div>

						<div class="row"><br>

							<div class="col">

								<div class="md-form mt-4">

									<label for="">Tipos de Movimiento</label>

								</div>

							</div>

							<div class="col-9">

								<div class="md-form mt-0">

									<select class="form-control form-control-sm" name="gasto" 

									id="gasto" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 

													$query = $conexion -> query("SELECT
													id_gasto,
													desc_gasto
												  FROM ga_gasto
												  WHERE fk_id_tipo_gasto = 1");

													while($res = mysqli_fetch_array($query))

													{

															echo "<option value =".$res['id_gasto'].">

																	".$res['desc_gasto']."

																	</option>";

													}

											?>

									</select>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-4">

									<label for="">Cajero</label>

								</div>

							</div>

							<div class="col-9">

								<div class="md-form mt-0">

									<select class="form-control form-control-sm" name="cajero" id="cajero" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 

													$query = $conexion -> query("SELECT u.`id_usuario`,
													u.`id_usr`,
													u.fk_id_perfil 
													FROM se_usuarios u
													WHERE u.`activo` = 'A'
													AND u.`fk_id_sucursal` = $fk_id_sucursal
													AND u.`fk_id_perfil` = 11");

													while($res = mysqli_fetch_array($query))

													{

															echo "<option value =".$res['id_usuario'].">

																	".$res['id_usr']."

																	</option>";

													}

											?>

									</select>

								</div>

							</div>

						</div>





					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" readonly name="fecha" id="fecha" class="form-control" maxlength="100" required>

									<label for="producto">Fecha</label>

								</div>

							</div>

						</div>

					</div>

					</div>

					<div class="modal-footer">

							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>



