<?php 


session_start();
include ("../../controladores/conex.php");



$prov = $_POST['prov'];
$provee  = $_POST['provee'];
$respon = $_POST['respon']; 
$direc = $_POST['direc'];
$cp = $_POST['cp'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$web = $_POST['web'];

$query = "UPDATE eb_proveedores
SET

 razon_social = '$provee',
 nombre_respon = '$respon',
 direccion = '$direc',
 codigo_postal ='$cp',
 telefono = '$tel',
 correo = '$email',
 sitio_web  ='$web'

WHERE id_proveedor = '$prov'";

$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>


































