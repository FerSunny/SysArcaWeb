<?php 

date_default_timezone_set('America/Chihuahua');
session_start();
include ("../../controladores/conex.php");



$id_factura = $_POST['factura'];

$codigo  = $_POST['codigo'];
//$producto =$_POST['producto'];
$nombre = $_POST['nombre']; 
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno']; 
$edad = $_POST['edad']; 
//$depto = $_POST['depto']; 
$id_sexo = $_POST['id_sexo'];
$diagnostico = $_POST['diagnostico'];
$clinicos = $_POST['clinicos'];
$medicamentos = $_POST['medicamentos'];

$telefono = $_POST['telefono'];
$email = $_POST['email'];
$id_califique = $_POST['id_califique'];


$query = "UPDATE so_clientes
SET

 nombre = '$nombre',
 a_paterno = '$a_paterno',
 a_materno = '$a_materno',
 anios = '$edad',
 fk_id_sexo = '$id_sexo',
 telefono_fijo = '$telefono',
 mail = '$email'
WHERE id_cliente = '$codigo'";

$result = $conexion -> query($query);
/*
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
*/

// actualiza la factura con el nuevo diagnoiistico
$query_fa = "UPDATE so_factura
SET diagnostico = '$diagnostico',
    datos_clinicos = '$clinicos',
    medicamentos = '$medicamentos',
    fk_id_califica = $id_califique
WHERE id_factura = '$id_factura'";

//echo 'so_factura:'.$query_fa;


$result_fa = $conexion -> query($query_fa);
if ($result_fa) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo.' '.$query;
}




$conexion->close();

?>


































