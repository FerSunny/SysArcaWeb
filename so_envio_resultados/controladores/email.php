<?php 


include ("../../controladores/conex.php");
include("../../emails/multiple.php");
$id_factura= $_POST['factura'];
$id_estudio= $_POST['estudio'];
$id_plantilla= $_POST['plantilla'];

switch ($id_plantilla) {
    case '1':
        $ruta="../ag_confirma_v3.0/pdfs".$id_factura."_".$id_estudio.".pdf";
        $atach = $ruta;
        $asunto="Ha recibido una queja a traves del SYSARCAWEB";
        $contenido="Medico:".$medico_id."<br>"."Paciente: ".$paciente_id."<br>"."Queja: ".$inconformidad;
        //echo $asunto;
        //echo $contenido;
          $regreso = multiple(4,0,$atach,$asunto,$contenido); //destinatario,id,adjunto,mensaje,contenido
      
        echo $regreso;
        break;
    
    default:
        # code...
        break;
}

/*
$query ="UPDATE eb_productos SET estado = 'S' WHERE id_producto = $id_producto ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}

*/

echo 1;

$conexion->close();
?>