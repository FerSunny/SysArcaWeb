<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$numero_factura= $_SESSION['numero_factura'];
$studio= $_SESSION['studio'];

$estado = 'A'; //$_POST['fn_estado']; //estado
$carpeta = $_POST['carpeta'];
//$img_x_hoja = '0';
//$nombre='pendiente';
//$ruta='pendiente';
$fecha_registro=date("y/m/d :H:i:s");
$alt=0;
$anc=0;
$nombre='prueba';
$estatus = 0;
// rutina para subir el fichero a al servidor

$id_insert=$numero_factura;
$ruta = '../img_tomo/'.$id_insert.'/'; //.$carpeta.'/';

$files_post = $_FILES['fn_archivo'];

$files = array();
$file_count = count($files_post['name']);
$file_keys = array_keys($files_post);

$permitidos = array("image/gif","image/png","image/jpeg","image/jpg","text/x-comma-separated-values", "text/comma-separated-values", "application/octet-stream", 
"application/vnd.ms-excel", "application/x-csv", "text/x-csv", "text/csv", "application/csv", "application/excel",
"application/vnd.msexcel", "text/plain");
$limite_kb = 8000;

for ($i=0; $i < $file_count; $i++) 
{ 

	//if(in_array($files_post["type"][$i], $permitidos))
	//{
		if($files_post["size"][$i] <= $limite_kb * 1024)
		{
			$archivo = $ruta.$files_post["name"][$i];

			$nombre=$files_post["name"][$i];
	//die('ruta-->'.$ruta);
			if(!file_exists($ruta)){
				//die('va a crear carpeta');
				mkdir($ruta);
			}

			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($files_post["tmp_name"][$i], $archivo);
				
				if($resultado){
					//echo "Archivo Guardado";
					$atributos=getimagesize($archivo);
					$alt=$atributos[0];
					$anc=$atributos[1];
					$estatus = 1;
				} else {
					$estatus = 0;
					$nombre= "No pudo bajar el fichero";
				}
				
			} else{
				$estatus = 0;
				$nombre= "Archivo ya existe";
			}
		}
		else{
			$estatus = 0;
			$nombre= "Tamaño excedente (max 819,200)";
		}
	/*
	}
	else{
		 $nombre= "Tipo de fichero invalido";
	}
	*/
	$query = "INSERT INTO cr_plantilla_tomo_img(fk_id_empresa,fk_id_factura,fk_id_estudio,id_imagen,nombre,ruta,fecha_registro,estado,alto,ancho,img_x_hoja,estatus)
	VALUES ('$empresa','$numero_factura','$studio',0,'$nombre','$ruta',NOW() ,'$estado','$alt','$anc','1',$estatus)";

    $resultado = mysqli_query($conexion, $query);
}
/*
	if($_FILES["fn_archivo"]["error"]>0){
		$nombre= "Error en cargar";	

		} else {

		$permitidos = array("image/gif","image/png","image/jpeg","image/jpg");
		$limite_kb = 800;
		
		if(in_array($_FILES["fn_archivo"]["type"], $permitidos) && $_FILES["fn_archivo"]["size"] <= $limite_kb * 1024){
			

			$ruta = '../img_usg/'.$id_insert.'/';
			$archivo = $ruta.$_FILES["fn_archivo"]["name"];

			$nombre=$_FILES["fn_archivo"]["name"];
	
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
	
			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($_FILES["fn_archivo"]["tmp_name"], $archivo);
				
				if($resultado){
					echo "Archivo Guardado";
					$atributos=getimagesize($archivo);
					$alt=$atributos[0];
					$anc=$atributos[1];
					} else {
					$nombre= "No pudo guardar el fichero";
				}
				
				} else {
				$nombre= "Archivo ya existe";
			}
			
			} else {
			$nombre= "Error en caracteristicas";
		}
		
	}
//


$query = "INSERT INTO cr_plantilla_usg_img(fk_id_empresa,fk_id_factura,fk_id_estudio,id_imagen,nombre,ruta,fecha_registro,estado,alto,ancho) VALUES ('$empresa','$numero_factura','$studio',0,'$nombre','$ruta','$fecha_registro' ,'$estado','$alt','$anc')";

$resultado = mysqli_query($conexion, $query);
*/
if ($resultado) {
			header("location: ../tabla_imagenes.php?numero_factura=$numero_factura&studio=$studio");
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
