<?php 

  // Nos conectamos a la Base de Datos MySQL
  $con = mysqli_connect("localhost", "labora41_root", "ArcaRoot_2017", "labora41_bd_arca");
 
  // Verificamos la conexión a la Base de Datos MySQL 
  if (mysqli_connect_errno()) {
      echo "Error al Conectar a la base de Datos: " . mysqli_connect_error();
  }
	@mysqli_query($con, "SET NAMES 'utf8'");
?>
