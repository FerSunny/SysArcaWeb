<?php
    session_start();
	include ("../controladores/conex.php");
    
    $studio= $_SESSION['studio'];
    $plantilla= $_SESSION['plantilla'];
	

    $query = "
SELECT es.`desc_estudio` 
FROM km_perfil_detalle pe, km_estudios es
WHERE pe.`fk_id_perfil` = $studio
AND pe.`fk_id_estudio` = es.`id_estudio`
    ";

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
