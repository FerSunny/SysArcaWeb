<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);

$sTableInsert = "so_factura";
$fk_id_empresa=1;
$numero_factura=2;
$fecha_factura=date("Y-m-d H:i:s");
$fk_id_cliente=$data['id_cliente'];
$fk_id_medico=$data['id_medico'];
$fk_id_usuario=$data['id_usuario'];
$afecta_comision=$data['afecta_comision'];
$fk_id_tipo_pago=$data['pago'];
$imp_subtotal=$data['subtotal'];
$porc_descuento=$data['descuento'];
$porc_incremento=$data['incremento'];
$imp_total=$data['total'];
$a_cuenta=$data['acuenta'];
$resta=$imp_total-$a_cuenta;
$observaciones=$data['observaciones'];
$diagnostico=$data['diagnostico'];
$estado_factura=$data['estado_factura'];
$fechaentrega=$data['fechaEntrega'];
$mail=$data['mail'];
$e_medico = $data['e_medico'];
$e_paciente = $data['e_paciente'];
$r_factura = $data['r_factura'];
$acepta_p = $data['acepta_p'];
$idfacturacion = $data['idfacturacion'];

$correo = $data['correo'];

$colonia = $data['colonia'];
$cp = $data['cp'];
$calle = $data['calle'];
$numero_exterior = $data['numero_exterior'];

$telefono_fijo = $data['tel1'];
$telefono_movil = $data['celular'];

$numturno = $data['numturno'];
$horaturno = '00:00:00';
$urgente_p = $data['urgente_p'];
$pendiente_p = $data['pendiente_p'];

$medico_aux="";
if(isset($data['medico_aux'])){
  $medico_aux=$data['medico_aux'];
}


$origen=1;
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

/* *** verificamos el grupo de la sucursal para obtener el folio *** */
    $q_sucursal = mysqli_query($con,"
             SELECT grupo
             FROM kg_sucursales
             WHERE id_sucursal = $fk_id_sucursal
             ");
    $r_sucursal = mysqli_fetch_array($q_sucursal);
    $nr = mysqli_num_rows($q_sucursal); 
    if($nr == 1){           
        $grupo = $r_sucursal['grupo'];
    }else{
        $grupo = 0;
    }
//



$fk_id_perfil=$_SESSION['fk_id_perfil'];

if ($fk_id_sucursal <1 || $fk_id_sucursal > 12){
  $err_empresa=1;
  $err_modulo='so_factura/ajax/insertBill.php';
  $err_desc_error= 'sucursal fuera de rengo valido (1-10)';
  $err_id_usuario= $data['id_usuario'];
  $err_fk_id_sucursal=$fk_id_sucursal;
  
  
  echo '<script> alert("ATENCION: Sucursal de inicio erronea, antes de continuar reportelo a su area de sistemas")</script>';
  $ins_errores="INSERT INTO tb_errores (fk_id_empresa,id_error,modulo,desc_error,id_usuario,fk_id_sucursal,fecha_hora) 
  VALUES('$err_empresa',0,'$err_modulo','$err_desc_error','$err_id_usuario','$err_fk_id_sucursal',NOW())";
  $resultado = mysqli_query($conexion, $ins_errores);
}

// Armamnos el nuevo numero de factura
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

  if ($result = mysqli_query($con, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $ultimo_dia=$row['ultimo']+1;
    }
  }else{
    $ultimo_dia=0;
  }





// fin


 $sql="INSERT INTO so_factura(fk_id_empresa,fk_id_sucursal,numero_factura,fecha_factura,fk_id_cliente,fk_id_medico,
 fk_id_usuario,afecta_comision,fk_id_tipo_pago,imp_subtotal,porc_descuento,porc_incremento,imp_total,
 a_cuenta,resta,observaciones,diagnostico,estado_factura,origen,fecha_hora_impresa,
 fecha_entrega,vmedico,estado_concilia,email_medico,email_paciente,requiere_factura,publicidad,turno_num,
 turno_hora,urgente,pendiente,fecha_ctl,cose_dia) 
 VALUES (1,'$fk_id_sucursal','$numero_factura','$fecha_factura','$fk_id_cliente','$fk_id_medico','$fk_id_usuario',
 '$afecta_comision','$fk_id_tipo_pago','$imp_subtotal','$porc_descuento','$porc_incremento','$imp_total',
 '$a_cuenta','$resta','$observaciones','$diagnostico','$estado_factura','$origen','$fecha_factura',
 '$fechaentrega','$medico_aux','A','$e_medico','$e_paciente','$r_factura','$acepta_p','$numturno',
 '$horaturno','$urgente_p','$pendiente_p',$prefolio,$ultimo_dia)";
