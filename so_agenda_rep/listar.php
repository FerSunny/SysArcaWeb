<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  ag.`fk_id_sucursal`,
  su.`desc_corta`,
  ag.fk_id_area,
  ar.`desc_area`,
  ag.`fecha`,
  COUNT(*) AS num_citas
  FROM 
  so_agenda ag,
  kg_sucursales su,
  km_areas ar
  WHERE ag.`estado` = 'A'  
  AND ag.`fk_id_sucursal` = su.id_sucursal
  AND ag.`fk_id_area` = ar.`id_area`
  AND ag.`fecha` >= CURDATE()
  GROUP BY 1,2,3,4,5
  ";

//echo $query;
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
