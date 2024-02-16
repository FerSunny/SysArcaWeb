<?php

	include ("../controladores/conex.php");

	$query = "
		SELECT	su.desc_corta,
			fa.`id_factura`,
			fa.`fecha_factura`,
			fa.`fecha_entrega`,
			es.id_estudio,
			es.`desc_estudio`,
			CASE
				WHEN TIME(fa.fecha_factura) <= '10:00:00' AND es.`estatus` = 'A' AND es.`urgente` = 'Si' AND es.`tiempo_entrega` = 0 AND es.`fk_id_tipo_estudio` = 2 
					AND (SELECT COUNT(*)
						FROM km_estudios es, so_detalle_factura df
						WHERE es.`estatus` = 'A'
						AND es.`urgente` = 'Si'
						AND es.`tiempo_entrega` = 0
						AND es.`fk_id_tipo_estudio` = 2
						AND es.`id_estudio` = df.`fk_id_estudio`
						AND df.`id_factura` = fa.id_factura 
						) = 1 THEN
					'Unica'
				WHEN su.hor_hab_cie <= '17:30:00' AND es.fk_id_tipo_estudio = 2 THEN
					'Ordinaria Matutina'
				WHEN su.hor_hab_cie >= '17:30:00' AND es.fk_id_tipo_estudio = 2 THEN
					'Ordinaria Vespertina'
				ELSE
					'no definido'
			END AS TipoLista
		FROM so_factura fa, so_detalle_factura df, km_estudios es, kg_sucursales su
		WHERE fa.`estado_factura` <> 5
		AND DATE(fa.`fecha_factura`) > '2021-04-01' -- <= CURDATE()
		AND fa.`id_factura` = df.`id_factura`
		AND df.`fk_id_estudio` = es.`id_estudio`
		AND fa.fk_id_sucursal = su.id_sucursal
		AND es.fk_id_tipo_estudio = 2
";
//LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra) where estatus in ('A','S')";
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
