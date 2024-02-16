<?php

	session_start();
  include ("../controladores/conex.php");
  
 // $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  $id_usuario=$_SESSION['id_usuario'];



  if ($fk_id_perfil==1 or $fk_id_perfil==13 or $fk_id_perfil==33 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
      $condicion=' > 0';
    }
    else
    {
      if($fk_id_perfil==9 or $fk_id_perfil==4 ){
        $condicion=" IN (SELECT ru.fk_id_sucursal FROM cr_plantilla_ruta ru WHERE fk_id_medico = ".$id_usuario.")";
      }else{
        $condicion=' = '.$fk_id_sucursal; 
      }
    }
  $query="
SELECT 
'".$fk_id_perfil."' AS perfil, 
fa.id_factura,
  pa.fk_id_estudio,
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
  DATE_FORMAT(fa.fecha_entrega,'%d-%b-%y') AS fecha_entrega,
  DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
  su.desc_sucursal AS sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
  CONCAT('PQ ',ep.desc_estudio) AS estudio,
    fa.resta,
  fa.diagnostico,
  
CASE
    WHEN p2.fk_id_estudio IS NULL THEN
      'Si'
    ELSE
      'Si'
END AS Registrado,
  ROUND((p2.num_imp/2),0) AS num_imp,
  p2.titulo_desc,
  p2.descripcion,
  p2.estado AS estado1,

  p2.t_otros_allazgos,
  p2.d_otros_allazgos,
  p2.t_diagnostico,
  p2.d_diagnostico,
  p2.t_comentarios,
  p2.d_comentarios
FROM so_factura fa
LEFT OUTER JOIN so_detalle_factura df ON ( df.`id_factura`  =  fa.`id_factura` )
LEFT OUTER JOIN km_estudios es ON (df.`fk_id_estudio` = es.`id_estudio`)
LEFT OUTER JOIN so_clientes cl ON (fa.fk_id_cliente  = cl.id_cliente)
LEFT OUTER JOIN kg_sucursales su ON (fa.fk_id_sucursal  =  su.id_sucursal)
LEFT OUTER JOIN km_paquetes pa ON ( es.`id_estudio` = pa.`id_paquete`)
LEFT OUTER JOIN km_estudios ep ON (pa.`fk_id_estudio` = ep.`id_estudio`)
LEFT OUTER JOIN cr_plantilla_colpo_re p2 ON (p2.fk_id_factura = fa.id_factura AND p2.fk_id_estudio = pa.fk_id_estudio)
WHERE fa.fk_id_sucursal ".$condicion."
  AND fa.estado_factura <> 5
  AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 95 DAY) AND DATE_ADD(CURDATE(), INTERVAL 95 DAY)
   AND es.fk_id_plantilla = '4'
   AND es.`per_paquete` = 'Si'

union all

SELECT 
'".$fk_id_perfil."' AS perfil, 
fa.id_factura,
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
  DATE_FORMAT(fa.fecha_entrega,'%d-%b-%y') AS fecha_entrega,
  DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
  su.desc_sucursal AS sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
  CONCAT('PQ ',es.desc_estudio) AS estudio,
    fa.resta,
  fa.diagnostico,
  
CASE
    WHEN p2.fk_id_estudio IS NULL THEN
      'No'
    ELSE
      'Si'
END AS Registrado,
  ROUND((p2.num_imp/2),0) AS num_imp,
  p2.titulo_desc,
  p2.descripcion,
  p2.estado AS estado1,

  p2.t_otros_allazgos,
  p2.d_otros_allazgos,
  p2.t_diagnostico,
  p2.d_diagnostico,
  p2.t_comentarios,
  p2.d_comentarios
FROM so_factura fa
LEFT OUTER JOIN so_detalle_factura df ON ( df.`id_factura`  =  fa.`id_factura` )
LEFT OUTER JOIN km_estudios es ON (df.`fk_id_estudio` = es.`id_estudio`)
LEFT OUTER JOIN so_clientes cl ON (fa.fk_id_cliente  = cl.id_cliente)
LEFT OUTER JOIN kg_sucursales su ON (fa.fk_id_sucursal  =  su.id_sucursal)
LEFT OUTER JOIN cr_plantilla_colpo_re p2 ON (p2.fk_id_factura = fa.id_factura AND p2.fk_id_estudio = df.fk_id_estudio)
  WHERE fa.estado_factura <> 5
  AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 95 DAY) AND DATE_ADD(CURDATE(), INTERVAL 95 DAY)
AND es.fk_id_plantilla = '4'
AND es.`per_paquete` = 'No'
and fa.fk_id_sucursal ".$condicion
;

$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
        echo "<script>location.href='../ag_orden_dia_colpo/tabla_agenda.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);