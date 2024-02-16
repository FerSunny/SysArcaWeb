<?php
session_start();


	include ("../controladores/conex.php");

  $id_usuario=$_SESSION['id_usuario'];



 

  $query = "
  SELECT
  ar.clave,
  ar.`desc_area`,
  COUNT(DISTINCT df.`id_factura`) AS ot,
  COUNT(DISTINCT df.fk_id_estudio) AS estudios
  FROM 
  so_factura fa,
  so_detalle_factura df,
  km_estudios_area ea,
  km_areas ar
  WHERE DATE(fa.`fecha_factura`) = CURDATE()-25
  AND df.`id_factura` = fa.id_factura
  AND ea.`fk_id_estudio` = df.`fk_id_estudio`
  AND ea.`fk_id_clave_area` = ar.`clave` AND ar.`estado` = 'A'
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

