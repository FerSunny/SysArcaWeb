<?php

	include ("../../controladores/conex.php");

	$query = "SELECT   id_estudio,
    iniciales,
    desc_estudio,
    urgente,
    tiempo_entrega,
    per_perfil,
    costo,estatus,
    m.desc_muestra,
    d.desc_descuento,
    p.desc_promocion,
    i.desc_indicaciones
FROM km_estudios e
LEFT OUTER JOIN kg_descuentos d ON (d.id_descuento = e.fk_id_descuento)
LEFT OUTER JOIN kg_promociones p ON (p.id_promocion = e.fk_id_promosion)
LEFT OUTER JOIN km_indicaciones i ON (i.id_indicaciones = e.fk_id_indicaciones)
LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra)";
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
