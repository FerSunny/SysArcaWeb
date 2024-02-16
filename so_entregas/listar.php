<?php
session_start();
include ("../controladores/conex.php");
$fk_id_perfil=$_SESSION['fk_id_perfil'];
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

if($fk_id_perfil==1){
    $sucursal = ' > 0';
}else{
    $sucursal = ' = '.$fk_id_sucursal;
}


  

 

  $query = "
SELECT 
su.id_sucursal,
su.`desc_corta`,
te.id_tipo_estudio,
te.`nombre_tipo_estudio`,
COUNT(DISTINCT fa.`id_factura`) AS ot,
COUNT(df.fk_id_estudio) AS estudios
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = fa.`fk_id_sucursal`),
so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = df.`fk_id_estudio`)
LEFT OUTER JOIN km_tipo_estudio te ON (te.`id_tipo_estudio` = es.`fk_id_tipo_estudio`)
WHERE fa.`estado_factura` <> 5
AND DATE(fa.`fecha_entrega`) = CURDATE()
AND fa.`id_factura` = df.`id_factura`
AND fa.fk_id_sucursal $sucursal
GROUP BY 1,2,3,4

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

