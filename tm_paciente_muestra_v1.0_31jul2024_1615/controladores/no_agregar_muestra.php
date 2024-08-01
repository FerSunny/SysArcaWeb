<?php 
date_default_timezone_set('America/Chihuahua');
session_start();
include ("../../controladores/conex.php");
$nombre = $_SESSION['nombre'];
$sucursal = $_SESSION['fk_id_sucursal'];

$id_factura=$_POST['id_factura'];
$studio=$_POST['id_estudio'];
$id_muestra=$_POST['id_muestra'];
$control=$_POST['control'];
$fecha_toma=date("y/m/d H:i:s");


$query ="INSERT INTO tm_tomas
            (id_toma,fk_id_sucursal,fk_id_usuario,fk_id_factura,fk_id_estudio,fk_id_muestra,fecha_toma,aplico,control)
            VALUES (0,$sucursal,'$nombre','$id_factura','$studio','$id_muestra',NOW(),'X',$control)";

//echo 'id_factura='.$id_factura;
/*
$query ="INSERT INTO tm_tomas
            (id_toma,fk_id_usuario,fk_id_factura,fk_id_estudio,fk_id_muestra,fecha_toma,aplico)
            VALUES (0,'$nombre','$id_factura','$studio','$id_muestra','$fecha_toma','N')";
*/
//echo $query;

// obtenemos el ultimo movimiento de la muestra
            /*
$queryfactura_a = mysqli_query($conexion,"SELECT MAX(fecha_toma) ultima_toma FROM tm_tomas a
WHERE a.fk_id_factura = $id_factura");
$muestra_a = mysqli_fetch_array($queryfactura_a);
$ultima_toma = $muestra_a['ultima_toma'];


$sql_update="DELETE FROM tm_tomas
where fk_id_factura= $id_factura  and fk_id_estudio= $studio AND aplico = 'S' AND control = '$control' ";
*/

// echo $sql_update;
$execute_query_update = mysqli_query($conexion,$query);


//$result = $conexion -> query($query);
if ($execute_query_update) {
   echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();


?>

