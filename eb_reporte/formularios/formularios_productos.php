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

								Nuevo Reporte

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

									<!--
									<input type="text" name="descripcion" id="descripcion" class="form-control" maxlength="100" required>
								-->
									<textarea type="text" rows="2" cols="50" name="problema" id="problema" class="form-control" maxlength="100" required> </textarea>
									<label for="producto"> Describa el problema </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="dequipo" id="dequipo" class="form-control" maxlength="100">

									<label for="desc_p">Descripción Equipo (temporal) </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date"  name="freporte" id="freporte" class="form-control"  required>
									<label for="costo">Fecha Reporte</label>
								</div>
							</div>
						</div>



						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="prioridad" id="prioridad" class="form-control" max="3 "min="1" maxlength="5" vlue="1"  step="1" required>
									<label for="utilidad">Prioridad (1-3)</label>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Equipo</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="equipo" 
								id="equipo" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_equipo,descripcion FROM eb_equipos WHERE estado = 'A'");
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


					<br>

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

									Editar Solicitud

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" reasdonly name="codigo" id="codigo" class="form-control" required>

							<label for="codigo">Código</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<textarea type="text" rows="2" cols="50" name="problema" id="problema" class="form-control" maxlength="100" required> </textarea>

										<label for="producto">Descripcion del problema</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="dequipo" id="dequipo" class="form-control" required>

										<label for="desc_p">Descripción equipo (temporal)</label>

									</div>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="date" name="fecha" id="fecha" class="form-control" required>

										<label for="costo">Fecha Reporte</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="prioridad" id="prioridad" class="form-control" value="0" step="1"  required>

										<label for="utilidad">Proioridad</label>

									</div>

								</div>

							</div>

						</div>

						<div class="row"><br>

							<div class="col">

								<div class="md-form mt-4">

									<label for="">Equipo</label>

								</div>

							</div>

							<div class="col-9">

								<div class="md-form mt-0">

									<select class="form-control form-control-sm" name="equipo" 

									id="equipo" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 

													$query = $conexion -> query("SELECT id_equipo,descripcion FROM eb_equipos WHERE estado = 'A'");

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



