<?php
session_start();
date_default_timezone_set('America/Mexico_City');
include ("../../../controladores/conex.php");

$fecha = date("Y-m-d H:i:s");


$data=json_decode($_POST['datas'],true);
$eritrocitos='0';
$hematocrito='0';
$hemoglobina='0';

foreach($data as $objeto)
{

    $orden=$objeto['td0'];
    $tipo=$objeto['td1'];
    $concepto=$objeto['td2'];
    $resultado=$objeto['td3'];
    $verificado=$objeto['td4'];
    $unidad_medida=$objeto['td5'];
    $valor_refe=$objeto['td6'];
    $observaciones=$objeto['observaciones'];
    $id_factura=$objeto['factura'];
    $id_studio=$objeto['estudio'];


    //echo 'valor=** '.$verificado.' **';
    if($concepto=='Eritrocitos'){
            $eritrocitos=$resultado;
    }

    if($concepto=='Hematocrito'){
    $hematocrito=$resultado;
    }

    if($concepto=='Hemoglobina'){
    $hemoglobina=$resultado;
    }

    if($concepto=='Volumen Corpuscular Medio (VCM)'){
    $resultado=bcdiv((($hematocrito/($eritrocitos/1000000))*10),'1',2);
    }

    if($concepto=='Conc Media de Hemoglobina (CMH)'){
    $resultado=bcdiv((($hemoglobina/($eritrocitos/1000000))*10),'1',2);
    }

    if($concepto=='Conc Media de Hemoglobina Corpuscular (CMHC)'){
    $resultado=bcdiv((($hemoglobina/$hematocrito)*100),'1',2);
    }

    // se incluye la fecha-Hora de impresion del resultado

    $fecha=date("Y-m-d H:i:s");
    $fecha_impresion=0;



    $sql="UPDATE cr_plantilla_1_re SET valor = '$resultado', verificado = '$verificado',  valor_refe = '$valor_refe', unidad_medida = '$unidad_medida', observaciones = '$observaciones',fecha_modificacion = '$fecha' WHERE fk_id_factura = $id_factura AND fk_id_estudio = $id_studio AND orden = '$orden'";
    //echo $sql;
    $query_new_insert = mysqli_query($conexion,$sql);
}
    $val = 1;


header('Content-Type: application/json');

echo $val;

//Devolvemos el array pasado a JSON como objeto

//echo json_encode($datos, JSON_FORCE_OBJECT);

?>