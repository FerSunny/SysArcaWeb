<?php 


session_start();
include ("../../controladores/conex.php");



//$pro = $_POST['pro'];
$codigo  = $_POST['codigo'];
//$producto =$_POST['producto'];
$nombre = $_POST['nombre']; 
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno']; 
$edad = $_POST['edad']; 
//$depto = $_POST['depto']; 
$id_sexo = $_POST['id_sexo'];
//$cat = $_POST['cat'];
//$caducidad = $_POST['caducidad'];


$query = "UPDATE so_clientes
SET

 nombre = '$nombre',
 a_paterno = '$a_paterno',
 a_materno = '$a_materno',
 anios = '$edad',
 fk_id_sexo = '$id_sexo'
WHERE id_cliente = '$codigo'";


$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>


































