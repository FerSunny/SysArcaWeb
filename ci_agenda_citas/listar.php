<?php

session_start();

	include ("../controladores/conex.php");


    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];





  $query = "
  SELECT ev.*, 
  su.`desc_sucursal`,
  CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) paciente,
  es.`desc_estudio`,
  te.`nombre_tipo_estudio`,
  df.`id_factura`
  FROM ci_eventos ev
  LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = ev.`fk_id_sucursal_rec`)
  LEFT OUTER JOIN so_clientes cl ON(cl.`id_cliente` = ev.`fk_id_paciente`)
  LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = ev.`fk_id_estudio`)
  LEFT OUTER JOIN km_tipo_estudio te ON (te.`id_tipo_estudio` = ev.`fk_id_tipo_estudio`)
  LEFT OUTER JOIN so_factura fa ON (fa.`fk_id_cliente` = ev.`fk_id_paciente` AND date(fa.`fecha_factura`) = ev.`fecha`)
  LEFT OUTER JOIN so_detalle_factura df ON (df.`id_factura` = fa.`id_factura` AND df.`fk_id_estudio` = ev.`fk_id_estudio`)
  WHERE  ev.estado IN ('R')
  AND ev.`fecha` >= CURDATE()-2
  AND ev.fk_id_sucursal_rec = $fk_id_sucursal
  ";

  //echo $query;





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

