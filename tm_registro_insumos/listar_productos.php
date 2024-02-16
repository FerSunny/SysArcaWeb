<?php

session_start();

	include ("../controladores/conex.php");

  //$id_modulo=$_SESSION['id_modulo'];
  //$fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  $studio= $_GET['studio'];
  $id_factura=$_GET['factura'];
  //$id_factura=1;
 
  $query = 'SELECT
   fa.`fk_id_empresa`,
  fa.`fk_id_sucursal`,
  su.`desc_sucursal`,
  fa.`id_folio_producto`,
  fa.`fk_id_factura`,
  fa.`fk_id_producto`,
  pr.`desc_producto`,
  fa.`cantidad`,
  fa.`estado`,
  fa.`fecha_registro`
FROM tm_folio_articulo fa
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = fa.`fk_id_sucursal`)
LEFT OUTER JOIN eb_productos pr ON (pr.`id_producto` = fa.fk_id_producto)
WHERE fa.fk_id_sucursal = '.$fk_id_sucursal.'
and fa.estado = "A"
AND fa.fk_id_factura = '.$id_factura
  ;

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
