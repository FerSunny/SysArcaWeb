<?php 





include ("../../controladores/conex.php");

$id_ingreso= $_POST['id_ingreso'];



$query ="UPDATE ga_ingreso SET estado = 'S' WHERE id_ingreso = $id_ingreso ";
//echo $query;
$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>