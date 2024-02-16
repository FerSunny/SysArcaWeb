<form id="form_usos" action="" method="post">
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
                Nuevo Uso
            </h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">

          <div class="md-form">
                <input type="text" size="10" maxlength="10" name="clave_uso" id="clave_uso" class="form-control" required>
                <label for="codigo">Clave de Uso</label>
          </div>

          <div class="md-form">
                <input type="text" name="desc_uso" id="desc_uso" class="form-control" required>
                <label for="codigo">Descripci&oacute;n de Uso</label>
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
    <div class="modal fade" id="usos" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
              Editar Uso
             </h2> 
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
         </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <form id="frm-edit">  
            <input type="hidden" id="id_uso" name="id_uso">
            

            <div class="md-form">
                <input type="text" size="10" maxlength="10"  name="clave_uso" id="clave_uso" class="form-control" readonly="readonly" >
                <label for="codigo">Clave de Uso</label>
            </div>  


            <div class="md-form">
                <input type="text" name="desc_uso" id="desc_uso" class="form-control" required>
                <label for="codigo">Descripci&oacute;n de Uso</label>
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

