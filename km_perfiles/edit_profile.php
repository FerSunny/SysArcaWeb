<?php
	date_default_timezone_set('America/Mexico_City');
	/* Connect To Database*/
	require_once ("./db/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("./db/conexion.php");//Contiene funcion que conecta a la base de datos

	$data=json_decode($_POST['datas'],true);
	$arrayContainer=array();

	$id_perfil=$data['id_perfil'];

	$sql="SELECT fk_empresa AS fk_id_empresa,iniciales,desc_estudio AS desc_perfil,urgente,tiempo_entrega,costo,observaciones,fk_id_comision,fk_id_descuento,fk_id_promosion,estatus FROM km_estudios WHERE estatus ='A' AND id_estudio=".$id_perfil;

//echo $sql;

	if ($result = mysqli_query($con, $sql)) {
				$out = array();

				while ($row = $result->fetch_assoc()) {
					$out[] = $row;
				}

				mysqli_free_result($result);

				$sql="select id_detalle,fk_id_estudio,cantidad,precio_venta,desc_estudio from km_perfil_detalle
                inner join km_estudios
                on km_perfil_detalle.fk_id_estudio=km_estudios.id_estudio where fk_id_perfil=".$id_perfil;
		//echo $sql;
				if ($resultado = mysqli_query($con, $sql)) {
							$dataResult=array();

							while ($rowData = $resultado->fetch_assoc()) {
								$dataResult[] = $rowData;
							}

							mysqli_free_result($resultado);

					$JSON= json_encode($dataResult);

				}

		//echo json_encode($arrayContainer);
	}


?>

<?php

	$title="Editar Perfile Médico";

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
             <h4><i class='glyphicon glyphicon-edit'></i> Editar Perfil </h4>
         </div>
         <div class="panel-body">

         <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="header">
                     </div>
                     <div class="content">
                         <form id="form-profile" action="">
                             <div class="row">
                                 <div class="form-group col-md-3">
                                   <label>Iniciales</label>
                                   <input type="text" readonly class="form-control border-input" id="iniciales" name="iniciales" value="<?php echo $out[0]['iniciales']; ?>">
                                 </div>
                                 


                                 <div class="form-group col-md-3">
                                   <label >¿Elaboración Urgente?</label>
                                   <select  disabled="disabled" class="form-control border-input" id="urgente" name="urgente">
                                     <option  disabled selected value> -- selecciona una opción -- </option>
                                     <option value="Si" <?php if("Si"==$out[0]['urgente']){ echo "selected";} ?> >Si</option>
                                     <option value="No" <?php if("No"==$out[0]['urgente']){ echo "selected";} ?> >No</option>
                                   </select>
                                 </div>
                                 
                                 <div class="form-group col-md-3">
                                   <label>Tiempo de entrega</label>
                                   <input type="number" readonly placeholder="dias" class="form-control border-input" id="tiempo_entrega" name="tiempo_entrega" value="<?php echo $out[0]['tiempo_entrega']; ?>">
                                 </div>

                                 <div class="form-group col-md-3">
                                   <label>Costo</label>
                              
                                   <input type="number" readonly class="form-control border-input" id="costo" name="costo" value="<?php echo $out[0]['costo']; ?>">

                                 </div>
                                 
                                 
                             
                             
                             </div>

                             <div class="row">
                                  <div class="form-group col-md-3">
                                   <label >Tipo de comisión</label>
                                   <select disabled="disabled" class="form-control border-input" id="fk_id_comision" name="fk_id_comision">
                                     <option disabled selected value> -- selecciona una opción -- </option>
                                     <?php
                                           $sql="select id_comision,desc_comision from kg_comisiones where estado='A';";
                                           $rec=mysqli_query($con,$sql);
                                           while ($row=mysqli_fetch_array($rec))
                                             {
                                               ?>
                                               <option value="<?php echo $row['id_comision']?>" <?php if($out[0]['fk_id_comision'] == $row['id_comision']) echo "selected"; ?> ><?php echo $row['desc_comision']; ?></option>
                                                <?php
                                             }
                                         ?>
                                   </select>
                                 </div>

                                 <div class="form-group col-md-3 ">
                                   <label>Clave Descuento</label>
                                   <select disabled="disabled" class="form-control border-input" id="fk_id_descuento" name="fk_id_descuento">
                                         <option disabled selected value> -- selecciona una opción -- </option>
                                         <?php
                                           $sql="select id_descuento,desc_descuento from kg_descuentos where estado='A';";
                                           $rec=mysqli_query($con,$sql);
                                           while ($row=mysqli_fetch_array($rec))
                                             {
                                               ?>
                                               <option value="<?php echo $row['id_descuento']?>" <?php if($out[0]['fk_id_descuento'] == $row['id_descuento']) echo "selected"; ?> ><?php echo $row['desc_descuento']; ?></option>
                                                <?php
                                             }
                                         ?>
                                     </select>
                                 </div>

                                 <div class="form-group col-md-3">
                                   <label>Clave Promoción</label>
                                   <select disabled="disabled" class="form-control border-input" id="fk_id_promosion" name="fk_id_promosion">
                                         <option disabled selected value> -- selecciona una opción -- </option>
                                         <?php
                                           $sql="select id_promocion,desc_promocion from kg_promociones where estado='A';";
                                           $rec=mysqli_query($con,$sql);
                                           while ($row=mysqli_fetch_array($rec))
                                             {
                                               ?>
                                               <option value="<?php echo $row['id_promocion']?>" <?php if($out[0]['fk_id_promosion'] == $row['id_promocion']) echo "selected"; ?> ><?php echo $row['desc_promocion']; ?></option>
                                                <?php
                                             }
                                             
                                         ?>
                                     </select>
                                 </div>

                                 <div class="form-group col-md-3 ">
                                   <label >Estado</label>
                                   <select disabled="disabled" class="form-control border-input" id="estado" name="estado">
                                     <option disabled selected value> -- selecciona una opción -- </option>
                                     <option value="A" selected>Activo</option>
                                     <option value="B">Baja</option>
                                   </select>
                                 </div>
                             </div> <!-- fin row-->
                             <div class="row">
                                 <div class="form-group col-md-3">
                                     <label for="desc_perfil">Descripción del perfil:</label>
                                     <textarea  readonly class="form-control" rows="3" id="desc_perfil" name="desc_perfil"><?php echo $out[0]['desc_perfil']; ?></textarea>
                                 </div>

                                 <div class="form-group col-md-3">
                                     <label for="observaciones">Observaciones:</label>
                                     <textarea readonly class="form-control" rows="3" id="observaciones" name="observaciones"><?php echo $out[0]['observaciones']; ?></textarea>
                                 </div>
                                             
                                 <div style="padding-top:3em;">
                                     <div class="form-group col-md-3">
                                         <button id="btnSaveBill" type="button" class="btn btn-info btn-lg " data-toggle="modal" data-target="#myModal" id="btn_add_studie">
                                             <span class="fa fa-plus" aria-hidden="true"></span> Agregar Estudios
                                         </button>
                                     </div>

                                     <div class="form-group col-md-3">
                                         <button id="btnupdateperfil" type="button" class="btn btn-success btn-lg ">
                                             <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar Perfil
                                         </button>
                                     </div>

                                     <span id="factory_id" hidden="hidden" value="<?php echo $id_perfil ?>"></span>
                                 </div>
                                 
                             
                       </form>
                             
                     </div>
                     
                     <div class="footer">
                         
                     </div>
                     
                 </div>
             </div>


             <div class="col-md-12">
                 <div class="card">
                     
                     <div class="header">
                         <h4 class="title">Estudios Asignados</h4>
<!--                                <button class="btn btn-info pull-right" style="margin-bottom: 1em;">Nuevo</button>-->
                     </div>
                     <div class="content">
                         
                         <table id="table_estudios" class="table table-bordered table-hover datatable-generated" width="100%" cellspacing="0">
                             <thead>
                                     <tr>
                                             <th>#ID</th>
                                             <th>Estudio</th>
                                             <th>Cantidad</th>
                                             <th>Precio Venta</th>
                                             <th></th>
                                            
                                     </tr>
                             </thead>
                             <tbody>
                                <?php
                                    for ($i = 0; $i <count($dataResult); $i++) {
                                        echo "<tr>";
                                                echo "<td>";
                                                    echo $dataResult[$i]['fk_id_estudio'];
                                                echo "</td>";

                                                echo "<td>";
                                                    echo $dataResult[$i]['desc_estudio'];
                                                echo "</td>";

                                                echo "<td>";
                                                    echo $dataResult[$i]['cantidad'];
                                                echo "</td>";

                                                echo "<td>";
                                                    echo  $dataResult[$i]['precio_venta'];
                                                echo "</td>";

                                                echo "<td>";
                                                echo '<button id="btnRemove_estudio" type="button" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-remove"></span></button>';
                                                echo "</td>";

                                        echo "</tr>";

                                    }
                                ?>
								</tbody>
                         </table>
                         
                         
                         <div class="footer">
                         <button id="btnClose" type="button" class="btn btn-danger btn-lg col-md-2" style="margin-left:5em;">
                            <span class="fa fa-chevron-left" aria-hidden="true"></span> Cancelar
                            </button>
                             
                             <div class="stats">
                                 
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

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
				<h4 class="modal-title" id="myModalLabel">Buscar Estudio</h4>
			</div>
			<div class="modal-body">
						<table id="data_estudios" class="table table-bordered table-hover datatable-generated" width="100%" cellspacing="0">
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
