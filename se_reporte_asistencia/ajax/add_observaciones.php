<?php
include "../../controladores/conex.php";
$id_usr = $_POST['id_usr'];
$fecha_r = $_POST['fecha_r'];
$observaciones = $_POST['observaciones'];
$query = "UPDATE generar_asistencia SET observaciones = ? WHERE fk_id_usuario = ? AND fecha_asistencia = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("sis",$observaciones,$id_usr,$fecha_r);
$result = $stmt->execute();

if($result)
{
  echo "Se registro la observación correctamente";
}else {
  $codigo = mysqli_errno($conexion);
  echo "Error en la consulta, #".$codigo;
}



 ?>
