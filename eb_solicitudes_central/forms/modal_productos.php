<br>
        <form id="form_view">
            <div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalEliminarLabel">Contenido del pedido</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                              <table id="de_sol" class="table" cellspacing="0" width="100%">
                                  <thead>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Costo</th>
                                      <th>Editar</th>
                                      <th>Ingresar</th>
                                      <th>Llego</th>
                                  </thead>
                              </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" onclick="reload_table()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
