<?php 
session_start();
include ("../../controladores/conex.php");
$id_usuario=$_SESSION['id_usuario'];
$id_factura= $_POST['id_factura'];



$query ="UPDATE cr_plantilla_ekg_re 
SET validado = 1,
fk_id_usuario_val = $id_usuario
WHERE fk_id_factura = $id_factura ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>