<?php

    include ("../controladores/conex.php");

  $query = "
  SELECT
  fa.`id_factura`,
  DATE(fa.`fecha_factura`) AS fecha_factura,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre,
  df.fk_id_estudio,
  es.`desc_estudio`,
  es.fk_id_plantilla,
  CASE
  WHEN re.fk_id_factura IS NULL THEN
  1 -- 'Sin resultado en sistema'
  WHEN re.fk_id_factura IS NOT NULL AND re.entregada IS NULL AND re.validado = 1 AND fa.resta = '0.00' THEN
  2 -- 'Pendiente de entregar'
  WHEN re.fk_id_factura IS NOT NULL AND re.entregada IS NULL AND re.validado = 0 THEN
  3 -- 'Pendiente de Validar'
  ELSE
  re.`entregada`
  END entregada,
  us.iniciales,
  fa.resta,
  fa.fk_id_cliente
  FROM 
  so_factura fa
  LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente),
  so_detalle_factura df
  LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = df.`fk_id_estudio`)
  LEFT OUTER JOIN vw_resultado re ON (re.`fk_id_factura` = df.`id_factura` AND re.`fk_id_estudio` = df.`fk_id_estudio`)
  LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = re.usuario)
  WHERE fa.`estado_factura` <> 5
  AND CAST(`fa`.`fecha_factura` AS DATE) BETWEEN CURDATE() - INTERVAL 70 DAY AND CURDATE() + INTERVAL 15 DAY
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
