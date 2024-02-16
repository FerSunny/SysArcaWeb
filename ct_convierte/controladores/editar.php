<?php 





session_start();
date_default_timezone_set('America/Mexico_City');
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



//  *** rutina para obtener el grupo al que pertenece la sucursal  *** //
$origen=1;
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

/* *** verificamos el grupo de la sucursal para obtener el folio *** */
    $q_sucursal = mysqli_query($conexion,"
             SELECT grupo
             FROM kg_sucursales
             WHERE id_sucursal = $sucursal
             ");
    $r_sucursal = mysqli_fetch_array($q_sucursal);
    $nr = mysqli_num_rows($q_sucursal); 
    if($nr == 1){           
        $grupo = $r_sucursal['grupo'];
    }else{
        $grupo = 0;
    }

// *** FIN  ***


// *** Armamnos el nuevo numero de factura ***
$fechaActual = date('d-m-Y');
$fechaComoEntero = strtotime($fechaActual);
$str_sucu = 2;
$sucu = substr("00{$fk_id_sucursal}", -$str_sucu);


$dia=date("d", $fechaComoEntero);
$mes=date("m", $fechaComoEntero);
$anio=date("y", $fechaComoEntero);

$prefolio=$dia.$mes.$anio.$sucu;


//* obtenemos el valor maximo del control del dia
$sql_max="select max(cose_dia) as ultimo FROM so_factura
where fk_id_sucursal =".$fk_id_sucursal." and fecha_ctl=".$prefolio;
// echo $sql_max;

  if ($result = mysqli_query($conexion, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $ultimo_dia=$row['ultimo']+1;
    }
  }else{
    $ultimo_dia=0;
  }

$id_factura_new = $prefolio.substr("00{$ultimo_dia}", -$str_sucu);
// *** fin ***





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

                       fk_id_cotiza,
                       bang_update,
                       fecha_ctl,
                       cose_dia,
                       id_factura_new,
                       id_factura_old
                      )
          VALUES ("
                  .$row['fk_id_empresa'].",
                  $sucursal,
                  $id_factura_new,
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
                  .$codigo.",
                  1,
                  $prefolio,
                  $ultimo_dia,
                  $id_factura_new,
                  0
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
                $id_factura_new,"
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

    $query3 ="UPDATE so_factura_pre SET numero_factura = $id_factura_new
        WHERE id_factura  =$codigo";
    $result2 = $conexion -> query($query3);

}

//$c = $a+$b/2;

/* Guardamos en la tabla de foliosn por grupo y obtenemos el numero de folio de factura  */
      switch ($grupo) {
        case '1':
          $tabla= 'so_control_tam';
          break;
        case '2':
          $tabla= 'so_control_acb';
          break;
        case '3':
          $tabla= 'so_control_jcv';
          break;
        case '4':
          $tabla= 'so_control_jca';   
          break;     
        default:
          // code...
          break;
      }

      $i_folio ="INSERT INTO ".$tabla." (fk_id_empresa,id_grupo,id_folio,fk_id_factura,fecha_creado,fk_id_usuario,estado) VALUES (
      1,$grupo,0,$id_factura_new,now(),$vendedor,'A')";

// echo 'folio: '.$i_folio;

      $n_insert = mysqli_query($conexion,$i_folio);
       if ($n_insert){
          $last_folio = $conexion->insert_id;

          $sql_cli3="UPDATE so_factura SET numero_factura = $last_folio
          WHERE id_factura = ".$id_factura_new;
          mysqli_query($conexion,$sql_cli3);

        }
/* Fin de rutina de asignacion de folio  */






if ($a == 1){
  $codigo_stm =1;
  echo $codigo_stm;
}else{
  echo $codigo_stm;
}










$conexion->close();



?>





































































