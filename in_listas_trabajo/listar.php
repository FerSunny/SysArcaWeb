                                                                  <?php

	include ("../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');
	$query = "
SELECT 
es.`id_estudio`,
es.`desc_estudio`,
COUNT(DISTINCT fa.`id_factura`) AS numot,
COUNT(df.`fk_id_estudio`) AS numest
FROM 
so_factura fa,
so_detalle_factura df,
km_estudios es
WHERE 
date(fa.`fecha_factura`) = curdate() AND
fa.`estado_factura` <> 5 AND
fa.`id_factura` = df.`id_factura` AND
df.`fk_id_estudio` = es.`id_estudio` 
GROUP BY 1,2 
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
