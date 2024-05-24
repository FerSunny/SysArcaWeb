<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$id_usuario=$_SESSION['id_usuario'];
/*
$id_doc= $_SESSION['id_doc'];
$num_version= $_SESSION['num_version'];
$desc_doc = $_SESSION['desc_doc'];
*/
$nuevaversion  = $_POST['nuevaversion'];
$id_imagen  = $_POST['codigo'];

if($nuevaversion == 'N'){
	// obtenemos el movimiento para copiarlo al histoico antes de sobre escvribirlo
	$stm_select ="
	SELECT * FROM sgc_lista_ficheros
	WHERE estado = 'A'
	AND id_imagen = $id_imagen
	";
	if ($res_select = mysqli_query($conexion, $stm_select)) {
		while($row = $res_select->fetch_assoc())
		{
			$fk_id_usuario_estatus=$row['fk_id_usuario_estatus'];
			$fecha_estatus=$row['fecha_estatus'];
			$estatus=$row['estatus'];
		}
	}

}
$fecha_registro=date("y/m/d H:i:s");
$alt=0;
$anc=0;
$nombre='prueba';
// rutina para subir el fichero a al servidor

$id_insert=$id_doc;
$ruta = '../ficheros/'.$id_insert.'/';

$files_post = $_FILES['fn_archivo'];

$files = array();
$file_count = count($files_post['name']);
$file_keys = array_keys($files_post);

$permitidos = array("image/gif","image/png","image/jpeg","image/jpg","text/x-comma-separated-values", "text/comma-separated-values", "application/octet-stream", 
"application/vnd.ms-excel", "application/x-csv", "text/x-csv", "text/csv", "application/csv", "application/excel",
"application/vnd.msexcel", "text/plain");
$limite_kb = 4000;

for ($i=0; $i < $file_count; $i++) 
{ 

	//if(in_array($files_post["type"][$i], $permitidos))
	//{
		if($files_post["size"][$i] <= $limite_kb * 1024)
		{
			$archivo = $ruta.$files_post["name"][$i];

			$nombre=$files_post["name"][$i];

			$tipo=$files_post["type"][$i];

			$extension = strtolower(pathinfo($files_post["name"][$i], PATHINFO_EXTENSION));
			/*
			if (str_contains($tipo, 'sheet')) {
				$extension='Excel';
			}elseif (str_contains($tipo, 'wordprocessingml')) {
				$extension='word';
			}elseif (str_contains($tipo, 'pdf')) {
				$extension='pdf';
			}elseif (str_contains($tipo, 'visio')) {
				$extension='visio';
			}elseif (str_contains($tipo, 'plain')) {
				$extension='texto';
			}elseif (str_contains($tipo, 'jpg')) {
				$extension='imagen';
			}elseif (str_contains($tipo, 'gif')) {
				$extension='imagen';
			}elseif (str_contains($tipo, 'png')) {
				$extension='imagen';
			}elseif (str_contains($tipo, 'bmp')) {
				$extension='imagen';
			}else{
				$extension='Desconocido';
			}
			*/	
			if(!file_exists($ruta)){
				mkdir($ruta);
			}

			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($files_post["tmp_name"][$i], $archivo);
				
				if($resultado){
					//echo "Archivo Guardado";
					$atributos=getimagesize($archivo);
					//$alt=$atributos[0];
					//$anc=$atributos[1];
				} else {
						$nombre= "No pudo bajar el fichero";
				}
				
			} else{
				// rutina para subir los ficheros duplicados
				$nombre= "Archivo ya existe";
			}
		}
		else{
			$nombre= "Tamaño excedente (max 819,200)";
		}

	//}
	//else{
	//	 $nombre= "Tipo de fichero invalido";
	//}
	$query = "
	INSERT INTO sgc_lista_ficheros
            (fk_id_empresa,
             id_imagen,
             fk_id_doc,
             fk_id_usuario,
             fecha_publicacion,
             ver,
             revision,
             nombre,
             tipo,
             ruta,
             fecha_registro,
             estatus,
             estado)
VALUES (1,
        0,
        '$id_doc',
        '$id_usuario',
        NOW(),
        0,
        0,
        '$nombre',
        '$extension',
        '$ruta',
        NOW(),
        'C',
        'A');
";

    $resultado = mysqli_query($conexion, $query);
}

	if ($resultado) {
			header("location: ../tabla_ficheros.php?id_doc=$id_doc&num_version=$num_version&desc_doc=$desc_doc");
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
