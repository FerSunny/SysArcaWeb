<?php

session_start();

	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1 or $fk_id_perfil==13) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }
 // los pacientes que ya se les tomo muestra..
  $query = 'SELECT  DATE_FORMAT(fa.`fecha_factura`,"%H:%i") hora,
    DATE(fa.`fecha_factura`) AS fecha_factura,
    fa.`id_factura`,
    cl.`nombre`,
    cl.`a_paterno`,
    cl.a_materno,
    cl.anios AS edad,
    se.`desc_sexo`,
    es.`iniciales`,
    su.`desc_corta`,
    se.id_sexo,
    cl.id_cliente,
    es.id_estudio,
    DATE_FORMAT(tm.`fecha_toma`,"%H:%i") hora_toma
FROM tm_tomas tm, so_factura fa, so_clientes cl, so_sexo se, km_estudios es, kg_sucursales su
WHERE tm.`fk_id_factura` = fa.`id_factura`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND cl.`fk_id_sexo` = se.id_sexo
AND tm.`fk_id_estudio` = es.`id_estudio`
AND es.per_paquete = "No"
AND fa.fk_id_sucursal = su.id_sucursal
AND fa.fk_id_sucursal '.$condicion.'
AND DATE(tm.fecha_toma) =  CURDATE()

union all

-- pacientes que aun nos se les toma muestra.

SELECT DATE_FORMAT(fa.`fecha_factura`,"%H:%i") hora,
    DATE(fa.`fecha_factura`) AS fecha_factura,
    fa.`id_factura`,
    cl.`nombre`,
    cl.`a_paterno`,
    cl.a_materno,
    cl.anios AS edad,
    se.`desc_sexo`,
    es.`iniciales`,
    su.`desc_corta`,
    se.id_sexo,
    cl.id_cliente,
    es.id_estudio,
    null AS hora_toma
FROM  so_factura fa, so_detalle_factura df, km_estudios es, so_clientes cl, so_sexo se, kg_sucursales su
WHERE DATE(fa.`fecha_factura`) >= CURDATE()-7
AND fa.`fk_id_sucursal` '.$condicion.'
AND fa.`id_factura` = df.`id_factura`
AND df.`fk_id_estudio` = es.`id_estudio`
AND es.`per_paquete` = "No"
AND es.`cubiculo` = "S"
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND cl.`fk_id_sexo` = se.id_sexo
AND fa.`fk_id_sucursal` = su.`id_sucursal`
AND NOT EXISTS (SELECT * FROM tm_tomas tm WHERE tm.`fk_id_factura` = fa.`id_factura` AND tm.`fk_id_estudio` = df.`fk_id_estudio`)

union all

-- paquetes 

SELECT  DATE_FORMAT(fa.`fecha_factura`,"%H:%i") hora,
    DATE(fa.`fecha_factura`) AS fecha_factura,
    fa.`id_factura`,
    cl.`nombre`,
    cl.`a_paterno`,
    cl.a_materno,
    cl.anios AS edad,
    se.`desc_sexo`,
    CONCAT(es.`iniciales`,"-",ep.`iniciales`) AS iniciales,
    su.`desc_corta`,
    se.id_sexo,
    cl.id_cliente,
    min(ep.id_estudio) as id_estudio,
    null AS hora_toma
FROM so_factura fa, so_detalle_factura df, km_estudios es, km_paquetes pq, km_estudios ep, so_clientes cl, so_sexo se, kg_sucursales su
WHERE DATE(fa.`fecha_factura`) >= CURDATE()-7
AND fa.`fk_id_sucursal` '.$condicion.'
AND fa.`id_factura` = df.`id_factura`
AND df.`fk_id_estudio` = es.`id_estudio`
AND es.`cubiculo` = "S"
AND es.`per_paquete` = "Si"
AND es.`id_estudio` = pq.`id_paquete`
AND pq.`fk_id_estudio` = ep.`id_estudio`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND cl.`fk_id_sexo` = se.id_sexo
AND fa.`fk_id_sucursal` = su.`id_sucursal`
-- and ep.`cubiculo` = "S"
AND NOT EXISTS (SELECT * FROM tm_tomas tm WHERE tm.`fk_id_factura` = fa.`id_factura` AND tm.`fk_id_estudio` = ep.`id_estudio`)
GROUP BY
DATE_FORMAT(fa.`fecha_factura`,"%H:%i"),
    DATE(fa.`fecha_factura`),
    fa.`id_factura`,
    cl.`nombre`,
    cl.`a_paterno`,
    cl.a_materno,
    cl.anios,
    se.`desc_sexo`,
    CONCAT(es.`iniciales`,"-",ep.`iniciales`),
    su.`desc_corta`,
    se.id_sexo,
    cl.id_cliente
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
