<?php

	include ("../controladores/conex.php");

	$query = "
        SELECT
          se.`id_servicio`,
          se.`desc_servicio`,
          se.`desc_abreviada`,
          se.`fk_id_tipo_servicio`,
          
	    ts.`desc_tipo_servicio` as servicio,
          
          se.`estado`
        FROM `km_servicios` se
        left outer join km_tipo_servicio ts on (ts.id_tipo_servicio = se.fk_id_tipo_servicio)
        WHERE se.estado = 'A'
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
