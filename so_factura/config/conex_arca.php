<?php
// conexion a la base de datos bd_arca
	$server = "localhost";
	
	$user = "root";
	$password = "";
	$bd = "labora41_bd_arca";
/*
	$user = "root";
	$password = "";
	$bd = "bd_arca";
*/
	$conexion_arca = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion_arca){
		die('Error de Conexion: ' . mysqli_connect_errno());
	}
       //$conexion->set_charset("utf8");
       
       //$conexion->set_charset("SET NAMES 'utf8'");
       @mysqli_query($conexion_arca, "SET NAMES 'utf8'");

?>
