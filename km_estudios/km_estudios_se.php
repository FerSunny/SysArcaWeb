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
    m1.desc_muestra AS desc_muestra_1,
    m2.desc_muestra AS desc_muestra_2,
    m3.desc_muestra AS desc_muestra_3,
    m4.desc_muestra AS desc_muestra_4,
    d.desc_descuento,
    p.desc_promocion,
    i.desc_indicaciones,
    cr.desc_plantilla,
    e.fk_id_plantilla
FROM km_estudios e
LEFT OUTER JOIN kg_descuentos d ON (d.id_descuento = e.fk_id_descuento)
LEFT OUTER JOIN kg_promociones p ON (p.id_promocion = e.fk_id_promosion)
LEFT OUTER JOIN km_indicaciones i ON (i.id_indicaciones = e.fk_id_indicaciones)
LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra)
LEFT OUTER JOIN km_muestras m1 ON (m1.id_muestra = e.fk_id_muestra_1)
LEFT OUTER JOIN km_muestras m2 ON (m2.id_muestra = e.fk_id_muestra_2)
LEFT OUTER JOIN km_muestras m3 ON (m3.id_muestra = e.fk_id_muestra_3)
LEFT OUTER JOIN km_muestras m4 ON (m4.id_muestra = e.fk_id_muestra_4)
LEFT OUTER JOIN cr_plantillas cr ON (cr.id_plantilla = e.fk_id_plantilla)";
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
