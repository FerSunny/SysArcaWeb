<form id="form_grupo" action="" method="post">
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
                Nuevo grupo
            </h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">

          <div class="md-form">
                <input type="text" size="2" maxlength="2" name="clave_grupo" id="clave_grupo" class="form-control" required>
                <label for="codigo">Clave de grupo</label>
          </div>

          <div class="md-form">
                <input type="text" name="desc_grupo" id="desc_grupo" class="form-control" required>
                <label for="codigo">Descripci&oacute;n de grupo</label>
            </div>  


            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <label for="">Estado</label>
                </div>
              </div>
              <div class="col">
                  <select class="form-control" name="estado" id="estado">
                      <option value="A">Activo</option>
                      <option value="S">Suspendido</option>
                    </select>
              </div>      
            </div>



        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Editar -->

  <form id="frm-edit" class="form-horizontal" method="POST">
    <div class="modal fade" id="grupo" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
              Editar Grupos
             </h2> 
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
         </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <form id="frm-edit">  
            <input type="hidden" id="id_grupo" name="id_grupo">
            

            <div class="md-form">
                <input type="text" size="2" maxlength="2"  name="clave_grupo" id="clave_grupo" class="form-control" readonly="readonly" >
                <label for="codigo">Clave de grupo</label>
            </div>  


            <div class="md-form">
                <input type="text" name="desc_grupo" id="desc_grupo" class="form-control" required>
                <label for="codigo">Descripci&oacute;n de grupo</label>
            </div>  


            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <label for="">Estado</label>
                </div>
              </div>
              <div class="col-9">
                  <select class="form-control" name="estado" id="estado">
                      <option value="A">Activo</option>
                      <option value="S">Suspendido</option>
                    </select>
              </div>      
            </div>           
                                
          <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
      
        </div>
      </div>
    </div>
  </div> 
  </form>  

