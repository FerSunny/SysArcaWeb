                                                                  <?php

	include ("../controladores/conex.php");

	$query = "SELECT   id_estudio,desc_estudio,tiempo_entrega,costo,
    d.desc_descuento,
    p.desc_promocion,
    i.desc_indicaciones,
    j.desc_comision,
    e.fk_id_plantilla,
    CASE 
        WHEN e.per_paquete = 'No' AND e.per_perfil = 'No' THEN
            'nr'
        WHEN e.per_paquete = 'Si' THEN
            'pq'
        WHEN e.per_perfil = 'Si' THEN
            'pe'
        ELSE
            'na'
    END AS tipoestudio
    FROM km_estudios e
INNER JOIN kg_descuentos d ON (d.id_descuento = e.fk_id_descuento) 
INNER JOIN kg_promociones p ON (p.id_promocion = e.fk_id_promosion)
INNER JOIN km_indicaciones i ON (i.id_indicaciones = e.fk_id_indicaciones) 
INNER JOIN kg_comisiones j ON (j.id_comision = e.fk_id_comision ) 
WHERE estatus IN ('A')
AND substr(e.desc_estudio,1,5) <> 'MAQDN'
AND e.id_estudio NOT IN (
	151, 152, 153, 904, 905, 625, 307, 314, 628, 275, 301, 304, 876, 1155, 486, 274, 
	616, 586, 587, 217, 410, 870, 622, 412, 632, 640, 235, 641, 720, 886, 731, 585, 
	566, 528, 130, 749, 1997, 1120, 1122, 1121, 1124, 678, 679, 661, 663, 646, 645, 
	2137, 680, 848,494
	)
and ((CURDATE() BETWEEN p.fecha_inicio AND p.fecha_final) OR e.`fk_id_promosion` = 7) 
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
