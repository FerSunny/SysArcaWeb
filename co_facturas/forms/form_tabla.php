<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="modal-folios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lista Folios Efectivo</h5>
      </div>
      <div class="modal-body table-responsive">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="md-form lbl-1">
              <input type="text" id="efec_total" class="form-control" readonly>
              <label for="efec_total">Total Efectivo</label>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="md-form lbl-2">
              <input type="text" id="efec_bus" class="form-control" readonly>
              <label for="efec_bus">Total Efectivo Buscado</label>
              <button type="button" class="btn btn-secondary" id="btn-econtrado">Buscar</button>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6"></div>
        </div>
        <table id="dt_efectivo" class="table table-bordered table-hover" cellspacing="1" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Sucursal</th>
              <th>Factura</th>
              <th>Imorte</th>
              <th>Fecha inicio</th>
              <th>Fecha Final</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="folio(1)">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="Cancelar(1)">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="modal-bancos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lista Folios Banco</h5>
      </div>
      <div class="modal-body table-responsive">
        <table id="dt_bancos" class="table table-bordered table-hover" cellspacing="1" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Sucursal</th>
              <th>Factura</th>
              <th>Imorte</th>
              <th>Fecha inicio</th>
              <th>Fecha Final</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="folio(2)">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="Cancelar(2)">Cancelar</button>
      </div>
    </div>
  </div>
</div>