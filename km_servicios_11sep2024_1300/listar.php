<?php

	include ("../controladores/conex.php");

	$query = "
        SELECT
          `id_servicio`,
          `desc_servicio`,
          `desc_abreviada`,
          `tipo_servicio`,
          CASE
            WHEN tipo_servicio = 'A' THEN
                'Administrativo'
            WHEN tipo_servicio = 'L' THEN
                'Laboratorio'
            WHEN tipo_servicio = 'G' THEN 
                'Gabinete'
            WHEN tipo_servicio = 'I' THEN 
                'Imagenologia'
            WHEN tipo_servicio = 'R' THEN 
                'Recepcion'
            ELSE
                'No asignado'
          END AS servicio,
          `estado`
        FROM `km_servicios`
        WHERE estado = 'A'
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
