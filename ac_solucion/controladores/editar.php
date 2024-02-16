<?php 





session_start();

include ("../../controladores/conex.php");


$id_usuario = $_SESSION['id_usuario'];


$codigo  = $_POST['codigo'];




$problema=$_POST['problema'];
$causas=$_POST['causas'];
$solucion=$_POST['solucion'];
$estatus=$_POST['estatus'];
$acciones=$_POST['acciones'];

$query = "
UPDATE `ac_quejas`
SET
problema = '$problema',
causas = '$causas',
solucion = '$solucion',
fecha_solucion = NOW(),
fk_id_estatus = $estatus,
acciones = '$acciones'
WHERE id_queja = $codigo;
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





































































