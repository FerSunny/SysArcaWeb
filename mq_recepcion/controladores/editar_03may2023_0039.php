<?php 


session_start();

include ("../../controladores/conex_dino.php");


$id_factura = $_POST['pro'];
$fk_id_estudio = $_POST['dc'];
$costo_maq = $_POST['costo_maq'];

$id_estudio_ori = $_POST['zapo'];
//$caducidad = $_POST['caducidad'];


// *** extraemos la afactura de DINO.
$queryfactura_fc = mysqli_query($conexion_dino,"SELECT fa.* FROM so_factura fa WHERE id_factura  ='$id_factura' AND fa.estado_factura <> 5");
$muestra_fc = mysqli_fetch_array($queryfactura_fc);
// *** extraemos la afactura de DINO.
//$queryfactura_fd = mysqli_query($conexion_dino,"SELECT df.* FROM so_detalle_factura df WHERE id_factura ='$id_factura' AND df.fk_id_estudio = '$fk_id_estudio' ");
//$muestra_fd = mysqli_fetch_array($queryfactura_fd);


[$codigo_cabeza, $id_factura_new] = insert_cabeza_arca($id_factura, $muestra_fc);

switch ($codigo_cabeza) {
    case 1: // cabecera registrada
        $codigo_detalle = insert_detalle_arca($id_factura, $id_factura_new, $fk_id_estudio,$costo_maq,$id_estudio_ori);
        switch($codigo_detalle){
          case 1: // detalle registrada
            $cr = 1;
            break;
          case 2:
            $cr=2;
            break;
          default:
            $cr = $codigo_detalle;
            break;
        }
        echo $cr;
        break;
    case 2: // Factura ya ragistrada
        $codigo_detalle = insert_detalle_arca($id_factura, $id_factura_new, $fk_id_estudio,$costo_maq,$id_estudio_ori);
        switch($codigo_detalle){
          case 1: // detalle registrada
            $cr = 1;
            break;
          case 2:
            $cr=2;
            break;
          default:
            $cr = $codigo_detalle;
            break;
        }
        echo $cr;
        break;
    default:
        echo $codigo_cabeza;
        break;
}
 
 
  
// ********  funcion para guaradar el cabecera ARCA.  ***********

function insert_cabeza_arca($id_factura,$muestra_fm)
{
  include ("../../controladores/conex.php");


// Armamnos el nuevo numero de factura
$sucursal=11;
$fechaActual = date('d-m-Y');
$fechaComoEntero = strtotime($fechaActual);
$str_sucu = 2;
$sucu = substr("00{$sucursal}", -$str_sucu);


$dia=date("d", $fechaComoEntero);
$mes=date("m", $fechaComoEntero);
$anio=date("y", $fechaComoEntero);

$prefolio=$dia.$mes.$anio.$sucu;


//* obtenemos el valor maximo del control del dia
$sql_max="select max(cose_dia) as ultimo FROM so_factura
where fk_id_sucursal =".$sucursal." and fecha_ctl=".$prefolio;
// echo $sql_max;

  if ($result = mysqli_query($conexion, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $ultimo_dia=$row['ultimo']+1;
    }
  }else{
    $ultimo_dia=0;
  }
// fin

//  *** rutina para obtener el grupo al que pertenece la sucursal  *** //
$origen=1;
$fk_id_sucursal=11;

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





  $queryfactura_a = mysqli_query($conexion,"SELECT fa.* FROM so_factura fa WHERE fk_id_factura_maq ='$id_factura' AND fa.estado_factura <> 5");
  $nra= mysqli_num_rows($queryfactura_a);
  if($nra == 0){  
    // Si no existe la damos de alta
    $queryinsert_fa = "
        INSERT INTO `so_factura`
                    (`fk_id_empresa`,`fk_id_sucursal`,`id_factura`,`numero_factura`,`fecha_factura`,`fk_id_cliente`,`fk_id_medico`,
                     `fk_id_usuario`,`afecta_comision`,`fk_id_tipo_pago`,`imp_subtotal`,`porc_descuento`,`porc_incremento`,`imp_total`,
                     `a_cuenta`,`resta`,`fecha_aplicacion`,`fecha_entrega`,`observaciones`,`diagnostico`,`fecha_hora_impresa`,`fecha_hora_entrega`,
                     `estado_factura`,`origen`,`vmedico`,`estado_concilia`,`email_medico`,`email_paciente`,`folio_unidad`,`requiere_factura`,
                     `publicidad`,`grupo`,fk_id_factura_maq,fecha_ctl,cose_dia
                     )
        VALUES (
        ".$muestra_fm['fk_id_empresa'].",
        11,
        0,
        ".$muestra_fm['numero_factura'].",
        '".$muestra_fm['fecha_factura']."',
        ".$muestra_fm['fk_id_cliente'].",
        ".$muestra_fm['fk_id_medico'].",
        259,
        0,
        ".$muestra_fm['fk_id_tipo_pago'].",
        ".$muestra_fm['imp_subtotal'].",
        ".$muestra_fm['porc_descuento'].",
        ".$muestra_fm['porc_incremento'].",
        ".$muestra_fm['imp_total'].",
        ".$muestra_fm['a_cuenta'].",
        ".$muestra_fm['resta'].",
        '".$muestra_fm['fecha_aplicacion']."',
        '".$muestra_fm['fecha_entrega']."',
        '".$muestra_fm['observaciones']."',
        '".$muestra_fm['diagnostico']."',
        '".$muestra_fm['fecha_hora_impresa']."',
        '".$muestra_fm['fecha_hora_entrega']."',
        '".$muestra_fm['estado_factura']."',
        'M',
        '".$muestra_fm['vmedico']."',
        '".$muestra_fm['estado_concilia']."',
        '".$muestra_fm['email_medico']."',
        '".$muestra_fm['email_paciente']."',
        '".$muestra_fm['folio_unidad']."',
        '".$muestra_fm['requiere_factura']."',
        '".$muestra_fm['publicidad']."',
        '".$muestra_fm['grupo']."',
        $id_factura,
        $prefolio,
        $ultimo_dia     
        )
        ";     
          if(mysqli_query($conexion,$queryinsert_fa))
          {
            $id_factura_new = $conexion->insert_id;
            $codigo=1; //echo 1;
          }else{
            $codigo = mysqli_errno($conexion);
            $id_factura_new =0;
          }
  }else{
    $codigo=2;
    $muestra_a = mysqli_fetch_array($queryfactura_a);
    $id_factura_existe = $muestra_a['id_factura'];
    $id_factura_new =$id_factura_existe;
  }

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
      1,$grupo,0,$id_factura_new,now(),259,'A')";

