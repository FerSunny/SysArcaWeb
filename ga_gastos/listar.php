<?php

	include ("../controladores/conex.php");

	$query = "SELECT
              ga.fk_id_clasifica,
              cl.desc_clasifica,
              ga.fk_id_tipo_gasto,
              tg.desc_tipo_gasto,
              ga.id_gasto,
              ga.desc_gasto,
              ga.estado
            FROM    ga_gasto ga,
                ga_clasifica cl,
                ga_tipo_gasto tg
            WHERE ga.fk_id_clasifica = cl.id_clasifica
              AND ga.fk_id_tipo_gasto = tg.id_tipo_gasto
              AND ga.estado = 'A'
              AND cl.estado = 'A'
              AND tg.estado = 'A'
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
