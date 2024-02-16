<?php 


session_start();
include ("../../controladores/conex.php");

$id_usuario=$_SESSION['id_usuario'];

//$pro = $_POST['pro'];
$fk_id_factura  = $_POST['codigo'];
$id_estudio =$_POST['id_estudio'];
//$desc_p = $_POST['desc_p']; 
//$costo = $_POST['costo'];
//$utilidad = $_POST['utilidad']; 
//$c_total = $_POST['c_total']; 
$sucursal = $_POST['sucursal']; 
$cubiculo = $_POST['cubiculo'];
//$cat = $_POST['cat'];
$fecha_usg = $_POST['fecha_usg'];
$hora = $_POST['hora_usg'];


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
        $fk_id_factura,
        $id_estudio,
        $sucursal,
        '$cubiculo',
        $id_usuario,
        '$fecha_usg',
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


































