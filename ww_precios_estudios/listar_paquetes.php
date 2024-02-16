<?php
    session_start();
	include ("../controladores/conex.php");
    
    $studio= $_SESSION['studio'];
    $plantilla= $_SESSION['plantilla'];
	

    $query = "
SELECT  es.`desc_estudio`
FROM km_paquetes pq, km_estudios es
WHERE pq.id_paquete = $studio
AND pq.`fk_id_estudio` = es.`id_estudio`
AND pq.`estado` = 'A'
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
