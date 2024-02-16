<?php 


session_start();


include ("../../controladores/conex.php");

$id_toma= $_POST['id_toma'];

$usuario = $_SESSION['id_usuario'];

$query ="UPDATE tm_tomas 
SET check_in = 2 ,
fecha_rechazo = now(),
emailsucursal = 0,
fk_id_usuario_rechazo = $usuario
WHERE id_toma = $id_toma
";
echo $query;
$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>