<?php
session_start();
date_default_timezone_set('America/Chihuahua');
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

include_once('./includes/class.phpmailer.php');
include_once('./includes/class.smtp.php');

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
$whatsapp_p = $data['whatsapp_p'];

$conocio = $data['conocio'];

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

if ($fk_id_sucursal <1 || $fk_id_sucursal > 13){
  $err_empresa=1;
  $err_modulo='so_factura/ajax/insertBill.php';
  $err_desc_error= 'sucursal fuera de rengo valido (1-13)';
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
$str_nota = 3;
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

$id_factura_new = $prefolio.substr("000{$ultimo_dia}", -$str_nota);

 $sql="INSERT INTO so_factura(fk_id_empresa,fk_id_sucursal,id_factura,numero_factura,fecha_factura,fk_id_cliente,fk_id_medico,
 fk_id_usuario,afecta_comision,fk_id_tipo_pago,imp_subtotal,porc_descuento,porc_incremento,imp_total,
 a_cuenta,resta,observaciones,diagnostico,estado_factura,origen,fecha_hora_impresa,
 fecha_entrega,vmedico,estado_concilia,email_medico,email_paciente,requiere_factura,publicidad,turno_num,
 turno_hora,urgente,pendiente,fecha_ctl,cose_dia,id_factura_new,id_factura_old,fk_id_conocio,whatsapp) 
 VALUES (1,'$fk_id_sucursal','$id_factura_new','$numero_factura','$fecha_factura','$fk_id_cliente','$fk_id_medico','$fk_id_usuario',
 '$afecta_comision','$fk_id_tipo_pago','$imp_subtotal','$porc_descuento','$porc_incremento','$imp_total',
 '$a_cuenta','$resta','$observaciones','$diagnostico','$estado_factura','$origen','$fecha_factura',
 '$fechaentrega','$medico_aux','A','$e_medico','$e_paciente','$r_factura','$acepta_p','$numturno',
 '$horaturno','$urgente_p','$pendiente_p',$prefolio,$ultimo_dia,$id_factura_new,0,$conocio,$whatsapp_p)";
// echo $sql;
 $query_new_insert = mysqli_query($con,$sql);
   if ($query_new_insert){
      $last_id = $con->insert_id;
// sen substituye el id_factura calculado por el auntonext.
      $last_id = $id_factura_new;

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
// *** Codigo para verificar si el estudio tiene plantilla      ***
// *** JPM 26ago2024                                            *** 
// *** Se elabora para el modulo de administracion de muestras  ***

//  obtenemos la informacion del estudio y vreerificamos si tiene plantilla
        $existe_p = 0;
        $sql_estudio="SELECT es.`fk_id_plantilla` FROM km_estudios es WHERE es.`estatus` = 'A' AND es.id_estudio = $studio_id"
        if ($res_estudio = mysqli_query($con, $sql_estudio)) {
          while($row_estudio = $res_estudio->fetch_assoc())
          {
              $existe_p = 0;
              $fk_id_plantilla=$row_estudio['fk_id_plantilla'];
              switch ($fk_id_plantilla) {
                case '1':
                  $q_p1 = mysqli_query($con,"SELECT id_valor FROM cr_plantilla_1 WHERE estado = 'A' AND fk_id_estudio = $studio_id");
                  $r_p1 = mysqli_fetch_array($q_p1);
                  $nr = mysqli_num_rows($q_p1); 
                  if($nr == 1){           
                      $existe_p = 1; // existe
                  }else{
                      $existe_p = 0; // mo existe
                  }
                  break;
                case '2':
                  $q_p2 = mysqli_query($con,"SELECT id_valor FROM cr_plantilla_2 WHERE estado = 'A' AND fk_id_estudio = $studio_id");
                  $r_p2 = mysqli_fetch_array($q_p2);
                  $nr = mysqli_num_rows($q_p2); 
                  if($nr == 1){           
                      $existe_p = 1; // existe
                  }else{
                      $existe_p = 0; // mo existe
                  }
                    break;                
                default:
                  # code...
                  break;
              }
          }
        }

        //Datos del destinatario
        //Paciente
        $usuario = 'Daniela M. Olivares M.';
        $e_paciente = 'daniela.olivares@medisyslabs.com.mx';
        //Medico
        $medico = $medico;
        $e_medico = $e_medico;
        //Estudio
        $estudio = $desc_estudio;
        //Asunto
        $subject = utf8_decode('Resultado de estudios');
        //Mensaje
        $mensage = utf8_decode('Resultados del estudio: '.$estudio.' del paciente: '.$paciente); 
        //echo 'datos -->'.$estudio.$mensage;
        //Este bloque es importante
        $mail = new PHPMailer();
        try{
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.ionos.mx";   //"laboratoriosarca.com.mx";
        $mail->Port = 587;
        
        
        //Nuestra cuenta
        $mail->Username ='atencion.clientes@laboratoriosarca.mx';
        $mail->Password = 'Arca_2021'; //Su password
         
        //Agregar destinatario
        //Recipients
        
        //De
        $mail->setFrom('atencion.clientes@laboratoriosarca.mx', 'Laboratorios Arca');
        
        
        //Para
        if($enviar == 1)
        {
          $mail->addAddress($e_medico,$medico);
        }else
        if($enviar == 2)
        {
          $mail->addAddress($e_paciente,$paciente);
        }else
        {
          $mail->addAddress($e_paciente,$paciente);
        }
        
        $mail->addCC('marisol.briceno@laboratoriosarca.mx','Copia Resultado enviado');
        
        //Para adjuntar archivo
        $mail->AddAttachment("../emails/".$fac."_".$studio.".pdf");
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    ='<h4>'.$mensage.'</h4>';
        $mail->AltBody = $mensage;
        
        //$mail->MsgHTML("Prueba de mensaje para ARCA");
        //echo 'mail -->'.'../emails/'.$fac.'_'.$studio.'.pdf';
        $mail->Send();
        
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => true,
            'allow_self_signed' => true
        ));
        echo 1;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }



        if ($existe == 0){


        }


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
