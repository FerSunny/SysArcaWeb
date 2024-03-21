<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	//$FechaHoy=date("d/m/Y : H : i : s");
	$FechaHoy = date("F j, Y, g:i a"); 

?>



<form id="form_productos" action="" method="post">

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nueva Medicion

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
								<label for="">Equipo</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="fk_id_equipo" 
								id="fk_id_equipo" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT
																			eq.`id_equipo`,
																			CONCAT(eq.`descripcion`,'-',se.`desc_abreviada`,'-',ar.`desc_area`) AS descripcion
																			FROM 
																			vw_termos te
																			,eb_equipos eq
																			,km_servicios se
																			,km_areas ar
																			WHERE te.`estado` = 'A'
																			AND te.`fk_id_equipo` = eq.`id_equipo`
																			AND eq.`fk_id_servicio` = se.`id_servicio`
																			AND eq.`fk_id_area` = ar.`id_area`
																			");
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
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="temperatura" id="temperatura" class="form-control" step="0.01" required>
									<label for="pasillo">Medicion</label>
								</div>
							</div>
						</div>

					</div>					


					<br>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" readonly name="fecha_registro" id="fecha_registro" class="form-control" value=" <?php echo $FechaHoy ?>" required>

									<label for="producto">Fecha Registro</label>

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

									Editar Medicion

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text"  readonly name="codigo" id="codigo" class="form-control" required>

							<label for="codigo">Código</label>

						</div>


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
												$query = $conexion -> query("SELECT
																	eq.`id_equipo`,
																	CONCAT(eq.`descripcion`,'-',se.`desc_abreviada`,'-',ar.`desc_area`) AS descripcion
																	FROM 
																	vw_termos te
																	,eb_equipos eq
																	,km_servicios se
																	,km_areas ar
																	WHERE te.`estado` = 'A'
																	AND te.`fk_id_equipo` = eq.`id_equipo`
																	AND eq.`fk_id_servicio` = se.`id_servicio`
																	AND eq.`fk_id_area` = ar.`id_area`");
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
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="temperatura" id="temperatura" class="form-control" step="0.01"  required>
									<label for="temperatura">Temperatura</label>
								</div>
							</div>
						</div>

					</div>	





					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" readonly name="fecha_registro" id="fecha_registro" class="form-control" required>

									<label for="fecha_registro">Fecha Regitro</label>

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



