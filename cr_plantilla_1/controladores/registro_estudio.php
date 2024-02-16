<?php
session_start();
include("../../controladores/conex.php");

//date_default_timezone_set('America/Mexico_City');

$empresa ="1";
 
$fn_orden = 0;
$fn_estudio = $_POST['fn_estudio'];
$fn_tipo = 'B';
$fn_interface = '';
$fn_concepto = '';
$fn_valor_refe =  '';
$fn_unidad_medida = '';
$fn_posini ='';
$fn_tamfue = '';
$fn_tipfue = '';
$fn_estado = $_POST['fn_estado'];


$query= "INSERT INTO cr_plantilla_1 (fk_id_empresa,id_valor,orden,fk_id_estudio,codigo_int,tipo,concepto,valor_refe,unidad_medida,posini,tamfue,tipfue,estado) 
VALUES('$empresa','0','$fn_orden','$fn_estudio','$fn_interface','$fn_tipo','$fn_concepto','$fn_valor_refe','$fn_unidad_medida','$fn_posini','$fn_tamfue','$fn_tipfue','$fn_estado')";

//echo $query;

$result = $conexion->query($query);

if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>
