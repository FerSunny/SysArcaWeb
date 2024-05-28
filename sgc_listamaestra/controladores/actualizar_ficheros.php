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
$id_imagen  = $_POST['id_imagen'];
$porcentaje  = $_POST['porcentaje'];

//die('id_imagen'.$id_imagen);

if($nuevaversion == 'N'){
	// obtenemos el movimiento para copiarlo al histoico antes de sobre escvribirlo
	$stm_select ="
	SELECT * FROM sgc_lista_ficheros
	WHERE estado = 'A'
	AND id_imagen = $id_imagen
	";
	//die('stm_select'.$stm_select);
	if ($res_select = mysqli_query($conexion, $stm_select)) {
		while($row = $res_select->fetch_assoc())
		{

			$fk_id_doc = $row['fk_id_doc'];
			$fk_id_usuario = $row['fk_id_usuario'];
			$fecha_publicacion = $row['fecha_publicacion'];
			$ver = $row['ver'];
			$revision = $row['revision'];
			$nombre = $row['nombre'];
			$tipo = $row['tipo'];
			$ruta = $row['ruta'];

			$stm_insert = "
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
             fk_id_usuario_estatus,
             fecha_status,
             estatus,
             estado)
			VALUES (1,
					0,
					$fk_id_doc,
					$fk_id_usuario,
					'$fecha_publicacion',
					$fk_id_doc,
					$revision,
					'$nombre',
					'$tipo',
					'$ruta',
					'$fecha_registro',
					$id_usuario,
					NOW(),
					'A',
					'A');
			";
			$res_insert = mysqli_query($conexion, $stm_insert);
			if ($res_insert){
				$stm_update=
				"
				update sgc_lista_ficheros
				set estatus = 'E'
				where id_imagen = $id_imagen
				";
				$res_update = mysqli_query($conexion, $stm_update);
				if ($res_update){

				}else{
					die('res_update'.$res_update);
				}
			}else{
				die('res_insert'.$res_insert);
			}
		}
	}else{
		die('error al recuperar el documento'.$stm_select);
		//die('Error de Conexión: ' . $query);
		
	}

}
header("location: ../tabla_ficheros.php?id_doc=$fk_id_doc&num_version=$fk_id_doc&desc_doc=$nombre");
/*
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
*/
?>
