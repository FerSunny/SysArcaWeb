<?php

    session_start();
	include ("../controladores/conex.php");

    $fk_id_perfil=$_SESSION['fk_id_perfil'];
    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
   
 
    switch($fk_id_perfil){
        case 1:     // admin
          $sucursal=' fa.fk_id_sucursal > 0';   
          break;
        default:
          $sucursal=' fa.fk_id_sucursal = '.$fk_id_sucursal;     
      }
    
      $query="
      SELECT DISTINCT '".$fk_id_perfil."' AS perfil,
      fa.id_factura,
        df.fk_id_estudio,
        DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
        DATE_FORMAT(fa.fecha_entrega,'%d-%b-%y') AS fecha_entrega,
        DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
             su.desc_sucursal AS sucursal,
             CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
             es.desc_estudio AS estudio,
        fa.resta,
        fa.diagnostico,
        CASE
        WHEN sv.id_signos IS NULL THEN
        'No'
        ELSE
        'Si'
        END AS registrado,
        fa.resta,
        df.fk_id_estudio, 

        sv.id_signos,

        sv.fk_id_usuario,
        sv.fk_id_medico,
        sv.fecha,
        sv.peso,
        sv.talla,
        sv.diabetes,
        sv.dislpemia,
        sv.hipertension,
        sv.infartos,
        sv.angina_pecho,
        sv.palpitaciones,
        sv.dolor,
        sv.fuma,
        sv.alcohol,
        sv.observaciones
      FROM so_factura fa
      LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
      LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
      LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
      LEFT OUTER JOIN ag_ekg_sv sv ON (sv.`fk_id_factura` = fa.`id_factura` AND sv.`fk_id_estudio` = df.`fk_id_estudio` AND sv.estado ='A'),
      km_estudios es
      WHERE fa.estado_factura <> 5
      AND es.fk_id_plantilla = '5'
      AND es.id_estudio = df.fk_id_estudio
      AND ".$sucursal."
      AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 25 DAY) AND DATE_ADD(CURDATE(), INTERVAL 25 DAY)

union

      SELECT DISTINCT '".$fk_id_perfil."' AS perfil,
      fa.id_factura,
        df.fk_id_estudio,
        DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
        DATE_FORMAT(fa.fecha_entrega,'%d-%b-%y') AS fecha_entrega,
        DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
             su.desc_sucursal AS sucursal,
             CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
             ep.desc_estudio AS estudio,
        fa.resta,
        fa.diagnostico,
        CASE
        WHEN sv.id_signos IS NULL THEN
        'No'
        ELSE
        'Si'
        END AS registrado,
        fa.resta,
        df.fk_id_estudio, 

        sv.id_signos,

        sv.fk_id_usuario,
        sv.fk_id_medico,
        sv.fecha,
        sv.peso,
        sv.talla,
        sv.diabetes,
        sv.dislpemia,
        sv.hipertension,
        sv.infartos,
        sv.angina_pecho,
        sv.palpitaciones,
        sv.dolor,
        sv.fuma,
        sv.alcohol,
        sv.observaciones
      FROM so_factura fa
      LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
      LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
      LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
      LEFT OUTER JOIN km_paquetes pq ON (pq.id_paquete = df.fk_id_estudio)
      LEFT OUTER JOIN km_estudios ep ON (ep.id_estudio = pq.fk_id_estudio)
      LEFT OUTER JOIN ag_ekg_sv sv ON (sv.`fk_id_factura` = fa.`id_factura` AND sv.`fk_id_estudio` = df.`fk_id_estudio` AND sv.estado ='A')
      WHERE fa.estado_factura <> 5
      AND ep.fk_id_plantilla = '5'
      AND fa.fk_id_sucursal > 0
      AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 25 DAY) AND DATE_ADD(CURDATE(), INTERVAL 25 DAY)

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

