<?php

  session_start();
	include ("../controladores/conex.php");

	$query = "
  SELECT 0 as id_factura,  es.id_estudio, es.`desc_estudio`, COUNT(p1.`id_valor`) AS numconceptos
  FROM cr_plantilla_1 p1, km_estudios es
  WHERE p1.`fk_id_estudio` = es.id_estudio
  AND p1.`estado` = 'A'
  GROUP BY es.id_estudio, es.`desc_estudio`
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
