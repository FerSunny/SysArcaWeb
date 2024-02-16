<?php 

session_start();
include ("../../controladores/conex.php");
// $sucursal = $_SESSION['fk_id_sucursal'];
$empresa=1;
$fecha=date("y/m/d H:i:s");
//$factura=1;

/*
$codigo  = $_POST['codigo'];
$producto = $_POST['producto'];
$desc_p = $_POST['desc_p']; 
$costo = $_POST['costo']; 
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
*/
$puesto = $_POST['puesto']; 
$tiempo = $_POST['tiempo'];
$studio = $_POST['id_estudio'];
$fecha_registro = date("y-m-d H:i:s");
$fecha_actualizacion = date("y-m-d H:i:s");

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

$query ="INSERT INTO km_tiempo_estudio
            (fk_id_empresa, id_tiempo, fk_id_estudio, fk_id_puesto, tiempo, costo, estado)
VALUES (1,0,$studio,$puesto,$tiempo,$costo,'A')";

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
