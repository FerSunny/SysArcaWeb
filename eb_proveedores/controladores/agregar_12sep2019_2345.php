<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$provee  = $_POST['provee'];
$respon = $_POST['respon']; 
$n_cel = $_POST['n_cel'];
$edo = $_POST['edo'];
$muni = $_POST['muni'];
$loca = $_POST['loca'];
$tel = $_POST['tel'];
$cp = $_POST['cp'];
$col = $_POST['col'];
$calle = $_POST['calle'];
$email = $_POST['email'];
$web = $_POST['web'];


$query ="INSERT INTO eb_proveedores
            (fk_id_empresa,fk_id_sucursal,razon_social,nombre_respon,celular,fk_id_estado,fk_id_municipio,fk_id_localidad,telefono,codigo_postal,colonia,calle,correo,sitio_web)
VALUES (1,'$sucursal','$provee','$respon','$n_cel','$edo','$muni','$loca','$tel','$cp','$col','$calle','$email','$web')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
