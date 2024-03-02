<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  c.id_cliente  as id,
  concat(c.nombre,' ',c.a_paterno,' ',c.a_materno) as nombre ,
  c.telefono_fijo,
  MIN(fa.fecha_factura) AS primer,
  MAX(fa.fecha_factura) AS ultimo,
  COUNT(fa.id_factura) AS  numot
  FROM 
  so_clientes c
  LEFT OUTER JOIN so_factura fa ON (fa.fk_id_cliente = c.id_cliente)
  WHERE CHAR_LENGTH(c.telefono_fijo) = 10 
  AND c.telefono_fijo REGEXP '^[0-9]+$'
  GROUP BY 1,2,3
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
