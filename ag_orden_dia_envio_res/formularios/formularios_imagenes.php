<!-- Agregar Imagen -->
<form id="frm_add_img" enctype="multipart/form-data">
	<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 style="color:blue;text-align:center" class="modal-title">
							Agregar Imagen
					</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div style="color:#000000;background:#EFFBF5" class="modal-body">
					<div class="md-form">
						<input type="text" name="fn_nota" id="fn_nota" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema" value="<?php echo $numero_factura ?>" />
						<label for="fn_nota">Nota</label>
					</div>
					<div class="md-form">
						<input type="text" name="fn_estudio" id="fn_estudio" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema" value="<?php echo $studio ?>" />
						<label for="fn_estudio">Estudio</label>
					</div>
					<div class="md-form">
						<input type="file" class="form-control" id="fn_archivo" required name="fn_archivo" >
					</div>
					<div class="md-form">
						Estado
						<select class="form-control" name="fn_estado" id="fi_estado">
							<option value="A">Activo</option>
							<option value="S">Suspendido</option>
						</select>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Guardar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- Editar Imagen -->

<form id="frmedit" enctype="multipart/form-data">
	<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="md-form">
						<input type="text" name="fn_nota" id="fn_nota" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema" value="<?php echo $numero_factura ?>" />
						<label for="fn_nota">Nota</label>
					</div>
					<div class="md-form">
						<input type="text" name="fn_estudio" id="fn_estudio" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema" value="<?php echo $studio ?>" />
						<label for="fn_estudio">Estudio</label>
					</div>
					<div class="md-form">
						<input id="fn_desc_estudio" name="fn_desc_estudio" maxkength="50" required type="text" class="form-control" readonly="readonly">
						<label for="fn_desc_estudio">Estudio</label>
					</div>
					<div class="md-form">
						<input id="fn_archivo" name="fn_archivo" maxkength="50" required="no entry" required type="text" class="form-control" readonly="readonly">
						<label for="fn_archivo">Nombre del Archivo</label>
					</div>
					<div class="md-form">
						<input type="file" class="form-control" id="fn_archivo" required name="fn_archivo" >
					</div>
					<div class="md-form">
						<select class="form-control" name="fn_estado" id="fi_estado">
							<option value="A">Activo</option>
							<option value="S">Suspendido</option>
						</select>
					</div>
						<p style="font-weight: bold;">Recuerda recargar tu pagina, para efectuar los cambios.</p>.

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Guardar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</form>
