<?php

	include ("../controladores/conex.php");

	$query = "SELECT 
  p1.fk_id_empresa,
  p1.id_valor,
  p1.orden,
  p1.fk_id_estudio,
  p1.tipo,
  p1.concepto,
  p1.posini,
  p1.tamfue,
  p1.tipfue,
  p1.estado,
  es.desc_estudio 
FROM cr_plantilla_cvo p1
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p1.fk_id_estudio)
WHERE p1.estado = 'A'
ORDER BY p1.fk_id_estudio,p1.orden";


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
