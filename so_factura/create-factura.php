<form action="" id="form-factura">
  <div class="modal fade" id="modal-factura" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Datos Facturación</h3>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <p> * Datos Abligatorios</p>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm">
                <label for=""></label>
                <input type="text" class="form-control" name="f_nombre" id="f_nombre" placeholder="Nombre Completo *" required>
              </div>
              <div class="col-sm">
                <label for=""></label>
                <input type="text" class="form-control" name="f_rfc" id="f_rfc" placeholder="RFC *" required>
              </div>
              <div class="col-sm">
                <label for=""></label>
                <input type="text" class="form-control" name="f_dom" id="f_dom" placeholder="Domicilio">
              </div>
              <div class="col-sm">
                <label for=""></label>
                <input type="mail" class="form-control" name="f_mail" id="f_mail" placeholder="Correo Electrónico *" required>
              </div>
              <div class="col-sm" style="margin-top:50px;">
                <label for="">Usos</label>
                <select class="selectpicker" data-live-search="true" name="f_usos" id="">
                  <?php
                    $stmt = $con->prepare("SELECT id_uso,desc_uso FROM kg_usos");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc())
                    {
                      echo "<option value='".$row['id_uso']."'>";
                      echo $row['desc_uso'];
                      echo "</option>";
                    }
                    $stmt->close();
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-danger" id="fac-cancelar">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>
