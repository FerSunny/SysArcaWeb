<?php 
	date_default_timezone_set('America/Mexico_City');
	$FechaHoy=date("d/m/Y : H : i : s");
?>
<div>
  <form id="frmEntregar" action="" method="POST">
    <input type="hidden" name="id_factura" id="id_factura" value="">
    <input type="hidden" name="id_estudio" id="id_estudio" value="">
    <input type="hidden" name="grupo" id="grupo" value="">
    <!-- Modal -->
    <div class="modal fade" id="modalEntregar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalEntregarLabel">Entregar resultados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>              
        </div>
        <div class="modal-body">              
          ¿Estas seguro de entregar resultado?<strong data-name=""></strong>
        </div>
        <div class="modal-footer">
          <button type="button" id="actualizar" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
    <!-- Modal -->
  </form>
</div>