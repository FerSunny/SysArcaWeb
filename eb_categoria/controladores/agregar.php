<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$cat  = $_POST['cat'];
$abrev = $_POST['abrev'];
$descrip = $_POST['descrip']; 
$fecha_registro = date("Y-m-d H:i:s");
$fecha_actualizacion = date("Y-m-d H:i:s");



$query ="INSERT INTO eb_categoria
            (fk_id_empresa,fk_id_sucursal,categoria,abreviatura,descripcion,fecha_registro,fecha_actualizacion)
VALUES (1,'$sucursal','$cat','$abrev','$descrip','$fecha_registro','$fecha_actualizacion')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
