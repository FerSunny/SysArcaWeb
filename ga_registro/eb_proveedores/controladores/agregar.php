<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$provee  = $_POST['provee'];
$respon = $_POST['respon']; 




$query ="INSERT INTO eb_proveedores
            (fk_id_empresa,fk_id_sucursal,razon_social,nombre_respon)
VALUES (1,'$sucursal','$provee','$respon')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
