<?php

date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

/* guardar quien modifico */
session_start();
    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
    $usuario= $_SESSION['nombre'];

    $ip_publica=$_SERVER['REMOTE_ADDR'];
    $navegador=getenv('HTTP_USER_AGENT');

    $exec = exec("hostname");
    $hostname = trim($exec);
    $ip_local = gethostbyname($hostname); 

/* guardar quien modifico */

$data=json_decode($_POST['datas'],true);

//$sTableInsert = "so_factura";
$fk_id_empresa=1;
$numero_factura=2;
//$fecha_factura=date("Y-m-d H:i:s");
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
$origen=1;
$id_factura=$data['factory_id'];
$medico_aux=$data['medico_aux'];
$e_medico=$data['e_medico'];
$e_paciente=$data['e_paciente'];
$r_factura=$data['r_factura'];
$acepta_p=$data['acepta_p'];

/*if(strlen($fechaentrega)>0){

}*/

    $insert="INSERT INTO au_alter_fac (fk_id_sucursal,fk_id_usuario,ip_publica,nombre_pc,fecha_inicio,fecha_fin,navegador,ip_local,fk_id_factura) VALUES('$fk_id_sucursal','$usuario','$ip_publica','0',NOW(),NOW(),'$navegador','$ip_local','$id_factura')";
    $resultado = mysqli_query($con, $insert);

 $sql="UPDATE so_factura SET fk_id_empresa=1,fk_id_cliente='$fk_id_cliente',fk_id_medico='$fk_id_medico',fk_id_usuario='$fk_id_usuario',afecta_comision='$afecta_comision',fk_id_tipo_pago='$fk_id_tipo_pago',imp_subtotal='$imp_subtotal',porc_descuento='$porc_descuento',porc_incremento='$porc_incremento',imp_total='$imp_total',a_cuenta='$a_cuenta',resta='$resta',observaciones='$observaciones',diagnostico='$diagnostico',estado_factura='$estado_factura',origen='$origen',fecha_entrega='$fechaentrega',vmedico='$medico_aux', email_medico = $e_medico, email_paciente = $e_paciente, requiere_factura = $r_factura, publicidad = $acepta_p WHERE id_factura=".$id_factura;
 //echo $sql;
 $query_update = mysqli_query($con,$sql);
   if ($query_update){

    //obtenemos todos los diagnosticos actuamente registrados

    $sql="select fk_id_estudio from so_detalle_factura where id_factura=".$id_factura;

    $resultado_diagnosticos = mysqli_query($con, $sql);
    $array_ids_estudios=array();    
    
    while ($row = mysqli_fetch_assoc($resultado_diagnosticos)) {
      //echo $row["fk_id_estudio"];
      array_push($array_ids_estudios,$row["fk_id_estudio"]);
    }


     // for($j=0;$j<count($array_ids_estudios);$j++){
//        echo $array_ids_estudios[$j];  
      //}


      $array_diagnosticos_agregados=array();
      $array_diagnosticos_eliminados=array();

        //for para saber que diagnosticos se eliminaron
        for ($m=0;$m<count($array_ids_estudios);$m++){
            $flag=false;
          for($k=0;$k<count($data['estudios']);$k++){
            if($array_ids_estudios[$m]==$data['estudios'][$k]['id']){
              $flag=true;
              break;
            }
          }
          if($flag==false){
            array_push($array_diagnosticos_eliminados,$array_ids_estudios[$m]);
          } 
        }
 
        //for para saber que diagnosticos se agregaron
        for ($m=0;$m<count($data['estudios']);$m++){
          $exist_diagnostic=false;
          for($k=0;$k<count($array_ids_estudios);$k++){
            if($array_ids_estudios[$k]==$data['estudios'][$m]['id']){
              $exist_diagnostic=true;
              break;
            }
          }
          if($exist_diagnostic==false){
            array_push($array_diagnosticos_agregados,$data['estudios'][$m]['id']);
          } 
      }


      for($i=0; $i<count($array_diagnosticos_eliminados); $i++) {
        
        $sql="DELETE FROM so_detalle_factura WHERE fk_id_estudio=".$array_diagnosticos_eliminados[$i]." and id_factura=".$id_factura;
        $query_delete = mysqli_query($con,$sql);
      }



      //insertamos los nuevos diagnosticos
      for($i=0; $i<count($data['estudios']); $i++) {
        for($j=0;$j<count($array_diagnosticos_agregados);$j++){
            if($array_diagnosticos_agregados[$j]==$data['estudios'][$i]['id']){
              
              $studio_id=$data['estudios'][$i]['id'];
              $estudio_cantidad=$data['estudios'][$i]['cantidad'];
              $estudio_precio_venta=$data['estudios'][$i]['precio_venta'];
      
              $sql="INSERT INTO so_detalle_factura(fk_id_empresa,id_factura,numero_factura,fk_id_estudio,cantidad,precio_venta)VALUES
              (1,'$id_factura','$numero_factura','$studio_id','$estudio_cantidad','$estudio_precio_venta')";
            //  echo $sql;
              $query_new_insert = mysqli_query($con,$sql);
            }
        }

      }

      header('Content-Type: application/json');
      //Guardamos los datos en un array
      $datos = array(
      'estado' => 'ok'
      );
      //Devolvemos el array pasado a JSON como objeto
      echo json_encode($datos, JSON_FORCE_OBJECT);

   }else{
     echo 'error al guardar la factura';
   }


//
//
// for($i=0; $i<count($data['ids']); $i++) {
//     //echo "Rating is " . $data['ids'][$i]["id"] . " and the excerpt is " . $data['ids'][$i]["cantidad"] . "<BR>";
//
// }
//
//
// INSERT INTO `bd_arca`.`so_factura`
// (`fk_id_empresa`,`numero_factura`,`fecha_factura`,`id_cliente`,`fk_id_medico`,`fk_id_usuario`,`afecta_comision`,`fk_id_tipo_pago`,`imp_subtotal`,`porc_descuento`,`porc_incremento`,`imp_total`,`a_cuenta`,`resta`,`observaciones`,`diagnostico`,`estado_factura`,`origen`)
// VALUES(1,2,now(),9,0,1,0,1,0.0,0.0,0.0,0.0,0.0,0.0,'holaaaa',1,0,1);
//
// header('Content-Type: application/json');
// echo json_encode(array('subtotal' => $total,'descuento'=>$totalMenosDescuento,'incremento'=>$totalMasIncremento,'total'=>$totalMasMenosIncrementos,'saldo'=>$saldo));

?>
