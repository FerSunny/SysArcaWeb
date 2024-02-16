<?php 


session_start();
include ("../../controladores/conex.php");

$id_usuario     = $_SESSION['id_usuario'];
$fk_id_sucursal = $_SESSION['fk_id_sucursal'];

$id_factura  = $_POST['id_factura'];
$id_estudio =$_POST['id_estudio'];


 
$cubiculo = 1;

$hora = "08:00:00";

/*
$query ="UPDATE tm_agenda SET cubiculo = $cubiculo , fk_id_sucursal = $sucursal, fecha = '$fecha_usg', hora='$hora'
WHERE fk_id_factura = $fk_id_factura and fk_id_estudio = $id_estudio ";
*/

$query = "INSERT INTO tm_agenda
            (fk_id_empresa,
             id_agenda,
             fk_id_factura,
             fk_id_estudio,
             fk_id_sucursal,
             cubiculo,
             fk_id_usuario,
             fecha,
             hora,
             estado)
VALUES (1,
        0,
        $id_factura,
        $id_estudio,
        $fk_id_sucursal,
        '$cubiculo',
        $id_usuario,
        now(),
        '$hora',
        'A')";

//echo $query;



$result = $conexion -> query($query);
if ($result) {
    echo 1;
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();



?>


































