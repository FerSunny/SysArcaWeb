<?php
	include("../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');
	$FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="form_clientes" action="" method="post">
	<div class="modal fade" id="myModals" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
						<h2 style="text-align:center; font-weight:500;" class="modal-title">
								Nuevo Empleado
						</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
					<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">
				<div style="color:#000000;background:#EFFBF5" class="modal-body">
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" required name="nombre" id="nombre" class="form-control" maxlength="35" size="35">
									<label for="nombre">Nombre</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" required name="a_paterno" id="a_paterno" class="form-control" maxlength="35" size="35">
										<label for="a_paterno">A.paterno</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" required name="a_materno" id="a_materno" class="form-control" maxlength="35" size="35">
										<label for="a_materno">A.materno</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
							<div class="col">
								<div class="md-form">
									<input type="text" required name="rfc" id="rfc" class="form-control" maxlength="17" size="20" value="XAXX010101000">
										<label for="rfc">RFC</label>
								</div>
							</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date" required name="fecha_nac" id="fecha_nac" class="form-control" maxlength="17" size="20">
								<!--	<i class="fas fa-calculator" style="cursor:pointer;" onclick="Calcular()"></i> -->
									<i class="fas fa-calculator" style="cursor:pointer;" onclick="CalcularEdad()"></i>
									<label for="fecha_nac">Fecha Nacimiento</label>
								</div>
							</div>
						</div>



						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" min="0" max="105" required name="anios" id="anios" class="form-control" maxlength="15" size="20">
									<label for="anios" class="active">Años</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									 <input type="number" min="0" max="11" required name="meses" id="fi_meses" class="form-control" maxlength="15" size="20">
									 <label for="fi_meses">Meses</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									 <input type="number" min="0" max="30" required name="dias" id="dias" class="form-control" maxlength="15" size="20">
									 <label for="dias">Dias</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form form-lg">
									<p>Sexo</p>
									<select required class="selectpicker form-control form-control-sm" name="sexo" id="sexo">
										<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$sexo = 'A';
													$sql="SELECT * FROM so_sexo where activo = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$sexo);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_sexo']."' >";
																	echo $row['desc_sexo'];
																	echo "</option>";
																	}
												?>
										</select>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>Estado Civil</p>
										<select required class="selectpicker form-control  form-control-sm" name="estado_civil" id="estado_civil">
											<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$estado = 'A';
													$sql="SELECT * FROM kg_estado_civil where estado = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$estado);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_estado_civil']."' >";
																	echo $row['desc_estado_civil'];
																	echo "</option>";
																	}
												?>
											</select>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>Puesto</p>
										<select required class="selectpicker form-control  form-control-sm"  name="puesto" id="puesto">
											<option value="" class="z-depth-5">Seleccione</option>
													<?php
														$ocupacion = 'A';
														$sql="SELECT * FROM no_puestos where estado = ?";
														$stmt = $conexion->prepare($sql);
																$stmt->bind_param("s",$ocupacion);
																$stmt->execute();
																$result = $stmt->get_result();
																while($row = $result->fetch_assoc())
																		{

																				echo "<option value='".$row['id_puesto']."' >";
																				echo $row['desc_puesto'];
																				echo "</option>";
																			
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
								<div class="md-form form-lg">
									<p>Empresa</p>
									<select required class="selectpicker form-control form-control-sm" name="empresa" id="empresa">
										<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$sexo = 'A';
													$sql="SELECT * FROM kg_grupos where estado = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$sexo);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_grupo']."' >";
																	echo $row['desc_grupo'];
																	echo "</option>";
																	}
												?>
										</select>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>Sucursal</p>
										<select required class="selectpicker form-control  form-control-sm" name="sucursal" id="sucursal">
											<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$estado = 'A';
													$sql="SELECT * FROM kg_sucursales where estado = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$estado);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_sucursal']."' >";
																	echo $row['desc_sucursal'];
																	echo "</option>";
																	}
												?>
											</select>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>horario</p>
										<select required class="selectpicker form-control  form-control-sm"  name="horario" id="horario">
											<option value="" class="z-depth-5">Seleccione</option>
													<?php
														$ocupacion = 'A';
														$sql="SELECT * FROM no_horarios where estado = ?";
														$stmt = $conexion->prepare($sql);
																$stmt->bind_param("s",$ocupacion);
																$stmt->execute();
																$result = $stmt->get_result();
																while($row = $result->fetch_assoc())
																		{

																				echo "<option value='".$row['id_horario']."' >";
																				echo $row['desc_horario'];
																				echo "</option>";
																			
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
									<input type="number"  name="t_fijo" id="t_fijo" maxlength="15" size="15"  class="form-control" >
									<label for="t_fijo">Tel. Fijo:</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" required name="movil" id="movil"  class="form-control"  maxlength="15" size="15">
									<label for="movil">Tel. Movil:</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="email" name="mail" id="mail"  class="form-control"  maxlength="50" size="40">
									<label for="mail">Mail:</label>
								</div>
							</div>
						</div>
					</div>

					
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form form-lg">
										<p>Estado</p>
										<select require class="selectpicker form-control  form-control-sm" data-live-search="true" name="edo" id="edo">
											<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$estado = 'A';
													$sql="SELECT * FROM ku_estados where estado = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$estado);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_estado']."' >";
																	echo $row['desc_estado'];
																	echo "</option>";
																	}
												?>
											</select>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>Municipio</p>
									<select name="muni" id="muni" class="selectpicker form-control form-control-sm" data-live-search="true">
										<option value="">Seleccione</option>
									</select>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										 <p>Localidad</p>
										<select  name="loca" id="loca" class="selectpicker form-control form-control-sm" data-live-search="true">
											<option value="">Seleccione</option>
										</select>
									</div>
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" required name="colonia" id="colonia" class="form-control" maxlength="50" size="50">
									<label for="colonia">Colonia</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" required name="cp" id="cp" class="form-control" maxlength="6" size="6">
									<label for="cp">CP</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" required name="calle" id="calle" class="form-control" maxlength="150" size="60">
									<label for="calle">Calle</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" required name="numero" id="numero" class="form-control" maxlength="35" size="35">
									<label for="numero">Numero</label>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date" required name="fecha_ing" id="fecha_ing" class="form-control" maxlength="17" size="20">
								<!--	<i class="fas fa-calculator" style="cursor:pointer;" onclick="Calcular()"></i> -->
									<i class="fas fa-calculator" style="cursor:pointer;" onclick="CalcularAntiguedad()"></i>
									<label for="fecha_nac">Fecha Ingreso</label>
								</div>
							</div>
						</div>



						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" min="0" max="105" required name="anios_ant" id="anios_ant" class="form-control" maxlength="15" size="20">
									<label for="anios" class="active">Años</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									 <input type="number" min="0" max="11" required name="meses_ant" id="meses_ant" class="form-control" maxlength="15" size="20">
									 <label for="fi_meses">Meses</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									 <input type="number" min="0" max="30" required name="dias_ant" id="dias_ant" class="form-control" maxlength="15" size="20">
									 <label for="dias">Dias</label>
								</div>
							</div>
						</div>
					</div>



					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form form-lg">
									<p>Turno</p>
									<select required class="selectpicker form-control form-control-sm" name="turno" id="turno">
										<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$sexo = 'A';
													$sql="SELECT * FROM no_turnos where estado = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$sexo);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_turno']."' >";
																	echo $row['desc_turno'];
																	echo "</option>";
																	}
												?>
										</select>
									</div>
								</div>
							</div>

							<div class="col">
							<div class="md-form mt-0">
								<div class="md-form form-lg">
									<p>Departamento</p>
									<select required class="selectpicker form-control form-control-sm" name="dpto" id="dpto">
										<option value="" class="z-depth-5">Seleccione</option>
												<?php
													$sexo = 'A';
													$sql="SELECT * FROM km_areas where estado = ?";
													$stmt = $conexion->prepare($sql);
															$stmt->bind_param("s",$sexo);
															$stmt->execute();
															$result = $stmt->get_result();
															while($row = $result->fetch_assoc())
																	{
																	echo "<option value='".$row['id_area']."' >";
																	echo $row['desc_area'];
																	echo "</option>";
																	}
												?>
										</select>
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


