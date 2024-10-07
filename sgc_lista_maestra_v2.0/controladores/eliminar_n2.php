<?php 


include ("../../controladores/conex.php");
$id_producto= $_POST['id_producto'];
$fk_id_numeral_1= $_POST['fk_id_numeral_1'];

$query ="UPDATE sgc_indice_dos SET estado = 'S' WHERE id_numeral_2 = $id_producto AND fk_id_numeral_1 = $fk_id_numeral_1";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>