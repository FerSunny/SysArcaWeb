<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  a.*,
  b.`desc_corta`,
  CONCAT(c.`nombre`,' ',c.`a_paterno`,' ',c.`a_materno`) AS paciente,
  d.`desc_area`,
  e.`iniciales`
  FROM so_agenda a
  LEFT OUTER JOIN kg_sucursales b ON (b.`id_sucursal` = a.`fk_id_sucursal`)
  LEFT OUTER JOIN so_clientes c ON (c.`id_cliente` = a.`fk_id_paciente`)
  LEFT OUTER JOIN km_areas d ON (d.`id_area` = a.`fk_id_area`)
  LEFT OUTER JOIN km_estudios e ON (e.`id_estudio` = a.`fk_id_estudio`)
  WHERE a.estado = 'A'
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
