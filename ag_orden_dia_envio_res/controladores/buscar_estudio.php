<?php 

include "../../controladores/conex.php";
    $fac = $_POST["val"];
    $est = $_POST["val2"];

    $query = "SELECT rx.fk_id_factura, rx.fk_id_estudio, e.desc_estudio, rx.fk_id_plantilla,crx.nombre_plantilla,rx.titulo_desc, rx.descripcion, rx.firma
        FROM cr_plantilla_ekg_re rx
        INNER JOIN km_estudios e
        ON e.id_estudio=rx.fk_id_estudio
        INNER JOIN cr_plantilla_ekg crx
        ON crx.id_plantilla=rx.fk_id_plantilla
        WHERE rx.estado='A' AND rx.fk_id_factura = $fac AND rx.fk_id_estudio  = $est";

        $arreglo = array();
    $resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);

 ?>