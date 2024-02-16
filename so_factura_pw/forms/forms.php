<form id="form-edit" method="POST">
  <!-- Modal -->
  <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:blue;text-align:center; font-size: 2em;  font-weight: 800;" class="modal-title">
                Cita:
            </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
        <div class="modal-body">        
          <input type="hidden" name="id" class="form-control" id="id">
          <div class="md-form mt-0">
            <div class="md-form">
              <input type="text" name="paciente" class="form-control" id="paciente">
              <label for="paciente">Nombre</label>
            </div>
          </div>
          <div class="md-form">
            <p style="color: black; font-weight: 900; font-size: 16px;">Lista de Estudios</p>
            <div class="estudios"></div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="md-form">
                <input type="text" name="total" class="form-control" id="total">
                <label for="total">Total a pagar</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="md-form">
                <input type="text" name="a_cuenta" class="form-control" id="a_cuenta" required>
                <label for="a_cuenta">A cuenta</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="md-form">
                <input type="text" name="resta" class="form-control" id="resta" required>
                <label for="resta">Saldo</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="md-form">
                <input type="datetime-local" name="entrega" class="form-control" id="entrega" required>
                <label for="entrega">Fecha de entrega</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="md-form">
                <select class='form-control input-sm  col-md-pull-1' name="tipo_pago" id="tipo_pago" required>
                      <option value="">Tipo de pago</option>
                      <?php
                          $sql="SELECT * FROM kg_tipo_pago where estado = 'A'";
                          $rec=mysqli_query($conexion,$sql);
                            while ($row=mysqli_fetch_array($rec))
                            {
                                echo "<option value='".$row['id_tipo_pago']."' >";
                                echo $row['desc_tipo_pago'];
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
                  <input type="text" name="medico" class="form-control" id="medico" readonly>
                  <label for="start">Medico</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="dx" id="dx" class="form-control" required>
                  <label for="start-time">Diagnostico</label>
                </div>
              </div>
            </div>
          </div>
          <div class="checkbox">
              <label class="text-danger"><input type="checkbox"  name="delete" id="delete">Eliminar Cita</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>
 