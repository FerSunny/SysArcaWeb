<?php
date_default_timezone_set('America/Mexico_City');

	include ("../controladores/conex.php");
  session_start();
   $fk_id_perfil=$_SESSION['fk_id_perfil'];
   $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

    $fecha_hoy = date('Y-m-d');
    $nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha_hoy  ) ) ;
    $fecha_anterior = date ( 'Y-m-d' , $nuevafecha );
  if ($fk_id_perfil==1) 
    {
      $condicion=' > 0';
      
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }
  
 
  $query = "SELECT 
DISTINCT 'P1' Plantilla,
suc.desc_sucursal,
p1.fk_id_factura,
p1.fk_id_estudio,
(SELECT desc_estudio FROM km_estudios WHERE id_estudio = p1.fk_id_estudio) desc_estudio,
fa.fecha_factura,
p1.fecha_registro,
p1.fecha_validacion,
fa.fecha_entrega,
p1.fecha_impresion,
DATEDIFF(p1.fecha_impresion,fa.fecha_entrega) dias,
TIMEDIFF(p1.fecha_impresion,fa.fecha_entrega) horas
FROM cr_plantilla_1_re p1
LEFT OUTER JOIN so_factura fa ON (fa.id_factura = p1.fk_id_factura)
LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = fa.fk_id_sucursal)
WHERE DATE(fecha_factura) > '$fecha_anterior' AND  DATE(fecha_factura) < '$fecha_hoy'
AND fk_id_sucursal$condicion

UNION ALL

SELECT 
DISTINCT 'P2' Plantilla,
suc.desc_sucursal,
p1.fk_id_factura,
p1.fk_id_estudio,
(SELECT desc_estudio FROM km_estudios WHERE id_estudio = p1.fk_id_estudio) desc_estudio,
fa.fecha_factura,
p1.fecha_registro,
p1.fecha_validacion,
fa.fecha_entrega,
p1.fecha_impresion,
DATEDIFF(p1.fecha_impresion,fa.fecha_entrega) dias,
TIMEDIFF(p1.fecha_impresion,fa.fecha_entrega) horas
FROM cr_plantilla_2_re p1
LEFT OUTER JOIN so_factura fa ON (fa.id_factura = p1.fk_id_factura)
LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = fa.fk_id_sucursal)
WHERE DATE(fecha_factura) > '$fecha_anterior' AND  DATE(fecha_factura) < '$fecha_hoy'
AND fk_id_sucursal$condicion

UNION ALL

SELECT 
DISTINCT 'P3' Plantilla,
suc.desc_sucursal,
p1.fk_id_factura,
p1.fk_id_estudio,
(SELECT desc_estudio FROM km_estudios WHERE id_estudio = p1.fk_id_estudio) desc_estudio,
fa.fecha_factura,
p1.fecha_registro,
p1.fecha_validacion,
fa.fecha_entrega,
p1.fecha_impresion,
DATEDIFF(p1.fecha_impresion,fa.fecha_entrega) dias,
TIMEDIFF(p1.fecha_impresion,fa.fecha_entrega) horas
FROM cr_plantilla_cvo_re p1
LEFT OUTER JOIN so_factura fa ON (fa.id_factura = p1.fk_id_factura)
LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = fa.fk_id_sucursal)
WHERE DATE(fecha_factura) > '$fecha_anterior' AND  DATE(fecha_factura) < '$fecha_hoy'
AND fk_id_sucursal$condicion";
  //AND fa.fk_id_sucursal".$condicion

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
