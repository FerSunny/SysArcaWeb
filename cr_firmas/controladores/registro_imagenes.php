<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

//$id_usuario= $_SESSION['id_usuario'];

$ancho = $_POST['ancho']; //estado
$alto = $_POST['alto'];
//$nombre = $_POST['nombre'];
$servicio = $_POST['servicio'];
$area = $_POST['area'];
$id_usuario = $_POST['usuario'];
//$nombre='pendiente';
//$ruta='pendiente';
$fecha_registro=date("y/m/d :H:i:s");
$alt=0;
$anc=0;
$nombre='prueba';
// rutina para subir el fichero a al servidor

$id_insert=$id_usuario;
$ruta = '../img_firmas/'.$id_insert.'/';

$files_post = $_FILES['fn_archivo'];

$files = array();
$file_count = count($files_post['name']);
$file_keys = array_keys($files_post);

$permitidos = array("image/gif","image/png","image/jpeg","image/jpg");
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
					$atributos=getimagesize($archivo);
					$alt=$atributos[0];
					$anc=$atributos[1];
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
		INSERT INTO cr_firmas
		            (fk_id_empresa,
		             id_firma,
		             desc_firma,
		             fk_id_servicio,
		             fk_id_area,
		             fk_id_usuario,
		             ruta_firma,
		             nombre,
		             alto,
		             ancho,
		             estado)
		VALUES (1,
		        0,
		        '$nombre',
		        $servicio,
		        $area,
		        $id_usuario,
		        '$ruta',
		        '$nombre',
		        $alto,
		        $ancho,
		        'A');
	";

    $resultado = mysqli_query($conexion, $query);
}

if ($resultado) {
			header("location: ../tabla_firmas.php");
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
