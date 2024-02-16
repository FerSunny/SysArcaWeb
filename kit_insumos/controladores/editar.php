<?php 


session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


//$pro = $_POST['pro'];
$id_costo_estudio  = $_POST['id_costo_estudio'];
//$producto =$_POST['producto'];
$articulo = $_POST['articulo']; 
$cantidad = $_POST['cantidad'];
// $a_materno = $_POST['a_materno']; 
//$edad = $_POST['edad']; 
//$depto = $_POST['depto']; 
//$id_sexo = $_POST['id_sexo'];
//$cat = $_POST['cat'];
//$caducidad = $_POST['caducidad'];

$costo_producto=0;

$sql_max="SELECT costo_producto FROM eb_productos
WHERE estado = 'A' and id_producto = ".$articulo;
// echo $sql_max;

if ($result = mysqli_query($conexion, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $costo_producto =$row['costo_producto'];
  }
}

$query = "UPDATE km_insumos_estudio
SET
 fk_id_producto = '$articulo',
 cantidad = '$cantidad',
 precio = $costo_producto
WHERE id_insumo_estudio = '$id_costo_estudio' 
";


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>


































