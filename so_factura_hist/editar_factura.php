<?php
	session_start();
	date_default_timezone_set('America/Mexico_City');
	$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos


	$data=json_decode($_POST['datas'],true);
	$arrayContainer=array();

	$id_factura=$data['id_factura'];
	$numero_factura=$data['numero_factura'];

	$table=" so_factura";
	$where=" where id_factura=".$id_factura;
	$sql="SELECT fk_id_cliente,fk_id_usuario,fk_id_medico,diagnostico,fecha_factura,afecta_comision,fecha_entrega,fk_id_tipo_pago,observaciones,estado_factura,imp_subtotal,porc_descuento,porc_incremento,a_cuenta,vmedico FROM  $table $where";

	if ($result = mysqli_query($con, $sql)) {
				$out = array();

				while ($row = $result->fetch_assoc()) {
					$out[] = $row;
				}

				mysqli_free_result($result);


				$table=" km_estudios inner join so_detalle_factura";
				$where=" where km_estudios.id_estudio=so_detalle_factura.fk_id_estudio and id_factura=".$id_factura;
				$sql="SELECT id_estudio,cantidad,desc_estudio,precio_venta FROM  $table $where";

				if ($resultado = mysqli_query($con, $sql)) {
							$dataResult=array();

							while ($rowData = $resultado->fetch_assoc()) {
								$dataResult[] = $rowData;
							}

							mysqli_free_result($resultado);

								$query="select nombre,a_paterno,a_materno from so_clientes where id_cliente=".$out[0]['fk_id_cliente'];
								if ($nombreCliente = mysqli_query($con, $query)) {
											$nombre_cliente="";
									    while ($arrayNombre = mysqli_fetch_row($nombreCliente)) {
												$apellido_p=$arrayNombre[1]=="apellido_p"?"":$arrayNombre[1];
												$apellido_m=$arrayNombre[2]=="apellido_m"?"":$arrayNombre[2];
									      $nombre_cliente= $arrayNombre[0]." ".$apellido_p." ".$apellido_m;
									    }
									    mysqli_free_result($nombreCliente);
								}

							 	$formateada = strtotime($out[0]['fecha_factura']);
							 	$fecha_factura=date('d/m/y ',$formateada);

							 	$spliteo = explode(" ",$out[0]['fecha_entrega']);
								$fecha_entrega = $spliteo[0].'T'.$spliteo[1];
								$JSON= json_encode($dataResult);
				}
	}
?>

