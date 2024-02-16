<?php 





include ("../../controladores/conex.php");

$id_sucursal= $_POST['id_sucursal'];
$id_estudio= $_POST['id_estudio'];
$fecha_toma= $_POST['fecha_toma'];



$query ="UPDATE tm_tomas SET check_in = 1 
WHERE fk_id_sucursal = $id_sucursal 
and fk_id_estudio = $id_estudio
and date(fecha_toma) = '$fecha_toma'
";
//echo $query;
$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>