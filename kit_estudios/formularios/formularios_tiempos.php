<?php 
	include("../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');
	$FechaHoy=date("d/m/Y : H : i : s");
	$fk_id_sucursal = $_SESSION['fk_id_sucursal_usr'];

?>

<form id="form_productos" action="" method="post">
	<div class="modal fade" id="myModals" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<h2 style="color:blue;text-align:center" class="modal-title">
								Nuevo Tiempo
						</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div style="color:#000000;background:#EFFBF5" class="modal-body">

				<input type="hidden"  name="id_estudio" value = "<?php echo $studio ?>">



					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Puesto</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="puesto" 
								id="puesto" >
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT `id_puesto`, `desc_puesto`, `sueldo_diario` FROM `bd_arca`.`se_puestos` WHERE estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_puesto'].">
																".$res['desc_puesto']."
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
									<input type="text" name="tiempo" id="tiempo" class="form-control" maxlength="7" required>
									<label for="Tiempo">Tiempo (min)</label>
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
									Editar Tiempos
							</h2>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div style="color:#000000;background:#EFFBF5" class="modal-body">
						<input type="hidden" id="idperfil" name="idperfil" value="0">
						<input type="hidden" id="opcion" name="opcion" value="modificar">
						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">
						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						
						<div class="md-form">
							<input type="hidden" noetry  name="id_tiempo" id="id_tiempo" class="form-control" required>
							<label for="codigo">Id</label>
						</div>
<!--
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="codigo" id="codigo" class="form-control" maxlength="10" required value="0">
									<label for="producto">Codigo</label>
								</div>
							</div>
						</div>
					</div>
-->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">Puesto</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="puesto" 
								id="puesto" >
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT `id_puesto`, `desc_puesto`, `sueldo_diario` FROM `bd_arca`.`se_puestos` WHERE estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_puesto'].">
																".$res['desc_puesto']."
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
									<input type="text" name="tiempo" id="tiempo" class="form-control" maxlength="7" required>
									<label for="Tiempo">Tiempo (min)</label>
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

