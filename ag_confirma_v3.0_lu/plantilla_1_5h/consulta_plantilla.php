<?php

date_default_timezone_set('America/Mexico_City');


include ("../../controladores/conex.php");


$id_factura = $_POST['id_factura'];
$id_estudio = $_POST['id_estudio'];

$arreglo_de_valores=array();
$arreglo_de_verificados=array();
$comentarios="";


    $stmt = $conexion->prepare("SELECT valor,verificado,observaciones FROM cr_plantilla_1_re WHERE fk_id_factura = ? AND fk_id_estudio = ? ORDER BY orden");
    $stmt->bind_param('ii', $id_factura,$id_estudio);
	$stmt->execute();
	$stmt->bind_result($valor,$verificado,$observaciones);
	while ($stmt->fetch()) {
      $array = array(
		    "valor_1" => $valor,
		    "valor_2" => $verificado,
		    "valor_3" => $observaciones,
		);
		array_push($arreglo_de_valores,$array['valor_1']);
        array_push($arreglo_de_verificados,$array['valor_2']);
        $comentarios=$array['valor_3'];    
    }

header('Content-Type: application/json');
echo json_encode(array('array_datos'=>$arreglo_de_valores,'array_verificados'=>$arreglo_de_verificados,'comentarios'=>$comentarios));

?>