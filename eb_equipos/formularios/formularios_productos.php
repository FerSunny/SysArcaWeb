<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	$FechaHoy=date("d/m/Y : H : i : s");

?>



<form id="form_productos" action="" method="post">

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nuevo Equipo

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

								<textarea class="form-control" id="descripcion" name="descripcion"rows="3"required ></textarea>

								<label for="descripcion">Describa detalladamente la descripcion del equipo</label>

								</div>

							</div>

						</div>
					</div>

					<div class="row">
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="serie" id="serie" class="form-control" maxlength="100" required>

									<label for="producto"> No. Serie </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="marca" id="marca" class="form-control" maxlength="100" required>

									<label for="producto"> Marca </label>

								</div>

							</div>

						</div>

					</div>


					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="modelo" id="modelo" class="form-control" maxlength="100" required>

									<label for="producto"> Modelo </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha_alta" id="fecha_alta" class="form-control"  required>

									<label for="fecha_alta"> Fecha Alta </label>

								</div>

							</div>

						</div>


					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha_marcha" id="fecha_marcha" class="form-control" maxlength="100" required>

									<label for="producto"> Fecha puesto en marcha </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha_expira_g" id="fecha_expira_g" class="form-control"  required>

									<label for="fecha_alta"> Fecha Expira Garantia </label>

								</div>

							</div>

						</div>


					</div>



					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Sucursal</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="sucursal" 

								id="sucursal" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_sucursal,desc_sucursal FROM kg_sucursales WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_sucursal'].">

																".$res['desc_sucursal']."

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

								<label for="">Servicio</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="servicio" 

								id="servicio" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_servicio,desc_servicio FROM km_servicios WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_servicio'].">

																".$res['desc_servicio']."

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

								<label for="">Area</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="area" id="area" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_area,desc_area FROM km_areas WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_area'].">

																".$res['desc_area']."

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

								<label for="">Gpo Contable</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="gpo_conta" id="gpo_conta" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_gpo_conta,desc_gpo_conta FROM km_gpo_conta WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_gpo_conta'].">

																".$res['desc_gpo_conta']."

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

								<label for="">Proveedor</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="proveedor" id="proveedor" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_proveedor, razon_social FROM eb_proveedores WHERE estado = 'A'  order by 2");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_proveedor'].">

																".$res['razon_social']."

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

									<input type="text" name="usuario" id="usuario" class="form-control" maxlength="100" required>

									<label for="producto"> Usuario </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="password" name="pass" id="pass" class="form-control" maxlength="100" required>

									<label for="producto"> Contraseña </label>

								</div>

							</div>

						</div>

					</div>


					<div class="row">

						<div class="col">



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

									Editar Equipos

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" readonly name="codigo" id="codigo" class="form-control" required>

							<label for="codigo">Código</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

									<textarea class="form-control" id="descripcion" name="descripcion"rows="3"required ></textarea>

									<label for="descripcion">Describa detalladamente la descripcion del equipo</label>

									</div>

								</div>

							</div>
						</div>
<!-- Serie -->
						<div class="row">
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="serie" id="serie" class="form-control" maxlength="100" required>

										<label for="producto"> No. Serie </label>

									</div>

								</div>

							</div>
<!-- Marca -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="marca" id="marca" class="form-control" maxlength="100" required>

										<label for="producto"> Marca </label>

									</div>

								</div>

							</div>

						</div>

<!-- Modelo -->
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="modelo" id="modelo" class="form-control" maxlength="100" required>

										<label for="producto"> Modelo </label>

									</div>

								</div>

							</div>
<!-- Fecha ALta -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="date" name="fecha_alta" id="fecha_alta" class="form-control"  required>

										<label for="fecha_alta"> Fecha Alta </label>

									</div>

								</div>

							</div>


						</div>

						<div class="row">
<!-- Fecha puesto marcha -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="date" name="fecha_marcha" id="fecha_marcha" class="form-control" maxlength="100" required>

										<label for="producto"> Fecha puesto en marcha </label>

									</div>

								</div>

							</div>
<!-- Fecha Expira garantia -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="date" name="fecha_expira_g" id="fecha_expira_g" class="form-control"  required>

										<label for="fecha_alta"> Fecha Expira Garantia </label>

									</div>

								</div>

							</div>


						</div>




					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Sucursal</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="sucursal" 

								id="sucursal" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_sucursal,desc_sucursal FROM kg_sucursales WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_sucursal'].">

																".$res['desc_sucursal']."

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

								<label for="">Servicio</label>

							</div>

						</div>





						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="servicio" 

								id="servicio" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_servicio,desc_servicio FROM km_servicios WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_servicio'].">

																".$res['desc_servicio']."

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

								<label for="">Area</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="area" id="area" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_area,desc_area FROM km_areas WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_area'].">

																".$res['desc_area']."

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

								<label for="">Gpo Contable</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="gpo_conta" id="gpo_conta" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_gpo_conta,desc_gpo_conta FROM km_gpo_conta WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_gpo_conta'].">

																".$res['desc_gpo_conta']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>


						<div class="row">

								<div class="col">

									<div class="md-form mt-0">

										<label for="">Proveedor</label>

									</div>

								</div>

								<div class="col-9">
									<div class="md-form mt-0">
										<select class="form-control form-control-sm" name="proveedor" id="proveedor" required>
											<option value="" class="z-depth-5">Seleccione</option>
												<?php 
														$query = $conexion -> query("SELECT id_proveedor, razon_social FROM eb_proveedores WHERE estado = 'A' order by razon_social");
														while($res = mysqli_fetch_array($query))
														{
																echo "<option value =".$res['id_proveedor'].">
																		".$res['razon_social']."
																		</option>";
														}
												?>
										</select>
									</div>
								</div>
							</div>
						</div>
		
					<div class="row">
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number" readonly name="conse" id="conse" class="form-control" maxlength="100" required>

									<label for="producto">Consecutivo</label>

								</div>

							</div>

						</div>
					</div>


					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="usuario" id="usuario" class="form-control" maxlength="100" required>

									<label for="producto"> Usuario </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="password" name="pass" id="pass" class="form-control" maxlength="100" required>

									<label for="producto"> Contraseña </label>

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



