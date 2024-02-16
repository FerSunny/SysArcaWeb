<?php

	include ("../controladores/conex.php");

  
$query = "
SELECT su.`desc_sucursal`, 
YEAR(ac.`fecha_actualizacion`) AS anio, 
MONTHNAME(ac.`fecha_actualizacion`) AS mes_nombre, 
MONTH(ac.`fecha_actualizacion`) AS mes, 
COUNT(ac.fk_id_producto) AS numprod, 
COUNT(ac.fk_id_proveedor) AS numprov, 
SUM(ac.`existencias`) AS existen, 
MIN(ac.`fecha_actualizacion`) AS minfecha, 
MAX(ac.`fecha_actualizacion`) AS maxfecha 
FROM eb_almacen_central ac 
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = ac.`fk_id_sucursal`) 
WHERE ac.estado ='A' 
GROUP BY su.`desc_sucursal`,
YEAR(ac.`fecha_actualizacion`), 
MONTHNAME(ac.`fecha_actualizacion`), 
MONTH(ac.`fecha_actualizacion`)
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
