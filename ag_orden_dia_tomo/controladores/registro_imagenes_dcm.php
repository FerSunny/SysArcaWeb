<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$numero_factura= $_GET['numero_factura'];
$studio=$_GET['studio'];

$fn_nombre_cloud = 'pradel'; //$_POST['fn_nombre_cloud']; 

$estado = 'A'; //$_POST['fn_estado']; //estado
$img_x_hoja = 1; //$_POST['fn_img_x_hoja'];
$alt=0;
$anc=0;

$fecha_registro=date("y/m/d H:i:s");


$dir=$numero_factura;
// *** VERIFICAMOS LA SUCURSAL DE ENVIO,
$sql="SELECT ag.`fk_id_sucursal` FROM ag_tomo ag
WHERE ag.fk_id_factura =".$numero_factura
;
//echo $sql;

if ($result = mysqli_query($conexion, $sql)) {
	while($row = $result->fetch_assoc())
	{
		$fk_id_sucursal=$row['fk_id_sucursal'];
	}
}

if($fk_id_sucursal != 1){
	$ruta="xch/tomografia/";
}else{
	$ruta="tly/tomografia/";
}

// *** Copiamos la informacion del CD a la PC

//$micarpeta = 'C:/repositorio_local/'.$fn_nombre_cloud;
$micarpeta = 'repositorio_local/'.$fn_nombre_cloud;
if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
}else{
	echo "<script>
	alert('La carpeta ya existe, asegure que el folio es correcto');
</script>";
}


if (copy('D:\DICOMDIR', $micarpeta.'\DICOMDIRE')) {
	echo 'Se ha copiado el archivo DICOMODIR';
 }
 else {
	echo 'Se produjo un error al copiar el fichero DICOMDIR';
 }

 $source ='D:\JRE';
 //El destino donde se guardara la copia
 $destination = $micarpeta."\JRE";
 full_copy($source, $destination);

 $source ='D:\A';
 //El destino donde se guardara la copia
 $destination = $micarpeta."\A";
 full_copy($source, $destination);

 echo "	<script>
 		alert('Puede retirar el CD');
		</script>
	";

// *** EMPACAR EL FICHERO
$subio=0;
//$files_post = $_FILES['fn_archivo'];
//$fn_nombre_cloud = $_POST['fn_nombre_cloud']; 

$fichero='C:/repositorio_local/'.$fn_nombre_cloud;
$fichero_zip='C:/repositorio_local/'.$ruta.$fn_nombre_cloud.".zip";



if(!is_dir($fichero)){ 
	echo "<script>
                alert('La carpeta no existe... verificar..');
                window.location= '../tabla_imagenes_dcm.php?numero_factura=$numero_factura&studio=$studio'
    </script>";
	//header("location: ../tabla_imagenes_dcm.php?numero_factura=$numero_factura&studio=$studio");
} 

$rootPath = realpath($fichero);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($fichero_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
		$subio=1;
    }
}

// Zip archive will be created only after closing object
$zip->close();

if($subio!=1){
	echo "<script>
	alert('Erro al compactar la carpeta... notifique al whatsapp 5625988448 enviando el folio de la nota y el nombre de lacarpeta a empacar.');
	window.location= '../tabla_imagenes_dcm.php?numero_factura=$numero_factura&studio=$studio'
	</script>";
}


// DATOS DE ACCESO AL SERVIDOR
$ftp_server="108.175.7.121";
 

$existe=0;
$listo=0;

// SE ABRE LA CONEXION 
$con_id=ftp_connect($ftp_server);

// SE ESTABLECE LA COMEXION
$lr=ftp_login($con_id,$ftp_usuario,$ftp_pass);
if( (!$con_id) || (!$lr) ){
	$estatus = "No se conecto";
}else{

	$mode = ftp_pasv($con_id, TRUE);
	$file_list = ftp_nlist($con_id, "");
	foreach ($file_list as $file)
	{
		if($file == $dir){
			echo "existe en el servidor";
			$existe=1;
		}else{
			echo "No existe en el servidr se va a crear";
		}
	}
	if($existe == 1){
		$listo=1; // ya existe la carpeta
	}else{
		echo "antes de crear la carpeta";
		if (ftp_mkdir($con_id, $dir)) {
			$listo=1;  // la carpeta se crea correctamente
		} else {
			$estatus = "Ha habido un problema durante la creación de $dir\n";
			$listo=2;
		}
	}


	if($listo==1){
		$source_file = $fichero_zip; 
		//$_FILES['fn_archivo']['tmp_name'];
		$destino=$dir."/";
		$nombre=$fn_nombre_cloud.".zip"; 
		//$_FILES["fn_archivo"]['name'];

		$subio=ftp_put($con_id,
						$destino.$nombre,
						$source_file,
						FTP_BINARY);
		ftp_close($con_id);

		if($subio){
			include("../../controladores/conex.php");
			$query = "INSERT INTO cr_plantilla_tomo_img(fk_id_empresa,fk_id_factura,fk_id_estudio,id_imagen,nombre,ruta,fecha_registro,estado,alto,ancho,img_x_hoja)
					VALUES ('$empresa','$numero_factura','$studio',0,'$nombre','$destino',now() ,'$estado','$alt','$anc','$img_x_hoja')";
			$resultado1 = mysqli_query($conexion, $query);
			if ($resultado1) {
				header("location: ../tabla_imagenes_dcm.php?numero_factura=$numero_factura&studio=$studio");
				//echo "<script>location.href='../tabla_usuarios.php'</script>";
			}else{
				echo "error en la ejecucion de la consulta. <br />";
				die('Error de Conexión: ' . $query);
			}
		}else{
			echo "error en el put del ftp: destino".$destino.$nombre." Origen: ".$source_file;
		}
	}else{
		echo $estatus;
	}
}

echo $estatus." regrese a la pagina anterior, tomando una captura de pantalla de este mensaje y notifique al whatsapp 5625988448 enviando el folio de la nota... gracias";


//Crear nuevos directorios completos
function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
 
        $d->close();
    }else {
        copy( $source, $target );
    }
}

?>
