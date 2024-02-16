<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$numero_factura= $_SESSION['numero_factura'];
$studio= $_SESSION['studio'];

$estado = $_POST['fn_estado']; //estado
//$nombre='pendiente';
//$ruta='pendiente';
$fecha_registro=date("y/m/d :H:i:s");
$alt=0;
$anc=0;
// rutina para subir el fichero a al servidor

$id_insert=$numero_factura;

	if($_FILES["fn_archivo"]["error"]>0){
		$nombre= "Error en cargar";	
		//echo '<script language="javascript">alert("juas");</script>'; 
		} else {
//echo '<script language="javascript">alert("juassss");</script>'; 
		$permitidos = array("image/gif","image/png","image/jpeg");
		$limite_kb = 30000;
		
		if(in_array($_FILES["fn_archivo"]["type"], $permitidos) && $_FILES["fn_archivo"]["size"] <= $limite_kb * 1024){
			
			//$ruta = 'files/'.$id_insert.'/';
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

$query = "INSERT INTO cr_plantilla_colpo_img(fk_id_empresa,fk_id_factura,fk_id_estudio,id_imagen,nombre,ruta,fecha_registro,estado,alto,ancho) VALUES ('$empresa','$numero_factura','$studio',0,'$nombre','$ruta','$fecha_registro' ,'$estado','$alt','$anc')";

$resultado = mysqli_query($conexion, $query);

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
