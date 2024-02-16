<?php 
	include("../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');
	$FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="form_provee" action="" method="post">
		<div class="modal fade" id="myModals" role="dialog">
				<div class="modal-dialog modal-lg">
				<!-- Modal content-->
						<div class="modal-content">
								<div class="modal-header">
									<h2 style="color:blue;text-align:center" class="modal-title">
											Nuevo Proveedor
									</h2>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div style="color:#000000;background:" class="modal-body">
									<div class="row">
										<div class="col">
											<div class="md-form mt-0">
												<div class="md-form">
													<input type="text" name="provee" id="provee" class="form-control" maxlength="100" required>
														<label for="provee">Proveedor</label>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="md-form mt-0">
											<div class="md-form">
												<input type="text" name="respon" id="respon" class="form-control" maxlength="100" required>
													<label for="respon">Responsable</label>
											</div>
										</div>
									</div>
									<div class="col">
										 <div class="md-form mt-0">
											 <div class="md-form">
													<input type="number" name="n_cel" id="n_cel" class="form-control" maxlength="15" required>
													<label for="n_cel">Celular del responsable</label>
										</div>
									</div>
								</div>
							</div>
									
								<label for="direc">Dirección</label>

									<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											Estado
											<select required class="form-control form-control-sm" name="edo" id="edo"  >
												<option value="" class="z-depth-5">Seleccione</option>
														<?php
															$sql="SELECT * FROM ku_estados where estado = 'A'";
															$rec=mysqli_query($conexion,$sql);
															while ($row=mysqli_fetch_array($rec))
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
										<div class="md-form">
											Municipio
										<select name="muni" id="muni" class="form-control" >
											
										</select>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											Localidad
											<select  name="loca" id="loca" class=" form-control">
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="tel" name="calle" id="calle" class="form-control" maxlength="20" required>
											<label for="calle">Calle</label>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="tel" name="col" id="col" class="form-control" maxlength="20" required>
											<label for="col">Colonia</label>
										</div>
									</div>
								</div>
									<div class="col">
										<div class="md-form mt-0">
											<div class="md-form">
												<input type="number" name="cp" id="cp" class="form-control" minlength="5" maxlength="5" required>
													<label for="cp">CP</label>
										</div>
									</div>
								</div>
								 <div class="col">
										<div class="md-form mt-0">
											<div class="md-form">
												<input type="number" name="tel" id="tel" class="form-control" minlength="10" maxlength="20" required>
													<label for="tel">Teléfono</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="email" name="email" id="email" placeholder="usuario@example.com" class="form-control">
											<label for="email">E-mail</label>
										</div>
									</div>
								</div>
									<div class="col">
										 <div class="md-form mt-0">
											 <div class="md-form">
													<input type="url"  name="web" id="web" class="form-control" placeholder="https://example.com" pattern="https://.*" size="30">
													<label for="web">Sitio web</label>
										</div>
									</div>
								</div>
							</div>
						</div>
								<div class="modal-footer">
										<button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
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
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
										<div class="modal-header">
												<h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">
														Editar Proveedor
												</h2>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
								<div style="color:#000000;background:" class="modal-body">
									<input type="hidden" id="prov" name="prov" value="0">
									<div class="row">
										<div class="col">
											<div class="md-form mt-0">
												<div class="md-form">
													<input type="text" name="provee" id="provee" class="form-control" maxlength="100" required>
														<label for="provee">Proveedor</label>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="md-form mt-0">
											<div class="md-form">
												<input type="text" name="respon" id="respon" class="form-control" maxlength="100" required>
													<label for="respon">Responsable</label>
											</div>
										</div>
									</div>
									<div class="col">
										 <div class="md-form mt-0">
											 <div class="md-form">
													<input type="text" name="n_cel" id="n_cel" class="form-control" maxlength="15" required>
													<label for="n_cel">Celular del responsable</label>
										</div>
									</div>
								</div>
								</div>
									
								<label for="direc">Dirección</label>

									<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											Estado
											<select required class="form-control form-control-sm" name="edo" id="edo"  >
												<option value="" class="z-depth-5">Seleccione</option>
														<?php
															$sql="SELECT * FROM ku_estados where estado = 'A'";
															$rec=mysqli_query($conexion,$sql);
															while ($row=mysqli_fetch_array($rec))
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
										<div class="md-form">
											Municipio
										<select name="muni" id="muni" class="form-control" >
											
										</select>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											Localidad
											<select  name="loca" id="loca" class=" form-control">
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="tel" name="calle" id="calle" class="form-control" maxlength="20" required>
											<label for="calle">Calle</label>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="tel" name="col" id="col" class="form-control" maxlength="20" required>
											<label for="col">Colonia</label>
										</div>
									</div>
								</div>
									<div class="col">
										 <div class="md-form mt-0">
												<div class="md-form">
													<input type="number" name="cp" id="cp" class="form-control" minlength="5" maxlength="5" required>
													<label for="cp">CP</label>
										</div>
									</div>
								</div>
								 <div class="col">
										<div class="md-form mt-0">
												<div class="md-form">
													<input type="number" name="tel" id="tel" class="form-control" minlength="10" maxlength="20" required>
													<label for="tel">Teléfono</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="md-form mt-0">
										<div class="md-form">
											<input type="email" name="email" id="email" placeholder="usuario@example.com" class="form-control">
											<label for="email">E-mail</label>
										</div>
									</div>
								</div>
									<div class="col">
										 <div class="md-form mt-0">
											 <div class="md-form">
													<input type="url" name="web" id="web" class="form-control" placeholder="https://example.com" pattern="https://.*" size="30">
													<label for="web">Sitio web</label>
										</div>
									</div>
								</div>
							</div>
						</div>
								<div class="modal-footer">
										<button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								</div>
						</div>
				</div>
		</div>
	</div>
</form>