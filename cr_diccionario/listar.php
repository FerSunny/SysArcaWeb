<?php

	include ("../controladores/conex.php");
 
  $query = "
        SELECT  
            p1.`fk_id_estudio`,
            es.`iniciales`,
            CONCAT(p1.`fk_id_estudio`,'.',p1.`id_valor`) AS id_concepto,
            p1.`concepto`,
            p1.`valor_refe`,
            p1.`unidad_medida`,

            di.`fk_id_sexo`,
            di.`edad_inicial`,
            di.`edad_final`,
            se.`desc_sexo`,
            di.`rango_inicial`,
            di.`rango_final`,
            es.fk_id_plantilla
        FROM cr_plantilla_1 p1
        LEFT OUTER JOIN cr_diccionario di ON (di.`fk_id_estudio` = p1.`fk_id_estudio` AND di.fk_id_concepto = p1.`id_concepto` AND di.estado = 'A' )
        LEFT OUTER JOIN so_sexo se ON (se.`id_sexo` = di.`fk_id_sexo`)
        LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = p1.`fk_id_estudio`)
        WHERE p1.`estado` = 'A'
        AND p1.`tipo` = 'P'
        AND p1.`concepto` <> '.'
        AND p1.`fk_id_estudio` <> 0

        union 

        SELECT  
            p1.`fk_id_estudio`,
            es.`iniciales`,
            CONCAT(p1.`fk_id_estudio`,'.',p1.`id_valor`) AS id_concepto,
            p1.`concepto`,
            '' AS `valor_refe`,
            '' AS `unidad_medida`,

            di.`fk_id_sexo`,
            di.`edad_inicial`,
            di.`edad_final`,
            se.`desc_sexo`,
            di.`rango_inicial`,
            di.`rango_final`,
            es.fk_id_plantilla
        FROM cr_plantilla_2 p1
        LEFT OUTER JOIN cr_diccionario di ON (di.`fk_id_estudio` = p1.`fk_id_estudio` AND di.fk_id_concepto = p1.`id_concepto` AND di.estado = 'A' )
        LEFT OUTER JOIN so_sexo se ON (se.`id_sexo` = di.`fk_id_sexo`)
        LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = p1.`fk_id_estudio`)
        WHERE p1.`estado` = 'A'
        AND p1.`tipo` = 'P'
        AND p1.`concepto` <> '.'
        AND p1.`fk_id_estudio` <> 0
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

