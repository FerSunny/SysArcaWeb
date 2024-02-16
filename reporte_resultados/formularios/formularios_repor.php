<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="form_obs" action="" method="post">
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
                Observaciones
            </h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <div class="md-form">
            <textarea name="observ" id="observ" class="md-textarea form-control" rows="3"></textarea>
            <label for="observ">Obervaciones</label>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btniniciar"  >Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>


