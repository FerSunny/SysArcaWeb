<form id="frm-obs">
  <!-- Modal -->
  <div class="modal fade" id="mdl-obs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="" style="font-weight: 900">
            Empleado: <p id="nombre"></p>
            N° Empleado: <p id="id_usuario"></p>
            Fecha Asistencia: <p id="fecha"></p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_usr" id="id_usr">
          <input type="hidden" name="fecha_r" id="fecha_r">
          <div class="md-form">
            <textarea name="observaciones" id="observaciones" class="md-textarea form-control" rows="3"></textarea>
            <label for="observaciones">Escribe tus observaciones</label>
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
