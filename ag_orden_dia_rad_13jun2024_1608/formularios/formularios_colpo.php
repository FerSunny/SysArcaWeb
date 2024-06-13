<?php 
include("../controladores/conex.php") ;
//$numero_factura=$_GET['numero_factura'];
//$studio=$_GET['studio'];
?>
<div class="modal fade" id="myModals" role="dialog">
	<div>
		<form id="AltasEstudio" action="controladores/registro_colpos.php" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 style="color:blue;text-align:center" class="modal-title">Registro de Nueva Nota</h2>
				</div>
				<div style="color:#000000;background:#EFFBF5" class="modal-body">
					<table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
						<tr>
							<td><label>Factura:</label></td>
							<td><input type="text" class="form-control" id="fi_id_factura" required name="fn_id_factura"  maxlength="50" size="50"  readonly="readonly" size="2"></td>
						</tr>
						 <tr>
								<td><label>Estudio:</label></td>
								<td><input type="text" class="form-control" id="fi_fk_id_estudio" required name="fn_fk_id_estudio"  maxlength="50" size="50" readonly="readonly" size="2"></td>
						</tr>
						<tr>
							<td><label></label></td>
							<td><input type="text" class="form-control" id="fi_titulo_desc" value="REPORTE DE RADIOLOGIA" required name="fn_titulo_desc"  maxlength="50" size="50" placeholder="Titulo del estudio"></td>
						</tr>
						<tr>
							<td><label></label></td>
							<td>
								<textarea name="fn_descripcion" id="fi_descripcion" rows="5" cols="150" wrap="soft" >
										</textarea>
							</td>
						</tr>
			<!-- Titulo otros allazgos -->
						<tr>
							<td><label></label></td>
							<td><input type="text" class="form-control" id="fi_t_allazgos" value="OTROS HALLAZGOS" required name="fn_t_allazgos"  maxlength="50" size="50" ></td>
						</tr>
			<!-- descripcion otros allazgos -->
						<tr>
							<td><label></label></td>
							<td>
								<textarea name="fn_d_allazgos" id="fi_d_allazgos" rows="3" cols="150" wrap="soft" >
								 </textarea>
							</td>
						</tr>
			<!-- Titulo otros diagnostico -->
						 <tr>
								<td><label></label></td>
								<td><input type="text" class="form-control" id="fi_t_diagnostico" value="CONSIDERACIONES" required name="fn_t_diagnostico"  maxlength="50" size="50" ></td>
						</tr>
			<!-- descripcion diagnostico -->
						 <tr>
								<td><label></label></td>
								<td>
									<textarea name="fn_d_disgnostico" id="fi_d_diagnostico" rows="3" cols="150" wrap="soft" >
									</textarea>
								</td>
						</tr>
			<!-- Titulo comentarios y sugerencias -->
						 <tr>
								<td><label></label></td>
								<td><input type="text" class="form-control" id="fi_t_comenta" value="COMENTARIOS Y SUGERENCIAS" required name="fn_t_comenta"  maxlength="50" size="50" ></td>
						</tr>
			<!-- descripcion comentarios y sugerencias -->
						 <tr>
								<td><label></label></td>
								<td>
								<textarea name="fn_d_comenta" id="fi_d_comenta" rows="3" cols="150" wrap="soft" ></textarea>
								</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
				  <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
				  <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!--  </div> -->
<!--</div> -->

<!--Editar Participacion-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				<div >
					<div class="modal-content">
					
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						  <h2 id="modalEliminarLabel" style="color:blue;text-align:center" class="modal-title">Modificar Nota </h2>
						</div>

						<div style="color:#000000;background:#EFFBF5" class="modal-body">
							<table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
								<tr>
									<td><label>Factura:</label></td>
									<td><input type="text" class="form-control" id="fi_id_factura" required name="fn_id_factura"  maxlength="50" size="50"  readonly="readonly" ></td>
								</tr>

								 <tr>
										<td><label>Estudio:</label></td>
										<td><input type="text" class="form-control" id="fi_fk_id_estudio" required name="fn_fk_id_estudio"  maxlength="50" size="50" readonly="readonly"></td>
								</tr>
								<tr>
									<td><label></label></td>
									<td><input type="text" class="form-control" id="fi_titulo_desc" required name="fn_titulo_desc"  maxlength="50" size="50" readonly="readonly"  placeholder="Titulo del estudio"></td>
								</tr>
								<tr>
									<td><label></label></td>
									<td>
									  <textarea name="fn_descripcion" id="fi_descripcion" rows="5" cols="150" wrap="soft" >
										</textarea>
									</td>
								</tr>
					<!-- Titulo otros allazgos -->
								<tr>
									<td><label></label></td>
									<td><input type="text" class="form-control" id="fi_t_allazgos" required readonly="readonly" name="fn_t_allazgos"  maxlength="50" size="50" ></td>
								</tr>
					<!-- descripcion otros allazgos -->
								<tr>
									<td><label></label></td>
								  <td>
									  <textarea name="fn_d_allazgos" id="fi_d_allazgos" rows="3" cols="150" wrap="soft" >
								  </textarea>
								  </td>
								</tr>
					<!-- Titulo otros diagnostico -->
								 <tr>
										<td><label></label></td>
										<td><input type="text" class="form-control" id="fi_t_diagnostico" readonly="readonly" name="fn_t_diagnostico"  maxlength="50" size="50" ></td>
								</tr>
					<!-- descripcion diagnostico -->
								 <tr>
										<td><label></label></td>
										<td>
											  <textarea name="fn_d_disgnostico" id="fi_d_diagnostico" rows="3" cols="150" wrap="soft" >
										 	</textarea>
										 </td>
								</tr>
					<!-- Titulo comentarios y sugerencias -->
								 <tr>
										  <td><label></label></td>
										  <td><input type="text" class="form-control" id="fi_t_comenta" readonly="readonly" name="fn_t_comenta"  maxlength="50" size="50" ></td>
								</tr>
					<!-- descripcion comentarios y sugerencias -->
								 <tr>
										<td><label></label></td>
										  <td>
											  <textarea name="fn_d_comenta" id="fi_d_comenta" rows="3" cols="150" wrap="soft" >
										  </textarea>
										</td>
								</tr>
							</table>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- Modal Eliminar-->
<form id="frmEliminarzona" action="controladores/eliminar.php" method="POST">
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Nota</h4>
            </div>
            <div class="modal-body">
              
                ¿Está seguro de eliminar el estudio?<strong data-name=""></strong>
                    <input type="hidden" id="idfactura" name="idfactura" value="">
                    <input type="hidden" id="opcion" name="opcion" value="eliminar">
                    <div class="form-group">

                      <div class="col-sm-8">
                        <input id="fi_id_factura" name="fn_id_factura" type="text" class="form-control" maxlength="8" >
                      </div>

                      <div class="col-sm-8">
                        <input id="fi_fk_id_estudio" name="fn_fk_id_estudio" type="text" class="form-control" maxlength="8" >
                      </div>

                      <div class="col-sm-8">
                        <input id="fi_titulo_desc" name="fn_titulo_desc" type="text" class="form-control" maxlength="8" >
                      </div>

                    </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
           
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
