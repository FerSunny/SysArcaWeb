<?php 





session_start();

include ("../../controladores/conex.php");


// *** Obtenemos variables
$pro = $_POST['pro'];
$codigo  = $_POST['codigo'];
$vendedor = $_SESSION['id_usuario']; // $_POST['vendedor'];
$pago = $_POST['pago']; 
$sucursal = $_POST['sucursal'];
$tpago = $_POST['tpago']; 
$comision = $_POST['comision']; 
$fentrega = $_POST['fentrega']; 

//*** extraemos los datos de la cotizacion
$a=0;
$b=0;
$query_stm=
"
select f.* from so_factura_pre f
where f.id_factura = $codigo
";
if ($result = mysqli_query($conexion, $query_stm)) {
  while($row = $result->fetch_assoc())
    { 

      $resta= $row['imp_total'] - $pago;

      $sql_insert="
          INSERT INTO so_factura
                      (fk_id_empresa,
                        fk_id_sucursal,
                        id_factura,
                        numero_factura,
                      fecha_factura,
                      fk_id_cliente,
                      fk_id_medico,
                      fk_id_usuario,
                      afecta_comision,
                      fk_id_tipo_pago,
                      imp_subtotal,
                      porc_descuento,
                      porc_incremento,
                      imp_total,
                      a_cuenta,
                      resta,
                       fecha_aplicacion,
                       fecha_entrega,
                       observaciones,
                       fecha_hora_impresa,
                       fecha_hora_entrega,
                       estado_factura,
                       origen,
                       vmedico,
                       estado_concilia,
                       email_medico,
                       email_paciente,
                       folio_unidad,
                       requiere_factura,
                       publicidad,
                       grupo,
                       fk_id_factura_maq,

                       fk_id_cotiza
                      )
          VALUES ("
                  .$row['fk_id_empresa'].",
                  $sucursal,
                  0,
                  0,
                  now(),"
                  .$row['fk_id_cliente'].","
                  .$row['fk_id_medico'].",
                  $vendedor,
                  $comision,
                  $tpago,"
                  .$row['imp_subtotal'].","
                  .$row['porc_descuento'].","
                  .$row['porc_incremento'].","
                  .$row['imp_total'].",
                  $pago,
                  $resta,"
                  ."'".$row['fecha_aplicacion']."'".",
                  '$fentrega',"
                  ."'".$row['observaciones']."'".","
                  ."'".$row['fecha_hora_impresa']."'".","
                  ."'".$row['fecha_hora_entrega']."'".","
                  ."'".$row['estado_factura']."'".","
                  ."'".$row['origen']."'".","
                  ."'".$row['vmedico']."'".","
                  ."'".$row['estado_concilia']."'".","
                  ."'".$row['email_medico']."'".","
                  ."'".$row['email_paciente']."'".","
                  ."'".$row['folio_unidad']."'".","
                  ."'".$row['requiere_factura']."'".","
                  ."'".$row['publicidad']."'".","
                  ."'".$row['grupo']."'".","
                  ."'".$row['fk_id_factura_maq']."'".","
                  .$codigo."
                )
                ";
               // echo $sql_insert;
                if(mysqli_query($conexion,$sql_insert))
                {
                  $ultimo_id = $conexion->insert_id;;
                  $a = 1; 
                }else{
                 // echo $sql_insert;
                  $codigo_stm = 'So_factura:'.mysqli_errno($conexion);
                }
    }
    // $a = 0;
}

if ($a == 1){
  //*** extraemos los datos de la cotizacion
  // $b=0;
  $query_stm1=
  "
  select d.* from so_detalle_factura_pre d
  where d.id_factura = $codigo
  ";
  if ($result1 = mysqli_query($conexion, $query_stm1)) {
    while($row1 = $result1->fetch_assoc())
      { 

        $sql_insert1="
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
        VALUES ("
                .$row1['fk_id_empresa'].",
                0,
                $ultimo_id,"
                .$row1['numero_factura'].","
                .$row1['fk_id_estudio'].","
                .$row1['cantidad'].","
                .$row1['precio_venta'].",
                0,"
                ."'A'"."
                )
        ";
        if(mysqli_query($conexion,$sql_insert1))
        {
          $a = 1; 
        }else{
          echo $sql_insert1;
          $codigo_stm = 'so_detalle_factura'.mysqli_errno($conexion);
        }
      }
  }

    $query3 ="UPDATE so_factura_pre SET numero_factura = $ultimo_id
        WHERE id_factura  =$codigo";
    $result2 = $conexion -> query($query3);

}

//$c = $a+$b/2;



if ($a == 1){
  $codigo_stm =1;
  echo $codigo_stm;
}else{
  echo $codigo_stm;
}










$conexion->close();



?>





































































