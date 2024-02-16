<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  header("Content-Type: text/html;charset=utf-8");
?>
<form name="AltasPlantilla_usg" action="controladores/registro_plantilla_usg_rx.php" method="post" >
<!-- Modal -->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <h5  style="color:blue;text-align:center" class="modal-title" id="exampleModalLabel">Nueva Plantilla RX</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="fn_id_plantilla" id="fi_id_plantilla" class="form-control" readonly="readonly" maxlength="5" size="5" placeholder="Id plantilla">
                  <label for="fn_id_plantilla">Id Plantillas</label>
                </div>
              </div>
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="fn_nombre" id="fi_nombre" class="form-control" maxlength="50" size="50">
                  <label for="fn_nombre">Nombre</label>
                </div>
              </div>
            </div>
             <div class="col">
            </div>
          </div>
           <div class="row">
            <div class="col">
              <div class="md-form ">
                <label for="">Medico</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form ">
                 <select class="form-control" name="fn_medico" id="fi_medico" >
                    <?php
                      $sql="SELECT us.id_usuario,CONCAT(us.nombre,' ',us.a_paterno,' ',a_materno) AS nombre_usu FROM se_usuarios us
                      WHERE us.activo = 'A'
                      AND fk_id_perfil in (9,39)
                      ORDER BY nombre,a_paterno,a_materno";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre_usu'];
                          echo "</option>";
                        }
                    ?>
                  </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form">
                <label for="">Estudio</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form">
                 <select class="form-control" name="fn_estudio" id="fi_estudio" >
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' and fk_id_plantilla = 6 order by desc_estudio";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estudio']."' >";
                          echo $row['desc_estudio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="fn_titulo_desc" id="fi_titulo_desc" class="form-control"   maxlength="50" size="50" >
                  <label for="fn_titulo_desc">Titulo</label>
                </div>
              </div>
            </div>
            <div class="col">
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                 <textarea  class="md-textarea form-control" name="fn_descripcion" id="fi_descripcion" rows="14" cols="125" wrap="soft"></textarea>
                  <label for="fn_descripcion">Descripción</label>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <textarea  class="md-textarea form-control"  name="fn_firma" id="fi_firma" rows="3" cols="50" wrap="hard"></textarea>
                  <label for="fn_descripcion">Firma</label>
                </div>
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col">
              <div class="md-form">
                <label for="">Estado</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form">
                 <select class="form-control" id="fi_estado" name="fn_estado">
                  <option value="A">Activo</option>
                  <option value="S">Suspendido</option>
            </select>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Ingresar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</form>


<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  style="color:blue;text-align:center" class="modal-title" id="exampleModalLabel">Editar Plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="color:#000000;background:#EFFBF5" class="modal-body">
           <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="fn_id_plantilla" id="fi_id_plantilla" class="form-control" readonly="readonly" maxlength="5" size="5" placeholder="Id plantilla">
                  <label for="fn_id_plantilla">Id Plantilla</label>
                </div>
              </div>
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="fn_nombre" id="fi_nombre" class="form-control" maxlength="50" size="50">
                  <label for="fn_nombre">Nombre</label>
                </div>
              </div>
            </div>
             <div class="col">
            </div>
          </div>
           <div class="row">
            <div class="col">
              <div class="md-form ">
                <label for="">Medico</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form ">
                 <select class="form-control" name="fn_medico" id="fi_medico" >
                    <?php
                      $sql="SELECT us.id_usuario,CONCAT(us.nombre,' ',us.a_paterno,' ',a_materno) AS nombre_usu FROM se_usuarios us
                      WHERE us.activo = 'A'
                      AND fk_id_perfil in(9,39)
                      ORDER BY nombre,a_paterno,a_materno";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre_usu'];
                          echo "</option>";
                        }
                    ?>
                  </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form">
                <label for="">Estudio</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form">
                 <select class="form-control" name="fn_estudio" id="fi_estudio" >
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' and fk_id_plantilla = 6 order by desc_estudio";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estudio']."' >";
                          echo $row['desc_estudio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="fn_titulo_desc" id="fi_titulo_desc" class="form-control"   maxlength="50" size="50" >
                  <label for="fn_titulo_desc">Titulo</label>
                </div>
              </div>
            </div>
            <div class="col">
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                 <textarea  class="md-textarea form-control" name="fn_descripcion" id="fi_descripcion" rows="14" cols="125" wrap="soft"></textarea>
                  <label for="fn_descripcion">Descripción</label>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <textarea  class="md-textarea form-control"  name="fn_firma" id="fi_firma" rows="3" cols="50" wrap="hard"></textarea>
                  <label for="fn_descripcion">Firma</label>
                </div>
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col">
              <div class="md-form">
                <label for="">Estado</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form">
                 <select class="form-control" id="fi_estado" name="fn_estado">
                  <option value="A">Activo</option>
                  <option value="S">Suspendido</option>
            </select>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Ingresar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</form>

