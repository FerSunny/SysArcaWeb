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





<!--Editar imagenes-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Ver Imagen</h4>
            </div>
            <div class="modal-body">

              <input type="hidden" id="idimagen" name="idimagen" value="0">
              <input type="hidden" id="opcion" name="opcion" value="modificar">
<!-- Nota -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Nota</label>
                <div class="col-sm-8">
                  <input id="edit1" name="edit1" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>

<!-- Esudio -->              
              <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Estudio</label>
                <div class="col-sm-8">
                  <input id="fi_desc_estudio" name="fn_desc_estudio" maxkength="50" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>
<!-- nomb imagen -->              
              <div class="form-group">
                <label for="nombre_img" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-8">
                  <input id="fi_nombre" name="fn_nombre" maxkength="50" required="no entry" required type="text" class="form-control" readonly="readonly">
                 </div>
              </div>
<!-- Imagen -->  
              <div class="form-group">
                <!--
                  <label for="descripcion" class="col-sm-2 control-label">Estudio</label>
                -->
                <div class="col-sm-8">

    

                  
                  <img src="" id="fi_imagen" alt="" width="500" >

                  <!--
                  <input id="fi_desc_estudio" name="fn_desc_estudio" maxkength="50" required type="text" class="form-control" >
                -->
                 </div>
              </div>


              
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8"></div>
              </div>

              <div class="modal-footer">
                <!--
                  <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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