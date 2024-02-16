<?php 





include ("../../controladores/conex.php");

$id_puesto= $_POST['id_puesto'];



$query ="UPDATE no_puestos SET estado = 'S' WHERE id_puesto = $id_puesto ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>