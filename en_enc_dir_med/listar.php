<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  c.id_medico  AS id,
  2 AS tipo,
  CONCAT(c.nombre,' ',c.a_paterno,' ',c.a_materno) AS nombre ,
  c.telefono_fijo,
  c.telefono_movil,
  CASE
  WHEN re.desc_respuesta IS NULL THEN
  'Pendiente'
  ELSE
  CONCAT(re.desc_respuesta,'-',di.fecha_encuesta)
  END AS estatus,
  di.fk_id_res_enc,

CASE 
WHEN COUNT(`fa`.`id_factura`) = 0 THEN 
0 
WHEN COUNT(`fa`.`id_factura`) / TIMESTAMPDIFF(MONTH, c.fecha_registro, CURDATE()) = 0 THEN 
0 
WHEN COUNT(`fa`.`id_factura`) / TIMESTAMPDIFF(MONTH, c.fecha_registro, CURDATE()) BETWEEN 0.0 AND 1 THEN 
1 
WHEN COUNT(`fa`.`id_factura`) / TIMESTAMPDIFF(MONTH, c.fecha_registro, CURDATE()) BETWEEN 1.01 AND 2.9 THEN 
2 
WHEN COUNT(`fa`.`id_factura`) / TIMESTAMPDIFF(MONTH, c.fecha_registro, CURDATE()) BETWEEN 3.01 AND 5.9 THEN 
3 
WHEN COUNT(`fa`.`id_factura`) / TIMESTAMPDIFF(MONTH, c.fecha_registro, CURDATE()) BETWEEN 6.01 AND 8.9 THEN 
4 
WHEN COUNT(`fa`.`id_factura`) / TIMESTAMPDIFF(MONTH, c.fecha_registro, CURDATE()) >= 9 THEN 
5 
ELSE 
5 
END AS `prioridad`,
	
  
  MIN(fa.fecha_factura) AS primer,
  MAX(fa.fecha_factura) AS ultimo,
  COUNT(fa.id_factura) AS  numot
  FROM 
  so_medicos c
  LEFT OUTER JOIN so_factura fa ON (fa.fk_id_medico = c.id_medico)
  LEFT OUTER JOIN en_enc_directorio di ON (di.tipo = 2 AND di.`fk_id` = c.`id_medico` AND di.estado ='A')
  LEFT OUTER JOIN en_res_enc re ON (re.id_res_enc = di.`fk_id_res_enc`)
  WHERE (CHAR_LENGTH(c.telefono_fijo) = 10 AND c.telefono_fijo REGEXP '^[0-9]+$')
  OR (CHAR_LENGTH(c.telefono_movil) = 10 AND c.telefono_movil REGEXP '^[0-9]+$')
  GROUP BY 1,2,3,4,5,6,7
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
