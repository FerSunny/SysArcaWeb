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

								Nueva Meta

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

								<div class="md-form"> Anio

									<input type="number" name="anio" id="anio" class="form-control"
									min="2017" maxlength="2024" value="2022"  step="1" >

								</div>

							</div>

						</div>


						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form"> Mes

								<select class="form-control form-control-sm" name="mes" 
								id="mes" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_mes,desc_mes FROM kg_meses ");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_mes'].">

																".$res['desc_mes']."

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

									<input type="number"  name="importe" id="importe" class="form-control" min="1" maxlength="5" step="0.01" value="1"  required>

									<label for="costo">Importe</label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number" name="notas" id="notas" class="form-control" min="1" maxlength="5" value="1"  step="0.01"  required>

									<label for="utilidad">Notas</label>

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

												$query = $conexion -> query("SELECT id_sucursal,desc_sucursal FROM kg_sucursales  WHERE estado = 'A'");

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

									Editar Meta

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

								<div class="md-form"> Anio

									<input type="number" name="anio" id="anio" class="form-control"
									min="2017" maxlength="2024" value="2022"  step="1" >

								</div>

							</div>

						</div>


						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form"> Mes

								<select class="form-control form-control-sm" name="mes" 
								id="mes" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_mes,desc_mes FROM kg_meses ");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_mes'].">

																".$res['desc_mes']."

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

									<input type="number"  name="importe" id="importe" class="form-control" min="1" maxlength="5" step="0.01" value="1"  required>

									<label for="costo">Importe</label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number" name="notas" id="notas" class="form-control" min="1" maxlength="5" value="1"  step="0.01"  required>

									<label for="utilidad">Notas</label>

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

												$query = $conexion -> query("SELECT id_sucursal,desc_sucursal FROM kg_sucursales  WHERE estado = 'A'");

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



