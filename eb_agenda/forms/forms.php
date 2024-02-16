<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form id="form-add" method="POST">
			  <div class="modal-header">
				<h2 style="color:blue;text-align:center" class="modal-title">
                Nuevo Evento
            </h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
			  <div class="modal-body">
			  	<div class="md-form mt-0">
            <div class="md-form">
              <input type="text" name="title" class="form-control" id="title">
              <label for="title">Titulo</label>
            </div>
          </div>
          <div class="md-form">
					  <textarea name="notas" id="notas" class="md-textarea form-control" rows="3"></textarea>
					  <label for="notas">Notas</label>
					</div>
					<div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="date" name="start" class="form-control" id="start" readonly>
                  <label for="start">Fecha de inicio</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" name="start-time" id="start-time" class="form-control" required>
                  <label for="start-time">Hora de inicio</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="date" name="end" class="form-control" id="end">
                  <label for="start">Fecha Final</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" name="end-time" id="end-time" class="form-control" required>
                  <label for="end-time">Hora Final</label>
                </div>
              </div>
            </div>
          </div>
          <div class="md-form mt-0">
            <div class="md-form">
              <input type="color" name="color-fecha" id="color-fecha" class="" required>
            </div>
          </div>
			  </div>
      </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form id="form-edit" method="POST">
			  <div class="modal-header">
			  	<h4 style="color:blue;text-align:center" class="modal-title">
                Modificar Evento
            </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
  			  <div class="modal-body">			  
  				  <input type="hidden" name="id" class="form-control" id="id">
  				  <div class="md-form mt-0">
              <div class="md-form">
                <input type="text" name="title" class="form-control" id="title">
                <label for="title">Titulo</label>
              </div>
            </div>
          <div class="md-form">
					  <textarea name="notas" id="notas" class="md-textarea form-control" rows="3"></textarea>
					  <label for="notas">Notas</label>
					</div>
					<div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="date" name="start" class="form-control" id="start" readonly>
                  <label for="start">Fecha de inicio</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" name="start-time" id="start-time" class="form-control" required>
                  <label for="start-time">Hora de inicio</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="date" name="end" class="form-control" id="end" >
                  <label for="start">Fecha Final</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" name="end-time" id="end-time" class="form-control" required>
                  <label for="end-time">Hora Final</label>
                </div>
              </div>
            </div>
          </div>
          <div class="md-form mt-0">
            <div class="md-form">
              <input type="color" name="color-fecha" id="color-fecha" class="" required>
              <label for="color-fecha">Color para identificar el evento</label>
            </div>
          </div>
          <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Eliminar Evento</label>
					</div>
			  </div>
      </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
 