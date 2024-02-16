<?php

	include ("../controladores/conex.php");

	$query = "SELECT p.*,
       ep.`desc_estudio` AS desc_paquete,
       e.`desc_estudio` AS desc_estudio,
       CASE
          WHEN p.estado = 'A' THEN
    'Activo'
    ELSE
    'Suspendido'
  END AS desc_estado,
  estado,
  fecha_registro,
  fecha_actualizacion
FROM km_paquetes p
LEFT OUTER JOIN km_estudios ep ON (ep.`id_estudio` = p.`id_paquete`)
LEFT OUTER JOIN km_estudios e ON (e.`id_estudio` = p.`fk_id_estudio`)
WHERE estado='A'";


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
