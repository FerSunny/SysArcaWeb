<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$id_usuario= $_SESSION['id_usuario'];


//$nombre='pendiente';
//$ruta='pendiente';
$fecha_registro=date("y/m/d H:i:s");
$alt=0;
$anc=0;
$nombre='prueba';
// rutina para subir el fichero a al servidor

//$files_post = $_FILES['fn_archivo'];
//$ruta = '../img_rx/'.$file_post;

//$files = array();
//$file_count = count($files_post['name']);
//$file_keys = array_keys($files_post);

$permitidos = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
$limite_kb = 1000;
if(!empty($_FILES['fn_archivo']['name']) && in_array($_FILES['fn_archivo']['type'],$permitidos)){
	if(is_uploaded_file($_FILES['fn_archivo']['tmp_name'])){
		
		$csv_file = fopen($_FILES['fn_archivo']['tmp_name'], 'r');
		while( ($emp_record = fgetcsv($csv_file)) !== FALSE){
			$mysql_insert = "INSERT INTO hm_recepcion_nx_550 (nickname) VALUES('$emp_record[1]')";
			echo "registro-->".$mysql_insert;
			$resultado = mysqli_query($conexion, $mysql_insert);
		}
	}else{
		echo "No se cargo el fichero";	
	}	 
} else {
	echo "Tipo de fichero invalido".$_FILES['fn_archivo'];
}
//echo "termino";
//header("location: ../tabla_ficheros.php");

?>