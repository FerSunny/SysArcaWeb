<?php 


session_start();

include ("../../controladores/conex.php");


$id_orden = $_POST['pro'];

$numero_factura = 0;
$iniciales = 'JPM'; //$_SESSION['iniciales'];
$fk_id_usuario = $_SESSION['id_usuario'];
$afecta_comision = 1;
$fk_id_tipo_pago = 1;


// *** extraemos la orden.
$q_orden = mysqli_query($conexion,"SELECT od.* FROM ce_ordenes od WHERE od.id_orden  ='$id_orden' AND od.estado = 'A' AND od.sigue_orden = 1 ");
$muestra_fm = mysqli_fetch_array($q_orden);

// *** extraemos el costo delos estudios  ***
$stm="
SELECT 
	SUM(es1.costo+
	(IF(es2.`costo` IS NULL,0,es2.`costo`))+
	(IF(es3.`costo` IS NULL,0,es3.`costo`))+
	(IF(es4.`costo` IS NULL,0,es4.`costo`))
	) AS costo
FROM ce_ordenes od
LEFT OUTER JOIN km_estudios es1 ON (es1.`id_estudio` = od.`fk_id_estudio_1`)
LEFT OUTER JOIN km_estudios es2 ON (es2.`id_estudio` = od.`fk_id_estudio_2`)
LEFT OUTER JOIN km_estudios es3 ON (es3.`id_estudio` = od.`fk_id_estudio_3`)
LEFT OUTER JOIN km_estudios es4 ON (es4.`id_estudio` = od.`fk_id_estudio_4`)
WHERE od.`estado` = 'A'
AND od.`sigue_orden` = 1
AND od.id_orden = $id_orden";

//echo $stm;

$q_costo = mysqli_query($conexion,$stm);

$muestra_cos = mysqli_fetch_array($q_costo);
$costo = $muestra_cos['costo'];

$porc_descuento = 0;
$porc_incremento = 0;
$a_cuenta = 0;
$fecha_aplicacion = null;
$observaciones = null;
$fecha_hora_impresa = null;
$estado_factura=2;
$vmedico=null;

//echo 'Costo: '.$costo;

    // la damos de alta
    $queryinsert_fa = "
        INSERT INTO `so_factura`
                    (`fk_id_empresa`,`fk_id_sucursal`,`id_factura`,`numero_factura`,`fecha_factura`,`fk_id_cliente`,`fk_id_medico`,
                     `fk_id_usuario`,`afecta_comision`,`fk_id_tipo_pago`,`imp_subtotal`,`porc_descuento`,`porc_incremento`,`imp_total`,
                     `a_cuenta`,`resta`,`fecha_aplicacion`,`fecha_entrega`
                     ,`observaciones`,`diagnostico`,`fecha_hora_impresa`,`fecha_hora_entrega`,
                     `estado_factura`,`origen`,`vmedico`,`estado_concilia`,`email_medico`,`email_paciente`,`folio_unidad`,`requiere_factura`,
                     `publicidad`,`grupo`,`fk_id_factura_maq`
                     )
        VALUES (
        ".$muestra_fm['fk_id_empresa'].",
        ".$muestra_fm['fk_id_sucursal'].",
        0,
        ".$numero_factura.",
        '".$muestra_fm['fecha_orden']."',
        ".$muestra_fm['fk_id_cliente'].",
        ".$muestra_fm['fk_id_medico'].",
        ".$fk_id_usuario.",
        '".$afecta_comision."',
        ".$fk_id_tipo_pago.",
        ".$costo.",
        ".$porc_descuento.",
        ".$porc_incremento.",
        ".$costo.",
        ".$a_cuenta.",
        ".$costo.",
        '".$fecha_aplicacion."',
        '".$muestra_fm['fecha_orden']."',
        '".$observaciones."',
        '".$muestra_fm['dx']."',
        '".$fecha_hora_impresa."',
        '".$fecha_hora_impresa."',
        '".$estado_factura."',
        'E',
        '".$vmedico."',
        'A',
        '1',
        '0',
        '0',
        '0',
        '0',
        '0',
        $id_orden
        )
        ";
        
$result = $conexion -> query($queryinsert_fa);

if ($result) {
    $id_factura_new = $conexion->insert_id;
    //echo 1;
    $estatus_1= 1;
}else{

  //$codigo = mysqli_errno($conexion); 

  //echo $codigo;
  $estatus_1 = 0;

}

// *** Guardamos detalle factura  ***
$sql="
SELECT od.`fk_id_empresa`,
	od.`fk_id_estudio_1` AS fk_id_estudio,
	1 AS cantidad,
	es.desc_estudio,
  es.costo
FROM ce_ordenes od, km_estudios es
WHERE od.fk_id_estudio_1 = es.id_estudio
AND od.`id_orden` = $id_orden
UNION
SELECT od.`fk_id_empresa`,
	od.`fk_id_estudio_2` AS fk_id_estudio,
	1 AS cantidad,
	es.desc_estudio,
  es.costo
