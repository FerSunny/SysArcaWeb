<?php 





include ("../../controladores/conex.php");

$codigo= $_POST['id_producto'];



$query ="
UPDATE cr_diccionario
SET   estado = 'S'
WHERE fk_id_concepto = '$codigo';
";
// echo $query;

$result = $conexion -> query($query);



if ($result) {

    echo 1;

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>