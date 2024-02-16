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
  $query = "
  (SELECT 
  fa. id_factura ,
  su.desc_corta,
  CONCAT(cl. nombre ,' ',cl. a_paterno ) AS paciente,
  TIME_FORMAT(fa. fecha_factura ,'%H:%i') AS hora,
  fa. turno_num ,
  us. iniciales ,
  es. desc_estudio ,
  -- es. fk_id_plantilla ,
  TIME_FORMAT(t. fecha_toma ,'%H:%i') AS hora_toma,
  usm. iniciales  AS flebo,
  TIMEDIFF(TIME(t. fecha_toma ),TIME(fa. fecha_factura )) AS tiempo2
  FROM
  so_factura fa
  LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal) ,
  so_clientes cl,
  se_usuarios us,
  km_estudios es,
  so_detalle_factura df
  LEFT OUTER JOIN tm_tomas t ON (t. fk_id_factura  = df. id_factura  AND t.fk_id_estudio = df. fk_id_estudio )
  LEFT OUTER JOIN se_usuarios usm ON (usm. id_usr  = t. fk_id_usuario  COLLATE 'utf8_general_ci') 
  WHERE fa. estado_factura  <> 5
  AND DATE(fa. fecha_factura ) = CURDATE()
  AND fa. fk_id_sucursal  $condicion
  AND fa. fk_id_cliente  = cl. id_cliente 
  AND fa. fk_id_usuario  = us. id_usuario 
  AND fa. id_factura  = df. id_factura 
  AND df. fk_id_estudio  = es. id_estudio 
  AND es. fk_id_plantilla  IN (1,2,3,4,5)
  )
  UNION all
  -- RX
  (
  SELECT 
  fa. id_factura ,
  su.desc_corta,
  CONCAT(cl. nombre ,' ',cl. a_paterno ) AS paciente,
  TIME_FORMAT(fa. fecha_factura ,'%H:%i') AS hora,
  fa. turno_num ,
  us. iniciales ,
  -- es.`id_estudio`,
  es. desc_estudio ,
  -- es. fk_id_plantilla ,
  TIME_FORMAT(rx.`fecha_registro` ,'%H:%i') AS hora_toma,
  'n/a'  AS flebo,
  TIMEDIFF(TIME(rx.`fecha_registro`),TIME(fa. fecha_factura )) AS tiempo2
  FROM
  so_factura fa
  LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal) ,
  so_clientes cl,
  se_usuarios us,
  km_estudios es,
  so_detalle_factura df
  LEFT OUTER JOIN cr_plantilla_rx_img rx ON (rx. fk_id_factura  = df. id_factura  AND rx.fk_id_estudio = df. fk_id_estudio )
  -- LEFT OUTER JOIN se_usuarios usm ON (usm. id_usr  = t. fk_id_usuario  COLLATE 'utf8_general_ci') 
  WHERE fa. estado_factura  <> 5
  AND DATE(fa. fecha_factura ) = CURDATE()
  AND fa. fk_id_sucursal  $condicion
  AND fa. fk_id_cliente  = cl. id_cliente 
  AND fa. fk_id_usuario  = us. id_usuario 
  AND fa. id_factura  = df. id_factura 
  AND df. fk_id_estudio  = es. id_estudio 
  AND es. fk_id_plantilla  = 6
  )
  
  UNION all
  
  (
  SELECT 
  fa. id_factura ,
  su.desc_corta,
  CONCAT(cl. nombre ,' ',cl. a_paterno ) AS paciente,
  TIME_FORMAT(fa. fecha_factura ,'%H:%i') AS hora,
  fa. turno_num ,
  us. iniciales ,
  -- es.`id_estudio`,
  es. desc_estudio ,
  -- es. fk_id_plantilla ,
  TIME_FORMAT(rx.`fecha_registro` ,'%H:%i') AS hora_toma,
  me.nombre AS flebo,
  TIMEDIFF(TIME(rx.`fecha_registro`),TIME(fa. fecha_factura )) AS tiempo2
  FROM
  so_factura fa
  LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal) ,
  so_clientes cl,
  se_usuarios us,
  km_estudios es,
  so_detalle_factura df
  LEFT OUTER JOIN cr_plantilla_usg_re rx ON (rx. fk_id_factura  = df. id_factura  AND rx.fk_id_estudio = df. fk_id_estudio )
  LEFT OUTER JOIN so_medicos me ON (me.`id_medico` = rx. fk_id_medico ) 
  WHERE fa. estado_factura  <> 5
  AND DATE(fa. fecha_factura ) = CURDATE()
  AND fa. fk_id_sucursal  $condicion
  AND fa. fk_id_cliente  = cl. id_cliente 
  AND fa. fk_id_usuario  = us. id_usuario 
  AND fa. id_factura  = df. id_factura 
  AND df. fk_id_estudio  = es. id_estudio 
  AND es. fk_id_plantilla  = 7
  )
  
  UNION ALL
  
  (
  SELECT 
  fa. id_factura ,
  su.desc_corta,
  CONCAT(cl. nombre ,' ',cl. a_paterno ) AS paciente,
  TIME_FORMAT(fa. fecha_factura ,'%H:%i') AS hora,
  fa. turno_num ,
  us. iniciales ,
  -- es.`id_estudio`,
  es. desc_estudio ,
  -- es. fk_id_plantilla ,
  TIME_FORMAT(rx.`fecha_registro` ,'%H:%i') AS hora_toma,
  me.nombre AS flebo,
  TIMEDIFF(TIME(rx.`fecha_registro`),TIME(fa. fecha_factura )) AS tiempo2
  FROM
  so_factura fa
  LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal) ,
  so_clientes cl,
  se_usuarios us,
  km_estudios es,
  so_detalle_factura df
  LEFT OUTER JOIN cr_plantilla_tomo_re rx ON (rx. fk_id_factura  = df. id_factura  AND rx.fk_id_estudio = df. fk_id_estudio )
  LEFT OUTER JOIN so_medicos me ON (me.`id_medico` = rx. fk_id_medico ) 
  WHERE fa. estado_factura  <> 5
  AND DATE(fa. fecha_factura ) = CURDATE()
  AND fa. fk_id_sucursal  $condicion
  AND fa. fk_id_cliente  = cl. id_cliente 
  AND fa. fk_id_usuario  = us. id_usuario 
  AND fa. id_factura  = df. id_factura 
  AND df. fk_id_estudio  = es. id_estudio 
  AND es. fk_id_plantilla  = 8
  )
  
  ORDER BY 3 desc

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
