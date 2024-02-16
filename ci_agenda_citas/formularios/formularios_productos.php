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

								Nuevo Dia

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" name="codigo" id="codigo" class="form-control"  maxlength="15" required readonly>

						<label for="codigo">Código</label>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-1">
								<div class="md-form">
									<input type="date" name="dia" id="dia" class="form-control"  required>
									<label for="producto"> Dia a crear </label>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col">
							<div class="md-form mt-1">
								<label for="">Servicio</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="servicio" 
								id="servicio" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT te.* FROM km_tipo_estudio te");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_tipo_estudio'].">
																".$res['nombre_tipo_estudio']."
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

									Asignar cita

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" name="codigo" id="codigo" class="form-control" readonly required>

							<label for="codigo">Código</label>

						</div>

						<div class="row">
<!-- Hora -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="hora" id="hora" class="form-control"  readonly required>

										<label for="hora">Hora</label>

									</div>

								</div>

							</div>

<!-- tiempo -->
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="tiempo" id="tiempo" class="form-control" min="30" max="120" step="30" required>
										<label for="tiempo">Tiempo (min)</label>
									</div>
								</div>
							</div>
						</div>

<!-- Sucursal -->
					<div class="row">
						<div class="col"><br>
							<div class="md-form mt-4">
								<label for="sucursal">Sucursal</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="sucursal" id="sucursal" required>
									<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$estado = 'A';
													$sql="SELECT su.`id_sucursal`,
																	su.`desc_sucursal`
																FROM kg_sucursales su
																WHERE su.`estado` = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$estado);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_sucursal']."' >";
																	echo $row['desc_sucursal'];
																	echo "</option>";
																	}
												?>
								</select>
							</div>
						</div>
					</div>

<!-- estudio -->
					<div class="row">
						<div class="col"><br>
							<div class="md-form mt-4">
								<label for="sucursal">Estudio</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="estudio" id="estudio" required>
									<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$estado = 'A';
													$sql="SELECT es.id_estudio,es.`desc_estudio` FROM km_estudios es
													WHERE es.fk_id_tipo_estudio = 5  and es.estatus = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$estado);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_estudio']."' >";
																	echo $row['desc_estudio'];
																	echo "</option>";
																	}
												?>
								</select>
							</div>
						</div>
					</div>


<!-- Medico -->
					<div class="row">
						<div class="col"><br>
							<div class="md-form mt-4">
								<label for="">Medico</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="medico" id="medico" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT 
																			us.id_usuario,
																			CONCAT(us.`nombre`,
																			us.`a_paterno`,
																			us.`a_materno`) AS medico
																			FROM se_usuarios us
																			WHERE us.`activo` = 'A'
																			AND us.`fk_id_servicio` IN(5,6,4,10)
																			");

												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_usuario'].">

																".$res['medico']."

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



