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

								Nuevo Concepto

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

								<div class="md-form mt-0"> Estudio

									<select class="form-control form-control-sm" name="estudio"

										id="estudio" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 
													$query = $conexion -> query("SELECT es.id_estudio, es.iniciales FROM km_estudios es
																		WHERE es.estatus = 'A' and es.fk_id_plantilla in (1,2) order by es.iniciales");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_estudio'].">
																	".$res['iniciales']."
																	</option>";
													}
											?>
									</select>

								</div>

							</div>

								<div class="md-form mt-0"> Concepto

									<select name="concepto" id="concepto" class="form-control"> 
									</select>

								</div>

						</div>



						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="edadi" id="edadi" class="form-control" step="0.01"  required>

										<label for="costo">Edad Inicial</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="edadf" id="edadf" class="form-control" step="0.01" required>

										<label for="edadfinal">Edad Final</label>

									</div>

								</div>

							</div>

						</div>





					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Genero</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="genero" id="genero" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT se.`id_sexo`, se.`desc_sexo` FROM so_sexo se
																		WHERE se.`activo` = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_sexo'].">

																".$res['desc_sexo']."

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

										<input type="number" name="rangoi" id="rangoi" class="form-control" step="0.01"  required>

										<label for="costo">Rango Inferior</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="rangof" id="rangof" class="form-control" step="0.01" required>

										<label for="edadfinal">Rango Superior</label>

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

									Editar Conceptos

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="id_plantilla" name="id_plantilla" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" name="codigo" id="codigo" class="form-control" required readonly>

							<label for="codigo">Código</label>

						</div>

						<div class="md-form">

							<input type="text" name="id_estudio" id="id_estudio" class="form-control" required readonly>

							<label for="codigo">id estudio</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0"> Estudio

									<select class="form-control form-control-sm" name="estudio" disabled

										id="estudio" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 
													$query = $conexion -> query("SELECT es.id_estudio, es.iniciales FROM km_estudios es
																		WHERE es.estatus = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_estudio'].">
																	".$res['iniciales']."
																	</option>";
													}
											?>
									</select>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="concepto" id="concepto" class="form-control" required readonly>

										<label for="desc_p">Concepto</label>

									</div>

								</div>

							</div>

						</div>



						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="edadi" id="edadi" class="form-control" step="0.01"  required>

										<label for="costo">Edad Inicial</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="edadf" id="edadf" class="form-control" value="0" step="0.01" required>

										<label for="edadfinal">Edad Final</label>

									</div>

								</div>

							</div>

						</div>

						<div class="row"><br>

							<div class="col">

								<div class="md-form mt-4">

									<label for="">Genero</label>

								</div>

							</div>

							<div class="col-9">

								<div class="md-form mt-0">

									<select class="form-control form-control-sm" name="genero" 

										id="genero" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 
													$query = $conexion -> query("SELECT se.`id_sexo`, se.`desc_sexo` FROM so_sexo se
																		WHERE se.`activo` = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_sexo'].">
																	".$res['desc_sexo']."
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

										<input type="number" name="rangoi" id="rangoi" class="form-control" step="0.01"  required>

										<label for="costo">Rango Inferior</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="rangof" id="rangof" class="form-control" value="0" step="0.01" required>

										<label for="edadfinal">Rango Superior</label>

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



