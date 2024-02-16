<?php

	include ("../controladores/conex.php");

  $query = "
SELECT od.id_orden,
od.`maquila`,
CONCAT(me.nombre,' ',me.a_paterno,' ',me.`a_materno`) AS medico,
od.`fecha_orden`,
od.`hora_orden`,
od.`fk_id_factura`,
od.`sigue_orden`,
CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.`a_materno`) AS paciente,
GROUP_CONCAT(es.desc_estudio SEPARATOR ' , ') AS estudio,
SUM(es.`costo`) AS pago
FROM ce_ordenes od,
so_medicos me,
so_clientes cl,
ce_ordenes_detalle de,
km_estudios es
WHERE od.`fk_id_medico` = me.`id_medico`
AND od.`fk_id_cliente` = cl.`id_cliente`
AND od.`id_orden` = de.`id_orden`
AND de.`fk_id_estudio` = es.id_estudio
AND od.`sigue_orden` IN (1,2)
GROUP BY 
od.id_orden,
od.`maquila`,
CONCAT(me.nombre,' ',me.a_paterno,' ',me.`a_materno`),
od.`fecha_orden`,
od.`hora_orden`,
od.`fk_id_factura`,
od.`sigue_orden`,
CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.`a_materno`)
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

