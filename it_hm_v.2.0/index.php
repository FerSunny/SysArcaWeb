<?php 
session_start();
include_once("db_connect.php");

?>
<head>
	<title>Administracion de Imagenes</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body background="../imagenes/logo_arca_sys_web.jpg">
<?php
  include("../includes/barra.php");
  //include("formularios/formularios_imagenes.php");
  ?>
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<br>
<div class="row">
<form action="import.php" method="post" enctype="multipart/form-data" id="import_form">
<div class="col-md-3">
<input type="file" name="file" />
</div>
<div class="col-md-5">
<input type="submit" class="btn btn-primary" name="import_data" value="IMPORT">
</div>
</form>
</div>
<br>
<div class="row">
<table class="table table-bordered">
<thead>
<tr>
<th>Nickname</th>
<th>Instrument ID</th>
<th>Date</th>
<th>Time</th>
<th>Adapter</th>
<th>Position</th>
<th>Sample No.</th>
</tr>
</thead>
<tbody>
	<?php
	$sql = "
	 SELECT
	   	nickname,
		Instrument_id,
		date_v,
		time_v,
		adapter,
		position_v,
		sample_no
	 FROM hm_recepcion_nx_550 
	 ORDER BY date_v 
	 DESC LIMIT 25
	 ";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	if(mysqli_num_rows($resultset)) {
		while( $rows = mysqli_fetch_assoc($resultset) ) {
		?>
		<tr>
		<td><?php echo $rows['nickname']; ?></td>
		<td><?php echo $rows['Instrument_id']; ?></td>
		<td><?php echo $rows['date_v']; ?></td>
		<td><?php echo $rows['time_v']; ?></td>
		<td><?php echo $rows['adapter']; ?></td>
		<td><?php echo $rows['position_v']; ?></td>
		<td><?php echo $rows['sample_no']; ?></td>
		</tr>
		<?php } 
	}else { 
		?>
		<tr><td colspan="5">No records to display.....</td></tr>
		<?php 
	} ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
