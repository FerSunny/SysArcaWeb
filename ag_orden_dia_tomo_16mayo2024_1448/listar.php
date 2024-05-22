<?php

	session_start();
  include ("../controladores/conex.php");
  
 // $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  $id_usuario=$_SESSION['id_usuario'];



  if ($fk_id_perfil==1 or $fk_id_perfil==13 or $fk_id_perfil==38 or $fk_id_perfil==33 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
      $condicion=' > 0';
    }
    else
    {
        $condicion=' = '.$fk_id_sucursal; 
    }
  $query="
SELECT 
'".$fk_id_perfil."' AS perfil, 
  a.*,
  f.`fecha_factura`,
  f.`fk_id_sucursal`,
  s.`desc_corta`,
  CONCAT(c.`nombre`,' ',c.`a_paterno`,' ',c.`a_materno`) paciente,
  e.`iniciales`,
  CASE 
  WHEN i.`estado` IS NULL THEN
    'Pendiente'
  ELSE
    i.estado
  END AS estado_img,
  f.resta,
  d.fk_id_estudio
FROM ag_tomo a
LEFT OUTER JOIN so_factura f ON (f.`id_factura` = a.`fk_id_factura`)
LEFT OUTER JOIN kg_sucursales s ON (s.`id_sucursal` = f.`fk_id_sucursal`)
LEFT OUTER JOIN so_clientes c ON (c.`id_cliente` = f.`fk_id_cliente`)
LEFT OUTER JOIN so_detalle_factura d ON (d.`id_factura` = f.`id_factura`)
LEFT OUTER JOIN km_estudios e ON (e.`id_estudio` = d.fk_id_estudio )
LEFT OUTER JOIN cr_plantilla_tomo_img i ON (i.`fk_id_factura` = f.`id_factura` AND i.`fk_id_estudio` = d.`fk_id_estudio`)
WHERE a.`estado` = 'A'
AND fecha = CURDATE()
AND e.`fk_id_plantilla` = 8
and f.fk_id_sucursal ".$condicion."
"
;

//echo $query;

$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
        echo "<script>location.href='../ag_orden_dia_rad/tabla_agenda.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);