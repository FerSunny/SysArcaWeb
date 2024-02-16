<?php

  session_start();

  include ("../../controladores/conex.php");
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $factura = $_GET['factura'];
  if ($fk_id_perfil==1 or $fk_id_perfil==13)
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
  END AS Registrado,
  ROUND((p2.num_imp/2),0) AS num_imp,
  p2.fecha_registro,
  p2.fecha_impresion
FROM
(
SELECT  'P1' num_plnatilla, '".$fk_id_perfil."' AS perfil, fa.id_factura,
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
  CONCAT('PQ ',es.desc_estudio) AS estudio,
  fa.resta,
  fa.email_medico,
  fa.email_paciente
FROM km_paquetes pq,
     so_detalle_factura df,
     so_factura fa,
     so_clientes cl ,
     kg_sucursales su,
     km_estudios es
WHERE pq.estado = 'A'
  AND fa.id_factura = ".$factura."
  AND es.fk_id_plantilla = '1'
  AND pq.id_paquete = df.fk_id_estudio
  AND df.id_factura = fa.id_factura
  AND es.id_estudio = pq.fk_id_estudio
  AND su.id_sucursal = fa.fk_id_sucursal
  AND cl.id_cliente = fa.fk_id_cliente
  AND fa.estado_factura <> 5
  AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)
  AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_1 WHERE estado = 'A')
 ) res
LEFT OUTER JOIN vw_cr_plantilla_1_re p2 ON (p2.fk_id_factura = res.id_factura AND p2.fk_id_estudio = res.fk_id_estudio)

  UNION

  SELECT 'P1' num_plnatilla,'".$fk_id_perfil."' AS perfil,fa.id_factura,
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
  fa.resta,
  fa.email_medico,
  fa.email_paciente,
  CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS Registrado,
ROUND((p2.num_imp/2),0) AS num_imp,
p2.fecha_registro,
p2.fecha_impresion
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN vw_cr_plantilla_1_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio),
km_estudios es
WHERE fa.estado_factura <> 5
AND fa.id_factura =  ".$factura."
AND es.fk_id_plantilla = '1'
AND es.id_estudio = df.fk_id_estudio
AND es.per_paquete = 'No'
AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_1 WHERE estado = 'A')
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)

UNION ALL

 SELECT res.*,
        CASE
    WHEN p2.fk_id_estudio IS NULL THEN
      'No'
    ELSE
      'Si'
  END AS Registrado,
  ROUND((p2.num_imp/2),0) AS num_imp,
  p2.fecha_registro,
  p2.fecha_impresion
FROM
(
SELECT 'P2' num_plnatilla,  '".$fk_id_perfil."' AS perfil,fa.id_factura,
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
  CONCAT('PQ ',es.desc_estudio) AS estudio,
  fa.resta,
  fa.email_medico,
  fa.email_paciente
FROM km_paquetes pq,
     so_detalle_factura df,
     so_factura fa,
     so_clientes cl ,
     kg_sucursales su,
     km_estudios es
WHERE pq.estado = 'A'
AND fa.id_factura = ".$factura."
  AND es.fk_id_plantilla = '2'
  AND pq.id_paquete = df.fk_id_estudio
  AND df.id_factura = fa.id_factura
  AND es.id_estudio = pq.fk_id_estudio
  AND su.id_sucursal = fa.fk_id_sucursal
  AND cl.id_cliente = fa.fk_id_cliente
  AND fa.estado_factura <> 5
  AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)
  AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_2 WHERE estado = 'A')
  AND pq.fk_id_estudio IN (870,307)
 ) res
LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = res.id_factura AND p2.fk_id_estudio = res.fk_id_estudio)


  UNION


  SELECT DISTINCT 'P2' num_plnatilla, '".$fk_id_perfil."' AS perfil,fa.id_factura,
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
  fa.resta,
  fa.email_medico,
  fa.email_paciente,
  CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS Registrado,
ROUND((p2.num_imp/2),0) AS num_imp,
p2.fecha_registro,
  p2.fecha_impresion
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio),
km_estudios es
WHERE fa.estado_factura <> 5
AND fa.id_factura = ".$factura."
AND es.fk_id_plantilla = '2'
AND es.id_estudio = df.fk_id_estudio
AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_2 WHERE estado = 'A')
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)

UNION ALL

SELECT res.*,
        CASE
    WHEN p2.fk_id_estudio IS NULL THEN
      'No'
    ELSE
      'Si'
   END AS Registrado,
  ROUND((p2.num_imp/2),0) AS num_imp,
  p2.fecha_registro,
  p2.fecha_impresion
FROM
(
SELECT 'P3' num_plnatilla,'".$fk_id_perfil."' AS perfil, fa.id_factura,
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
  CONCAT('PQ ',es.desc_estudio) AS estudio,
  fa.resta,
  fa.email_medico,
  fa.email_paciente
FROM km_paquetes pq,
     so_detalle_factura df,
     so_factura fa,
     so_clientes cl ,
     kg_sucursales su,
     km_estudios es
WHERE pq.estado = 'A'
AND fa.id_factura = ".$factura."
  AND es.fk_id_plantilla = '3'
  AND pq.id_paquete = df.fk_id_estudio
  AND df.id_factura = fa.id_factura
  AND es.id_estudio = pq.fk_id_estudio
  AND su.id_sucursal = fa.fk_id_sucursal
  AND cl.id_cliente = fa.fk_id_cliente
  AND fa.estado_factura <> 5
  AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)
  AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_cvo WHERE estado = 'A')
   ) res
LEFT OUTER JOIN cr_plantilla_cvo_re p2 ON (p2.fk_id_factura = res.id_factura AND p2.fk_id_estudio = res.fk_id_estudio)

UNION


SELECT DISTINCT 'P3' num_plnatilla, '".$fk_id_perfil."' AS perfil,fa.id_factura,
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
       fa.resta,
  fa.email_medico,
  fa.email_paciente,
  CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS Registrado,
ROUND((p2.num_imp/2),0) AS num_imp,
p2.fecha_registro,
p2.fecha_impresion
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN cr_plantilla_cvo_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio),
km_estudios es
WHERE fa.estado_factura <> 5
AND fa.id_factura = ".$factura."
AND es.fk_id_plantilla = '3'
AND es.id_estudio = df.fk_id_estudio
AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_cvo WHERE estado = 'A')
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)
";

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
