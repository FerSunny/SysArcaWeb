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

								Nuevo Propuesta

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
									<textarea name="situacion" id="situacion" class="form-control" rows="1" required > </textarea> 
									<label for="producto"> Situacion Inicial </label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<textarea name="origen" id="origen" class="form-control" rows="1" required> </textarea>
									<label for="desc_p">Origen </label>
								</div>
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

								<select class="form-control form-control-sm" name="area" 

								id="area" required>

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
								<div class="md-form">
									<textarea name="causas" id="causas" class="form-control" rows="3" >Que sucede?, Que comentarios ha recibido al respecto?, Que se puede mejorar? </textarea> 
									<label for="producto"> Deteccion de las principales causas de la situacion </label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<textarea name="objetivo" id="objetivo" class="form-control" rows="3" >Cual es el proposito del plan de mejora?, Que espera del plan de mejora? </textarea> 
									<label for="producto"> Formulacion del objetivo </label>
								</div>
							</div>
						</div>
					</div>


					<div class="row">

						<div class="col-9">
						¿Se requiere modificar o generar algún documento?
							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="doc" 

								id="doc" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_boleana,desc_boleana FROM kg_si_no WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_boleana'].">

																".$res['desc_boleana']."

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
									<textarea name="cual" id="cual" class="form-control" rows="3" >Mencione el nombre del documento </textarea> 
									<label for="producto"> Cual? </label>
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

									Editar Propuestas

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
									<textarea name="situacion" id="situacion" class="form-control" rows="1" required > </textarea> 
									<label for="producto"> Situacion Inicial </label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<textarea name="origen" id="origen" class="form-control" rows="1" required> </textarea>
									<label for="desc_p">Origen </label>
								</div>
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

								<select class="form-control form-control-sm" name="area" 

								id="area" required>

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
								<div class="md-form">
									<textarea name="causas" id="causas" class="form-control" rows="3" >Que sucede?, Que comentarios ha recibido al respecto?, Que se puede mejorar? </textarea> 
									<label for="producto"> Deteccion de las principales causas de la situacion </label>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<textarea name="objetivo" id="objetivo" class="form-control" rows="3" >Cual es el proposito del plan de mejora?, Que espera del plan de mejora? </textarea> 
									<label for="producto"> Formulacion del objetivo </label>
								</div>
							</div>
						</div>
					</div>


					<div class="row">

						<div class="col-9">
						¿Se requiere modificar o generar algún documento?
							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="doc" 

								id="doc" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_boleana,desc_boleana FROM kg_si_no WHERE estado = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_boleana'].">

																".$res['desc_boleana']."

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
									<textarea name="cual" id="cual" class="form-control" rows="3" >Mencione el nombre del documento </textarea> 
									<label for="producto"> Cual? </label>
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



