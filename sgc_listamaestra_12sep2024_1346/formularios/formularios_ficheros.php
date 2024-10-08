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





<!--actualiza versiones-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar_ficheros.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Actualizacion de version</h4>
            </div>
            <div class="modal-body">

              <input type="hidden" id="id_imagen" name="id_imagen" value="0">
              <input type="hidden" id="opcion" name="opcion" value="modificar">
              <input type="hidden" id="id_doc" name="id_doc" >
<!-- Nombre -->              
              <div class="form-group">
                <label for="Documento" class="col-sm-2 control-label">Documento</label>
                <div class="col-sm-8">
                  <input id="nombre" name="nombre" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>

<!-- Version -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-4 control-label">Version Actual</label>
                <div class="col-sm-8">
                  <input id="version" name="version" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>
<!-- Pregunta , nueva version -->              
              <div class="form-group">
                <label for="nombre_img" class="col-sm-6 control-label">Cambiara la version?</label>
                <div class="col-sm-8">
                  <!--
                    <input id="fi_nombre" name="fn_nombre" maxkength="50" required="no entry" required type="text" class="form-control" readonly="readonly">
                  -->  
                    <select name="nuevaversion" id="nuevaversion">
                              <option value="S">Si</option>
                              <option value="N">No</option>
                    </select>              
                </div>
              </div>

<!-- porcentaje de cambio -->              
              <div class="form-group">
                              <label for="Porcentaje" class="col-sm-8 control-label">Porcentaje de cambio</label>
                              <div class="col-sm-3">
                                <input id="porcentaje" name="porcentaje" maxkength="50" required type="number" class="form-control" min="1" max="100" value="1"  step="0.5" >
                              </div>
                            </div>

<!-- Imagen -->  
              <div class="form-group">
                <!--
                  <label for="descripcion" class="col-sm-2 control-label">Estudio</label>
                -->
                <div class="col-sm-8">
                  <input input type="file" class="form-control" id="fn_archivo"  name="fn_archivo[]" multiple />
                 </div>
              </div>


              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8"></div>
              </div>

              <div class="modal-footer">
                
                  <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                <!--
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Eliminar-->
<form id="frmEliminarzona" action="controladores/eliminar_imagenes.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Imagenes</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar la imagen?<strong data-name=""></strong>
                    <input type="hidden" id="idimagen" name="idimagen" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input id="zona" name="zona" type="text" class="form-control" maxlength="8" >
                      </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
           
          </div>
        </div>
      </div>
      <!-- Modal -->
</form>





        <!-- Modal para subir los ficheros
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

-->