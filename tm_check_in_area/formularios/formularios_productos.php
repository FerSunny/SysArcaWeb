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

								Orden der Impresion

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Escriba el numero para ordenar la sucursal (1,2,3,4....), para imprimir  (0 = No, 1 = Si)</label>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="tulye" id="tulye" class="form-control" maxlength="5" value="14"  required>
									<input type="text" class="custom-control" name="box_tulye" id="box_tulye" value="0" maxlength="1" size="1">
									<label for="producto"> Tulye </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="tlahuac" id="tlahuac" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_tlahuac" id="box_tlahuac" value="0" maxlength="1" size="1">
									<label for="desc_p">Tlahuac </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="gregorio" id="gregorio" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_gregorio" id="box_gregorio" value="0" maxlength="1" size="1">
									<label for="producto"> San Gregorio </label>
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="xochimilco" id="xochimilco" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_xochimilco" id="box_xochimilco" value="0" maxlength="1" size="1">
									<label for="desc_p">Xochimilco </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="dino" id="dino" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_dino" id="box_dino" value="0" maxlength="1" size="1">
									<label for="producto"> Division Norte </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="santiago" id="santiago" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_santiago" id="box_santiago" value="0" maxlength="1" size="1">
									<label for="desc_p">Santiago </label>
								</div>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="pablo" id="pablo" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_pablo" id="box_pablo" value="0" maxlength="1" size="1">
									<label for="producto"> San Pablo </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="pedro" id="pedro" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_pedro" id="box_pedro" value="0" maxlength="1" size="1">
									<label for="desc_p">San Pedro </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="milpa" id="milpa" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_milpa" id="box_milpa" value="0" maxlength="1" size="1">
									<label for="producto"> Milpa Alta </label>
								</div>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="tecomitl" id="tecomitl" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_tecomitl" id="box_tecomitl" value="0" maxlength="1" size="1">
									<label for="desc_p"> Tecomitl </label>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="tetelco" id="tetelco" class="form-control" maxlength="5" value="14" required>
									<input type="text" class="custom-control" name="box_tetelco" id="box_tetelco" value="0" maxlength="1" size="1">
									<label for="producto"> Tetelco </label>
								</div>
							</div>
						</div>
					</div>

					<br>

				</div>

				<div class="modal-footer">

						<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>
<!--
						<button type="button" onclick="location.href='./reports/list_work.php';" class="btn btn-primary pull-right menu" ><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Imprimir Hoja de trabajo</button>
-->
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

									Rechazar Muestra

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input readonly type="text" name="codigo" id="codigo" class="form-control" required>

							<label for="codigo">Id</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<textarea id="observa" name="observa" rows="4" cols="50">
Escriba aquí el detalle del rechazo de la muestra.
</textarea>

										<label for="producto">Observaciones</label>

									</div>

								</div>

							</div>



						</div>

						<div class="row"><br>

							<div class="col">

								<div class="md-form mt-4">

									<label for="">Motivo</label>

								</div>

							</div>

							<div class="col-9">

								<div class="md-form mt-0">

									<select class="form-control form-control-sm" name="motivo" 

									id="motivo" required>

										<option value="" class="z-depth-5">Seleccione</option>

											<?php 

													$query = $conexion -> query("SELECT re.`id_rechazo`, re.`desc_rechazo` FROM kg_rechazos re WHERE re.`estado` = 'A'");

													while($res = mysqli_fetch_array($query))

													{

															echo "<option value =".$res['id_rechazo'].">

																	".$res['desc_rechazo']."

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

									Sucursal: <br>
									<input type="radio" name="si_sucursal" value="1" checked /> Si<br />
									<input type="radio" name="si_sucursal" value="0"  /> No<br />

									<label for="producto">Envio por email</label>

								</div>

							</div>

						</div>

					</div>


					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									Sucursal: <input size="35" readonly type="text" name="email_sucursal" id="email_sucursal"  /><br />

									<label for="producto">Email de envio</label>

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



