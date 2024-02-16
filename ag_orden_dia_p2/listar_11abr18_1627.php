<?php

  session_start();

	include ("../controladores/conex.php");
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }

  $query="
  SELECT res.*,
        CASE
    WHEN p2.fk_id_estudio IS NULL THEN
      'No'
    ELSE
      'Si'
  END AS registrado,
  round((p2.num_imp/2),0) as num_imp
FROM 
(
SELECT  fa.id_factura,
  pq.fk_id_estudio,
  CASE
    WHEN fa.estado_factura = 1 THEN
      'Elaborada'
    WHEN fa.estado_factura = 2 THEN
      'Terminada'
    WHEN fa.estado_factura = 3 THEN
      'Entregada'
    WHEN fa.estado_factura = 4 THEN
      'Impresa'
    WHEN fa.estado_factura = 5 THEN
      'Eliminada'
  END AS estado,
  DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
  DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
  su.desc_sucursal AS sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
  CONCAT('PQ ',es.desc_estudio) AS estudio
FROM km_paquetes pq,
     so_detalle_factura df,
     so_factura fa,
     so_clientes cl ,
     kg_sucursales su,
     km_estudios es
WHERE pq.estado = 'A'
  AND es.fk_id_plantilla = '2'
  AND pq.id_paquete = df.fk_id_estudio
  AND df.id_factura = fa.id_factura
  AND es.id_estudio = pq.fk_id_estudio
  AND su.id_sucursal = fa.fk_id_sucursal
  AND cl.id_cliente = fa.fk_id_cliente
  AND fa.estado_factura <> 5
  AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND DATE_ADD(CURDATE(), INTERVAL 15 DAY)
  AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_2 WHERE estado = 'A')
  AND pq.fk_id_estudio IN (870,307)
 ) res
LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = res.id_factura AND p2.fk_id_estudio = res.fk_id_estudio)
  UNION
  SELECT DISTINCT fa.id_factura,
  df.fk_id_estudio,
  CASE
    WHEN fa.estado_factura = 1 THEN
    'Elaborada'
    WHEN fa.estado_factura = 2 THEN
    'Terminada'
    WHEN fa.estado_factura = 3 THEN
    'Entregada'
    WHEN fa.estado_factura = 4 THEN
    'Impresa'
    WHEN fa.estado_factura = 5 THEN
    'Eliminada'
  END AS estado,
  DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
  DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
       su.desc_sucursal AS sucursal,
       CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
       es.desc_estudio AS estudio,
  CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS registrado,
round((p2.num_imp/2),0) as num_imp
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio),
km_estudios es
WHERE fa.estado_factura <> 5
AND es.fk_id_plantilla = '2'
AND es.id_estudio = df.fk_id_estudio
AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_2 WHERE estado = 'A')
AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND DATE_ADD(CURDATE(), INTERVAL 15 DAY)
AND fa.fk_id_sucursal".$condicion;
//echo $query;
	// $query = "SELECT fa.id_factura,
  //             CASE
  //               WHEN fa.estado_factura = 1 THEN
  //               'Elaborada'
  //               WHEN fa.estado_factura = 2 THEN
  //               'Terminada'
  //               WHEN fa.estado_factura = 3 THEN
  //               'Entregada'
  //               WHEN fa.estado_factura = 4 THEN
  //               'Impresa'
  //               WHEN fa.estado_factura = 5 THEN
  //               'Eliminada'
  //             END AS estado,
  //             DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
  //             DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
  //                  su.desc_sucursal AS sucursal,
  //                  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
  //                  es.desc_estudio AS estudio,
  //             te.nombre_tipo_estudio
  //           FROM so_factura fa
  //           LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
  //           LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
  //           LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
  //           LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
  //           LEFT OUTER JOIN km_tipo_estudio te ON (te.id_tipo_estudio = es.fk_id_tipo_estudio)
  //           WHERE fa.estado_factura <> 5
  //           AND DATE(fa.fecha_entrega) = CURDATE()
  //           AND es.fk_id_tipo_estudio".$condicion; 
//echo $query;
	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
        echo "<script>location.href='../ag_agenda/tabla_agenda.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
