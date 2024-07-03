<?php 





include ("../../controladores/conex.php");

$id_equipo= $_POST['id_equipo'];



$query ="UPDATE eb_equipos SET estado = 'S' WHERE id_equipo = $id_equipo";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>