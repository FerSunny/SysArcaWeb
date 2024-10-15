<?php
session_start();
include("../../controladores/conex.php");

//date_default_timezone_set('America/Mexico_City');

$empresa ="1";
 
$fn_id_valor = $_POST['fn_id_valor'];
$fn_orden = $_POST['fn_orden'];
$fn_estudio = $_POST['fn_estudio'];
$fn_tipo = $_POST['fn_tipo'];
//$fn_interface = $_POST['fn_interface'];
//$fn_interface2 = $_POST['fn_interface2'];
$fn_concepto = $_POST['fn_concepto'];
//$fn_valor_refe =  $_POST['fn_valor_refe'];
//$fn_unidad_medida = $_POST['fn_unidad_medida'];
$fn_posini =$_POST['fn_posini'];
$fn_tamfue = $_POST['fn_tamfue'];
$fn_tipfue = $_POST['fn_tipfue'];
$fn_estado = $_POST['fn_estado'];


//$query= "INSERT INTO cr_plantilla_1 (fk_id_empresa,id_valor,orden,fk_id_estudio,codigo_int,codigo_int2,tipo,concepto,valor_refe,unidad_medida,posini,tamfue,tipfue,estado) VALUES('$empresa','0','$fn_orden','$fn_estudio','$fn_interface','$fn_interface2','$fn_tipo','$fn_concepto','$fn_valor_refe','$fn_unidad_medida','$fn_posini','$fn_tamfue','$fn_tipfue','$fn_estado')";
$query=
"
INSERT INTO cr_plantilla_cvo  
            (  fk_id_empresa  ,
             id_valor  ,
             orden  ,
             fk_id_estudio  ,
             tipo  ,
             concepto  ,
             estado  ,
             posini  ,
             tamfue  ,
             tipfue  )
VALUES (1,
        0,
        '$fn_orden',
        '$fn_estudio',
        '$fn_tipo',
        '$fn_concepto',
        'A',
        '$fn_posini',
        '$fn_tamfue',
        '$fn_tipfue');
";
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
