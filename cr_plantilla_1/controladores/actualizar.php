<?php
session_start();
include("../../controladores/conex.php");

//date_default_timezone_set('America/Mexico_City');

$id_valor=$_POST["idvalor"];
$fn_orden=$_POST["fn_orden"];
$fn_estudio=$_POST["fn_estudio"];
$fn_tipo=$_POST["fn_tipo"];
$fn_interface=$_POST["fn_interface"];
$fn_interface2=$_POST["fn_interface2"];
$fn_concepto=$_POST["fn_concepto"];
$fn_valor_refe=$_POST["fn_valor_refe"];
$fn_unidad_medida=$_POST["fn_unidad_medida"];
$fn_posini =$_POST['fn_posini'];
$fn_tamfue = $_POST['fn_tamfue'];
$fn_tipfue = $_POST['fn_tipfue'];
$fn_estado=$_POST["fn_estado"];

$query = "UPDATE  cr_plantilla_1 SET orden='$fn_orden', fk_id_estudio = '$fn_estudio', tipo = '$fn_tipo', codigo_int = '$fn_interface' ,codigo_int2 = '$fn_interface2', concepto = '$fn_concepto' , valor_refe = '$fn_valor_refe', unidad_medida='$fn_unidad_medida',posini='$fn_posini',tamfue='$fn_tamfue',tipfue='$fn_tipfue',estado = '$fn_estado' WHERE fk_id_empresa = 1 and  id_valor='$id_valor'";

$result = $conexion->query($query);

if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();


 ?>
