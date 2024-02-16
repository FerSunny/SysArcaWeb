<?php

date_default_timezone_set('America/Mexico_City');

// conexion de factura
include ("../../controladores/conex.php");
$id_factura = $_POST['id_factura'];
$id_estudio = $_POST['id_estudio'];

$arreglo_de_valores=array();
$comentarios="";

    $stmt = $conexion->prepare("SELECT valor,observaciones FROM cr_plantilla_cvo_re WHERE fk_id_factura = ? AND fk_id_estudio = ?");

    $stmt->bind_param('ii', $id_factura,$id_estudio);
	$stmt->execute();
	$stmt->bind_result($valor,$observaciones);
	while ($stmt->fetch()) {
      $array = array(
		    "valor_1" => $valor,
		    "valor_2" => $observaciones,
		);
	array_push($arreglo_de_valores,$array['valor_1']);
	$comentarios=$array['valor_2'];
    }

header('Content-Type: application/json');
echo json_encode(array('array_datos'=>$arreglo_de_valores,'comentarios'=>$comentarios));

?>