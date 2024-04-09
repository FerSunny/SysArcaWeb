<?php 
session_start();

include ("../../controladores/conex.php");
include("../../emails/multiple.php");
$id_factura= $_POST['factura'];
$id_estudio= $_POST['estudio'];
$id_plantilla= $_POST['plantilla'];
$id_cliente= $_POST['id_cliente'];
$desc_estudio= $_POST['desc_estudio'];

$id_usuario = $_SESSION['id_usuario'];

//enviamos el email //
$ruta=$id_factura."_".$id_estudio.".pdf";
$atach = $ruta;
//echo 'atach:'.$atach;
$asunto="Ha Recibido un email de Laboratorios de analsis Clinicos ARCA";
$contenido="Ha recibido los resultados del estudio ".$desc_estudio;
$regreso = multiple(6,$id_cliente,$atach,$asunto,$contenido); //destinatario,id,adjunto,mensaje,contenido
if($regreso == 1){
    switch ($id_plantilla) {
    case '1':
        $sql_up=
        "
        UPDATE cr_plantilla_1_re
        SET 
        fecha_hora_entregada = NOW(),
        fk_id_usuario = '$id_usuario'
        WHERE fk_id_factura = $id_factura
        AND fk_id_estudio = $id_estudio
        ";
        $execute_query_update = mysqli_query($conexion,$sql_up);
        break;
    case '2':
        $sql_up=
        "
        UPDATE cr_plantilla_2_re
        SET 
        fecha_hora_entregada = NOW(),
        fk_id_usuario = $id_usuario
        WHERE fk_id_factura = $id_factura
            AND fk_id_estudio = $id_estudio
        ";
        $execute_query_update = mysqli_query($conexion,$sql_up);
        break;
    case '3':
        $sql_up=
        "
        UPDATE cr_plantilla_cvo_re
        SET 
        fecha_hora_entregada = NOW(),
        fk_id_usuario = $id_usuario
        WHERE fk_id_factura = $id_factura
            AND fk_id_estudio = $id_estudio
        ";
        $execute_query_update = mysqli_query($conexion,$sql_up);
        break;
    default:
        echo '<script> alert("Update de entregada fallida, No hay plantilla para este estudio")</script>';
        break;
    }
}else{
    echo '<script> alert("Update de entregada fallida, el email no se envio")</script>';
}


echo $regreso;

?>