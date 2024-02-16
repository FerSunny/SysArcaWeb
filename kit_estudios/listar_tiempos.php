<?php

session_start();

	include ("../controladores/conex.php");

  //$id_modulo=$_SESSION['id_modulo'];
  //$fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  $studio=$_GET['studio'];
  //$id_factura=1;
 
  $query = "
  SELECT
  te.`fk_id_empresa`,
  te.`id_tiempo`,
  te.`fk_id_puesto`,
  te.fk_id_estudio,
  pu.`desc_puesto`,
  pu.`id_puesto`,
  te.`tiempo`,
  te.`costo`,
  te.`estado`
  FROM `bd_arca`.`km_tiempo_estudio` te
  LEFT OUTER JOIN se_puestos pu ON (pu.`id_puesto` = te.`fk_id_puesto`)
  WHERE te.estado = 'A'
  AND te.`fk_id_estudio` = $studio
"  ;

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
