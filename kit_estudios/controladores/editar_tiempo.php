<?php 


session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];


//$pro = $_POST['pro'];
$id_tiempo  = $_POST['id_tiempo'];
//$producto =$_POST['producto'];
$puesto = $_POST['puesto']; 
$tiempo = $_POST['tiempo'];
// $a_materno = $_POST['a_materno']; 
//$edad = $_POST['edad']; 
//$depto = $_POST['depto']; 
//$id_sexo = $_POST['id_sexo'];
//$cat = $_POST['cat'];
//$caducidad = $_POST['caducidad'];

$sueldo_diario=0;

$sql_max="SELECT sueldo_diario FROM se_puestos
WHERE estado = 'A' and id_puesto = ".$puesto;
// echo $sql_max;

if ($result = mysqli_query($conexion, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $sueldo_diario =$row['sueldo_diario'];
  }
}

$costo=($sueldo_diario/480)*$tiempo;

$query = "UPDATE km_tiempo_estudio
SET
 fk_id_puesto = '$puesto',
 tiempo = '$tiempo',
 costo = $costo
WHERE id_tiempo = '$id_tiempo' 
";

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


































