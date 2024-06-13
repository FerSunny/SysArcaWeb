<?php

  session_start();

	include ("../controladores/conex.php");
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  $id_usr=$_SESSION['id_usuario'];
  //$id_usuario= ' = '.$_SESSION['id_usuario'];
  switch($fk_id_perfil){
    case 1:  // admin
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal=' fa.fk_id_sucursal > 0';   
      break;
    case 9: // usg
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal = 'fa.fk_id_sucursal in (SELECT distinct fk_id_sucursal FROM ag_interpreta_tomo WHERE fk_id_usuario = '.$id_usr.')';
      break;
    case 11: // Recepcion NC
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal = 'fa.fk_id_sucursal = '.$fk_id_sucursal;
      break;
    case 39: // rayos x y usg zona 1 (xochimilco,san pedro, santiago, san poablo)
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal = 'fa.fk_id_sucursal > 0';
      break;
    case 43:  // ismael recepcion
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal=' fa.fk_id_sucursal > 0';   
      break;
    case 45:  // admin
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal=' fa.fk_id_sucursal > 0';   
      break;
    case 46:  // admin
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal=' fa.fk_id_sucursal > 0';   
      break;
    case 33:  // admin
      $agenda = ' ';
      $factura =' ';
      $id_usuario= ' ';
      $recepcion='';
      $sucursal=' fa.fk_id_sucursal > 0';   
      break;
    default:
      $agenda = ',ag_tomo ak';
      $recepcion='  AND ak.fk_id_factura = fa.id_factura AND ak.fk_id_usuario = '.$_SESSION['id_usuario'];
      $sucursal=' ak.fk_id_sucursal = '.$fk_id_sucursal;     
  }

/*  
  if ($fk_id_perfil==1) 
    {
        $agenda = ' ';

        $factura =' ';
        $id_usuario= ' ';

        $recepcion='';
        $sucursal=' fa.fk_id_sucursal > 0';
    }
    else
    {

      if($fk_id_perfil==11 or $fk_id_perfil==39 or $fk_id_perfil==9){
        $agenda = ' ';

        $factura =' ';
        $id_usuario= ' ';

        $recepcion='';

        $sucursal=' fa.fk_id_sucursal in (7,6,4)';

      }else{
        $agenda = ',ag_rx ak';

        //$fractura =' AND ak.fk_id_factura = fa.id_factura';
        //$id_usuario= ' AND ak.fk_id_usuario = '.$_SESSION['id_usuario'];

        $recepcion='  AND ak.fk_id_factura = fa.id_factura AND ak.fk_id_usuario = '.$_SESSION['id_usuario'];

        $sucursal=' ak.fk_id_sucursal = '.$fk_id_sucursal;
        
      }

 
        //$condicion=' = '.$fk_id_sucursal; 
    }
    */
  $query="
  SELECT res.*,
        CASE
    WHEN p2.fk_id_estudio IS NULL THEN
      'No'
    ELSE
      'Si'
  END AS Registrado,
  round((p2.num_imp/2),0) as num_imp,
  0 as imagen,
  p2.validado,
  p2.fk_id_medico,
  ".$id_usr." as id_usuario
FROM 
(
SELECT ' ".$fk_id_perfil."' as perfil, fa.id_factura,
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
  DATE_FORMAT(fa.fecha_entrega,'%d-%b-%y') AS fecha_entrega,
  DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
  su.desc_sucursal AS sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
  CONCAT('PQ ',es.desc_estudio) AS estudio,
  fa.resta,
  'No' as nota_rad ,
  fa.diagnostico
FROM km_paquetes pq,
     so_detalle_factura df,
     so_factura fa,
     so_clientes cl ,
     kg_sucursales su,
     km_estudios es
     ".$agenda."
WHERE pq.estado = 'A'
  AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 95 DAY) AND DATE_ADD(CURDATE(), INTERVAL 90 DAY)
  AND es.fk_id_plantilla = '8'
  AND pq.id_paquete = df.fk_id_estudio
  AND df.id_factura = fa.id_factura
  AND es.id_estudio = pq.fk_id_estudio
  AND su.id_sucursal = fa.fk_id_sucursal
  AND cl.id_cliente = fa.fk_id_cliente
  AND fa.estado_factura <> 5
  -- AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 95 DAY) AND DATE_ADD(CURDATE(), INTERVAL 90 DAY)
  AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_tomo WHERE estado = 'A')

  ".$recepcion."
  AND ".$sucursal."
 ) res
LEFT OUTER JOIN cr_plantilla_tomo_re p2 ON (p2.fk_id_factura = res.id_factura AND p2.fk_id_estudio = res.fk_id_estudio)

  UNION

  SELECT DISTINCT '".$fk_id_perfil."' as perfil,fa.id_factura,
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
       es.desc_estudio AS estudio,
  fa.resta,
CASE
  WHEN ra.titulo_desc IS NULL THEN 
    'No'
  ELSE
    'Si'
END AS nota_rad,
  fa.diagnostico,
  CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS Registrado,
round((p2.num_imp/2),0) as num_imp,
(select count(*) as imagen from cr_plantilla_tomo_img im where im.fk_id_factura = fa.id_factura 
and im.fk_id_estudio = df.fk_id_estudio) as imagen,
p2.validado,
p2.fk_id_medico,
".$id_usr." as id_usuario
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN cr_plantilla_tomo_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN cr_plantilla_tomo_rad_re ra ON(df.id_factura = ra.fk_id_factura AND df.fk_id_estudio = ra.fk_id_estudio and ra.estado = 'A'),

km_estudios es
".$agenda."
WHERE fa.estado_factura <> 5
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 95 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
AND es.fk_id_plantilla = '8'
and es.id_estudio = df.fk_id_estudio
AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_tomo WHERE estado = 'A')
-- AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 95 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
".$recepcion."
 AND  ".$sucursal;

//echo $query;

//echo “<script languaje=’javascript’>alert(‘Perfil : “.$fk_id_perfil.”‘)</script>”;

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error-->".$query);
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
