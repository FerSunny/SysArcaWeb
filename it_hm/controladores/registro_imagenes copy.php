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

$files_post = $_FILES['fn_archivo'];
$ruta = '../img_rx/'.$file_post;

$files = array();
$file_count = count($files_post['name']);
$file_keys = array_keys($files_post);

$permitidos = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
$limite_kb = 1000;

for ($i=0; $i < $file_count; $i++) 
{ 

	if(in_array($files_post["type"][$i], $permitidos))
	{
		if($files_post["size"][$i] <= $limite_kb * 1024)
		{
			$archivo = $ruta.$files_post["name"][$i];

			$nombre=$files_post["name"][$i];
	
			if(!file_exists($ruta)){
				mkdir($ruta);
			}

			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($files_post["tmp_name"][$i], $archivo);
				
				if($resultado){
					//echo "Archivo Guardado";
					//$atributos=getimagesize($archivo);
					//$alt=$atributos[0];
					//$anc=$atributos[1];
					if(is_uploaded_file($_FILES['fn_archivo']['tmp_name'])){
							$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
					}
					
				} else {
						$nombre= "No pudo bajar el fichero";
				}
				
				} else{
					$nombre= "Archivo ya existe";
				}
		}
		else{
			$nombre= "Tamaño excedente (max 819,200)";
		}

	}
	else{
		 $nombre= "Tipo de fichero invalido";
	}
	$query = "
		INSERT INTO hm_ficheros
					(fk_id_empresa,
					id_fichero,
					nombre_fichero,
					ruta,
					estatus,
					fecha_estatus,
					fk_id_usuario,
					estado)
		VALUES (1,
				0,
				'$nombre',
				'$ruta',
				'C',
				NOW(),
				'$id_usuario',
				'A');	
		";

    $resultado = mysqli_query($conexion, $query);
}

if ($resultado) {
			header("location: ../tabla_ficheros.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexión: ' . $query);
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}
?>
