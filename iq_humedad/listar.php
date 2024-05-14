<?php

	include ("../controladores/conex.php");

  $query = "
  SELECT 
  t.*,
  e.`descripcion`,
  a.`desc_area`,
  se.`desc_servicio`,
  gc.`desc_gpo_conta`
  FROM iq_humedad t,
  eb_equipos e
  LEFT OUTER JOIN `eb_termohigrometros` eq ON (eq.`fk_id_equipo` = e.`id_equipo`),
  km_areas a,
  km_servicios se,
  km_gpo_conta gc
  WHERE t.estado = 'A'
  AND t.`fk_id_equipo` = e.`id_equipo`
  AND e.`fk_id_area` = a.`id_area`
  AND e.`fk_id_servicio` = se.`id_servicio`
  AND e.`fk_id_gpo_conta` = gc.`id_gpo_conta`
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

