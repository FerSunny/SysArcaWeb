<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  a.*,
  b.`desc_corta`,
  case
  when (length(c.nombre) = 0) or (c.nombre is null) then
  a.observaciones
  else
  CONCAT(c.`nombre`,' ',c.`a_paterno`,' ',c.`a_materno`)
  end AS paciente,
  d.`desc_area`,
  e.`iniciales`,
  c.telefono_fijo,
  c.telefono_movil,
  concat(us.`nombre`,' ',us.`a_paterno`) reservo
  FROM so_agenda a
  LEFT OUTER JOIN kg_sucursales b ON (b.`id_sucursal` = a.`fk_id_sucursal`)
  LEFT OUTER JOIN so_clientes c ON (c.`id_cliente` = a.`fk_id_paciente`)
  LEFT OUTER JOIN km_areas d ON (d.`id_area` = a.`fk_id_area`)
  LEFT OUTER JOIN km_estudios e ON (e.`id_estudio` = a.`fk_id_estudio`)
  left outer join se_usuarios us on (us.`id_usuario` = a.`fk_id_usuario`)
  WHERE a.estado = 'A'
  AND a.`fecha` >= CURDATE()
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
