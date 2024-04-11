<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  s.`desc_corta`,
  DATE(t.`fecha_toma`) AS fecha,
  -- time(t.`fecha_toma`) as tiempo,
  HOUR(t.fecha_toma) AS hora,
  -- t.fk_id_factura,
  -- t.`fk_id_estudio`,
  -- es.`iniciales`,
  COUNT(
  CASE
  WHEN r.fk_id_factura IS NULL THEN
  'Pendiente'
  END)  pendientes,
  COUNT(
  CASE
  WHEN r.fk_id_factura IS NOT NULL THEN
  'Realizadas'
  END)  procesadas,
  COUNT(*) AS todas
  
  FROM tm_tomas t
  LEFT OUTER JOIN vw_resultado r ON (r.fk_id_factura = t.`fk_id_factura` AND r.`fk_id_estudio` = t.`fk_id_estudio`),
  km_estudios es,
  kg_sucursales s
  WHERE t.`fk_id_estudio` = es.`id_estudio`
  AND t.`fk_id_sucursal` = s.`id_sucursal`
  AND YEAR(t.fecha_toma) = YEAR(CURDATE())
  -- AND MONTH(t.`fecha_toma`) = MONTH(CURDATE())
  GROUP BY 1,2,3
  ORDER BY 1,2,3
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
