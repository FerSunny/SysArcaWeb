<?php
session_start();
	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  $id_usuario=$_SESSION['id_usuario'];
  
    if ($fk_id_perfil==1 or $fk_id_perfil==13 ) 
    {
      $condicion=' > 0';
    }
    else
    {
      //if($fk_id_perfil==9){
      //  $condicion=" IN (SELECT ru.fk_id_sucursal FROM cr_plantilla_ruta ru WHERE fk_id_medico = ".$id_usuario.")";
      //}else{
        $condicion=' = '.$fk_id_sucursal; 
     // }
    }
 
  $query = "
  -- pacientes con estudios normal. (NO PAQUETE)
  SELECT ' ".$fk_id_perfil."' as perfil, fa.id_factura,
	fa.`fecha_factura`,
	fa.`fecha_entrega`,
	su.`desc_corta` as sucursal,
	CONCAT(cl.nombre,' ',cl.`a_paterno`, ' ',cl.a_materno) AS paciente,
  es.id_estudio,
  es.`iniciales` as estudio,
  ag.id_agenda,
	ag.cubiculo,
	ag.`fecha`,
	ag.`hora`,
	CASE
		WHEN tt.id_toma IS NULL THEN
			'No'
		ELSE
			'Si'
	END AS registrado
	
FROM so_factura fa,
	kg_sucursales su,
	so_clientes cl,
	so_detalle_factura df
	LEFT OUTER JOIN tm_agenda ag ON (ag.fk_id_factura = df.`id_factura` AND ag.fk_id_estudio = df.`fk_id_estudio` AND estado = 'A')
	LEFT OUTER JOIN tm_tomas tt ON (tt.fk_id_factura = df.`id_factura` AND tt.`fk_id_estudio` = df.fk_id_estudio AND tt.aplico = 'S'),
	km_estudios es
WHERE fa.`estado_factura` <> 5
AND DATE(fa.`fecha_factura`) BETWEEN CURDATE()-7 AND CURDATE()
AND fa.fk_id_sucursal = su.`id_sucursal`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND fa.`id_factura` = df.`id_factura`
AND df.fk_id_estudio = es.`id_estudio`
AND es.`cubiculo` = 'S'
AND es.`per_paquete` = 'No'
AND fa.fk_id_sucursal ".$condicion."


union all

-- extrae paquetes

SELECT ' ".$fk_id_perfil."' AS perfil, 
fa.id_factura,
fa.`fecha_factura`,
fa.`fecha_entrega`,
su.`desc_corta` AS sucursal,
CONCAT(cl.nombre,' ',cl.`a_paterno`, ' ',cl.a_materno) AS paciente,
pq.fk_id_estudio,
es.`iniciales` AS estudio,
ag.id_agenda,
ag.cubiculo,
ag.`fecha`,
ag.`hora`,
CASE
  WHEN tm.id_toma IS NULL THEN
    'No'
  ELSE
    'Si'
END AS registrado
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.`id_cliente` = fa.`fk_id_cliente`)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.`id_factura`)
LEFT OUTER JOIN km_estudios a ON (a.`id_estudio` = df.`fk_id_estudio`)
LEFT OUTER JOIN km_paquetes pq ON (pq.`id_paquete` = df.fk_id_estudio)
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = pq.`fk_id_estudio`)
LEFT OUTER JOIN tm_agenda ag ON(ag.`fk_id_factura` = fa.`id_factura` AND ag.`fk_id_estudio` = pq.`fk_id_estudio` AND ag.estado = 'A')
LEFT OUTER JOIN tm_tomas tm ON (tm.`fk_id_factura` = fa.`id_factura` AND tm.`fk_id_estudio` = pq.`fk_id_estudio` AND tm.`aplico` = 'S')
WHERE fa.`estado_factura` <> 5
AND DATE(fa.`fecha_factura`) BETWEEN CURDATE()-7 AND CURDATE()
AND df.`id_factura` = fa.`id_factura`
AND a.`cubiculo` = 'S'
AND a.`per_paquete` = 'Si'
AND fa.fk_id_sucursal ".$condicion
;


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