<!-- Editar -->

<form id="frmedit" class="form-horizontal" method="POST">
	<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
		<div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
							<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">
									Editar Paciente
							</h2>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<input type="hidden" id="idcliente" name="idcliente" value="0">
					<div style="color:#000000;background:#EFFBF5" class="modal-body">
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" required name="nombre" id="nombre" class="form-control" maxlength="35" size="35">
										<label for="nombre">Nombre</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" required name="a_paterno" id="a_paterno" class="form-control" maxlength="35" size="35">
											<label for="a_paterno">A.paterno</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" required name="a_materno" id="a_materno" class="form-control" maxlength="35" size="35">
											<label for="a_materno">A.materno</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
								<div class="col">
									<div class="md-form">
										<input type="text" required name="rfc" id="rfc" class="form-control" maxlength="17" size="20" value="XAXX010101000">
											<label for="rfc">RFC</label>
									</div>
								</div>
						</div>

						<div class="row">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date" required name="fecha_nac" id="fecha_nac" class="form-control" maxlength="17" size="20">
								<!--	<i class="fas fa-calculator" style="cursor:pointer;" onclick="Calcular()"></i> -->
									<i class="fas fa-calculator" style="cursor:pointer;" onclick="CalcularEdadMo()"></i>
									<label for="fecha_nac">Fecha Nacimiento</label>
								</div>
							</div>
							
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" min="0" max="105" required name="anios" id="anios" class="form-control" maxlength="15" size="20">
										<label for="anios">Años</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										 <input type="number" min="0" max="12" required name="meses" id="meses" class="form-control" maxlength="15" size="20">
										 <label for="meses">Meses</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										 <input type="number" min="0" max="30" required name="dias" id="dias" class="form-control" maxlength="15" size="20">
										 <label for="dias">Dias</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>Sexo</p>
										<select required class="selectpicker form-control form-control-sm" name="sexo" id="sexo">
											<option value="" class="z-depth-5">Seleccione</option>
													<?php
														$sexo = 'A';
														$sql="SELECT * FROM so_sexo where activo = ?";
														$stmt = $conexion->prepare($sql);
																$stmt->bind_param("s",$sexo);
																$stmt->execute();
																$result = $stmt->get_result();
																while($row = $result->fetch_assoc())
																		{
																		echo "<option value='".$row['id_sexo']."' >";
																		echo $row['desc_sexo'];
																		echo "</option>";
																		}
													?>
											</select>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form form-lg">
											<p>Estado Civil</p>
											<select required class="selectpicker form-control  form-control-sm" name="estado_civil" id="estado_civil">
												<option value="" class="z-depth-5">Seleccione</option>
													<?php
														$estado = 'A';
														$sql="SELECT * FROM kg_estado_civil where estado = ?";
														$stmt = $conexion->prepare($sql);
																$stmt->bind_param("s",$estado);
																$stmt->execute();
																$result = $stmt->get_result();
																while($row = $result->fetch_assoc())
																		{
																		echo "<option value='".$row['id_estado_civil']."' >";
																		echo $row['desc_estado_civil'];
																		echo "</option>";
																		}
													?>
												</select>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form form-lg">
											<p>Ocupación</p>
											<select required class="selectpicker form-control  form-control-sm" data-live-search="true" name="ocupacion" id="ocupacion">
												<option value="" class="z-depth-5">Seleccione</option>
														<?php
															$ocupacion = 'A';
															$sql="SELECT * FROM kg_ocupaciones where estado = ?";
															$stmt = $conexion->prepare($sql);
																	$stmt->bind_param("s",$ocupacion);
																	$stmt->execute();
																	$result = $stmt->get_result();
																	while($row = $result->fetch_assoc())
																			{
																			echo "<option value='".$row['id_ocupacion']."' >";
																			echo $row['desc_ocupacion'];
																			echo "</option>";
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
										<input type="number"  name="t_fijo" id="t_fijo" maxlength="15" size="15"  class="form-control" >
										<label for="t_fijo">Tel. Fijo:</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" required name="movil" id="movil"  class="form-control"  maxlength="15" size="15">
										<label for="movil">Tel. Movil:</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="email" name="mail" id="mail"  class="form-control"  maxlength="50" size="40">
										<label for="mail">Mail:</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
											<p>Estado</p>
											<select require class="selectpicker form-control  form-control-sm" data-live-search="true" name="edo" id="edo">
												<option value="" class="z-depth-5">Seleccione</option>
													<?php
														$estado = 'A';
														$sql="SELECT * FROM ku_estados where estado = ?";
														$stmt = $conexion->prepare($sql);
																$stmt->bind_param("s",$estado);
																$stmt->execute();
																$result = $stmt->get_result();
																while($row = $result->fetch_assoc())
																		{
																		echo "<option value='".$row['id_estado']."' >";
																		echo $row['desc_estado'];
																		echo "</option>";
																		}
													?>
												</select>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form form-lg">
											<p>Municipio</p>
										<select name="muni" id="muni" class="selectpicker form-control form-control-sm" data-live-search="true">
											<option value="">Seleccione</option>
										</select>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form form-lg">
											 <p>Localidad</p>
											<select  name="loca" id="loca" class="selectpicker form-control form-control-sm" data-live-search="true">
												<option value="">Seleccione</option>
											</select>
										</div>
									</div>
								</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" required name="colonia" id="colonia" class="form-control" maxlength="50" size="50">
										<label for="colonia">Colonia</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" required name="cp" id="cp" class="form-control" maxlength="6" size="6">
										<label for="cp">CP</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" required name="calle" id="calle" class="form-control" maxlength="150" size="60">
										<label for="calle">Calle</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" required name="numero" id="numero" class="form-control" maxlength="35" size="35">
										<label for="numero">Numero</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="date" required name="f_alta" id="f_alta" maxlength="15" size="15" class="form-control">
										<label for="f_alta">Fecha alta</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="f_actu" id="f_actu" maxlength="15" size="20" class="form-control">
										<label for="f_actu">Fecha actualizacion</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form form-lg">
										<p>Estado</p>
											<select class="selectpicker form-control  form-control-sm" id="estado" name="estado">
											<option value="A">Activo</option>
											<option value="S">Suspendido</option>
											</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="custom-control custom-checkbox">
									<p>Acepta Publicidad</p>
									<select class="selectpicker form-control  form-control-sm" id="box_publicidad" name="box_publicidad">
										<option value=1>Acepto</option>
										<option value=0>No Acepto</option>
									</select>
									<!--
									 <input type="checkbox" class="custom-control-input"  name="box_publicidad" id="box_publicidad"  value="1" checked>
										<label class="custom-control-label" for="box_publicidad">Acepto publicidad</label>
									-->
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
