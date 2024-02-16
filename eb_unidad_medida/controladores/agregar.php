<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$unidad  = $_POST['unidad'];
$abrev = $_POST['abrev'];
$empresa =1;

$query ="INSERT INTO eb_unidad_medida
            (fk_id_empresa,fk_id_sucursal,unidad_medida,abreviatura)
VALUES (?,?,?,?)";

$stmt = $conexion->prepare($query);
$stmt->bind_param("iiss",$empresa,$sucursal,$unidad,$abrev);

if($stmt->execute()){
    echo "Datos Agregados Correctamente";
}else{
    $codigo = mysqli_errno($conexion); 
  echo $codigo;
}

$stmt->close();

?>