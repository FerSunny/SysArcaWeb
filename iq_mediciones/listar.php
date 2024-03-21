<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT
  me.*,
  eq.`descripcion`,
  ar.`desc_area`,
  su.`desc_corta`,
  se.`desc_servicio`,
  us.`iniciales`
  FROM
  iq_mediciones me,
  eb_equipos eq,
  km_areas ar
  ,kg_sucursales su
  ,km_servicios se
  ,se_usuarios us
  WHERE me.`estado` = 'A'
  AND me.`fk_id_equipo` = eq.`id_equipo`
  AND eq.`fk_id_area` = ar.`id_area`
  AND me.`fk_id_sucursal` = su.id_sucursal
  AND eq.`fk_id_servicio` = se.`id_servicio`
  AND me.`fk_id_usuario` = us.`id_usuario`
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
