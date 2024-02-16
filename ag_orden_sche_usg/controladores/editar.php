<?php 


session_start();
include ("../../controladores/conex.php");



//$pro = $_POST['pro'];
$fk_id_factura  = $_POST['codigo'];
//$producto =$_POST['producto'];
//$desc_p = $_POST['desc_p']; 
//$costo = $_POST['costo'];
//$utilidad = $_POST['utilidad']; 
//$c_total = $_POST['c_total']; 
$sucursal = $_POST['sucursal']; 
$medico = $_POST['medico'];
//$cat = $_POST['cat'];
$fecha_usg = $_POST['fecha_usg'];


$query = "INSERT INTO ag_usg
            (empresa,
             id_agenda,
             fk_id_factura,
             fk_id_sucursal,
             fk_id_usuario,
             fecha,
             estado)
VALUES (1,
        0,
        $fk_id_factura,
        $sucursal,
        $medico,
        '$fecha_usg',
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


































