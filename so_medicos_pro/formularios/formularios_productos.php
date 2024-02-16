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

								Nuevo Prospecto

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" name="codigo" id="codigo" class="form-control"  maxlength="15" required readonly>

						<label for="codigo">Código</label>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="nombre" id="nombre" class="form-control" maxlength="100" required>

									<label for="producto"> Nombre </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text"  name="apaterno" id="apaterno" class="form-control"  required>

									<label for="apaterno">A. paterno</label>

								</div>

							</div>

						</div>


					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text"  name="amaterno" id="amaterno" class="form-control"  required>

									<label for="apaterno">A. materno</label>

								</div>

							</div>

						</div>


					</div>

					

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									
									<textarea class="form-control" name="observaciones" id="observaciones" rows="1"></textarea>

									<label for="observaciones">Describa todos los datos que permitan localizar al medico</label>

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

									Editar Prospecto

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" name="codigo" id="codigo" class="form-control" required readonly>

							<label for="codigo">Código</label>

						</div>


<!-- inicio -->
					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text" name="nombre" id="nombre" class="form-control" maxlength="100" required>

									<label for="producto"> Nombre </label>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text"  name="apaterno" id="apaterno" class="form-control"  required>

									<label for="apaterno">A. paterno</label>

								</div>

							</div>

						</div>


					</div>

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									<input type="text"  name="amaterno" id="amaterno" class="form-control"  required>

									<label for="apaterno">A. materno</label>

								</div>

							</div>

						</div>


					</div>

					

					<div class="row">

						<div class="col">

							<div class="md-form mt-0">

								<div class="md-form">

									
									<textarea class="form-control" name="observaciones" id="observaciones" rows="1"></textarea>

									<label for="observaciones">Describa todos los datos que permitan localizar al medico</label>

								</div>

							</div>

						</div>
					</div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Asignar Medico
                   <select name="medico" id="medico" class="form-control" data-width="fit" required>
                    <?php
                      $sql="SELECT m.id_medico, concat(m.nombre,' ',m.a_paterno,' ',m.a_materno) as nombre 
                      FROM so_medicos m
                      where estado = 'A' 
                      order by m.nombre,m.a_paterno,m.a_materno";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_medico']."' >";
                          echo $row['nombre'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </div>
              </div>
            </div>




				</div>

<!-- fin  -->


					<div class="modal-footer">

							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>