FROM ce_ordenes od, km_estudios es
WHERE od.fk_id_estudio_2 = es.id_estudio
AND od.`id_orden` = $id_orden
UNION
SELECT od.`fk_id_empresa`,
	od.`fk_id_estudio_3` AS fk_id_estudio,
	1 AS cantidad,
	es.desc_estudio,
  es.costo
FROM ce_ordenes od, km_estudios es
WHERE od.fk_id_estudio_3 = es.id_estudio
AND od.`id_orden` = $id_orden
UNION
SELECT od.`fk_id_empresa`,
	od.`fk_id_estudio_4` AS fk_id_estudio,
	1 AS cantidad,
	es.desc_estudio,
  es.costo
FROM ce_ordenes od, km_estudios es
WHERE od.fk_id_estudio_4 = es.id_estudio
AND od.`id_orden` = ".$id_orden
;
// echo $sql_max;

if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
  {
      $fk_id_empresa=$row['fk_id_empresa'];
      $fk_id_estudio=$row['fk_id_estudio'];
      $cantidad=$row['cantidad'];
      $costo=$row['costo'];

      $insert =
      "
      INSERT INTO so_detalle_factura
            (fk_id_empresa,
             id_detalle,
             id_factura,
             numero_factura,
             fk_id_estudio,
             cantidad,
             precio_venta,
             fk_id_factura_maq,
             estado_factura)
      VALUES ($fk_id_empresa,
              0,
              $id_factura_new,
              0,
              $fk_id_estudio,
              $cantidad,
              $costo,
              $id_orden,
              0)
      ";
      //echo $insert;
      
      $result1 = $conexion -> query($insert);

      if ($result1) {
        $estatus_1= 1;
      }else{
        $estatus_1 = 0;
      }  
  }
}

// *** actualizamos el estado d el aorden, para que el medico vea que esta en proceso  ***
$query ="UPDATE ce_ordenes SET sigue_orden = 2, fk_id_factura = $id_factura_new  WHERE id_orden  =$id_orden";
$result = $conexion -> query($query);

if ($result) {
    $estatus_1= 1;
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



if ($estatus_1 == 1){
    echo 1;
}else{
  echo $codigo;
}




$conexion->close();






/*
          if(mysqli_query($conexion,$queryinsert_fa))
          {
            $id_factura_new = $conexion->insert_id;
            $codigo=1; 
          }else{
            $codigo = mysqli_errno($conexion);

          }
          
          $conexion->close();
          */
//echo $$queryinsert_fa;
// *** FIN   ***



// ********  funcion para guaradar el detalle ARCA.  ***********
/*
function insert_detalle_arca($id_factura, $id_factura_new, $fk_id_estudio,$costo_maq,$id_estudio_ori)
{
  include ("../../controladores/conex.php");
  include ("../../controladores/conex_dino.php");
  // Obtenemos el estudio segun la maquila
  //$query_3 = mysqli_query($conexion,"SELECT es.* FROM km_estudios es WHERE es.id_estudio = '$fk_id_estudio' ");
  //$muestra_3 = mysqli_fetch_array($query_3); 
  
  
  // verificamos si ya existe el detalle en en ARCA
  $queryfactura_2 = mysqli_query($conexion,"SELECT df.* FROM so_detalle_factura df WHERE df.estado_factura <> 5 AND fk_id_factura_maq ='$id_factura' AND df.fk_id_estudio = '$fk_id_estudio' ");
  $nrda= mysqli_num_rows($queryfactura_2);
  if($nrda == 0){
    // No existe lo recuperamos de DINO y lo enviamos a ARCA.
    $query_insert_df=
    "
    INSERT INTO so_detalle_factura
                (fk_id_empresa,

                 id_factura,

                 fk_id_estudio,
                 cantidad,
                 precio_venta,
                 fk_id_factura_maq,
                 estado_factura)
    VALUES ('1','$id_factura_new',$fk_id_estudio,1,$costo_maq,$id_factura,2)
    ";
          if(mysqli_query($conexion,$query_insert_df))
          {
//  *** Actualizamos los importes de la factura  ***            
            $query_4 = mysqli_query($conexion,"SELECT SUM(df.precio_venta) as importe FROM so_detalle_factura df WHERE df.id_factura = $id_factura_new");
            $muestra_4 = mysqli_fetch_array($query_4);
            $importe_total = $muestra_4['importe'];
            $query_5 = "UPDATE so_factura SET imp_subtotal=$importe_total, porc_descuento = 0, imp_total=$importe_total,resta = $importe_total,a_cuenta=0  WHERE id_factura = '$id_factura_new'";
            $result_5 = $conexion -> query($query_5);
            if ($result_5) {
// *** Actualizamos la tabla de maquilas de DINO  ***
              $query_6 = "UPDATE ma_maquila SET fk_id_folio_maquila =$id_factura_new WHERE fk_id_factura = $id_factura AND fk_id_estudio = $id_estudio_ori";
              $result_6 = $conexion_dino -> query($query_6);
              if ($result_6) {
                $codigo= 1;
              }else{
                $codigo = mysqli_errno($conexion);
              }
            }else{
              $codigo_5 = mysqli_errno($conexion); 
            }
          }else{
            $codigo = mysqli_errno($conexion); 
          }
  }else{
    $codigo=2;
  }
  return $codigo;
}
*/
?>
