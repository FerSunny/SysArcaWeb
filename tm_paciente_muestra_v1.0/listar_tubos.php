<?php

session_start();

	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  $id_factura = $_SESSION['id_factura'];
  //$id_factura = 19442;

  //$studio = $_GET['studio'];
  //$id_factura=$_GET['factura'];
 
  $query = " 
  SELECT a.* 
FROM
(
SELECT a.`fk_id_factura` AS id_factura,
	a.`fk_id_estudio` AS studio,
	concat(mu.control,'-',mu.`desc_muestra`) desc_muestra,
	IFNULL(t.aplico,'N') AS aplico,
	es.`desc_estudio`,
	mu.id_muestra,
	-- m.desc_muestra,
	mu.control
FROM tm_agenda a
LEFT OUTER JOIN vw_estudios_muestras_deta mu ON (mu.`id_estudio` = a.`fk_id_estudio` and mu.control = a.control)
LEFT OUTER JOIN tm_tomas t ON (t.`fk_id_factura` = a.`fk_id_factura` AND t.fk_id_estudio = a.`fk_id_estudio` AND t.`fk_id_muestra` = mu.`id_muestra` and t.control = mu.control )
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = a.`fk_id_estudio`)
-- LEFT OUTER JOIN km_muestras m on (m.id_muestra = mu.fk_id_muestra)
WHERE a.`fk_id_factura` = $id_factura
AND a.fecha = DATE(CURDATE() )
) a
WHERE a.aplico in ('N')

/*
union 

SELECT
	a.`id_factura`,
	a.studio,
	a.id_muestra,
	a.`desc_estudio`,
	0 as aplico,
	COUNT(a.muestras) cuantas,
	COUNT(t.`id_toma`) tomadas,
	(COUNT(a.muestras) - COUNT(t.`id_toma`)) pendientes
FROM
(
SELECT df.`id_factura`,
	pq.`fk_id_estudio` AS studio,
	0 AS id_muestra,
	es.`desc_estudio`,
	mu.`muestras`,
	m.desc_muestra
FROM so_detalle_factura df,
km_paquetes pq,
km_estudios es
LEFT OUTER JOIN vw_estudios_muestras mu ON (mu.`id_estudio` = es.`id_estudio`)
LEFT OUTER JOIN km_muestras m (m.id_muestra = mu.fk_id_muestra)
WHERE df.id_factura =". $id_factura."
AND pq.`estado` = 'A'
AND es.`estatus` = 'A'
AND df.`fk_id_estudio` = pq.`id_paquete`
AND pq.`fk_id_estudio` = es.`id_estudio`
) a
LEFT OUTER JOIN tm_tomas t ON (t.`fk_id_factura` = a.`id_factura` AND t.fk_id_estudio = a.studio )
GROUP BY
	a.`id_factura`,
	a.studio,
	a.id_muestra,
	a.`desc_estudio`
*/
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
