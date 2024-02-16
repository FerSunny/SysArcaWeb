<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];
date_default_timezone_set('America/Mexico_City');
$FechaHoy=date("y/m/d  H:i:s");

$fk_id_proveedor  = $_POST['proveedor'];
$producto = $_POST['producto'];
$esxistencia = $_POST['exis']; 
$minimo = $_POST['mini']; 
$maximo = $_POST['maxi']; 
$FechaHoy; 
$estado="A";

$existe="select count(*) as existe from eb_almacen_unidades
where fk_id_producto = ".$producto;
//echo $existe;

if ($result = mysqli_query($conexion, $existe)) {
   while($row = $result->fetch_assoc())
   {

       $existe=$row['existe'];
   }
}
//echo $existe;
if ($existe == 0){
$query ="INSERT INTO eb_almacen_unidades
(fk_id_empresa,fk_id_sucursal,fk_id_producto,fk_id_proveedor,existencias,min,max,fecha_actualizacion,estado)
VALUES(1,$sucursal,'$producto','$fk_id_proveedor','$esxistencia','$minimo','$maximo','$FechaHoy','$estado')";

    $result = $conexion -> query($query);
    if ($result) {
        echo 1;
       
       
    }else{
      $codigo = mysqli_errno($conexion); 
      echo $codigo;
    }

}else{
  echo 1062;
}
$conexion->close();
?>
