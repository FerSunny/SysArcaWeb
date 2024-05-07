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

<form id="form_productos" autocomplete="off" action="" method="post">




	<div class="modal fade" id="myModals" role="dialog">







		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nuevo Evento

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="date" name="fecha" id="fecha" class="form-control" maxlength="100" required>

									<label for="producto"> Fecha </label>

								</div>

							</div>

						</div>

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="hora" id="hora" class="form-control" maxlength="100">

									<label for="desc_p">Hora Inicio</label>

								</div>

							</div>

						</div>
<!-- Duracion -->
						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="time" name="duracion" id="duracion" class="form-control" >

									<label for="desc_p">Hora Termino</label>

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
												$query = $conexion -> query("SELECT id_sucursal,desc_corta FROM kg_sucursales WHERE estado = 'A' AND id_sucursal <> 11");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_sucursal'].">
																".$res['desc_corta']."
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
									<input type="text"  name="observa" id="observa" class="form-control"  required>
									<label for="pasillo">Observaciones</label>
								</div>
							</div>
						</div>
					</div>	
<!-- Paciente  -->
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

<!-- Estudio  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Estudio:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input autocomplete="off" type="text" id="estudio_id" name="estudio_id" onkeyup="autocompletar_e()">
			                    <ul id="lista_id_e"></ul>
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



<form id="frmedit" class="form-horizontal" autocomplete="off" action="" method="POST">

	<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">

		<div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

							<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">

									Editar evento

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
<!-- fecha  -->
						<div class="row">

							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="date" name="fecha" id="fecha" class="form-control" required>

										<label for="producto">Fecha</label>

									</div>

								</div>

							</div>
<!-- hora -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="hora" id="hora" class="form-control" required>

										<label for="desc_p">Hora inicio</label>

									</div>

								</div>

							</div>

<!-- tiempo -->
							<div class="col">

								<div class="md-form mt-0">

									<div class="md-form">

										<input type="time" name="duracion" id="duracion" class="form-control" required>

										<label for="desc_p">Hora termino</label>

									</div>

								</div>

							</div>

						</div>
<!-- sucursal -->
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
													$query = $conexion -> query("SELECT id_sucursal,desc_corta FROM kg_sucursales WHERE estado = 'A' AND id_sucursal <> 11");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_sucursal'].">
																	".$res['desc_corta']."
																	</option>";
													}
											?>
									</select>
								</div>
							</div>
						</div>	
<!-- area -->

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
<!-- observaciones -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text"  name="observa" id="observa" class="form-control"  required>
									<label for="pasillo">Observaciones</label>
								</div>
							</div>
						</div>
					</div>	
<!-- Paciente  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Paciente:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input autocomplete="off" readonly type="text" id="cliente_id" name="cliente_id" onkeyup="autocompletar_p()">
			                    <ul id="lista_id"></ul>
			                </div>
						</div>
					</div>

<!-- Estudio  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Estudio:</label>
							</div>
						</div>
						<div class="col-9">          
			                <div class="input_container">
			                    <input autocomplete="off" readonly type="text" id="estudio_id" name="estudio_id" onkeyup="autocompletar_e()">
			                    <ul id="lista_id_e"></ul>
			                </div>
						</div>
					</div>
<!--
					</div>
-->
					<div class="modal-footer">

							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>



