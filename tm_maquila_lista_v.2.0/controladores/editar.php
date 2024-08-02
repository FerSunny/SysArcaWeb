<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$producto =$_POST['producto'];

$desc_p = $_POST['desc_p']; 

$costo = $_POST['costo'];

$utilidad = $_POST['utilidad']; 

$c_total = $_POST['c_total']; 

$depto = $_POST['depto']; 

$proveedor = $_POST['proveedor'];

$cat = $_POST['cat'];

$caducidad = $_POST['caducidad'];

$unidad_medida=$_POST['uni_med_mod'];
$almacen=$_POST['almacen'];
$pasillo=$_POST['pasillo'];
$nivel=$_POST['nivel'];
$anaquel=$_POST['anaquel'];


$query = "UPDATE eb_productos

SET



 cod_producto = '$codigo',

 producto = '$producto',

 desc_producto = '$desc_p',

 costo_producto = '$costo',

 utilidad = '$utilidad',

 costo_total = '$c_total',

 departamento = '$depto',

 fk_id_proveedor = '$proveedor',

 fk_id_categoria = '$cat',

 fk_unidad_medida = '$unidad_medida',

 caducidad = '$caducidad',

 fecha_actualizacion = Now(),
 fk_id_almacen = $almacen,
 pasillo = '$pasillo',
 anaquel = '$anaquel',
 nivel='$nivel'

WHERE id_producto = '$pro'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































