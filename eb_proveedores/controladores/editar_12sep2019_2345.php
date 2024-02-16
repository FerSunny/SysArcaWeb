<?php 


session_start();
include ("../../controladores/conex.php");



$prov = $_POST['prov'];
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

$query = "UPDATE eb_proveedores
SET
 razon_social = '$provee',
 nombre_respon = '$respon',
 celular = '$n_cel',
 fk_id_estado = '$edo',
 fk_id_municipio = '$muni',
 fk_id_localidad = '$loca',
 telefono = '$tel',
 codigo_postal = '$cp',
 colonia = '$col', 
 calle = '$calle',
 correo = '$email',
 sitio_web = '$web'
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


































