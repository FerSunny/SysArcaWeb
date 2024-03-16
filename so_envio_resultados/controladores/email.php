<?php 


include ("../../controladores/conex.php");
include("../../emails/multiple.php");
$id_factura= $_POST['factura'];
$id_estudio= $_POST['estudio'];
$id_plantilla= $_POST['plantilla'];
$id_cliente= $_POST['id_cliente'];
$id_usuario = $_SESSION['id_usuario'];

//enviamos el email
$ruta="www.laboratoriosarca.com/sysarcaweb_1.0/pdfs/".$id_factura."_".$id_estudio.".pdf";
$atach = $ruta;
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
        fk_id_usuario = $id_usuario
        WHERE 
            AND fk_id_factura = $fk_id_factura
            AND fk_id_estudio = $fk_id_estudio
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
        WHERE 
            AND fk_id_factura = $fk_id_factura
            AND fk_id_estudio = $fk_id_estudio
        ";
        $execute_query_update = mysqli_query($conexion,$sql_up);
        break;
    default:
        # code...
        break;
}
}


echo $regreso;

?>