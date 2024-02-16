<?php 


session_start();
include ("../../controladores/conex.php");



$ca = $_POST['ca'];
$unidad  = $_POST['unidad'];
$abrev = $_POST['abrev'];


$query = "UPDATE eb_unidad_medida SET
            unidad_medida = ?,
             abreviatura = ?
            WHERE id_unidad = ?";


$stmt = $conexion->prepare($query);
$stmt->bind_param("ssi",$unidad,$abrev,$ca);

if($stmt->execute()){
    echo 1;
}else{
    $codigo = mysqli_errno($conexion); 
  echo $codigo;
}

$stmt->close();

?>


































