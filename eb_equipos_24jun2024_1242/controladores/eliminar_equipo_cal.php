<?php 





include ("../../controladores/conex.php");

$id_manto= $_POST['id_manto'];



$query ="UPDATE eb_calendario_mto SET estado = 'S' WHERE id_manto = $id_manto";

//echo $query;

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>