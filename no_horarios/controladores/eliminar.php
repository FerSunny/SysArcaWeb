<?php 





include ("../../controladores/conex.php");

$id_horario = $_POST['id_horario'];



$query ="UPDATE no_horarios SET estado = 'S' WHERE id_horario = $id_horario ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>