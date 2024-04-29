<?php 
session_start();

include ("../../controladores/conex.php");
include("../../emails/multiple.php");
$id_factura= $_POST['factura'];
$id_estudio= $_POST['estudio'];
$id_plantilla= $_POST['plantilla'];
$id_cliente= $_POST['id_cliente'];
$id_usuario = $_SESSION['id_usuario'];

//enviamos el email
$ruta="https://www.laboratoriosarca.com/sysarcaweb_1.0/pdf_resenv/".$id_factura."_".$id_estudio.".pdf";
$atach = $ruta;
//echo 'ruta'.$ruta;
$asunto="Ha Recibido un email de Laboratorios de analsis Clinicos ARCA";
$contenido="Ha recibido sus resultados del estudio practicado";
$regreso = multiple(1,$id_cliente,$atach,$asunto,$contenido); //destinatario,id,adjunto,mensaje,contenido
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