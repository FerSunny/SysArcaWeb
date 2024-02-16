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

								Nuevo Producto

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="producto" id="producto" class="form-control" maxlength="100" required>

									<label for="producto"> Descripción corta </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="desc_p" id="desc_p" class="form-control" maxlength="100">

									<label for="desc_p">Descripción larga </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number"  name="costo" id="costo" class="form-control" min="1" maxlength="5" step="0.01" onkeyup="calcular(1)" required>

									<label for="costo">Costo</label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number" name="utilidad" id="utilidad" class="form-control" min="1" maxlength="5" value="1"  step="0.01" onkeyup="calcular(1)" required>

									<label for="utilidad">Utilidad</label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number" name="c_total" id="c_total" class="form-control" step="0.01" readonly>

									<label for="c_total" id="lbl_total">Precio</label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Departamento</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="depto" 

								id="depto" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_departamento,desc_departamento FROM eb_departamento WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_departamento'].">

																".$res['desc_departamento']."

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

												$query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A'");

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

								<label for="">Categoría</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="cat" id="cat" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_categoria,categoria FROM eb_categoria WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_categoria'].">

																".$res['categoria']."

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

								<label for="">Unidad de medida</label>

							</div>

						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="uni_med" id="uni_med" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_unidad, unidad_medida FROM eb_unidad_medida WHERE estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_unidad'].">
																".$res['unidad_medida']."
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

									<input type="date" name="caducidad" id="caducidad" class="form-control" maxlength="100" required>

									<label for="producto">Caducidad del producto</label>

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

									Editar hoja de SV

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="id_signos" name="id_signos" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="fk_id_estudio" name="fk_id_estudio">


						<div class="md-form">
							<input type="text" name="folio" id="folio" class="form-control" required>
							<label for="codigo">Folio</label>
						</div>

						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="date" name="fecha" id="fecha" class="form-control" required>
										<label for="fecha">Fecha</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<label for="">Medico</label>
							</div>
						</div>


						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="id_medico" id="id_medico" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_usuario,CONCAT(nombre,' ',a_paterno,' ',a_materno) AS nombre FROM se_usuarios
												WHERE activo = 'A'
												AND fk_id_perfil = 21");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_usuario'].">
																".$res['nombre']."
																</option>";
												}
										?>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="peso" id="peso" class="form-control" min="1" omax="150" required>
										<label for="peso">Peso</label>
									</div>
								</div>
							</div>

							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="talla" id="talla" class="form-control" min="1" max="250"  required>
										<label for="talla">Talla</label>
									</div>
								</div>
							</div>

							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<label for="diabetes" id="diabetes">Diabetes</label>
										<select name="diabetes" id="diabetes">
											<option value="S">Si</option>
											<option value="N">No</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row"><br>
							<div class="col">
								<div class="md-form mt-4">
									<label for="">Displemia</label>
								</div>
							</div>

							<div class="col-9">
								<div class="md-form mt-0">
								<select name="dislpemia" id="dislpemia">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col">
								<div class="md-form mt-4">
									<label for="">Hipertension</label>
								</div>
							</div>

							<div class="col-9">
								<div class="md-form mt-0">
								<select name="hipertension" id="hipertension">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
								</div>
							</div>
						</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-4">
								<label for="">Infartos</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
							<select name="infartos" id="infartos">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-4">
								<label for="">Angina</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
							<select name="angina" id="angina">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-4">
								<label for="">Palpitaciones</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
							<select name="palpitaciones" id="palpitaciones">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-4">
								<label for="">Dolor</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
							<select name="dolor" id="dolor">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-4">
								<label for="">Fuma</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
							<select name="fuma" id="fuma">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-4">
								<label for="">Alcohol</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
							<select name="alcohol" id="alcohol">
									<option value="S">Si</option>
									<option value="N">No</option>
								</select>
							</div>
						</div>
					</div>






					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="observaciones" id="observaciones" class="form-control" maxlength="100" >
									<label for="producto">Observaciones</label>
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



