<?php



	include ("../controladores/conex.php");



  

 

  $query = "

SELECT 
@n := @n + 1 contador,
tm.`id_toma`,
su.`desc_corta`,
tm.`fk_id_factura`,
es.`iniciales`,
tm.`check_in`,
0 as estatus,
tm.fecha_toma
FROM 
tm_tomas tm,
km_estudios es,
kg_sucursales su,
(SELECT @n := 0) m
WHERE tm.`fk_id_estudio` = es.`id_estudio` 
AND es.`fk_id_estudio_ori` = 274
AND tm.`fk_id_sucursal` = su.`id_sucursal`
-- AND DATE(tm.`fecha_toma`) = CURDATE()
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

