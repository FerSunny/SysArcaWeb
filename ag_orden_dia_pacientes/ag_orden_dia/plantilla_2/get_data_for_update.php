<?php

date_default_timezone_set('America/Mexico_City');

// conexion de factura
require_once ("../../../so_factura/config/db.php");
require_once ("../../../so_factura/config/conexion.php");

$data=json_decode($_POST['datas'],true);
$arreglo_de_valores=array();
$arreglo_de_verificados=array();
$comentarios="";

    $sql="SELECT valor,verificado,observaciones FROM cr_plantilla_2_re WHERE fk_id_estudio=".$data['id_estudio'] . " AND fk_id_factura=".$data['id_factura'] ." AND tipo='P'";


    $executando_sql = mysqli_query($con, $sql);
    while ($fila = mysqli_fetch_row($executando_sql)) {
        
        array_push($arreglo_de_valores,$fila[0]);
        array_push($arreglo_de_verificados,$fila[1]);
        $comentarios=$fila[2];
    }


header('Content-Type: application/json');
echo json_encode(array('array_datos'=>$arreglo_de_valores,'array_verificados'=>$arreglo_de_verificados,'comentarios'=>$comentarios));

?>