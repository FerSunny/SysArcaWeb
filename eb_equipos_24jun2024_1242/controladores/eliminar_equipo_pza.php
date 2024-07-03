<?php 





include ("../../controladores/conex.php");

$id_pieza= $_POST['id_pieza'];



$query ="UPDATE eb_piezas SET estado = 'S' WHERE id_pieza = $id_pieza";

//echo $query;

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>