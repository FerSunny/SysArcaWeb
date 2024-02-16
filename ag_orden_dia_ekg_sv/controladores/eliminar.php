<?php 





include ("../../controladores/conex.php");

$id_signos= $_POST['id_signos'];



$query ="UPDATE ag_ekg_sv SET estado = 'S' WHERE id_signos = $id_signos ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>