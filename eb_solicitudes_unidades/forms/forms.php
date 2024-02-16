<form id="frm_editp">
  <div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar productos</h5>
            <input type="hidden" id="id_solicitud" name="id_solicitud">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="md-form">
            <input type="text" id="producto" class="form-control" disabled>
            <label for="producto">Producto</label>
          </div>
          <div class="md-form">
            <input type="text" id="proveedor" class="form-control" disabled>
            <label for="proveedor">Proveedor</label>
          </div>
          <div class="md-form">
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            <label for="cantidad">Cantidad</label>
          </div>
          <div class="md-form">
            <input type="number" id="costo" class="form-control" disabled>
            <label for="costo">Costo</label>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</form>