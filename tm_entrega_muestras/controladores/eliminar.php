<?php 


include ("../../controladores/conex.php");
$fk_id_toma= $_POST['fk_id_toma'];

$query ="UPDATE tm_sigue_muestra SET estado = 'S' WHERE fk_id_etapa = 'EN' and  fk_id_toma = $fk_id_toma ";

$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>