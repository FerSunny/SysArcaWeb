<?php 


session_start();

include ("../../controladores/conex.php");


$id_orden = $_POST['pro'];
$tipo_pago = $_POST['tipo_pago'];
$pago = $_POST['pago'];

$numero_factura = 0;
$iniciales = 'JPM'; //$_SESSION['iniciales'];
$fk_id_usuario = $_SESSION['id_usuario'];
$fk_id_sucursal = $_SESSION['fk_id_sucursal'];

$fk_id_tipo_pago = 1;


// *** extraemos la orden.
$q_orden = mysqli_query($conexion,"SELECT od.* FROM ce_ordenes od WHERE od.id_orden  ='$id_orden' AND od.estado = 'A' AND od.sigue_orden = 1 ");
$muestra_fm = mysqli_fetch_array($q_orden);
$maquila = $muestra_fm['maquila'];

// *** extraemos el costo delos estudios  ***
if($maquila == 'N'){
    $afecta_comision = 1;   
}else{
   $afecta_comision = 0;
}   
   $stm1="
   SELECT SUM(es.`costo`) as costo
    FROM ce_ordenes_detalle od, km_estudios es
    WHERE od.`fk_id_estudio` = es.`id_estudio` 
    AND od.estado = 'A'
    AND od.`id_orden` = $id_orden
   ";
    $q_costo1 = mysqli_query($conexion,$stm1);
    $muestra_cos1 = mysqli_fetch_array($q_costo1);
    $costo = $muestra_cos1['costo'];  



$porc_descuento = 0;
$porc_incremento = 0;
$a_cuenta = $pago;
$fecha_aplicacion = null;
$observaciones = null;
$fecha_hora_impresa = null;
$estado_factura=2;
$vmedico=null;
$resta=$costo-$a_cuenta;
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
        ".$fk_id_sucursal.",
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
        ".$resta.",
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

  $stm2="
    SELECT od.*,es.*
    FROM ce_ordenes_detalle od, km_estudios es 
    WHERE od.estado = 'A'
    AND od.`fk_id_estudio` = es.`id_estudio`
    AND od.`id_orden` = $id_orden
  ";
  if ($result2 = mysqli_query($conexion, $stm2)) {
  while($row2 = $result2->fetch_assoc())
    {

          $fk_id_empresa=$row2['fk_id_empresa'];
          $fk_id_estudio=$row2['fk_id_estudio'];
          $cantidad=$row2['cantidad'];
          $costo=$row2['costo'];

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
          
          $result3 = $conexion -> query($insert);

          if ($result3) {
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
?>
