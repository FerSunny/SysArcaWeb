<?php 


include ("../../controladores/conex.php");
//include("../../emails/multiple.php");
include("../../sendwa/enviaWA.php");
$id_factura= $_POST['factura'];
$id_estudio= $_POST['estudio'];
$id_plantilla= $_POST['plantilla'];
$id_cliente= $_POST['id_cliente'];

switch ($id_plantilla) {
    case '1':
        $ruta="https://laboratoriosarca.com/sysarcaweb_1.0/pdf_resenv/".$id_factura."_".$id_estudio.".pdf";
        //$ruta="localhost/sysarcaweb/so_envio_resultados/pdfs/".$id_factura."_".$id_estudio.".pdf";
        $atach = $ruta;
        //echo 'Atach:'.$atach;
        $asunto="Ha Recibido un email de Laboratorios de analsis Clinicos ARCA";
        $contenido="Ha recibido sus resultados del estudio practicado";
        //echo $asunto;
        //echo $contenido;
        $regreso=enviaWA($id_factura, $atach);
        //$regreso = multiple(1,$id_cliente,$atach,$asunto,$contenido); //destinatario,id,adjunto,mensaje,contenido
     // echo 'regreso'.$regreso;
     //   echo $regreso;
      //  $regreso=1;
        break;
    
    default:
        # code...
        break;
}

echo $regreso;

?>