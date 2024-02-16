<?php
include "../../controladores/conex.php";

$id = $_POST['id'];
$listar = $_POST['listar'];

switch ($listar) {
  case '1':
        eliminar_todo($id);
    break;
  case '2':
        eliminar($id);
      break;
  default:
      echo "No  existe la consulta";
    break;
}

function eliminar_todo($id)
{
  global $conexion;

  $query = "UPDATE eb_detalle_solicitud SET estado = 'S' WHERE id_detalle = ?";
  $stmt = $conexion->prepare($query);
  $stmt->bind_param("i",$id);
  $result = $stmt->execute();
  $stmt->close();

  if($result){
    $query = "UPDATE eb_solicitudes SET estado = 'S',llego = 'N' WHERE fk_id_detalle = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i",$id);
    $result = $stmt->execute();
    $stmt->close();
    if($result){
      echo "Se elimino Correcamente ";
    }else {
      $codigo = mysqli_errno($conexion);
      echo $codigo;
    }
  }else {
    $codigo = mysqli_errno($conexion);
    echo $codigo;
  }
}


function eliminar($id)
{
  global $conexion;

  $query = "UPDATE eb_solicitudes SET estado = 'S',llego ='N' WHERE id_solicitud = ?";
  $stmt = $conexion->prepare($query);
  $stmt->bind_param("i",$id);
  $result = $stmt->execute();
  $stmt->close();

  if($result){
      echo "Se elimino Correcamente ";
  }else {
    $codigo = mysqli_errno($conexion);
    echo $codigo;
  }
}



 ?>
