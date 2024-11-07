<?php 

	include("../controladores/conex.php");

	date_default_timezone_set('America/Mexico_City');

	$FechaHoy=date("d/m/Y : H : i : s");

?>



<form id="form_productos" action="" method="post">

	<div class="modal fade" id="myModals" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

						<h2 style="color:blue;text-align:center" class="modal-title">

								Nuevo Elemento

						</h2>

						<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div style="color:#000000;background:#EFFBF5" class="modal-body">

					<div class="md-form">

						<input type="number" name="codigo" id="codigo" class="form-control"  maxlength="15" required>

						<label for="codigo">Código</label>

					</div>


<!-- linea 1 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="wbctotales" id="wbctotales" class="form-control" required>
										<label for="producto">wbctotales</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="rbctotales" id="rbctotales" class="form-control" required>
										<label for="desc_p">rbctotales </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="hgb" id="hgb" class="form-control" required>
										<label for="desc_p">hgb </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="hct" id="hct" class="form-control" required>
										<label for="desc_p">hct </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 2 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mcv" id="mcv" class="form-control" required>
										<label for="producto">mcv</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mchpg" id="mchpg" class="form-control" required>
										<label for="desc_p">mchpg </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mchcgdl" id="mchcgdl" class="form-control" required>
										<label for="desc_p">mchcgdl </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="plt" id="plt" class="form-control" required>
										<label for="desc_p">plt </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 3 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="rdwsd" id="rdwsd" class="form-control" required>
										<label for="producto">rdwsd</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="rdwcv" id="rdwcv" class="form-control" required>
										<label for="desc_p">rdwcv </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mpv" id="mpv" class="form-control" required>
										<label for="desc_p">mpv </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="neutabs" id="neutabs" class="form-control" required>
										<label for="desc_p">neutabs </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 4 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="lymphabs" id="lymphabs" class="form-control" required>
										<label for="producto">lymphabs</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="monoabs" id="monoabs" class="form-control" required>
										<label for="desc_p">monoabs </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="eoabs" id="eoabs" class="form-control" required>
										<label for="desc_p">eoabs </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="basoabs" id="basoabs" class="form-control" required>
										<label for="desc_p">basoabs </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 5 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="neutporc" id="neutporc" class="form-control" required>
										<label for="producto">neutporc</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="lymphporc" id="lymphporc" class="form-control" required>
										<label for="desc_p">lymphporc </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="monoporc" id="monoporc" class="form-control" required>
										<label for="desc_p">monoporc </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="eoporc" id="eoporc" class="form-control" required>
										<label for="desc_p">eoporc </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 6 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="basoporc" id="basoporc" class="form-control" required>
										<label for="producto">basoporc</label>
									</div>
								</div>
							</div>

							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="date_v" id="date_v" class="form-control" required>
										<label for="producto">Fecha (MM/DD/YYYY)</label>
									</div>
								</div>
							</div>

						</div>





					







				</div>

				<div class="modal-footer">

						<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

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

									Editar Elemento

							</h2>

							 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>

					<div style="color:#000000;background:#EFFBF5" class="modal-body">

						<input type="hidden" id="idperfil" name="idperfil" value="0">

						<input type="hidden" id="opcion" name="opcion" value="modificar">

						<input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">

						 <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">

						<div class="md-form">

							<input type="text" name="codigo" id="codigo" class="form-control" readonly>

							<label for="codigo">Código</label>

						</div>
<!-- linea 1 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="wbctotales" id="wbctotales" class="form-control" required>
										<label for="producto">wbctotales</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="rbctotales" id="rbctotales" class="form-control" required>
										<label for="desc_p">rbctotales </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="hgb" id="hgb" class="form-control" required>
										<label for="desc_p">hgb </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="hct" id="hct" class="form-control" required>
										<label for="desc_p">hct </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 2 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mcv" id="mcv" class="form-control" required>
										<label for="producto">mcv</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mchpg" id="mchpg" class="form-control" required>
										<label for="desc_p">mchpg </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mchcgdl" id="mchcgdl" class="form-control" required>
										<label for="desc_p">mchcgdl </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="plt" id="plt" class="form-control" required>
										<label for="desc_p">plt </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 3 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="rdwsd" id="rdwsd" class="form-control" required>
										<label for="producto">rdwsd</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="rdwcv" id="rdwcv" class="form-control" required>
										<label for="desc_p">rdwcv </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="mpv" id="mpv" class="form-control" required>
										<label for="desc_p">mpv </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="neutabs" id="neutabs" class="form-control" required>
										<label for="desc_p">neutabs </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 4 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="lymphabs" id="lymphabs" class="form-control" required>
										<label for="producto">lymphabs</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="monoabs" id="monoabs" class="form-control" required>
										<label for="desc_p">monoabs </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="eoabs" id="eoabs" class="form-control" required>
										<label for="desc_p">eoabs </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="basoabs" id="basoabs" class="form-control" required>
										<label for="desc_p">basoabs </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 5 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="neutporc" id="neutporc" class="form-control" required>
										<label for="producto">neutporc</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="lymphporc" id="lymphporc" class="form-control" required>
										<label for="desc_p">lymphporc </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="monoporc" id="monoporc" class="form-control" required>
										<label for="desc_p">monoporc </label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="eoporc" id="eoporc" class="form-control" required>
										<label for="desc_p">eoporc </label>
									</div>
								</div>
							</div>
						</div>

<!-- linea 6 -->
						<div class="row">
							<div class="col">
								<div class="md-form mt-0">
									<div class="md-form">
										<input type="text" name="basoporc" id="basoporc" class="form-control" required>
										<label for="producto">basoporc</label>
									</div>
								</div>
							</div>

						</div>



					</div>

					<div class="modal-footer">

							<button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

					</div>

				</div>

			</div>

		</div>

	</div> 

</form>



