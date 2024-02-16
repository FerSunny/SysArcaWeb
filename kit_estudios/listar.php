                                                                  <?php

    include ("../controladores/conex.php");

    $query = "
SELECT es.id_estudio,
    es.iniciales,
    es.desc_estudio,
    te.nombre_tipo_estudio,
    CONCAT('$',FORMAT(SUM(ce.`cantidad` * ce.precio),2)) AS costo,
    sum(ce.`cantidad`) AS numarticulos,
	SUM(t1.`tiempo`) AS minutos,
    SUM(t1.`costo`) AS costo_tiempo
FROM km_estudios es
LEFT OUTER JOIN km_costo_estudio ce ON (ce.`fk_id_estudio` = es.`id_estudio`  AND ce.estado = 'A')
LEFT OUTER JOIN km_tiempo_estudio t1 ON (t1.fk_id_estudio = es.id_estudio AND t1.estado ='A'),
km_tipo_estudio te
WHERE  es.fk_id_tipo_estudio = te.id_tipo_estudio
AND es.`estatus` = 'A'
GROUP BY 
es.id_estudio,
    es.iniciales,
    es.desc_estudio,
    te.nombre_tipo_estudio
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