// echo $sql;
 $query_new_insert = mysqli_query($con,$sql);
   if ($query_new_insert){
      $last_id = $con->insert_id;

// actualiza la edad del paciente
      $sql_cli="UPDATE so_clientes SET fecha_nac= '".$mail."' , mail = '".$correo."' ,
      anios = DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,fecha_nac)),'%y '),
      meses = DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,fecha_nac)),'%c '),
      dias = DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE,fecha_nac)),'%e'),
      colonia = '".$colonia."',
      cp = '".$cp."',
      calle = '".$calle."',
      numero_exterior = '".$numero_exterior."',
      telefono_fijo = '".$telefono_fijo."',
      telefono_movil = '".$telefono_movil."'


      WHERE id_cliente = ".$fk_id_cliente;
      mysqli_query($con,$sql_cli);
/*
      $sql_cli2="UPDATE so_facturacion SET fk_id_factura= ".$last_id."
      WHERE id_facturacion = ".$idfacturacion;
      mysqli_query($con,$sql_cli2);

*/

/* Guardamos en la tabla de folios y obtenemos el numero de folio de factura  */
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
      1,$grupo,0,$last_id,'$fecha_factura',$fk_id_usuario,'A')";

// echo 'folio: '.$i_folio;

      $n_insert = mysqli_query($con,$i_folio);
       if ($n_insert){
          $last_folio = $con->insert_id;

          $sql_cli3="UPDATE so_factura SET numero_factura = $last_folio
          WHERE id_factura = ".$last_id;
          mysqli_query($con,$sql_cli3);

        }
/* Fin de rutina de asignacion de folio  */





      for($i=0; $i<count($data['estudios']); $i++) {
      //     //echo "Rating is " . $data['ids'][$i]["id"] . " and the excerpt is " . $data['ids'][$i]["cantidad"] . "<BR>";
        $studio_id=$data['estudios'][$i]['id'];
        $estudio_cantidad=$data['estudios'][$i]['cantidad'];
        $estudio_precio_venta=$data['estudios'][$i]['precio_venta'];

        $sql="INSERT INTO so_detalle_factura(fk_id_empresa,id_factura,numero_factura,fk_id_estudio,cantidad,precio_venta)VALUES
        (1,'$last_id','$last_id','$studio_id','$estudio_cantidad','$estudio_precio_venta')";
        //echo $sql;
        $query_new_insert = mysqli_query($con,$sql);
      }

      
  //  _     _ _                            
  // | |   (_) |                           
  // | |__  _| |_ __ _  ___ ___  _ __ __ _ 
  // | '_ \| | __/ _` |/ __/ _ \| '__/ _` |
  // | |_) | | || (_| | (_| (_) | | | (_| |
  // |_.__/|_|\__\__,_|\___\___/|_|  \__,_|
                                        
                                        
 

      $log_error=mysqli_error($con);
      $sql="INSERT INTO tb_bitacora(dt_date,vsucursal,vmodulo,usuario_id,voperation,verror)VALUES
      ('$fecha_factura','$fk_id_sucursal','facturas','$fk_id_perfil','insert','$log_error');";
      //echo $sql;
      mysqli_query($con,$sql);
  
  
//                  _   _     _ _                            
//                 | | | |   (_) |                           
//    ___ _ __   __| | | |__  _| |_ __ _  ___ ___  _ __ __ _ 
//   / _ \ '_ \ / _` | | '_ \| | __/ _` |/ __/ _ \| '__/ _` |
//  |  __/ | | | (_| | | |_) | | || (_| | (_| (_) | | | (_| |
//   \___|_| |_|\__,_| |_.__/|_|\__\__,_|\___\___/|_|  \__,_|
                                                          
                                                          

                                        

      header('Content-Type: application/json');
      //Guardamos los datos en un array
      $datos = array(
      'id' => $last_id
      );
      //Devolvemos el array pasado a JSON como objeto
      echo json_encode($datos, JSON_FORCE_OBJECT);

   }else{
  //  _     _ _                            
  // | |   (_) |                           
  // | |__  _| |_ __ _  ___ ___  _ __ __ _ 
  // | '_ \| | __/ _` |/ __/ _ \| '__/ _` |
  // | |_) | | || (_| | (_| (_) | | | (_| |
  // |_.__/|_|\__\__,_|\___\___/|_|  \__,_|
                                        
                                        
 

        $log_error=mysqli_error($con);
        $sql="INSERT INTO tb_bitacora(dt_date,vsucursal,vmodulo,usuario_id,voperation,verror)VALUES
        ('$fecha_factura','$fk_id_sucursal','facturas','$fk_id_perfil','insert','$log_error');";
        //echo $sql;
        mysqli_query($con,$sql);

//                  _   _     _ _                            
//                 | | | |   (_) |                           
//    ___ _ __   __| | | |__  _| |_ __ _  ___ ___  _ __ __ _ 
//   / _ \ '_ \ / _` | | '_ \| | __/ _` |/ __/ _ \| '__/ _` |
//  |  __/ | | | (_| | | |_) | | || (_| | (_| (_) | | | (_| |
//   \___|_| |_|\__,_| |_.__/|_|\__\__,_|\___\___/|_|  \__,_|
                                    
      
     echo $log_error;
   }


?>
