<?php

	include ("../controladores/conex.php");

	$query = "SELECT bi.*,es.desc_estudio
FROM in_bitacora bi
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = fk_id_estudio)";


	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
