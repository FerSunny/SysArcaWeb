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

								Nuevo servicio

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
<!-- problema  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

								<textarea class="form-control" id="problema" name="problema"rows="3"required ></textarea>

								<label for="descripcion">Describa detalladamente el problema</label>

								</div>

							</div>

						</div>
					</div>

					<!-- solucion  -->
					<div class="row">
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

								<textarea class="form-control" id="solucion" name="solucion"rows="3"required ></textarea>

								<label for="descripcion">Describa detalladamente el la solucion</label>

								</div>

							</div>

						</div>
					</div>


					<!-- observaciones  -->
					<div class="row">
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

								<textarea class="form-control" id="observaciones" name="observaciones"rows="3"required ></textarea>

								<label for="descripcion">Describa las observaciones</label>

								</div>

							</div>

						</div>
					</div>


<!-- Fecha Reporte  -->
					<div class="row">
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">Fecha Reporte

									<input type="date" name="reporte" id="reporte" class="form-control"  required>
									<!-- <label for="producto"> Fecha Reporte </label> -->

								</div>

							</div>
						</div>
<!-- Fecha inicio -->
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form"> Hora Inicio

									<input type="datetime-local" name="hora_inicio" id="hora_inicio" class="form-control" min="00" max="31" >

									<!-- <label for="producto"> Hora Inicio </label> -->

								</div>

							</div>

						</div>

					</div>

<!-- Fecha Final  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">Hora Final

									<input type="datetime-local" name="hora_final" id="hora_final" class="form-control" maxlength="100" >

									<!-- <label for="hora_final"> Hora Final </label> -->

								</div>

							</div>

						</div>

					</div>

<!-- proveedor  -->
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

						

					</div>

					
<!-- Contsacto usuario  -->
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


<!-- tipo  -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Tipo</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="tipo" id="tipo" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT a.id_tipo,desc_tipo FROM eb_tipos_mto a WHERE a.estado = 'A' ORDER BY 2");

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

<!-- Origen  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Origen</label>
							</div>
						</div>

						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="origen" id="origen" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT a.id_origen,desc_origen FROM eb_origen_mto a WHERE a.estado = 'A' ORDER BY 2");
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

									Editar Servicio

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


<!-- problema  -->
<div class="row">

<div class="col">

	<div class="md-form mt-0">

		<div class="md-form">

		<textarea class="form-control" id="problema" name="problema"rows="3"required ></textarea>

		<label for="descripcion">Describa detalladamente el problema</label>

		</div>

	</div>

</div>
</div>

<!-- solucion  -->
<div class="row">
<div class="col">

	<div class="md-form mt-0">

		<div class="md-form">

		<textarea class="form-control" id="solucion" name="solucion"rows="3"required ></textarea>

		<label for="descripcion">Describa detalladamente el la solucion</label>

		</div>

	</div>

</div>
</div>


<!-- observaciones  -->
<div class="row">
<div class="col">

	<div class="md-form mt-0">

		<div class="md-form">

		<textarea class="form-control" id="observaciones" name="observaciones"rows="3"required ></textarea>

		<label for="descripcion">Describa las observaciones</label>

		</div>

	</div>

</div>
</div>


<!-- Fecha Reporte  -->
<div class="row">
<div class="col">

	<div class="md-form mt-0">

		<div class="md-form">Fecha Reporte

			<input type="date" name="reporte" id="reporte" class="form-control"  required>
			<!-- <label for="producto"> Fecha Reporte </label> -->

		</div>

	</div>
</div>
<!-- Fecha inicio -->
<div class="col">

	<div class="md-form mt-0">

		<div class="md-form"> Hora Inicio

			<input type="datetime-local" name="hora_inicio" id="hora_inicio" class="form-control" min="00" max="31" >

			<!-- <label for="producto"> Hora Inicio </label> -->

		</div>

	</div>

</div>

</div>

<!-- Fecha Final  -->
<div class="row">

<div class="col">

	<div class="md-form mt-0">

		<div class="md-form">Hora Final

			<input type="datetime-local" name="hora_final" id="hora_final" class="form-control" maxlength="100" >

			<!-- <label for="hora_final"> Hora Final </label> -->

		</div>

	</div>

</div>

</div>

<!-- proveedor  -->
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



</div>


<!-- Contsacto usuario  -->
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


<!-- tipo  -->
<div class="row">

<div class="col">

	<div class="md-form mt-0">

		<label for="">Tipo</label>

	</div>

</div>

<div class="col-9">

	<div class="md-form mt-0">

		<select class="form-control form-control-sm" name="tipo" id="tipo" required>

			<option value="" class="z-depth-5">Seleccione</option>

				<?php 

						$query = $conexion -> query("SELECT a.id_tipo,desc_tipo FROM eb_tipos_mto a WHERE a.estado = 'A' ORDER BY 2");

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

<!-- Origen  -->
<div class="row">
<div class="col">
	<div class="md-form mt-0">
		<label for="">Origen</label>
	</div>
</div>

<div class="col-9">
	<div class="md-form mt-0">
		<select class="form-control form-control-sm" name="origen" id="origen" required>
			<option value="" class="z-depth-5">Seleccione</option>
				<?php 
						$query = $conexion -> query("SELECT a.id_origen,desc_origen FROM eb_origen_mto a WHERE a.estado = 'A' ORDER BY 2");
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



