<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$provee  = $_POST['provee'];
$respon = $_POST['respon']; 
$direc = $_POST['direc'];
$cp = $_POST['cp'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$web = $_POST['web'];


$query ="INSERT INTO eb_proveedores
            (fk_id_empresa,fk_id_sucursal,razon_social,nombre_respon,direccion,codigo_postal,telefono,correo,sitio_web)
VALUES (1,'$sucursal','$provee','$respon','$direc','$cp','$tel','$email','$web')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
