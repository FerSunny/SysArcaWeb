<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
include ("../../controladores/conex.php");
$nombre = $_SESSION['nombre'];

$id_factura=$_POST['id_factura'];
$studio=$_POST['id_estudio'];
$id_muestra=$_POST['id_muestra'];
$fecha_toma=date("y/m/d H:i:s");

//echo 'id_factura='.$id_factura;
$query ="INSERT INTO tm_tomas
            (id_toma,fk_id_usuario,fk_id_factura,fk_id_estudio,fk_id_muestra,fecha_toma,aplico)
            VALUES (0,'$nombre','$id_factura','$studio','$id_muestra','$fecha_toma','N')";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
   echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();


?>

