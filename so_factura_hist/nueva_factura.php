<?php
session_start();
date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	$title="Nueva Factura";

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

//session_start();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    	include("head.php");
			if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
		  {
    ?>
  </head>
	  <body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
		include("../includes/barra.php");
		include("create-cliente.php"); 
	?>
	
    <div class="container">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4><i class='glyphicon glyphicon-edit'></i> Nueva Factura <?php echo $_SESSION['fk_id_sucursal']?></h4>
				</div>
				<div class="panel-body">
					<?php
					//	include("modal/buscar_productos.php");
						//include("modal/registro_clientes.php");
				//		include("modal/registro_productos.php");
					?>


						<form class="form-horizontal" role="form" id="form-factura" action="">
							
							<div class="form-group row">


							<!-- cliente -->
							  <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
								   <div class="col-md-3">
										
										<select id="nombre_cliente" name="nombre_cliente" class="js-data-example-ajax col-md-12">
										</select>
										
								    </div>


							<!-- telefono  -->
							  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
										<div class="col-md-2">
											<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
										</div>
							
							<!-- Mail  -->
								<label for="mail" class="col-md-1 control-label">Email</label>
										<div class="col-md-3">
											<input type="email" class="form-control input-sm" ilo d="mail" placeholder="Email" readonly>
										</div>
							</div>

							 <!-- Renglon 2 -->

							 <div class="form-group row">

							 		<!-- VENDEDEDOR -->
									<label for="empresa" class="col-md-1 control-label">Vendedor</label>
									<div class="col-md-3">
										<select class="form-control input-sm" id="id_vendedor">
											<option disabled selected value> -- selecciona una opción -- </option>
											<?php

												$sql_vendedor=mysqli_query($con,"select * from se_usuarios WHERE activo = 'A' and fk_id_sucursal = ".$fk_id_sucursal);
												while ($rw=mysqli_fetch_array($sql_vendedor)){
													$id_vendedor=$rw["id_usuario"];
													$nombre_vendedor=$rw["nombre"]." ".$rw["a_paterno"];
													if ($id_vendedor==$_SESSION['id_usuario']){
														$selected="selected";
													} else {
														$selected="";
													}
													?>
													<option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
													<?php
												}
											?>
										</select>
									</div>

									<!-- FECHA -->
									<label for="tel2" class="col-md-1 control-label">Fecha</label>
									<div class="col-md-2">
										<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
									</div>

									<!-- fecha de entrega -->
									<label  class="control-label pull-left">Fecha de entrega</label>
									<div class="col-md-2">
										<input type="datetime-local" name="fechaentrega" class="form-control " id="fechaentrega" style="width:145%;">
									</div>

								 </div>



							<!-- Renglon 3 -->

							 <div class="form-group row">

							 			<!-- MEDICO -->
										<label for="f_medico" class="col-md-1 control-label">Medico</label>
										<div class="col-md-3">
											<select class='form-control input-sm' id="fi_medico" name="fi_medico">
											    
												<option disabled selected value> -- selecciona una opción -- </option>
												
												<?php
							                      $sql="SELECT * FROM so_medicos where estado = 'A' order by nombre,a_paterno,a_materno";
												  $rec=mysqli_query($con,$sql);
												  //$a_paterno=$row['a_paterno']=='a_paterno'?"":$row['a_paterno'];
												  //$a_materno=$row['a_materno']=='a_materno'?"":$row['a_materno'];
							                      while ($row=mysqli_fetch_array($rec))
							                        {
							                          echo "<option value='".$row['id_medico']."' >";
							                          echo $row['nombre'] .' '. $row['a_paterno'] .' '. $row['a_materno'];
							                          echo "</option>";
							                        }
							                    ?>
											</select>
										</div>

										<!-- AFECTA COMISION -->
										<label class="col-md-1 control-label">Comision</label>
												<div class="col-md-2">
													<select class='form-control ' id="fi_comision" name="fi_comision">
													<option disabled selected value> -- selecciona una opción -- </option>
														<option value="1">Si</option>
														<option value="0">No</option>
													</select>
												</div>



												<label for="condiciones" class="col-md-1 control-label ">Pago</label>
													<div class="col-md-3 ">
													<select class='form-control input-sm  col-md-pull-1' id="condiciones">
														<option disabled selected value> -- selecciona una opción -- </option>
														<?php
																				$sql="SELECT * FROM kg_tipo_pago where estado = 'A'";
																				$rec=mysqli_query($con,$sql);
																				while ($row=mysqli_fetch_array($rec))
																					{
																						echo "<option value='".$row['id_tipo_pago']."' >";
																						echo $row['desc_tipo_pago'];
																						echo "</option>";
																					}
																			?>
													</select>
												</div>


											</div>

								<!-- Botones  -->

									<div class="form-group row">

									    <label  class="col-md-1 control-label">Medico O</label>
								        <div class="col-md-3">
								            <input type="text" class="form-control col-md-1" id="medico_aux" name="medico_aux" placeholder="Doctor ocasional" >
								        </div>

									    <label  class="col-md-1 control-label">Diagnostico</label>
									    <div class="col-md-3">
									        <input type="text" class="form-control col-md-1" id="diagnostico" name="diagnostico"  required>
									    </div>

									    <div class="col-md-4">
									        <div >

									            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
									                <span class="glyphicon glyphicon-search"></span> Agregar Estudios
									            </button>
									             <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalClientes">
									                <span class="glyphicon glyphicon-plus"></span> Agregar Clientes
									            </button> 
									            <!-- <button class="btn btn-default">
									                <a href="./reports/factura.php"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
									            </button> -->
									        </div>
									    </div>
									</div>
								<!--
								<div id="containerMedicoAuxiliar">
									
								</div>
								-->
						</form>

						<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->

						<table id="data_facturacion" class="table table-bordered table-hover datatable-generated" cellspacing="0" width="100%">
				        <thead>
				            <tr>
				                <th>Código</th>
				                <th>Cant</th>
				                <th>Descripción</th>
				                <th>Precio</th>
												<th >Operación</th>
				            </tr>
				        </thead>
				    </table>


							<div class="container">
  							<div class="row">
									 <div class="col-md-4" well tal>
										 <textarea id="observaciones" name="textarea" rows="8" cols="50" placeholder="Observaciones" style = "resize:none"></textarea>
										 <label  class="control-label">Estado de la factura</label>

												<select class='form-control input-sm' id="estadoFactura">
																									                                                     <option value="2">Terminada</option>
													
												</select>

									 </div>

									 <div class="col-md-6">
											 	<div class="col-md-12">

														<div class="col-md-3">
															<label class="col-md-6">Subtotal:</label>
														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3 col-centered">
															<label  id="subtotal" >0</label>
														</div>
											  </div>

												<div class="col-md-12">

														<div class="col-md-3">
															<label>% Descuento:</label>
														</div>

														<div class="col-md-3">
															<input type="number" id="descuento" class="col-centered">
														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3 col-centered">
															<label  id="subtotalDescuento">0</label>
														</div>

											  </div>

												<div class="col-md-12">

														<div class="col-md-3">
															<label>% Incremento:</label>
														</div>

														<div class="col-md-3">
															<input type="number" id="incremento" class="col-centered">
														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3 col-centered">
															<label  id="subtotalIncremento">0</label>
														</div>

											  </div>

												<div class="col-md-12">

														<div class="col-md-3">
															<label class="col-md-6">Total:</label>
														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3 col-centered">
															<label  id="total" >0</label>
														</div>
											  </div>

												<div class="col-md-12">

														<div class="col-md-3">
															<label class="col-md-6">a/cuenta:</label>
														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3 col-centered">
															<input type="number" id="acuenta" class="col-centered">
														</div>
											  </div>

												<div class="col-md-12">

														<div class="col-md-3">
															<label class="col-md-6">Saldo:</label>
														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3">

														</div>

														<div class="col-md-3 col-centered">
															<label  id="saldo" >0</label>
														</div>
											  </di	v>

												<div class="offset-md-3 col-md-9">
													<button type="button" class="btn btn-default" id="recalculate">
													 <span class="fa fa-calculator" aria-hidden="true"></span> Recalcular
													</button>
											  </div>

									 </div>
								</div>
							</div>
						</div>

						<button id="btnSaveBill" type="button" class="btn btn-success btn-lg pull-right" id="recalculate">
						 <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar Factura
						</button>


			</div>  <!-- fin de panel body -->
		 </div> <!--fin del panel -->

		  <div class="row-fluid">
				<div class="col-md-12">
				</div>
		 </div>
	</div><!--  fin del metodo container -->
	<hr>

	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
			</div>
			<div class="modal-body">
						<table id="data_productos" class="table table-bordered table-hover datatable-generated" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Código</th>
									<th>Producto</th>
									<th>Cant.</th>
									<th>Precio</th>
									<th>Agregar</th>
								</tr>
							</thead>
						</table>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

			</div>
		</div>
		</div>
	</div>

	<?php
	include("footer.php");
	?>

	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>

	<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<script type="text/javascript" src="js/sweetalert2.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script src="js/bootstrap-notify.js"></script>																					
	<script type="text/javascript" src="js/nueva_factura.js"></script>

  </body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
