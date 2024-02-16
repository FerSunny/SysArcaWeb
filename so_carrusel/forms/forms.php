<!--Agregar-->
<form id="add-form">
	<!-- Modal -->
	<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Subir Imagen</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="md-form">
			  <input type="text" id="titulo" name="titulo" class="form-control">
			  <label for="titulo">Titulo Imagen</label>
			</div>
			<div class="md-form">
			  <input type="text" id="sub" name="sub" class="form-control">
			  <label for="sub">Subtitulo Imagen</label>
			</div>
	        <div class="custom-file">
			  <input type="file" class="custom-file-input" name="carrucel" id="carrucel" lang="es">
			  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success">Guardar</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>


<!--Editar-->
<form id="edit-form">
	<!-- Modal -->
	<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	  aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Editar Imagen</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" id="id" name="id">
	      	<div class="md-form">
			  <input type="text" id="ruta" name="ruta" class="form-control" readonly>
			  <label for="ruta">Nombre del archivo</label>
			</div>
	       	<div class="custom-file">
			  <input type="file" class="custom-file-input" name="carrucel" id="carrucel" lang="es">
			  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success">Guardar</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>


<!-- IMG -->

<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="img_bd">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>