<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="form_provee" action="" method="post">
    <div class="modal fade" id="myModals" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <h2 style="color:blue;text-align:center" class="modal-title">
                      Nuevo proveedor
                  </h2>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div style="color:#000000;background:#EFFBF5" class="modal-body">
                  <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="text" name="provee" id="provee" class="form-control" required>
                        <label for="provee">Proveedor</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="text" name="respon" id="respon" class="form-control" required>
                        <label for="respon">Responsable</label>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                    <div class="md-form">
                        <input type="text" name="direc" id="direc" class="form-control" required>
                        <label for="respon">Dirección</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="cp" id="cp" class="form-control" required>
                      <label for="cp">Codigo postal</label>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="tel" id="tel" class="form-control" required>
                      <label for="tel">Teléfono</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="email" id="email" class="form-control" required>
                      <label for="email">E-mail</label>
                    </div>
                  </div>
                </div>
                  <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="web" id="web" class="form-control" required>
                      <label for="web">Sitio web</label>
                    </div>
                  </div>
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

<form id="frmedit" class="form-horizontal" method="POST">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
        <div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">
                            Editar Proveedor
                        </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div style="color:#000000;background:#EFFBF5" class="modal-body">
                  <input type="hidden" id="prov" name="prov" value="0">
                  <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="text" name="provee" id="provee" class="form-control" required>
                        <label for="provee">Proveedor</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="text" name="respon" id="respon" class="form-control" required>
                        <label for="respon">Responsable</label>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                    <div class="md-form">
                        <input type="text" name="direc" id="direc" class="form-control" required>
                        <label for="respon">Dirección</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="cp" id="cp" class="form-control" required>
                      <label for="cp">Codigo postal</label>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="tel" id="tel" class="form-control" required>
                      <label for="tel">Teléfono</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="email" id="email" class="form-control" required>
                      <label for="email">E-mail</label>
                    </div>
                  </div>
                </div>
                  <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      <input type="text" name="web" id="web" class="form-control" required>
                      <label for="web">Sitio web</label>
                    </div>
                  </div>
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