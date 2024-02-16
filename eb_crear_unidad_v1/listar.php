<?php

include ("../controladores/conex.php");
session_start();
$sucursal =$_SESSION['fk_id_sucursal'];
$perfil =$_SESSION['fk_id_perfil'];

if($perfil == 1){
    $suc = '> 0';
}else{
    $suc = ' = '.$sucursal;
}
  
$query = "
SELECT 
ds.`id_detalle`, 
ds.`fk_id_sucursal`,
su.desc_corta,
us.`iniciales`,
ds.`importe_total`,
ds.`importe_real_total`,
ds.`estatus`,
ds.`fecha_registro`,
ds.`estado`,
ds.`tipo`,
date(ds.fecha_libera) as fecha_libera,
COUNT(*) AS numpro
FROM eb_detalle_solicitud ds
LEFT OUTER JOIN kg_sucursales su ON(su.id_sucursal = ds.`fk_id_sucursal`) 
LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = ds.`fk_id_usuario`)
LEFT OUTER JOIN eb_solicitudes so ON (so.`fk_id_detalle` = ds.`id_detalle` and so.estado = 'A')
WHERE ds.`estado` = 'A'
AND ds.fk_id_sucursal $suc
GROUP BY 1,2,3,4,5,6,7,8,9,10,11
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
