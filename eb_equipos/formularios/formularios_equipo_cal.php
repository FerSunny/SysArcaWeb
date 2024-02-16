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

								Nuevo Mantenimiento Preventivo

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">
<!--
					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>
-->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

								<textarea class="form-control" id="descripcion" name="descripcion"rows="3"required ></textarea>

								<label for="descripcion">Describa detalladamente el servicio</label>

								</div>

							</div>

						</div>
					</div>
<!-- Mes de servicio  -->
					<div class="row">
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">Mes Servicio

									<input type="month" name="mes" id="mes" class="form-control"  required>

								</div>

							</div>
						</div>
<!-- Mes de servicio  -->
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="number" name="dia" id="dia" class="form-control" min="00" max="31" >

									<label for="producto"> Dia Servicio </label>

								</div>

							</div>

						</div>

					</div>

<!-- hora incio  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hora_inicio" id="hora_inicio" class="form-control" maxlength="100" >

									<label for="hora_inicio"> Hora Inicio </label>

								</div>

							</div>

						</div>
<!-- Hora final  -->
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hora_final" id="hora_final" class="form-control"  >

									<label for="hora_final"> Hora Final </label>

								</div>

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

								<select class="form-control form-control-sm" name="proveedor" 

								id="proveedor" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A' order by 2");

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

								<label for="">Responsable</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="responsable" 

								id="responsable" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT a.id_usuario,CONCAT(a.nombre,' ',a.a_paterno,' ',a.a_materno) AS responsable FROM se_usuarios a WHERE a.activo = 'A' order by 2");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['responsable']."

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

								<label for="">Contacto Usu</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="contacto" id="contacto" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT a.id_usuario,CONCAT(a.nombre,' ',a.a_paterno,' ',a.a_materno) AS responsable FROM se_usuarios a WHERE a.activo = 'A' order by 2");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['responsable']."

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

									Editar Equipos

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

							<label for="codigo">Código</label>

						</div>

						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

									<textarea class="form-control" id="descripcion" name="descripcion"rows="3"required ></textarea>

									<label for="descripcion">Describa el detalle del servicio</label>

									</div>

								</div>

							</div>
						</div>
<!-- mes -->
						<div class="row">
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="month" name="mes" id="mes" class="form-control" maxlength="100" required>

										<label for="mes"> Mes del servicio </label>

									</div>

								</div>

							</div>
<!-- dia -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="number" name="dia" id="dia" class="form-control" min="0" max="31" required>

										<label for="dia"> Dia servicio </label>

									</div>

								</div>

							</div>

						</div>

<!-- hora inicio -->
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="hora_inicio" id="hora_inicio" class="form-control" maxlength="100" required>

										<label for="hora_inicio"> Hora Inicio</label>

									</div>

								</div>

							</div>
<!-- hora final -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="hora_final" id="hora_final" class="form-control"  required>

										<label for="hora_final"> Hora Final </label>

									</div>

								</div>

							</div>


						</div>

<!-- proveedor -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Proveedor</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="proveedor" 

								id="proveedor" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A' order by 2");

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

<!-- responsable  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Responsable</label>

							</div>

						</div>





						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="responsable" 

								id="responsable" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT a.id_usuario,CONCAT(a.nombre,' ',a.a_paterno,' ',a.a_materno) AS responsable FROM se_usuarios a WHERE a.activo = 'A' order by 2");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['responsable']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

<!-- contacto -->						

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Contacto</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="contacto" id="contacto" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT a.id_usuario,CONCAT(a.nombre,' ',a.a_paterno,' ',a.a_materno) AS responsable FROM se_usuarios a WHERE a.activo = 'A' order by 2");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_usuario'].">

																".$res['responsable']."

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



