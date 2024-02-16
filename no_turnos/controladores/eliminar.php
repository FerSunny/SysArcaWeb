<?php 





include ("../../controladores/conex.php");

$id_turno = $_POST['id_turno'];



$query ="UPDATE no_turnos SET estado = 'S' WHERE id_turno = $id_turno ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>