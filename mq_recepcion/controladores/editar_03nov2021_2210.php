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
                     `publicidad`,`grupo`,`fk_id_factura_maq`
                     )
        VALUES (
        ".$muestra_fm['fk_id_empresa'].",
        11,
        0,
        ".$muestra_fm['numero_factura'].",
        '".$muestra_fm['fecha_factura']."',
        ".$muestra_fm['fk_id_cliente'].",
        ".$muestra_fm['fk_id_medico'].",
        ".$muestra_fm['fk_id_usuario'].",
        '".$muestra_fm['afecta_comision']."',
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
        $id_factura        
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
