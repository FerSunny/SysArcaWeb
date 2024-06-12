<?php 
session_start();

include ("../../controladores/conex.php");
//include("../../emails/multiple.php");
include("../../sendwa/enviaWA.php");
$id_factura= $_POST['factura'];
$id_estudio= $_POST['estudio'];
$id_plantilla= $_POST['plantilla'];
$id_cliente= $_POST['id_cliente'];
$id_usuario = $_SESSION['id_usuario'];

switch ($id_plantilla) {
    case '1':
        //echo 'p1';
        $ruta="https://laboratoriosarca.com/sysarcaweb_1.0/pdf_resenv/".$id_factura."_".$id_estudio.".pdf";
        //$ruta="localhost/sysarcaweb/so_envio_resultados/pdfs/".$id_factura."_".$id_estudio.".pdf";
        $atach = $ruta;
        //echo 'Atach:'.$atach;
        $asunto="Ha Recibido un email de Laboratorios de analsis Clinicos ARCA";
        $contenido="Ha recibido sus resultados del estudio practicado";
        //echo $asunto;
        //echo $contenido;
        $regreso=enviaWA($id_factura, $atach,$id_estudio,$id_usuario);
        if($regreso == 1){
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
        }
        break;
    case '2':
        $ruta="https://laboratoriosarca.com/sysarcaweb_1.0/pdf_resenv/".$id_factura."_".$id_estudio.".pdf";
        //$ruta="localhost/sysarcaweb/so_envio_resultados/pdfs/".$id_factura."_".$id_estudio.".pdf";
        $atach = $ruta;
        //echo 'Atach:'.$atach;
        $asunto="Ha Recibido un email de Laboratorios de analsis Clinicos ARCA";
        $contenido="Ha recibido sus resultados del estudio practicado";
        //echo $asunto;
        //echo $contenido;
        $regreso=enviaWA($id_factura, $atach,$id_estudio,$id_usuario);
        if($regreso == 1){
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
        }
        break;
    case '3':
        $ruta="https://laboratoriosarca.com/sysarcaweb_1.0/pdf_resenv/".$id_factura."_".$id_estudio.".pdf";
        //$ruta="localhost/sysarcaweb/so_envio_resultados/pdfs/".$id_factura."_".$id_estudio.".pdf";
        $atach = $ruta;
        //echo 'Atach:'.$atach;
        $asunto="Ha Recibido un email de Laboratorios de analsis Clinicos ARCA";
        $contenido="Ha recibido sus resultados del estudio practicado";
        //echo $asunto;
        //echo $contenido;
        $regreso=enviaWA($id_factura, $atach,$id_estudio,$id_usuario);
        if($regreso == 1){
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
        }
        break;
    default:
        # code...
        break;
}

echo $regreso;

?>