<?php 
	include("../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');
	$FechaHoy=date("d/m/Y : H : i : s");
	$lote = $_SESSION['lote'];
?>

<form id="form_productos" action="" method="post">
	<div class="modal fade" id="myModals" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<h2 style="color:blue;text-align:center" class="modal-title">
								Asigna Lote
						</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div style="color:#000000;background:#EFFBF5" class="modal-body">
					<div class="md-form">
						<input type="text" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>
						<label for="codigo">Lote</label>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" readonly name="producto" id="producto" class="form-control" maxlength="100" required>
									<label for="producto"> Asignara a todas las muestras de lista  el lote</label>
								</div>
							</div>
						</div>
					</div>


				</div>
				<div class="modal-footer">
						<button type="submit" class="btn btn-success" id="btniniciar">Asignar</button>
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
									Editar Paciente
							</h2>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div style="color:#000000;background:#EFFBF5" class="modal-body">
						<input type="hidden" id="idperfil" name="idperfil" value="0">
						<input type="hidden" id="opcion" name="opcion" value="modificar">
						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">
						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">
						<div class="md-form">
							<input type="text" name="codigo" id="codigo" class="form-control" readonly="">
							<label for="codigo">Id.</label>
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="nombre" id="nombre" class="form-control" required>
										<label for="nombre">Nombre</label>
									</div>
								</div>
							</div>
							<!--
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="desc_p" id="desc_p" class="form-control" required>
										<label for="desc_p">Descripción larga</label>
									</div>
								</div>
							</div>
						-->
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="a_paterno" id="a_paterno" class="form-control" required>
										<label for="Paterno">A. Paterno</label>
									</div>
								</div>
							</div>
						<!--
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="utilidad" id="utilidad" class="form-control" value="0" step="0.01" onkeyup="calcular(2)" required>
										<label for="utilidad">Utilidad</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="c_total" id="c_total" class="form-control" step="0.000000000001" required>
										<label for="c_total" id="lbl_total">Precio</label>
									</div>
								</div>
							</div>
						-->
						</div>
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="a_materno" id="a_materno" class="form-control" required>
										<label for="costo">A. Materno</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="edad" id="edad" class="form-control" required>
										<label for="costo">Edad</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<label for="">Sexo</label>
								</div>
							</div>
							<div class="col-9">
								<div class="md-form mt-0">
									<select class="form-control form-control-sm" name="id_sexo" id="id_sexo" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_sexo,desc_sexo FROM so_sexo WHERE activo = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_sexo'].">
																	".$res['desc_sexo']."
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

