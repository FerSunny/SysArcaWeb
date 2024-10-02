<?php

	include ("../controladores/conex.php");

  
 
  $query = "
    SELECT 
    a.*,
    se.`desc_sexo`,
    um.`desc_unidad_medida`
    FROM cr_analitos a
    LEFT OUTER JOIN so_sexo se ON (se.id_sexo = a.fk_id_sexo)
    LEFT OUTER JOIN cr_unidad_medida um ON (um.`id_unidad_medida` = a.`fk_id_unidad_medida`)
    WHERE a.`estado` = 'A'
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
