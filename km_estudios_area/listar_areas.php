<?php

include ("../controladores/conex.php");
session_start();
$fk_id_estudio_ori =$_SESSION['fk_id_estudio_ori'];
$sucursal =$_SESSION['fk_id_sucursal'];
  
$query = "
SELECT
ea.*,
ar.`desc_area`,
ar.id_area
FROM km_estudios_area ea
LEFT OUTER JOIN km_areas ar ON (ar.`clave` = ea.`fk_id_clave_area`)
WHERE ea.`estado` = 'A'
AND ea.`fk_id_estudio` = $fk_id_estudio_ori
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
