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
								Nuevo Producto
						</h2>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div style="color:#000000;background:#EFFBF5" class="modal-body">
				<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<label for="">producto</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="producto" 
								id="producto" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_producto,producto FROM eb_productos WHERE estado = 'A'");
												while($res = mysqli_fetch_array($query))
												{
														echo "<option value =".$res['id_producto'].">
																".$res['producto']."
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
								<label for="">proveedor</label>
							</div>
						</div>
						<div class="col-9">
							<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="proveedor" 
								id="proveedor" required>
									<option value="" class="z-depth-5">Seleccione</option>
										<?php 
												$query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A'");
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
								<div class="md-form">
									<input type="number"  name="exis" id="exis" class="form-control" maxlength="5" step="0.01" >
									<label for="costo">Existencia</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="mini" id="mini" class="form-control"   step="0.01" >
									<label for="utilidad">Minimo</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="maxi" id="maxi" class="form-control" step="0.01" >
									<label for="maxi" >Maximo</label>
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
									Editar Productos
							</h2>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div style="color:#000000;background:#EFFBF5" class="modal-body">
						<input type="hidden" id="idperfil" name="idperfil" value="0">
						<input type="hidden" id="opcion" name="opcion" value="modificar">
						<input type="hidden" class="form-control  form-control-sm" id="id_unidades" name="id_unidades">
							 <div class="col-9">

						 <div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<label for="">Producto</label>
								</div>
							</div>
							<div class="col-9">
								<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="producto" id="producto" required>
										<option value="" for="producto"class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_producto,producto FROM eb_productos WHERE estado = 'A'");
													while($res = mysqli_fetch_array($query))
													{
															echo "<option value =".$res['id_producto'].">
																	".$res['producto']."
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
									<label for="">Proveedores</label>
								</div>
							</div>
							<div class="col-9">
								<div class="md-form mt-0">
								<select class="form-control form-control-sm" name="proveedor" 
									id="proveedor" required>
										<option value="" class="z-depth-5">Seleccione</option>
											<?php 
													$query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A'");
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
									<div class="md-form">
										<input type="number" name="exis" id="exis" class="form-control" required>
										<label for="costo">Existencia</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="min" id="min" class="form-control" value="0" required>
										<label for="utilidad">Minimo</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="number" name="max" id="max" class="form-control"  required>
										<label for="c_total" id="max">Maximo</label>
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

