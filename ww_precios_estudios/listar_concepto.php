<?php
    session_start();
	include ("../controladores/conex.php");
    
    $studio= $_SESSION['studio'];
    $plantilla= $_SESSION['plantilla'];
	
    switch ($plantilla) {
        case 1:
            $query = "
                SELECT 	p1.`fk_id_estudio`,
                p1.`tipo`,
                p1.`concepto`,
                p1.`valor_refe`,
                p1.`unidad_medida`
                FROM cr_plantilla_1 p1
                WHERE p1.`estado` = 'A'
                AND p1.`tipo` NOT IN ('B','R','F','M','T')
                AND p1.`fk_id_estudio` = ".$studio."
                ORDER BY p1.`orden`
            ";
            break;
        case 2:
            $query = "
            SELECT 	p1.`fk_id_estudio`,
            p1.`concepto`,
            ' ' AS `valor_refe`,
            ' ' AS `unidad_medida`
            FROM cr_plantilla_2 p1
            WHERE p1.`estado` = 'A'
            AND p1.`tipo` NOT IN ('B','R','F','M','T')
            AND p1.`fk_id_estudio` = ".$studio."
            ORDER BY p1.`orden`
            ";
            break;
        case 3:
            $query = "
            SELECT 	p1.`fk_id_estudio`,
            p1.`concepto`,
            ' ' AS `valor_refe`,
            ' ' AS `unidad_medida`
            FROM cr_plantilla_cvo p1
            WHERE p1.`estado` = 'A'
            AND p1.`tipo` NOT IN ('B','R','F','M','T')
            AND p1.`fk_id_estudio` = ".$studio."
            ORDER BY p1.`orden`
            ";
            break;
    }

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
