<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	$FechaHoy=date("d/m/Y : H : i : s");

  	$fk_id_perfil=$_SESSION['fk_id_perfil'];
  	$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

    if ($fk_id_perfil==1 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
       $sucursal = "> 0"; 
    }ELSE{
        $sucursal = " = ".$fk_id_sucursal;
    }

?>



<form id="form_productos" action="" method="post">

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Duplica mes

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" disabled name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Códigoooo</label>

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

												$query = $conexion -> query("SELECT id_sucursal,desc_sucursal FROM kg_sucursales 
													WHERE estado = 'A'
													AND id_sucursal $sucursal
													");

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

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Servicio</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="selectpicker form-control form-control-sm" name="servicio" id="servicio" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_servicio,desc_servicio 
													FROM km_servicios 
													WHERE estado = 'A' and tipo_servicio in('G','I','L') 
													");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_servicio'].">

																".$res['desc_servicio']."

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
								<label for="">Responsable </label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select name="medico" id="medico" class="selectpicker form-control form-control-sm" data-live-search="true">
									<option value="">Seleccione</option>
								</select>
								<!--
								<select class="form-control form-control-sm" name="medico" id="medico" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT u.`id_usuario`, CONCAT(u.`nombre`,' ',u.`a_paterno`,' ',u.`a_materno`) nombre FROM se_usuarios u
													WHERE u.`activo` = 'A'
													AND u.`fk_id_servicio` NOT IN (0,1,2,3,7,8,9,13)");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_usuario'].">
																".$res['nombre']."
																</option>";
												}
										?>
								</select>
							-->
							</div>
						</div>
					</div>



					<br>
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date" name="fecha" id="fecha" class="form-control" maxlength="100" required>
									<label for="producto">Fecha</label>
								</div>
							</div>
						</div>


						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="subrrogado" id="subrrogado" class="form-control" maxlength="1" required>

									<label for="producto">Subrrogado (S/N)</label>

								</div>

							</div>

						</div>



					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hinicio" id="hinicio" class="form-control" maxlength="100" required>

									<label for="producto"> Hora Inicio </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hfinal" id="hfinal" class="form-control" maxlength="100">

									<label for="desc_p">Hora Fin </label>

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

									Duplica Horarios mensuales

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


<!-- inicio -->


					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Sucursal</label>

							</div>

						</div>





						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="sucursal" 

								id="sucursal" disabled required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_sucursal,desc_sucursal FROM kg_sucursales 
													WHERE estado = 'A'
													AND id_sucursal $sucursal
													");

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

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Periodo</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="periodo" id="periodo" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT DISTINCT CONCAT (YEAR(fecha) ,'-',MONTHNAME(fecha)) AS periodo,
													CONCAT (YEAR(fecha) ,'-',MONTH(fecha)) AS id
												FROM kg_calendario
												WHERE MONTH(fecha) >  MONTH(CURDATE())
												AND YEAR(fecha) >= YEAR(CURDATE())");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id'].">

																".$res['periodo']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

					</div>


<!--

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<label for="">Responsable Servicio</label>

							</div>

						</div>

						<div class="col-9">

							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="medico" id="medico" required>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT u.`id_usuario`, CONCAT(u.`nombre`,' ',u.`a_paterno`,' ',u.`a_materno`) nombre FROM se_usuarios u
													WHERE u.`activo` = 'A'
													AND u.`fk_id_servicio` NOT IN (0,1,2,3,7,8,9,13)");

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
-->


					<br>


<!--

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha" id="fecha" class="form-control" maxlength="100" required>

									<label for="producto">Fecha</label>

								</div>

							</div>

						</div>


						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="subrrogado" id="subrrogado" class="form-control" maxlength="1" required>

									<label for="producto">Subrrogado (S/N)</label>

								</div>

							</div>

						</div>



					</div>




					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hinicio" id="hinicio" class="form-control" maxlength="100" required>

									<label for="producto"> Hora Inicio </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hfinal" id="hfinal" class="form-control" maxlength="100">

									<label for="desc_p">Hora Fin </label>

								</div>

							</div>

						</div>

					</div>
-->


				</div>



<!-- Final -->

					<div class="modal-footer">

							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>



