<?php 


include ("../../controladores/conex.php");
$id_reporte= $_POST['id_reporte'];

$query ="UPDATE eb_reportes SET estado = 'S' WHERE id_reporte = $id_reporte";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>