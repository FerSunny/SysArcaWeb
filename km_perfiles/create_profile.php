<?php
date_default_timezone_set('America/Mexico_City');

	$title="Nuevo Perfil";

	/* Connect To Database*/
	require_once ("./db/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("./db/conexion.php");//Contiene funcion que conecta a la base de datos

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
	?>
    <div class="container">
			<div class="panel panel-info">
				<div class="panel-heading">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h4><i class='glyphicon glyphicon-edit'></i> Nuevo Perfilll </h4>
                        </div>
                        <div class="col-md-6">
                        <a  href="lista_perfiles.php" class="btn btn-warning pull-right"> <span class="fa fa-arrow-left" > </span>Regresar</a>
                        </div>
                    </div>
                    </div>
					
                   
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
                                          <input type="text" class="form-control border-input" id="iniciales" name="iniciales">
                                        </div>
                                        


                                        <div class="form-group col-md-3">
                                          <label >¿Elaboración Urgente?</label>
                                          <select class="form-control border-input" id="urgente" name="urgente">
                                            <option disabled selected value> -- selecciona una opción -- </option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                          </select>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                          <label>Tiempo de entrega</label>
                                          <input type="number" placeholder="dias" class="form-control border-input" id="tiempo_entrega" name="tiempo_entrega">
                                        </div>

                                        <div class="form-group col-md-3">
                                          <label>Costo</label>
                                          <input type="number" class="form-control border-input" id="costo" name="costo">
                                        </div>
                                        
                                        
                                    
                                    
                                    </div>

                                    <div class="row">
                                         <div class="form-group col-md-3">
                                          <label >Tipo de comisión</label>
                                          <select class="form-control border-input" id="fk_id_comision" name="fk_id_comision">
                                            <option disabled selected value> -- selecciona una opción -- </option>
                                            <?php
							                      $sql="select id_comision,desc_comision from kg_comisiones where estado='A';";
							                      $rec=mysqli_query($con,$sql);
							                      while ($row=mysqli_fetch_array($rec))
							                        {
							                          echo "<option value='".$row['id_comision']."' >";
							                          echo $row['desc_comision'];
							                          echo "</option>";
							                        }
							                    ?>
                                          </select>
                                        </div>

                                        <div class="form-group col-md-3 ">
                                          <label>Clave Descuento</label>
                                          <select class="form-control border-input" id="fk_id_descuento" name="fk_id_descuento">
                                                <option disabled selected value> -- selecciona una opción -- </option>
                                                <?php
							                      $sql="select id_descuento,desc_descuento from kg_descuentos where estado='A';";
							                      $rec=mysqli_query($con,$sql);
							                      while ($row=mysqli_fetch_array($rec))
							                        {
							                          echo "<option value='".$row['id_descuento']."' >";
							                          echo $row['desc_descuento'];
							                          echo "</option>";
							                        }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                          <label>Clave Promoción</label>
                                          <select class="form-control border-input" id="fk_id_promosion" name="fk_id_promosion">
                                                <option disabled selected value> -- selecciona una opción -- </option>
                                                <?php
							                      $sql="select id_promocion,desc_promocion from kg_promociones where estado='A';";
							                      $rec=mysqli_query($con,$sql);
							                      while ($row=mysqli_fetch_array($rec))
							                        {
							                          echo "<option value='".$row['id_promocion']."' >";
							                          echo $row['desc_promocion'];
							                          echo "</option>";
							                        }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3 ">
                                          <label >Estado</label>
                                          <select class="form-control border-input" id="estado" name="estado">
                                            <option disabled selected value> -- selecciona una opción -- </option>
                                            <option value="A">Activo</option>
                                            <option value="B">Baja</option>
                                          </select>
                                        </div>
                                    </div> <!-- fin row-->
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="desc_perfil">Descripción del perfil:</label>
                                            <textarea class="form-control" rows="3" id="desc_perfil" name="desc_perfil"></textarea>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="observaciones">Observaciones:</label>
                                            <textarea class="form-control" rows="3" id="observaciones" name="observaciones"></textarea>
                                        </div>
                                                    
                                        <div style="padding-top:3em;">
                                            <div class="form-group col-md-3">
                                                <button id="btnSaveBill" type="button" class="btn btn-info btn-lg " data-toggle="modal" data-target="#myModal" id="btn_add_studie">
                                                    <span class="fa fa-plus" aria-hidden="true"></span> Agregar Estudios
                                                </button>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <button id="btnSaveProfile" type="button" class="btn btn-success btn-lg ">
                                                    <span class="fa fa-floppy-o" aria-hidden="true"></span> Guardar Perfil</button>
                                            </div>
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
                                </table>
                                
                                
                                <div class="footer">
                                    
                                    
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
				<h4 class="modal-title" id="myModalLabel">Buscar estudio</h4>
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

	<?php
	include("footer.php");
	?>
    <script type="text/javascript" src="js/create-profile.js"></script>
  </body>
</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
