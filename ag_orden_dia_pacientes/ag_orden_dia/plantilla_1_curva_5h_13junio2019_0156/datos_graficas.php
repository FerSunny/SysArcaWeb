<?php 
include ("../../../controladores/conex.php");

$factura = $_POST['factura'];
$estudio = $_POST['estudio'];

$arreglo_de_conceptos=array();
$arreglo_de_valores=array();
$comentarios="";


    $stmt = $conexion->prepare("SELECT concepto,valor FROM `cr_plantilla_1_re` 
WHERE fk_id_factura = ? AND fk_id_estudio = ?");
    $stmt->bind_param('ii', $factura,$estudio);
	$stmt->execute();
	$stmt->bind_result($concepto,$valor);
	while ($stmt->fetch()) {
      $array = array(
		    "valor_1" => $concepto,
		    "valor_2" => $valor,
		);
		array_push($arreglo_de_conceptos,$array['valor_1']);
        array_push($arreglo_de_valores,$array['valor_2']);  
    }

header('Content-Type: application/json');
echo json_encode(array('array_concepto'=>$arreglo_de_conceptos,'array_valor'=>$arreglo_de_valores));

 ?>