<?php

	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	$title="Editar Factura";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    	include("head.php");
    ?>
  </head>
	<body background="../imagenes/logo_arca_sys_web.jpg">
		<?php
		include("../includes/barra.php");
		?>
    <div class="container">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4><i class='glyphicon glyphicon-edit'></i> Editar Factura #<?php echo $id_factura ?></h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" id="form-factura" action="">
						<div class="form-group row">
							<label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
						  <div class="col-md-3">
								<select id="nombre_cliente" name="nombre_cliente" class="js-data-example-ajax col-md-12">
									<option value="<?php echo $out[0]['fk_id_cliente'];?>"><?php echo $nombre_cliente ?></option>
								</select>
						  </div>
						  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
							<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="email" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>
						</div>
						<div class="form-group row">
							<!-- VENDEDEDOR -->
							<label for="empresa" class="col-md-1 control-label">Vendedor</label>
							<div class="col-md-3">
								<select class="form-control input-sm" id="id_vendedor" >
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
											<option value="<?php echo $id_vendedor?>" <?php echo $selected;?>  <?php if($out[0]['fk_id_usuario'] == $id_vendedor) echo "selected"; ?> ><?php echo $nombre_vendedor?></option>
											<?php
										}
									?>
								</select>
							</div>
							<!-- FECHA -->
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo $fecha_factura ?>" readonly>
							</div>
							<!-- fecha de entrega -->
							<label  class="control-label pull-left">Fecha de entrega</label>
							<div class="col-md-2">
								<input type="datetime-local" name="fechaentrega" class="form-control " id="fechaentrega" style="width:145%;" value="<?php echo $fecha_entrega ?>">
							</div>
						</div>
						<!-- Renglon 3 -->
						<div class="form-group row">
							<!-- MEDICO -->
							<label for="f_medico" class="col-md-1 control-label">Medico</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="fi_medico" name="fi_medico" >
									<?php
	                  $sql="SELECT * FROM so_medicos where estado = 'A' order by nombre,a_paterno,a_materno";
	                  $rec=mysqli_query($con,$sql);
	                  while ($row=mysqli_fetch_array($rec))
	                    {
									?>
									<option value="<?php echo $row['id_medico']?>" <?php if($out[0]['fk_id_medico'] == $row['id_medico']) echo "selected"; ?> ><?php echo $row['nombre']." ".$row['a_paterno']." ".$row['a_materno']; ?></option>
											<?php
				                 }
				             ?>
								</select>
							</div>
							<!-- AFECTA COMISION -->
							<label class="col-md-1 control-label">Comision</label>
							<div class="col-md-2">
								<select class='form-control ' id="fi_comision">
									<option value="1" <?php if($out[0]['afecta_comision'] == 1) echo "selected"; ?>>Si</option>
									<option value="0" <?php if($out[0]['afecta_comision'] == 0) echo "selected"; ?> >No</option>
								</select>
							</div>
							<label for="condiciones" class="col-md-1 control-label ">Pago</label>
							<div class="col-md-3 ">
								<select class='form-control input-sm  col-md-pull-1' id="condiciones">
									<?php
															$sql="SELECT * FROM kg_tipo_pago where estado = 'A'";
															$rec=mysqli_query($con,$sql);
															while ($row=mysqli_fetch_array($rec))
																{
																	?>
																		<option value="<?php echo $row['id_tipo_pago'] ?>" <?php if($out[0]['fk_id_tipo_pago'] == $row['id_tipo_pago']) echo "selected"; ?> ><?php echo $row['desc_tipo_pago']; ?></option>
																	<?php

																}
														?>
								</select>
							</div>
						</div>
						<!-- Botones  -->
						<div class="form-group row">
							<label  class="col-md-1 control-label">Diagnostico</label>
							<div class="col-md-3">
								<input type="text" class="form-control col-md-1" id="diagnostico" name="diagnostico"  required value="<?php echo $out[0]['diagnostico']; ?>">
							</div>
							<div class="col-md-4 col-md-offset-3">
								<div class="pull-right">
									<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
									 <span class="glyphicon glyphicon-search"></span> Agregar Estudios
									</button>

									<a role="button" class="btn btn-info" target="_blank" href="./reports/factura.php?numero_factura=<?php echo $id_factura ?>" onclick="openTikets('<?php echo $id_factura ?>');"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

								</div>
							</div>
						</div>
						<div id="containerMedicoAuxiliar">
							<?php
								if(strlen($out[0]['vmedico'])>0){
							?>
							<div class="form-group row">
									<label  class="col-md-1 control-label">Médico</label>
									<div class="col-md-4">
										<input type="text" class="form-control col-md-1" id="medico_aux" name="medico_aux" placeholder="Nombre del médico auxiliar" required value="<?php echo $out[0]['vmedico']?>">
									</div>
							</div>
							<?php
								}
							?>
						</div>
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
						<tbody>
								<?php
									for ($i = 0; $i <count($dataResult); $i++) {
										echo "<tr>";
											 echo "<td>";
													echo $dataResult[$i]['id_estudio'];
											 echo "</td>";
											 echo "<td>";
											 		echo $dataResult[$i]['cantidad'];
						 					 echo "</td>";
						 				 	 echo "<td>";
											 		echo $dataResult[$i]['desc_estudio'];
											 echo "</td>";
											 echo "<td>";
											 		echo  $dataResult[$i]['precio_venta'];
											 echo "</td>";
											 echo "<td>";
											 	echo 						'<button id="btnRemove_product" type="button" class="btn btn-danger btn-md"><span  class="glyphicon glyphicon-remove"></span></button>';
											 echo "</td>";
									 			echo "</tr>";
									}
								?>
						</tbody>
			    </table>
					<div class="container">
  					<div class="row">
							 <div class="col-md-4" well tal>
								 <textarea id="observaciones" name="textarea" rows="8" cols="50" placeholder="Observaciones" style = "resize:none" ><?php  echo $out[0]['observaciones']; ?></textarea>
								 <label  class="control-label">Estado de la factura</label>
									<select class='form-control input-sm' id="estadoFactura"  >
										<option value="2" <?php if($out[0]['estado_factura'] == 2) echo "selected"; ?>>Terminada</option>
									</select>
							 </div>
								<div class="col-md-6">
								 	<div class="col-md-12">
											<div class="col-md-3">
												<label class="col-md-6">Subtotal:</label>
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3"></div>
											<div class="col-md-3 col-centered">
												<label  id="subtotal" >0</label>
											</div>
								  </div>
									<div class="col-md-12">
											<div class="col-md-3">
												<label>% Descuento:</label>
											</div>
											<div class="col-md-3">
												<input type="number" id="descuento" class="col-centered" value="<?php echo $out[0]['porc_descuento']; ?>">
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3 col-centered">
												<label  id="subtotalDescuento">0</label>
											</div>
								  </div>
									<div class="col-md-12">
											<div class="col-md-3">
												<label>% Incremento:</label>
											</div>
											<div class="col-md-3">
												<input type="number" id="incremento" class="col-centered" value="<?php echo $out[0]['porc_incremento']; ?>">
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3 col-centered">
												<label  id="subtotalIncremento">0</label>
											</div>
								  </div>
									<div class="col-md-12">
											<div class="col-md-3">
												<label class="col-md-6">Total:</label>
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3"></div>
											<div class="col-md-3 col-centered">
												<label  id="total" >0</label>
											</div>
								  </div>
									<div class="col-md-12">
											<div class="col-md-3">
												<label class="col-md-6">a/cuenta:</label>
											</div>
											<div class="col-md-3"></div>
											<div class="col-md-3"></div>
											<div class="col-md-3 col-centered">
												<input type="number" id="acuenta" class="col-centered" value="<?php echo $out[0]['a_cuenta']; ?>">
											</div>
								  </div>
									<div class="col-md-12">
										<div class="col-md-3">
											<label class="col-md-6">Saldo:</label>
										</div>
										<div class="col-md-3"></div>
										<div class="col-md-3"></div>
										<div class="col-md-3 col-centered">
											<label  id="saldo" >0</label>
										</div>
									</div>
									<div class="offset-md-3 col-md-9">
										<button type="button" class="btn btn-default" id="recalculate">
										 <span class="fa fa-calculator" aria-hidden="true"></span> Recalcular
										</button>
								  </div>
								</div>
							</div>
						</div> <!-- Fin container-->
					</div>  <!-- fin de panel body -->
		 		</div> <!--fin del panel -->
			 	<div class="form-group row">
					<button id="btnClose" type="button" class="btn btn-danger btn-lg col-md-2" style="margin-left:5em;">
					 <span class="fa fa-chevron-left" aria-hidden="true"></span> Cancelar
					</button>
					<button id="btnUpdateBill" type="button" class="btn btn-success btn-lg col-md-2 col-md-offset-6">
					 <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar
					</button>
					<span id="factory_id" hidden="hidden" value="<?php echo $id_factura ?>"></span>
			 	</div>
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
							<table id="data_productos" class="table table-bordered table-hover" cellspacing="1" width="100%">
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
	</div>
