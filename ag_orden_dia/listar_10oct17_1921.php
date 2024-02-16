<?php

  session_start();

	include ("../controladores/conex.php");
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];

  if ($fk_id_perfil==1) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$id_modulo;
    }

  $query="SELECT fa.id_factura,
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
  te.nombre_tipo_estudio,
  CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS Registrado,
CASE
WHEN p2.num_imp = 0 OR p2.num_imp IS NULL THEN
'No'
ELSE
'Si'
END AS Impreso
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_tipo_estudio te ON (te.id_tipo_estudio = es.fk_id_tipo_estudio)
LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_estudio = df.fk_id_estudio)
WHERE fa.estado_factura <> 5
AND DATE(fa.fecha_entrega) = CURDATE()
AND es.fk_id_tipo_estudio".$condicion;

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
