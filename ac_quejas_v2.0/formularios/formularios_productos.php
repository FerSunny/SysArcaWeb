<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	$FechaHoy=date("d/m/Y : H : i : s");

?>



	<link rel="stylesheet" href="css/style.css" />
<style type="text/css">
*{ font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif}
.main{ margin:auto; border:1px solid #7C7A7A; width:40%; text-align:left; padding:30px; background:#85c587}
input[type=submit]{ background:#6ca16e; width:100%;
    padding:5px 15px; 
    background:#ccc; 
    cursor:pointer;
    font-size:16px;
   
}
input[type=text]{ margin: 5px;
   
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





<!--   MEDICO  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Medico:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input autocomplete="off" type="text" name="medico_id" id="medico_id" onkeyup="autocompletar_m()">
			                    <ul id="lista_id_m"></ul>
			                </div>
						</div>
					</div>

<!-- paciete -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Paciente:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input autocomplete="off" type="text" id="cliente_id" name="cliente_id" onkeyup="autocompletar_p()">
			                    <ul id="lista_id"></ul>
			                </div>
						</div>
					</div>

<!-- orden -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Orden:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input autocomplete="off" type="text" id="orden_id" name="orden_id" onkeyup="autocompletar_o()">
			                    <ul id="lista_id_o"></ul>
			                </div>
						</div>
					</div>

<!-- empleado -->

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



<!-- seccion Editar la queja-->



<form id="frmedit" class="form-horizontal" method="POST">

	<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">

		<div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

							<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">

									Editar Productos

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

									<input type="text" name="fecha_queja" id="fecha_queja" class="form-control" maxlength="100" readonly>

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



<!--   MEDICO  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Medico:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input readonly autocomplete="off" type="text" name="medico_id" id="medico_id" onkeyup="autocompletar_m()">
			                    <ul id="lista_id_m"></ul>
			                </div>
						</div>
					</div>

<!-- paciete -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Paciente:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input readonly autocomplete="off" type="text" id="cliente_id" name="cliente_id" onkeyup="autocompletar_p()">
			                    <ul id="lista_id"></ul>
			                </div>
						</div>
					</div>

<!-- orden -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Orden:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input readonly autocomplete="off" type="text" id="orden_id" name="orden_id" onkeyup="autocompletar_o()">
			                    <ul id="lista_id_o"></ul>
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

<!-- secccion para darle seguimiento a la quieja-->



<form id="frmver" class="form-horizontal" method="POST">

	<div id="cuadro9" class="col-sm-12 col-md-12 col-lg-12 ocultar">

		<div class="modal fade" id="form_ver" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

							<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">

									Avance solucion

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



<!-- fecha de la queja -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="fecha_queja" id="fecha_queja" class="form-control" maxlength="100" readonly>

									<label for="desc_p">Fecha Queja </label>

								</div>

							</div>

						</div>

					</div>
<!-- fecha de la asiganacion -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="fecha_asignacion" id="fecha_asignacion" class="form-control" maxlength="100" readonly>

									<label for="desc_p">Fecha Asignacion </label>

								</div>

							</div>

						</div>

					</div>
<!-- fecha de la atencion -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="fecha_solucion" id="fecha_solucion" class="form-control" maxlength="100" readonly>

									<label for="desc_p">Fecha Solucion </label>

								</div>

							</div>

						</div>

					</div>

<!--  inconfomridad -->

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="inconformidad" name="inconformidad"rows="1"required readonly></textarea>

									<label for="descripcion">Describa detalladamente la inconformidad</label>

								</div>

							</div>

						</div>

					</div>
<!--  observaciomnes -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="observaciones" name="observaciones"rows="1"required readonly></textarea>

									<label for="observaciones">Observaciones</label>

								</div>

							</div>

						</div>

					</div>

<!--  Problema -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="problema" name="problema"rows="1" readonly ></textarea>

									<label for="observaciones">Describa el problema que origino el la queja</label>

								</div>

							</div>

						</div>

					</div>

<!--  Causas -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="causas" name="causas"rows="1" readonly ></textarea>

									<label for="observaciones">Describa la causa que origino el problema</label>

								</div>

							</div>

						</div>

					</div>

<!--  solucion -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="solucion" name="solucion"rows="1" readonly ></textarea>

									<label for="observaciones">Describa la solucion al problema</label>

								</div>

							</div>

						</div>

					</div>
<!--  acciones -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<textarea class="form-control" id="acciones" name="acciones"rows="1" readonly ></textarea>

									<label for="observaciones">Describa las acciones para no repetir el problema</label>

								</div>

							</div>

						</div>

					</div>

<!-- estatus  -->
					<div class="row">


						<div class="col-9">
							Estatus
							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="estatus" id="estatus" disabled>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_estatus, desc_estatus FROM kg_queja_estatus 
													WHERE estado = 'A' AND id_estatus IN (7,3) ");

												while($res = mysqli_fetch_array($query))

												{

														echo "<option value =".$res['id_estatus'].">

																".$res['desc_estatus']."

																</option>";

												}

										?>

								</select>

							</div>

						</div>

					</div>


<!-- sucursal  -->
					<div class="row">



						<div class="col-9">
							Sucursal de atencion
							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="sucursal" id="sucursal" disabled>

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

<!-- servicio  -->
					<div class="row">



						<div class="col-9">
							Servicio de atencion
							<div class="md-form mt-0">

								<select class="form-control form-control-sm" name="servicio" id="servicio" disabled>

									<option value="" class="z-depth-5">Seleccione</option>

										<?php 

												$query = $conexion -> query("SELECT id_servicio, desc_servicio FROM km_servicios 
													WHERE estado = 'A' ");

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

<!-- aqui -->

					</div>

					<div class="modal-footer">
<!--
							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>
-->
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>


