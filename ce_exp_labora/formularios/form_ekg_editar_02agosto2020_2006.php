<!-- Editar -->

  <form id="frm-edit" class="form-horizontal" method="POST">
    <div class="modal fade" id="resultado_usg" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" style="size: 40%">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
              Editar Resultadooo
             </h2> 
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
         </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <form id="frm-edit">  
            <input type="hidden" id="id_factura" name="id_factura">

          <div class="row">
            <div class="col">
               <div class="md-form">
                <input type="text"   name="desc_estudio" id="desc_estudio" class="form-control" readonly="" required=""  >
                <label for="codigo">Estudio</label>
              </div>
            </div>
            <div class="col">
              <div class="md-form">
                <input type="text"   name="nombre_plantilla" id="nombre_plantilla" class="form-control" readonly=""  required="" >
                <label for="codigo">Plantilla</label>
              </div> 
            </div>
            
          </div>
            

            <div class="md-form">
                <input type="text"   name="titulo_desc" id="titulo_desc" class="form-control" required=""  >
                <label for="codigo">Titulo</label>
            </div> 

          <div class="md-form">
            <!--Material textarea-->
              <textarea id="descripcion" name="descripcion" class="md-textarea form-control" rows="40" required=""></textarea>
              <label for="codigo">Descripci&oacute;n</label>
          </div>  

          <div class="md-form">
            <!--
                <input type="text"   name="firma" id="firma" class="form-control" required="">
            -->
                <textarea id="firma" name="firma" class="md-textarea form-control" rows="3" required=""></textarea>
                <label for="codigo">Firma</label>
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

