<?php
include("../../controladores/conex.php");

$id_medico = $_POST["id_medico"];
// obtenemos el ultimo movimiento
$sql="
SELECT MAX(va.id_agenda) AS id_agenda
FROM vm_agenda va
WHERE va.estado = 'A' 
and va.`fk_id_medico` = ".$id_medico;
$resultado = mysqli_query($conexion, $sql);

if($row = mysqli_fetch_array($resultado))
{
  $id_agenda=$row['id_agenda'];
}




$activo="A";
$suspendido="S";






$query="UPDATE vm_agenda set estado = 'E' WHERE id_agenda='$id_agenda'";
$resultado = $conexion -> query($query);

if($resultado){

}else{
  $codigo = mysql_errno($conexion);
  echo $codigo;
}

$conexion->close();

 
 ?>
