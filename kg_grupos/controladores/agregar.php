<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


$clave_grupo = $_POST['clave_grupo'];
$desc_grupo = $_POST['desc_grupo'];
$estado = $_POST['estado'];



$query ="INSERT INTO kg_grupos (fk_id_empresa, clave_grupo, desc_grupo, estado) 
VALUES (1, '$clave_grupo','$desc_grupo','$estado')";


$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>