<?php
  session_start();
  include ("../controladores/conex.php");
  $sucursal = $_SESSION['fk_id_sucursal'];
  $id = $_SESSION['id_usuario'];
  $estado = 'A';

  $query = "SELECT * FROM so_carrucel WHERE estado IN ('A','S')";
  $stmt = $conexion->prepare($query);


    if($stmt->execute())
    {
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()){
          $arreglo["data"][]=$row;
      }
      echo json_encode($arreglo);

    }else
    {
      die("Error");
    }

    $stmt->close();
