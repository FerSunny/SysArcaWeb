<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];
$empresa=1;
$fecha=date("y/m/d H:i:s");
//$factura=1;

/*
$codigo  = $_POST['codigo'];
$producto = $_POST['producto'];
$desc_p = $_POST['desc_p']; 
$costo = $_POST['costo']; 
$utilidad = $_POST['utilidad']; 
$c_total = $_POST['c_total']; 
*/
$articulo = $_POST['articulo']; 

$cantidad = $_POST['cantidad'];
$factura = $_POST['id_factura'];
$estudio = $_POST['id_estudio'];
$codigo = $_POST['codigo'];

$codigo_real=0;

if ($codigo==0) {
	$codigo_real=$articulo;
}elseif ($articulo==null) {
	$codigo_real=$codigo;
}

$query ="INSERT INTO tm_folio_articulo
            (fk_id_empresa, fk_id_sucursal, id_folio_producto, fk_id_factura, fk_id_estudio, fk_id_producto, cantidad, fecha_registro, estado)
VALUES (1,$sucursal,0,'$factura','$estudio','$codigo_real','$cantidad','$fecha','A')";

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
