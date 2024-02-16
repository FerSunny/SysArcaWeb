<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$cat  = $_POST['cat'];
$abrev = $_POST['abrev'];
$descrip = $_POST['descrip']; 



$query ="INSERT INTO eb_categoria
            (fk_id_empresa,fk_id_sucursal,categoria,abreviatura,descripcion)
VALUES (1,'$sucursal','$cat','$abrev','$descrip')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
