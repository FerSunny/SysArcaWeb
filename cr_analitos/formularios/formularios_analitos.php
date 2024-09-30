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

								Nuevo Analito

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" name="codigo" id="codigo" class="form-control"  maxlength="15" readonly required>

						<label for="codigo">Código</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="desc_analito" id="desc_analito" class="form-control" maxlength="100" required>

									<label for="producto"> Descripción </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="abreviacion" id="abreviacion" class="form-control" size="5" maxlength="50">

									<label for="desc_p">Abreviatura </label>

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
								<select class="form-control form-control-sm" name="fk_id_sexo" 
								id="fk_id_sexo" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_sexo,desc_sexo FROM so_sexo WHERE activo = 'A'");
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
									<input type="number"  name="edad_inicial" id="edad_inicial" class="form-control" min="1" maxlength="5" step="0.01" required>
									<label for="costo">Edad Inical</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="edad_final" id="edad_final" class="form-control" min="1" maxlength="5"  step="0.01"  required>
									<label for="utilidad">Edad Final</label>
								</div>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="limite_inferior" id="limite_inferior" class="form-control"  step="0.01" required>
									<label for="pasillo">Limite Inferiror</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="limite_superior" id="limite_superior" class="form-control" step="0.01" required>
									<label for="Anaquel">Limite Superior</label>
								</div>
							</div>
						</div>

\					</div>	

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">U. Medida</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="fk_id_unidad_medida" 
								id="fk_id_unidad_medida" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_unidad_medida,desc_unidad_medida FROM cr_unidad_medida WHERE estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_unidad_medida'].">
																".$res['desc_unidad_medida']."
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
									<input type="text"  name="qs_680" id="qs_680" class="form-control"  required>
									<label for="pasillo">qs-680</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="xn_550" id="xn_550" class="form-control" required>
									<label for="Anaquel">xn-550</label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="h8" id="h8" class="form-control" required>
									<label for="Anaquel">h8</label>
								</div>
							</div>
						</div>
					</div>		

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text"  name="alinity" id="alinity" class="form-control"  required>
									<label for="pasillo">Alinity</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="uro" id="uro" class="form-control" required>
									<label for="Anaquel">Uro</label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
								<!--	
									<input type="text" name="bibliografia" id="bibliografia" class="form-control" required>
								-->
									<textarea class="form-control" name="bibliografia" id="bibliografia" rows="1"></textarea>
									<label for="Anaquel">Bibliografia</label>
								</div>
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

									Editar Analitos

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

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="desc_analito" id="desc_analito" class="form-control" required>

										<label for="producto">Descripcion</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="text" name="abreviacion" id="abreviacion" class="form-control" required>

										<label for="desc_p">Abreviacion</label>

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
								<select class="form-control form-control-sm" name="fk_id_sexo" 
								id="fk_id_sexo" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_sexo,desc_sexo FROM so_sexo WHERE activo = 'A'");
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

										<input type="number" name="edad_inicial" id="edad_inicial" class="form-control" step="0.01" required>

										<label for="costo">Edad Inicial</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="edad_final" id="edad_final" class="form-control" value="0" step="0.01" onkeyup="calcular(2)" required>

										<label for="utilidad">Edad Final</label>

									</div>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="limite_inferior" id="limite_inferior" class="form-control" step="0.01" required>

										<label for="costo">Limite Inferior</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="limite_superior" id="limite_superior" class="form-control" value="0" step="0.01" required>

										<label for="utilidad">Limite Superior</label>

									</div>

								</div>

							</div>

						</div>


					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">U. Medida</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="fk_id_unidad_medida" 
								id="fk_id_unidad_medida" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_unidad_medida,desc_unidad_medida FROM cr_unidad_medida WHERE estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_unidad_medida'].">
																".$res['desc_unidad_medida']."
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
									<input type="text"  name="qs_680" id="qs_680" class="form-control"  required>
									<label for="pasillo">qs_680</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="xn_550" id="xn_550" class="form-control" required>
									<label for="Anaquel">xn_550</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="h8" id="h8" class="form-control" >
									<label for="h8" id="Nivel">h8</label>
								</div>
							</div>
						</div>
					</div>	

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text"  name="alinity" id="alinity" class="form-control"  required>
									<label for="pasillo">alinity</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="uro" id="uro" class="form-control" required>
									<label for="Anaquel">uro</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<textarea class="form-control" name="bibliografia" id="bibliografia" rows="1"></textarea>
									<label for="h8" id="Nivel">bibliografia</label>
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