// echo 'folio: '.$i_folio;

      $n_insert = mysqli_query($conexion,$i_folio);
       if ($n_insert){
          $last_folio = $conexion->insert_id;

          $sql_cli3="UPDATE so_factura SET numero_factura = $last_folio
          WHERE id_factura = ".$id_factura_new;
          mysqli_query($conexion,$sql_cli3);

        }
/* Fin de rutina de asignacion de folio  */






return [$codigo, $id_factura_new];
}
// *** FIN   ***



// ********  funcion para guaradar el detalle ARCA.  ***********
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
//  *** verificamos si el estudio se debe cerar un evento en la agenda /RX, EKG, USG)
            $query_es="SELECT es.fk_id_plantilla FROM km_estudios es WHERE es.`id_estudio` =".$fk_id_estudio;
            $query_es_res = mysqli_query($conexion,$query_es);
            $nr_es= mysqli_num_rows($query_es_res);
            if($nr_es == 1){
              $record_es = mysqli_fetch_array($query_es_res);
              $fk_id_plantilla = $record_es['fk_id_plantilla'];
            }else{
              $fk_id_plantilla=0;
            }

            switch ($fk_id_plantilla) {
              case 6: // RX
                  // *** Obtenemos la sucursdal del evento que asigno DINO
                  $query_se = "SELECT a.* FROM ag_rx a WHERE a.`fk_id_factura` = ".$id_factura;
                  $query_se_res = mysqli_query($conexion_dino,$query_se);
                  $record_se = mysqli_fetch_array($query_se_res);
                  $se = $record_se['fk_id_sucursal'];
                  $usuario_medico = $record_se['fk_id_usuario'];
                  $fecha_agenda = $record_se['fecha'];

                  $insert_ag_rx="INSERT INTO ag_rx
                  (empresa,
                   id_agenda,
                   fk_id_factura,
                   fk_id_sucursal,
                   fk_id_usuario,
                   fecha,
                   estado)
                  VALUES (1,
                          0,
                          $id_factura_new,
                          $se,
                          $usuario_medico,
                          '$fecha_agenda',
                          'A')";
                  $result_ag_rx = $conexion -> query($insert_ag_rx);
                  break;
              case 0: // no necesita agenda el estudio
                  break;
              default:
                  break;
          }



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

?>
