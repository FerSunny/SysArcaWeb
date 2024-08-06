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

								Nuevo Detalle de lote

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" name="codigo" id="codigo" class="form-control"  maxlength="15" required>
						<input type="text" name="lopte" id="lote" class="form-control"  maxlength="15" required>
						<label for="codigo">Código/Lote</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="hentrada" id="hentrada" class="form-control" maxlength="100" required>

									<label for="producto"> Hora Entrada </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="hsalida" id="hsalida" class="form-control" maxlength="100">

									<label for="desc_p">hora salida </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="decimal"  name="temref" id="temref" class="form-control" min="1" maxlength="5" step="0.01" required>

									<label for="costo">Temp. Ref</label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="decimal" name="temamb" id="temamb" class="form-control" min="1" maxlength="5" value="1"  step="0.01"  required>

									<label for="utilidad">Utilidad</label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="decimal" name="temcon" id="temcon" class="form-control" min="1" maxlength="5" value="1"  step="0.01"  required>

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

									Detalle del Envio

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
							<input type="text" readonly name="fecha_toma" id="fecha_toma" class="form-control" required>
							<input type="text" readonly name="equipo" id="equipo" class="form-control" required>					
							<label for="codigo">Mochila</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="hora_llegada" id="hora_llegada" class="form-control" required>

										<label for="producto">Hora Llegada</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="hora_salida" id="hora_salida" class="form-control" required>

										<label for="desc_p">Hora salida</label>

									</div>

								</div>

							</div>
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="decimal" name="temperatura" id="temperatura" class="form-control" value="0" step="0.01" required>

										<label for="temperatura">Temperatura</label>

									</div>

								</div>

							</div>
						</div>
<!--
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="decimal" name="tem_ref" id="tem_ref" class="form-control" value="0" step="0.01"  required>

										<label for="temp. Refere">temp. Refere</label>

									</div>

								</div>

							</div>



							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="decimal" name="tem_amb" id="tem_amb" class="form-control" value="0" step="0.01"  required>

										<label for="Temp. ambie">Temp. ambie</label>

									</div>

								</div>

							</div>

											
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="decimal" name="tem_con" id="tem_con" class="form-control" value="0" step="0.01"  required>

										<label for="Temp. Cong">Temp. Cong</label>

									</div>

								</div>

							</div>


						</div>
											-->
<!--
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="t_d" id="t_d" class="form-control" value="0" step="1"  required>

										<label for="T.D">T.D</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="t_r" id="t_r" class="form-control" value="0" step="1"  required>

										<label for="T.R">T.R</label>

									</div>

								</div>

							</div>


							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="t_m" id="t_m" class="form-control" value="0" step="1"  required>

										<label for="T.M.">T.M.</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="t_a" id="t_a" class="form-control" value="0" step="1"  required>

										<label for="T.A.">T.A.</label>

									</div>

								</div>

							</div>
						</div>

											-->
<!--
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="t_sec_sue" id="t_sec_sue" class="form-control" value="0" step="1"  required>

										<label for="t.sec.sue">t.sec.sue</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="t_sec_pla" id="t_sec_pla" class="form-control" value="0" step="1"  required>

										<label for="t.sec.pla">t.sec.pla</label>

									</div>

								</div>

							</div>


							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="fro_san" id="fro_san" class="form-control" value="0" step="1"  required>

										<label for="fro.san">fro.san</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="fro_eod" id="fro_eod" class="form-control" value="0" step="1"  required>

										<label for="fro.eod">fro.eod</label>

									</div>

								</div>

							</div>
						</div>
											-->

<!--											
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="fro_cul" id="fro_cul" class="form-control" value="0" step="1"  required>

										<label for="fro.cul">fro.cul</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="fro_cult" id="fro_cult" class="form-control" value="0" step="1"  required>

										<label for="fro.cult">fro.cult</label>

									</div>

								</div>

							</div>


							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="ego_uro" id="ego_uro" class="form-control" value="0" step="1"  required>

										<label for="ego.uro">ego.uro</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="heces" id="heces" class="form-control" value="0" step="1"  required>

										<label for="heces">heces</label>

									</div>

								</div>

							</div>
						</div>
											-->
<!--
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="bx_o_fco_esteril" id="bx_o_fco_esteril" class="form-control" value="0" step="1"  required>

										<label for="bx.o.fco.esteril">bx.o.fco.esteril</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="ecg_traz" id="ecg_traz" class="form-control" value="0" step="1"  required>

										<label for="ecg.traz">ecg.traz</label>

									</div>

								</div>

							</div>


							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="pap" id="pap" class="form-control" value="0" step="1"  required>

										<label for="pap">pap</label>

									</div>

								</div>

							</div>

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="med_stu" id="med_stu" class="form-control" value="0" step="1"  required>

										<label for="med.stu">med.stu</label>

									</div>

								</div>

							</div>
						</div>
											
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="med_liq" id="med_liq" class="form-control" value="0" step="1"  required>

										<label for="med_liq">med_liq</label>

									</div>

								</div>

							</div>


						</div>

-->

						<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Termometro</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="termometro" 
								id="termometro" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT
																			e.id_equipo,
																			e.`descripcion`
																			FROM eb_equipos e
																			WHERE e.`descripcion` LIKE 'TERMO%' AND e.estado = 'A' order by 2");
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



