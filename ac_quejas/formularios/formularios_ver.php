<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	$FechaHoy=date("d/m/Y : H : i : s");

?>

	<style type="text/css">
		ul {
			list-style-type: none;
			width: 300px;
			height: auto;
			position: absolute;
			margin-top: 10px;
			margin-left: 10px;
		}

		li {
			background-color: #EEEEEE;
			border-top: 1px solid #9e9e9e;
			padding: 5px;
			width: 100%;
			float: left;
			cursor: pointer;
		}
	</style>

<form id="form_productos" action="" method="post" autocomplete="off">

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nueva Queja

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

							<div class="md-form mt-0">

								<div class="md-form">
									Tipo
									<select class="form-control form-control-sm" name="q_o_s" 
										id="q_o_s" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_q_i,desc_q_i FROM kg_queja_incon WHERE estado = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_q_i'].">
																	".$res['desc_q_i']."
																	</option>";
													}
											?>
									</select>

									

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha_queja" id="fecha_queja" class="form-control" maxlength="100" required>

									<label for="desc_p">Fecha Queja </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">
								Origen
								<select class="form-control form-control-sm" name="origen" 
										id="origen" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_origen,desc_origen FROM kg_origen_queja WHERE estado = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_origen'].">
																	".$res['desc_origen']."
																	</option>";
													}
											?>
									</select>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">
									Clasificacion
									<select class="form-control form-control-sm" name="tipo" 
										id="tipo" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_tipo,desc_tipo FROM kg_tipo_queja WHERE estado = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_tipo'].">
																	".$res['desc_tipo']."
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

								<label for="">Medico</label>

							</div>

						</div>



<!--   MEDICO  -->

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="medico" id="medico" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_medico, concat(nombre,'',a_paterno,' ',a_materno) as nombre FROM so_medicos WHERE estado = 'A' and id_medico between 100 and 200");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_medico'].">

																".$res['nombre']."

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

								<label for="">Paciente:</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="paciente" id="paciente" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_cliente,concat(nombre,'',a_paterno,' ',a_materno) as nombre FROM so_clientes WHERE activo = 'A' and id_cliente between 100 and 200");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_cliente'].">

																".$res['nombre']."

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

								<label for="">(interna) Empleado</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="empleado" id="empleado" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_usuario, CONCAT(nombre,'',a_paterno,' ',a_materno) AS nombre  FROM se_usuarios c WHERE activo = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['nombre']."

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

								<label for="">Orden</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="orden" id="orden" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT fa.`id_factura`, CONCAT(fa.`id_factura`,' - ',cl.nombre,'',cl.a_paterno,' ',cl.a_materno) AS nombre FROM so_factura fa, so_clientes cl
													WHERE fa.`id_factura` BETWEEN 278722 AND 278822
													AND fa.`fk_id_cliente` = cl.`id_cliente`");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_factura'].">

																".$res['nombre']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

					</div>

<!-- Sucursal  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Sucursal</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="sucursal" id="sucursal" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_sucursal, desc_sucursal FROM kg_sucursales 
													WHERE estado = 'A' ");

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


					<br>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="inconformidad" name="inconformidad"rows="1"required ></textarea>

									<label for="descripcion">Describa detalladamente la inconformidad</label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="observaciones" name="observaciones"rows="1"required ></textarea>

									<label for="observaciones">Observaciones</label>

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

<script src="js/peticiones.js"></script>



<!-- Editar -->



<form id="frmver" class="form-horizontal" method="POST">

	<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">

		<div class="modal fade" id="form_ver" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

							<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">

									Avance Solucion

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" name="codigo" id="codigo" class="form-control" readonly>

							<label for="codigo">Código</label>

						</div>


<!-- Aqui -->


					<div class="row">


						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="fecha_queja" id="fecha_queja" class="form-control" maxlength="100" required>

									<label for="desc_p">Fecha Queja </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">
								Origen
								<select class="form-control form-control-sm" name="origen" 
										id="origen" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_origen,desc_origen FROM kg_origen_queja WHERE estado = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_origen'].">
																	".$res['desc_origen']."
																	</option>";
													}
											?>
									</select>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">
									Clasificacion
									<select class="form-control form-control-sm" name="tipo" 
										id="tipo" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_tipo,desc_tipo FROM kg_tipo_queja WHERE estado = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_tipo'].">
																	".$res['desc_tipo']."
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

								<label for="">Medico</label>

							</div>

						</div>



<!--   MEDICO  -->

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="medico" id="medico" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_medico, concat(nombre,'',a_paterno,' ',a_materno) as nombre FROM so_medicos WHERE estado = 'A' and id_medico between 100 and 200");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_medico'].">

																".$res['nombre']."

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

								<label for="">Paciente:</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="paciente" id="paciente" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_cliente,concat(nombre,'',a_paterno,' ',a_materno) as nombre FROM so_clientes WHERE activo = 'A' and id_cliente between 100 and 200");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_cliente'].">

																".$res['nombre']."

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

								<label for="">(Interna)Empleado</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="empleado" id="empleado" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_usuario, CONCAT(nombre,'',a_paterno,' ',a_materno) AS nombre  FROM se_usuarios c WHERE activo = 'A'");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['nombre']."

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

								<label for="">Orden</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="orden" id="orden" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT fa.`id_factura`, CONCAT(fa.`id_factura`,' - ',cl.nombre,'',cl.a_paterno,' ',cl.a_materno) AS nombre FROM so_factura fa, so_clientes cl
													WHERE fa.`id_factura` BETWEEN 278722 AND 278822
													AND fa.`fk_id_cliente` = cl.`id_cliente`");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_factura'].">

																".$res['nombre']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

					</div>

<!-- Sucursal  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Sucursal</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="sucursal" id="sucursal" >

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_sucursal, desc_sucursal FROM kg_sucursales 
													WHERE estado = 'A' ");

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


					<br>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="inconformidad" name="inconformidad"rows="1"required ></textarea>

									<label for="descripcion">Describa detalladamente la inconformidad</label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="observaciones" name="observaciones"rows="1"required ></textarea>

									<label for="observaciones">Observaciones</label>

								</div>

							</div>

						</div>

					</div>


<!-- aqui -->

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



