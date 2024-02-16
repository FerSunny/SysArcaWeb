<?php 

  date_default_timezone_set('America/Mexico_City');
  session_start();
  include ("../../controladores/conex.php");


  $id = $_POST['id'];
  $fecha = date("Y-m-d H:i:s");

  $query = "UPDATE so_carrucel SET estado = 'A', fecha_actualizacion = '$fecha' WHERE id_carrucel = $id";
  $stmt = $conexion->prepare($query);
  $stmt->execute();


 ?>