<?php 


session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


//$pro = $_POST['pro'];
$id_folio_producto  = $_POST['id_folio_producto'];
//$producto =$_POST['producto'];
$articulo = $_POST['articulo']; 
$cantidad = $_POST['cantidad'];
// $a_materno = $_POST['a_materno']; 
//$edad = $_POST['edad']; 
//$depto = $_POST['depto']; 
//$id_sexo = $_POST['id_sexo'];
//$cat = $_POST['cat'];
//$caducidad = $_POST['caducidad'];


$query = "UPDATE tm_folio_articulo
SET
 fk_id_producto = '$articulo',
 cantidad = '$cantidad'
WHERE id_folio_producto = '$id_folio_producto' 
and fk_id_sucursal = '$sucursal'";


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>


































