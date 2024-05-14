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

								Nuevo Termometro

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>
<!-- LINEA 2 -->
<!-- Equipo -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Equipo</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="fk_id_equipo" 
								id="fk_id_equipo " required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT eq.`id_equipo`,eq.`descripcion` FROM eb_equipos  eq
																			WHERE (eq.`descripcion` LIKE '%termo%' OR eq.`descripcion` LIKE 'HIGRO%')
																			AND estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_equipo'].">
																".$res['descripcion']."
																</option>";
												}
										?>
								</select>
							</div>
						</div>
					</div>

<!-- LINEA 3 -->
					<div class="row">
<!-- fecha de calibracion  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date"  name="fecha_calibracion" id="fecha_calibracion" class="form-control"  required> <!-- maxlength="5" step="0.01"  -->
									<label for="fecha_calibracion">Fecha Calibracion</label>
								</div>
							</div>
						</div>
<!-- Duracion (dias)  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="duracion" id="duracion" valu	e="365" class="form-control" required>
									<label for="duracion" >Duraciopon (dias)</label>
								</div>
							</div>
						</div>
					</div>


<!-- LINEA 4 -->
					<div class="row">
<!-- temperatura de calibracion  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="temp_calibra" id="temp_calibra" class="form-control" maxlength="100" step="0.01" required>
									<label for="temp_calibra">Temperatura Calibracion (°C)</label>
								</div>
							</div>
						</div>
<!-- humedad  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="humedad" id="humedad" class="form-control" maxlength="100" step="0.01" required>
									<label for="humedad" >Humedad (%)</label>
								</div>
							</div>
						</div>
<!-- exactitud  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="exactitud" id="exactitud" class="form-control" maxlength="100" step="0.01" required>
									<label for="exactitud" >Exactitud (°C)</label>
								</div>
							</div>
						</div>
					</div>

<!-- LINEA 5 -->
<!-- Proveedor  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Proveedor</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="fk_id_proveedor" 
								id="fk_id_proveedor" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT pr.`id_proveedor`,pr.`razon_social` FROM eb_proveedores pr
																			WHERE pr.`estado` = 'A'");
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
<!-- LINEA 6 -->
					<div class="row">
<!-- temp_refere_1  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="temp_refere_1" id="temp_refere_1" class="form-control" maxlength="100" step="0.01" required>
									<label for="temp_refere_1">Temp Refer (°C)</label>
								</div>
							</div>
						</div>
<!-- valor_medido_1  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="valor_medido_1" id="valor_medido_1" class="form-control" maxlength="100" step="0.01" required>
									<label for="valor_medido_1" >Valor Medido (°C)</label>
								</div>
							</div>
						</div>
<!-- correccion_1  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="correccion_1" id="correccion_1" class="form-control" maxlength="100" step="0.01" required>
									<label for="correccion_1" >Corre (°C)</label>
								</div>
							</div>
						</div>
<!-- incertidumbre_1  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="incertidumbre_1" id="incertidumbre_1" class="form-control" maxlength="100" step="0.01" required>
									<label for="incertidumbre_1" >Incerti (°C)</label>
								</div>
							</div>
						</div>
					</div>
<!-- LINEA 7 -->
					<div class="row">
<!-- temp_refere_2  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="temp_refere_2" id="temp_refere_2" class="form-control" maxlength="100" step="0.01" required>
									<label for="temp_refere_2">Temp Refer (°C)</label>
								</div>
							</div>
						</div>
<!-- valor_medido_2 -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="valor_medido_2" id="valor_medido_2" class="form-control" maxlength="100" step="0.01" required>
									<label for="valor_medido_2" >Valor Medido (°C)</label>
								</div>
							</div>
						</div>
<!-- correccion_2  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="correccion_2" id="correccion_2" class="form-control" maxlength="100" step="0.01" required>
									<label for="correccion_2" >Corre (°C)</label>
								</div>
							</div>
						</div>
<!-- incertidumbre_2  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="incertidumbre_2" id="incertidumbre_2" class="form-control" maxlength="100" step="0.01" required>
									<label for="incertidumbre_2" >Incerti (°C)</label>
								</div>
							</div>
						</div>
					</div>
<!-- LINEA 8 -->
					<div class="row">
<!-- temp_refere_3  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="temp_refere_3" id="temp_refere_3" class="form-control" maxlength="100" step="0.01" required>
									<label for="temp_refere_3">Temp Refer (°C)</label>
								</div>
							</div>
						</div>
<!-- valor_medido_3 -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="valor_medido_3" id="valor_medido_3" class="form-control" maxlength="100" step="0.01" required>
									<label for="valor_medido_3" >Valor Medido (°C)</label>
								</div>
							</div>
						</div>
<!-- correccion_3  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="correccion_3" id="correccion_3" class="form-control" maxlength="100" step="0.01" required>
									<label for="correccion_3" >Corre (°C)</label>
								</div>
							</div>
						</div>
