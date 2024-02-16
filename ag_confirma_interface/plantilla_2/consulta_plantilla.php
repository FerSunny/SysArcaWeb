<?php

date_default_timezone_set('America/Mexico_City');

include ("../../controladores/conex.php");

$id_factura = $_POST['id_factura'];
$id_estudio = $_POST['id_estudio'];

$arreglo_de_valores=array();
$arreglo_de_verificados=array();
$comentarios="";

    $sql="SELECT valor,verificado,observaciones FROM cr_plantilla_2_re_i WHERE fk_id_estudio=$id_estudio AND fk_id_factura=$id_factura AND tipo='P'";


    $result = $conexion->query($sql);
    while ($fila = mysqli_fetch_row($result)) {
        
        array_push($arreglo_de_valores,$fila[0]);
        array_push($arreglo_de_verificados,$fila[1]);
        $comentarios=$fila[2];
    }


header('Content-Type: application/json');
echo json_encode(array('array_datos'=>$arreglo_de_valores,'array_verificados'=>$arreglo_de_verificados,'comentarios'=>$comentarios));

?>