<?php
    date_default_timezone_set('America/Mexico_City');
    $title="Perfiles Médicos";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>
  <body background="../imagenes/logo_arca_sys_web.jpg">
	<?php
	include("../includes/barra.php");
	?>
    <div class="container">
			<div class="panel panel-info">
					<div class="panel-heading">
					    <div class="btn-group pull-right">
							<!--<a  href="create_profile.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nuevo Perfil</a>-->
						</div>
						  <h4><i class='glyphicon glyphicon-search'></i> Lista de perfiles médicos</h4> 
					</div>
					<div class="panel-body">
						<!-- <div id="resultados"></div> -->
						<div class='outer_div'></div>

						<div class="table-responsive col-sm-12">
							<table id="table_profile_medic" class="table table-bordered table-hover datatable-generated" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>ID Perfil</th>
                    					<th>Clave</th>
										<th>Descripción</th>
										<th>Costo</th>
										<th></th>
									</tr>
								</thead>
						</div>

					</div>
			</div>

		</div>


    <?php include("footer.php");?>
	<script type="text/javascript" src="js/list-profile.js"></script>

  </body>
</html>
