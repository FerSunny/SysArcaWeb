<?php 


session_start();
include ("../../controladores/conex.php");
$id_grupo= $_POST['id_grupo'];
$clave_grupo = $_POST['clave_grupo'];
$desc_grupo = $_POST['desc_grupo'];
$estado = $_POST['estado'];


$query = "UPDATE kg_grupos SET clave_grupo = '$clave_grupo', desc_grupo= '$desc_grupo', estado= '$estado'  WHERE id_grupo = '$id_grupo' ";





$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
