<?php

session_start();

	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  $studio= $_GET['studio'];
  $id_factura=$_GET['factura'];
 
  $query = 'SELECT 
  "'.$studio.'" as studio,"'.$id_factura.'" as id_factura,
   es.`iniciales`,mu.id_muestra,
  mu.desc_muestra,mu.`recoleccion`,
  CASE
    WHEN tm.id_toma IS NULL THEN
      "N"
    ELSE
      "S"
  END AS existe
 FROM km_estudios es
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra`)
LEFT OUTER JOIN tm_tomas tm ON (tm.`fk_id_factura` = '.$id_factura.' AND tm.`fk_id_estudio` = '.$studio.' AND tm.`fk_id_muestra` = mu.`id_muestra`)
WHERE id_estudio = '.$studio.'
AND es.`fk_id_muestra` <> 539

union all

SELECT 
  "'.$studio.'" as studio,"'.$id_factura.'" as id_factura,
   es.`iniciales`,mu.id_muestra,
  mu.desc_muestra,mu.`recoleccion`,
  CASE
    WHEN tm.id_toma IS NULL THEN
      "N"
    ELSE
      "S"
  END AS existe
 FROM km_estudios es
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_1`)
LEFT OUTER JOIN tm_tomas tm ON (tm.`fk_id_factura` = '.$id_factura.' AND tm.`fk_id_estudio` = '.$studio.' AND tm.`fk_id_muestra` = mu.`id_muestra`)
WHERE id_estudio = '.$studio.'
AND es.`fk_id_muestra_1` <> 539

union all

SELECT 
  "'.$studio.'" as studio,"'.$id_factura.'" as id_factura,
   es.`iniciales`,mu.id_muestra,
  mu.desc_muestra,mu.`recoleccion`,
  CASE
    WHEN tm.id_toma IS NULL THEN
      "N"
    ELSE
      "S"
  END AS existe
 FROM km_estudios es
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_2`)
LEFT OUTER JOIN tm_tomas tm ON (tm.`fk_id_factura` = '.$id_factura.' AND tm.`fk_id_estudio` = '.$studio.' AND tm.`fk_id_muestra` = mu.`id_muestra`)
WHERE id_estudio = '.$studio.'
AND es.`fk_id_muestra_2` <> 539

union all

SELECT 
  "'.$studio.'" as studio,"'.$id_factura.'" as id_factura,
   es.`iniciales`,mu.id_muestra,
  mu.desc_muestra,mu.`recoleccion`,
  CASE
    WHEN tm.id_toma IS NULL THEN
      "N"
    ELSE
      "S"
  END AS existe
 FROM km_estudios es
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_3`)
LEFT OUTER JOIN tm_tomas tm ON (tm.`fk_id_factura` = '.$id_factura.' AND tm.`fk_id_estudio` = '.$studio.' AND tm.`fk_id_muestra` = mu.`id_muestra`)
WHERE id_estudio = '.$studio.'
AND es.`fk_id_muestra_3` <> 539

union all

SELECT 
  "'.$studio.'" as studio,"'.$id_factura.'" as id_factura,
   es.`iniciales`,mu.id_muestra,
  mu.desc_muestra,mu.`recoleccion`,
  CASE
    WHEN tm.id_toma IS NULL THEN
      "N"
    ELSE
      "S"
  END AS existe
 FROM km_estudios es
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_4`)
LEFT OUTER JOIN tm_tomas tm ON (tm.`fk_id_factura` = '.$id_factura.' AND tm.`fk_id_estudio` = '.$studio.' AND tm.`fk_id_muestra` = mu.`id_muestra`)
WHERE id_estudio = '.$studio.'
AND es.`fk_id_muestra_4` <> 539
';

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
