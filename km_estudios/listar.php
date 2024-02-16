                                                                  <?php

	include ("../controladores/conex.php");

	$query = "SELECT   fk_id_descuento,fk_id_promosion,fk_id_indicaciones,fk_id_muestra,fk_id_muestra_1,fk_id_muestra_2,fk_id_muestra_3,fk_id_muestra_4,fk_id_tipo_estudio,fk_id_comision,observaciones,id_estudio,iniciales,desc_estudio,urgente,tiempo_entrega,per_perfil,costo,origen, maquila, cubiculo, estatus,
    d.desc_descuento,
    p.desc_promocion,
     m.desc_muestra,
     m1.desc_muestra AS desc_muestra_1,
     m2.desc_muestra AS desc_muestra_2,
     m3.desc_muestra AS desc_muestra_3,
     m4.desc_muestra AS desc_muestra_4,
     i.desc_indicaciones,
     j.desc_comision,
     e.per_paquete,
     cr.desc_plantilla,
     cr.id_plantilla,
     e.fk_id_plantilla,
     e.fk_id_estudio_ori,
     e.fk_id_estudio_maq,
     e.fk_id_metodo,
     e.fk_id_area
    FROM km_estudios e
INNER JOIN kg_descuentos d ON (d.id_descuento = e.fk_id_descuento) 
INNER JOIN kg_promociones p ON (p.id_promocion = e.fk_id_promosion)
LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra) 
LEFT OUTER JOIN km_muestras m1 ON (m1.id_muestra = e.fk_id_muestra_1)
LEFT OUTER JOIN km_muestras m2 ON (m2.id_muestra = e.fk_id_muestra_2)
LEFT OUTER JOIN km_muestras m3 ON (m3.id_muestra = e.fk_id_muestra_3)
LEFT OUTER JOIN km_muestras m4 ON (m4.id_muestra = e.fk_id_muestra_4)
LEFT OUTER JOIN cr_plantillas cr ON (cr.id_plantilla = e.fk_id_plantilla)
INNER JOIN km_indicaciones i ON (i.id_indicaciones = e.fk_id_indicaciones) 
INNER JOIN kg_comisiones j ON (j.id_comision = e.fk_id_comision ) 
WHERE grupo_estudio = 0
and estatus IN ('A')";
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