<!-- incertidumbre_3  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="incertidumbre_3" id="incertidumbre_3" class="form-control" maxlength="100" step="0.01" required>
									<label for="incertidumbre_3" >Incerti (°C)</label>
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

									Editar Termometros

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
							<!-- inicio -->

							<!-- Equipo -->
							<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<label for="">Equipo</label>
									</div>
								</div>

								<div class="col-9">
									<div class="md-form mt-0">
										<select class="form-control form-control-sm" name="fk_id_equipo" 
											id="fk_id_equipo" required>
											<option value="" class="z-depth-5">Seleccione</option>
												<?php 
														$query = $conexion -> query("SELECT eq.`id_equipo`,eq.`descripcion` FROM eb_equipos  eq
																					WHERE (eq.`descripcion` LIKE '%termo%' OR eq.`descripcion` LIKE 'HIGRO%')
																					AND estado = 'A'");
														while($res = mysqli_fetch_array($query))
														{
																echo "<option value =".$res['id_equipo'].">
																		".$res['descripcion']."
																		</option>";
														}
												?>
										</select>
									</div>
								</div>
							</div>


						

							<div class="row">
								<!-- Fecha calibracion -->
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="date" name="fecha_calibracion" id="fecha_calibracion" class="form-control" required>
											<label for="fecha_calibracion">Fecha calibracion</label>
										</div>
									</div>
								</div>
								<!-- Duracion -->								
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="text" name="duracion" id="duracion" class="form-control" required>
											<label for="duracion">Duracion</label>
										</div>
									</div>
								</div>
							</div>




						<div class="row">
							<!-- temperatura de calibracion -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number"  name="temp_calibra" id="temp_calibra" class="form-control"   step="0.01" required>
										<label for="temp_calibra">Temperatura Calibracion (°C)</label>
									</div>
								</div>
							</div>

							<!-- humedad -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="humedad" id="humedad" class="form-control" step="0.01" required>
										<label for="humedad" >Humedad (%)</label>
									</div>
								</div>
							</div>

							<!-- Exactirtud -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="exactitud" id="exactitud" class="form-control" step="0.01" required>
										<label for="exactitud" >Exactitud (°C)</label>
									</div>
								</div>
							</div>
						</div>

						<!-- Proveedor -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<label for="">Proveedor</label>
								</div>
							</div>

							<div class="col-9">
								<div class="md-form mt-0">
									<select class="form-control form-control-sm" name="fk_id_proveedor" 
										id="fk_id_proveedor" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT pr.`id_proveedor`,pr.`razon_social` FROM eb_proveedores pr
																				 WHERE pr.`estado` = 'A'");
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
							<!--temp_refere_1 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number"  name="temp_refere_1" id="temp_refere_1" class="form-control"   step="0.01" required>
										<label for="temp_refere_1">Temp Refer (°C)</label>
									</div>
								</div>
							</div>

							<!-- valor_medido_1 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="valor_medido_1" id="valor_medido_1" class="form-control" step="0.01" required>
										<label for="valor_medido_1" >Valor Medido (°C)</label>
									</div>
								</div>
							</div>

							<!-- correccion_1 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="correccion_1" id="correccion_1" class="form-control" step="0.01" required>
										<label for="correccion_1" >Corre (°C)</label>
									</div>
								</div>
							</div>

							<!-- incertidumbre_1 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="incertidumbre_1" id="incertidumbre_1" class="form-control" step="0.01" required>
										<label for="incertidumbre_1" >Incerti (°C)</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<!--temp_refere_2 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number"  name="temp_refere_2" id="temp_refere_2" class="form-control"   step="0.01" required>
										<label for="temp_refere_2">Temp Refer (°C)</label>
									</div>
								</div>
							</div>

							<!-- valor_medido_2 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="valor_medido_2" id="valor_medido_2" class="form-control" step="0.01" required>
										<label for="valor_medido_2" >Valor Medido (°C)</label>
									</div>
								</div>
							</div>

							<!-- correccion_2 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="correccion_2" id="correccion_2" class="form-control" step="0.01" required>
										<label for="correccion_2" >Corre (°C)</label>
									</div>
								</div>
							</div>

							<!-- incertidumbre_2 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="incertidumbre_2" id="incertidumbre_2" class="form-control" step="0.01" required>
										<label for="incertidumbre_2" >Incerti (°C)</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<!--temp_refere_3 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number"  name="temp_refere_3" id="temp_refere_3" class="form-control"   step="0.01" required>
										<label for="temp_refere_3">Temp Refer (°C)</label>
									</div>
								</div>
							</div>

							<!-- valor_medido_3 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="valor_medido_3" id="valor_medido_3" class="form-control" step="0.01" required>
										<label for="valor_medido_3" >Valor Medido (°C)</label>
									</div>
								</div>
							</div>

							<!-- correccion_3 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="correccion_3" id="correccion_3" class="form-control" step="0.01" required>
										<label for="correccion_3" >Corre (°C)</label>
									</div>
								</div>
							</div>

							<!-- incertidumbre_3 -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="incertidumbre_3" id="incertidumbre_3" class="form-control" step="0.01" required>
										<label for="incertidumbre_3" >Incerti (°C)</label>
									</div>
								</div>
							</div>
						</div>

						<!-- fin -->


					</div><!-- cierra body  -->

					<div class="modal-footer">

							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>



