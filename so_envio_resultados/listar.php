<?php

    include ("../controladores/conex.php");

  
 
  $query = "
  SELECT
  fa.`id_factura`,
  DATE(fa.`fecha_factura`) AS fecha_factura,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre,
  df.fk_id_estudio,
  es.`desc_estudio`,
  CASE
  WHEN re.fk_id_factura IS NULL THEN
  1 -- 'Sin resultado en sistema'
  WHEN re.entregada IS NULL THEN
  2 -- 'Pendiente de entregar'
  ELSE
  re.`entregada`
  END entregada,
  us.iniciales,
  fa.resta
  FROM 
  so_factura fa
  LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente),
  so_detalle_factura df
  LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = df.`fk_id_estudio`)
  LEFT OUTER JOIN vw_resultado re ON (re.`fk_id_factura` = df.`id_factura` AND re.`fk_id_estudio` = df.`fk_id_estudio`)
  LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = re.usuario)
  WHERE fa.`estado_factura` <> 5
  AND CAST(`fa`.`fecha_factura` AS DATE) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() + INTERVAL 30 DAY
  AND fa.`id_factura` = df.`id_factura`
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
