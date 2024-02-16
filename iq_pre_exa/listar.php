<?php



	include ("../controladores/conex.php");



  

 

  $query = "
  SELECT 
  su.id_sucursal,
  su.`desc_corta`,
  DATE(fa.`fecha_factura`) AS diafactura,
  COUNT(*) AS numfac
  FROM so_factura fa,
  kg_sucursales su
  WHERE fa.`estado_factura` <> 5
  AND DATE(fa.`fecha_factura`) >= '2023-09-01'
  AND fa.`fk_id_sucursal` = su.`id_sucursal`
  GROUP BY 1,2,3
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

