<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="form_depto" action="" method="post">
    <div class="modal fade" id="myModals" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                      <h2 style="color:blue;text-align:center" class="modal-title">
                            Nueva Solicitud
                         </h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div style="color:#000000;background:#EFFBF5" class="modal-body">
                    <div class="row">
                    <div class="col">
                      <div class="md-form mt-0">
                        <div class="md-form">
                            <input type="date" name="festima" id="festima" class="form-control" maxlength="30" required>
                            <label for="depto">Fecha Estimada de entrega</label>
                        </div>
                    </div>
                  </div>
              </div>

          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
            </table>
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

<form id="frmedit" class="form-horizontal" method="POST">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
        <div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                      <input type="hidden" class="form-control  form-control-sm" id="dep" name="dep" minlength="1" maxlength="100" >
                    <div class="modal-header">
                         <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">
                            Editar Solicitudes
                         </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div style="color:#000000;background:#EFFBF5" class="modal-body">
                      <div class="row">
                         <div class="col">
                           <div class="md-form mt-0">
                              <div class="md-form">
                            <input type="date" name="festima" id="festima" class="form-control" required>
                            <label for="depto">Fecha Estimada de entrega</label>
                        </div>
                    </div>
                  </div>

              </div>

          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">   
            </table>
                    </div><!--Cierre modal body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

