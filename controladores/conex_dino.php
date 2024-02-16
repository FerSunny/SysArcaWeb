<?php
// conexion a la base de datos syslabweb DiNo
	$server = "localhost";
	$user = "sysusrdba";
	$password = "GatoFelix_2021";
	$bd = "admin_syslabweb";

	$conexion_dino = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion_dino){
		die('Error de Conexion: ' . mysqli_connect_errno());
	}
       //$conexion->set_charset("utf8");
       
       //$conexion->set_charset("SET NAMES 'utf8'");
       @mysqli_query($conexion_dino, "SET NAMES 'utf8'");

?>