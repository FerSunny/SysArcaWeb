<?php

session_start();

	include ("../controladores/conex.php");

  //$id_modulo=$_SESSION['id_modulo'];
  //$fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  $studio=$_GET['studio'];
  //$id_factura=1;
 
  $query = "SELECT
  ce.`id_insumo_estudio`,
  ce.`fk_id_estudio`,
  ce.`fk_id_producto`,
  pr.`desc_producto`,
  ce.`precio`,
  ce.`cantidad`,
  ce.`fecha_registro`,
  pr.id_producto
FROM `km_insumos_estudio` ce, eb_productos pr
WHERE ce.estado = 'A'
AND ce.`fk_id_producto` = pr.`id_producto`
AND ce.`fk_id_estudio` = $studio
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
