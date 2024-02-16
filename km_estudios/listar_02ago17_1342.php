                                                                  <?php

	include ("../controladores/conex.php");

	$query = "SELECT 	fk_id_descuento,fk_id_promosion,fk_id_indicaciones,fk_id_muestra,fk_id_tipo_estudio,fk_id_comision,observaciones,id_estudio,iniciales,desc_estudio,urgente,tiempo_entrega,per_perfil,costo,estatus,
    d.desc_descuento,
    p.desc_promocion,
     m.desc_muestra,
     i.desc_indicaciones,
     j.desc_comision
    FROM km_estudios e
INNER JOIN kg_descuentos d ON (d.id_descuento = e.fk_id_descuento) 
INNER JOIN kg_promociones p ON (p.id_promocion = e.fk_id_promosion)
LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra) 
INNER JOIN km_indicaciones i ON (i.id_indicaciones = e.fk_id_indicaciones) 
INNER JOIN kg_comisiones j ON (j.id_comision = e.fk_id_comision ) where estatus in ('A')";
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
