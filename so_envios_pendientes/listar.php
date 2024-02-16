<?php



	include ("../controladores/conex.php");



  

 

  $query = "
  SELECT 
  fa.`id_factura`,
  su.`desc_corta`,
  fa.`fecha_factura`,
  es.`desc_estudio`
  FROM 
  so_detalle_factura df,
  so_factura fa,
  kg_sucursales su,
  km_estudios es
  WHERE df.`fk_id_estudio` = es.`id_estudio`
  AND es.fk_id_plantilla IN (4,5,6,8)
  AND fa.`id_factura` = df.`id_factura`
  AND DATE(fa.`fecha_factura`) BETWEEN  DATE_ADD(CURDATE(), INTERVAL -15 DAY) AND CURDATE()
  AND fa.`fk_id_sucursal` = su.`id_sucursal`
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

