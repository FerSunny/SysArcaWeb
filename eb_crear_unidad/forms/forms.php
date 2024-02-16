<form id="form_productos" class="form_productos" action="controladores/actualizar.php" method="POST">
  	<div class="modal fade" id="modal_productos" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
    	<div class="modal-dialog modal-fluid" role="document">
      		<div class="modal-content">
	            <div class="modal-header">
	              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Productos</h2>
	              <h5 style="color:blue;text-align:center" class="modal-title">Agregar Productos</h5>
	            </div>
        
	            <div style="color:#000000;background:#EFFBF5" class="modal-body table-responsive">
	           		<table id="dt_pro" class="table compact hover row-border" cellspacing="1" width="100%">
						<thead>
							<tr>
								<th>Id Proveedor</th>
								<th>Código</th>
								<th>Producto</th>
								<th>Descripción</th>
								<th>Proveedor</th>
								<th>Minimo</th>
			    				<th>Maximo</th>
			    				<th>Existencias</th>
			    				<th>Costo</th>
			    				<th>Cantidad</th>
			    				<th>Agregar</th>
							</tr>
						</thead>
					</table>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	            </div>
      		</div>
    	</div>
 	</div>
</form>