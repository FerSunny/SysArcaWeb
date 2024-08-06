<?php
    session_start();
	include ("../controladores/conex.php");


    $fk_id_perfil=$_SESSION['fk_id_perfil'];
    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

    $id_usuario=$_SESSION['id_usuario'];
    
      if ($fk_id_perfil==1 or $fk_id_perfil==13 or $fk_id_perfil==45 or $fk_id_perfil==46) 
      {
        $condicion=' > 0';
      }
      else
      {
          $condicion=' = '.$fk_id_sucursal; 
      }  
 
  $query = "
SELECT 
  t.`id_toma`,
  s.desc_corta,
  t.lote,
  fk_id_factura,
  fk_id_estudio,
  es.`desc_estudio`,
  t.`fk_id_muestra`,
  m.`desc_muestra`,
  t.`fk_id_medio`,
  me.`desc_medio`,
  t.`fk_id_equipo`,
  eq.`descripcion`,
  t.fecha_toma
FROM
  tm_tomas t 
  LEFT OUTER JOIN tm_lote_detalle ld ON (ld.lote = t.lote)
  left outer join km_estudios es on (es.`id_estudio` = t.fk_id_estudio)
  left outer join km_muestras m on (m.`id_muestra` = t.fk_id_muestra)
  left outer join km_medios me on (me.`id_medio` = t.`fk_id_medio`)
  left outer join eb_equipos eq on (eq.`id_equipo` = t.`fk_id_equipo`),
  kg_sucursales s 
 -- WHERE DATE(t.fecha_toma) = CURDATE()
  WHERE DATE(t.fecha_toma) >= '2024-01-01'
  AND t.fk_id_sucursal = s.id_sucursal 
  AND t.lote is not null 
  AND t.fk_id_sucursal $condicion
  ";


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
