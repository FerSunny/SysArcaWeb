<?php
session_start();
  include ("../controladores/conex.php");
    $fk_id_perfil = $_SESSION['fk_id_sucursal'];
    $fk_id_sucursal = $_SESSION['fk_id_perfil'];

    $id_modulo=$_SESSION['id_modulo'];


    if ($fk_id_perfil==1 or $fk_id_perfil==13) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }


    $stmt = $conexion->prepare("SELECT DISTINCT $fk_id_perfil AS perfil, 
    su.desc_sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre_paciente,
  p1.fk_id_factura,
  p1.fk_id_estudio,
  p1.validado,
  es.desc_estudio,
  fa.fecha_factura,
  es.fk_id_plantilla,
  cl.anios,
  fa.fk_id_cliente
FROM cr_plantilla_1_re p1
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p1.fk_id_estudio), 
so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal=fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE p1.fk_id_factura = fa.id_factura
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 25 DAY) AND DATE_ADD(CURDATE(), INTERVAL 25 DAY)
AND fa.fk_id_sucursal$condicion

UNION ALL

SELECT DISTINCT $fk_id_perfil AS perfil, 
  su.desc_sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre_paciente,
  p2.fk_id_factura,
  p2.fk_id_estudio,
  p2.validado,
  es.desc_estudio,
  fa.fecha_factura,
  es.fk_id_plantilla,
  cl.anios,
  fa.fk_id_cliente
FROM  cr_plantilla_2_re p2
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p2.fk_id_estudio), 
so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal=fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE p2.fk_id_factura = fa.id_factura
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 25 DAY) AND DATE_ADD(CURDATE(), INTERVAL 25 DAY)
AND fa.fk_id_sucursal$condicion

UNION ALL

SELECT DISTINCT $fk_id_perfil AS perfil, 
  su.desc_sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre_paciente,
  p3.fk_id_factura,
  p3.fk_id_estudio,
  p3.validado,
  es.desc_estudio,
  fa.fecha_factura,
  es.fk_id_plantilla,
  cl.anios,
  fa.fk_id_cliente
FROM  cr_plantilla_cvo_re p3
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p3.fk_id_estudio), 
so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal=fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE p3.fk_id_factura = fa.id_factura
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 25 DAY) AND DATE_ADD(CURDATE(), INTERVAL 25 DAY)
AND fa.fk_id_sucursal$condicion");

    //$stmt->bind_param('ii', $id_factura,$id_estudio);
  $stmt->execute();
  $stmt->bind_result($perfil,$desc_sucursal,$nombre_paciente,$fk_id_factura,$fk_id_estudio,$validado,$desc_estudio,$fecha_factura,$fk_id_plantilla,$anios,$fk_id_cliente);

  while ($stmt->fetch()) {
      $array = array(
        "perfil" => $perfil,
        "desc_sucursal" => $desc_sucursal,
        "nombre_paciente" => $nombre_paciente,
        "fk_id_factura"=>$fk_id_factura,
        "fk_id_estudio"=>$fk_id_estudio,
        "validado"=>$validado,
        "desc_estudio"=>$desc_estudio,
        "fecha_factura"=>$fecha_factura,
        "fk_id_plantilla"=>$fk_id_plantilla,
        "anios"=>$anios,
        "fk_id_cliente"=>$fk_id_cliente,
    );
      $arreglo["data"][]=$array; 
    }
        echo json_encode($arreglo);
    $stmt->close();


?>