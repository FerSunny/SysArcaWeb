<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	$FechaHoy=date("d/m/Y : H : i : s");

?>



<form id="form_productos" action="controladores/registro_ficheros.php" method="post" enctype="multipart/form-data" >

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nuevo Fichero

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" readonly name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>

<!-- selecciona fichero  -->
					<div class="col-xs-8">
                        <input input type="file" class="form-control" id="fn_archivo" required name="fn_archivo[]" multiple />
                    </div>

					

					<br>

				</div>

<!-- Botones de accion -->
				<div class="modal-footer">

						<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

				</div>
<!-- Fin de la forma  -->
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

									Nueva version

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" readonly name="codigo" id="codigo" class="form-control" required>

							<label for="codigo">Código</label>

						</div>


<!-- consecutivo -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
								<select class="form-control" id="fi_estado" name="fn_estado">
                                        <option value="P O S I T I V O">Positivo</option>
                                        <option value="N E G A T I V O">Negativo</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
									<label for="producto"> Consecutivo</label>
								</div>
							</div>
						</div>
					</div>					
<!-- descripcion -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="nombre" id="nombre" class="form-control" maxlength="100" required>
									<label for="producto"> Descripción</label>
								</div>
							</div>
						</div>
					</div>


<!-- copias Electronico  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text"  name="fk_id_doc" id="fk_id_doc" class="form-control"  required>
									<label for="costo">Electronico # copias</label>
								</div>
							</div>
						</div>
<!-- ubicacion Electronico  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="eubicacion" id="eubicacion" class="form-control" min="1" maxlength="25"  required>
									<label for="utilidad">Electronico Ubicacion</label>
								</div>
							</div>
						</div>
					</div>
<!-- Fisico copias  -->
					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="fncopias" id="fncopias" class="form-control" min="1" maxlength="5" step="1"  required>
									<label for="costo">Fisico # copias</label>
								</div>
							</div>
						</div>
<!-- Fisico ubicacion  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="text" name="fubicacion" id="fubicacion" class="form-control" min="1" maxlength="25"  required>
									<label for="utilidad">Fisico Ubicacion</label>
								</div>
							</div>
						</div>
					</div>

<!-- revision numero  -->

					<div class="row">
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number"  name="revision" id="revision" class="form-control"  step="1" required>
									<label for="revision"># Revision</label>
								</div>
							</div>
						</div>


<!-- version numero  -->						
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="number" name="version" id="version" class="form-control" step="1" required>
									<label for="version"># Version</label>
								</div>
							</div>
						</div>
					</div>					

<!-- fecha emision  -->

					<div class="row">

						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date" name="femision" id="femision" class="form-control" >
									<label for="Nivel" id="emision">Fecha Emision</label>
								</div>
							</div>
						</div>
<!-- fecha revision  -->
						<div class="col">
							<div class="md-form mt-0">
								<div class="md-form">
									<input type="date" name="frevision" id="frevision" class="form-control" >
									<label for="Nivel" id="emision">Fecha Pro. Revision</label>
								</div>
							</div>
						</div>
					</div>	
					<br>
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




        <!-- Modal para subir los ficheros-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" id="form1">
                            <div class="form-group">
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="description">archivo</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="onSubmitForm()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>



        <script>
                            function onSubmitForm() {
                                var frm = document.getElementById('form1');
                                var data = new FormData(frm);
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4) {
                                        var msg = xhttp.responseText;
                                        if (msg == 'success') {
                                            alert(msg);
                                            $('#exampleModal').modal('hide')
                                        } else {
                                            alert(msg);
                                        }

                                    }
                                };
                                xhttp.open("POST", "upload.php", true);
                                xhttp.send(data);
                                $('#form1').trigger('reset');
                            }
                            function openModelPDF(url) {
                                $('#modalPdf').modal('show');
                                $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/uploadfile/'; ?>'+url);
                            }
        </script>

