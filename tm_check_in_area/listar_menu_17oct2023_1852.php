<?php
session_start();


	include ("../controladores/conex.php");

  $id_usuario=$_SESSION['id_usuario'];



 

  $query = "
  SELECT 
  DATE(tm.`fecha_toma`) AS fecha,
  ea.`fk_id_clave_area` AS clave,
  CASE
  WHEN ar.`desc_area` IS NULL  THEN
  'sin area'
  ELSE
  ar.`desc_area`
  END AS desc_area,
  COUNT(DISTINCT tm.`fk_id_factura`) AS ot,
  COUNT(DISTINCT tm.`fk_id_estudio`) AS estudios,
  COUNT(tm.`fk_id_muestra`) AS muestras
  FROM tm_tomas tm
  LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = tm.`fk_id_estudio`)
  LEFT OUTER JOIN km_estudios_area ea ON (ea.`fk_id_estudio` = es.`id_estudio`)
  LEFT OUTER JOIN km_areas ar ON (ar.`clave` = ea.`fk_id_clave_area`)
  WHERE DATE(tm.`fecha_toma`) = '2023-10-13'
  AND tm.check_in = 1
  AND (tm.fk_id_rechazo IS NULL OR tm.fk_id_rechazo = 0)
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

