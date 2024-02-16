<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$lote  = $_POST['lote'];

$hora_llegada =$_POST['hora_llegada'];

$hora_salida = $_POST['hora_salida']; 

$tem_ref = $_POST['tem_ref'];

$tem_amb = $_POST['tem_amb']; 

$tem_con = $_POST['tem_con']; 

$t_d = $_POST['t_d']; 

$t_r = $_POST['t_r'];

$t_m = $_POST['t_m'];

$t_a = $_POST['t_a'];

$t_sec_sue=$_POST['t_sec_sue'];
$t_sec_pla=$_POST['t_sec_pla'];
$fro_san=$_POST['fro_san'];
$fro_eod=$_POST['fro_eod'];
$fro_cul=$_POST['fro_cul'];
$fro_cult=$_POST['fro_cult'];
$ego_uro=$_POST['ego_uro'];
$heces=$_POST['heces'];
$bx_o_fco_esteril=$_POST['bx_o_fco_esteril'];
$ecg_traz=$_POST['ecg_traz'];
$pap=$_POST['pap'];
$med_stu=$_POST['med_stu'];
$med_liq=$_POST['med_liq'];

$q_existe =
"
select count(*) as existe from tm_lote_detalle 
where lote = '$codigo'
";
if ($r_existe = mysqli_query($conexion, $q_existe)) {
  while($row = $r_existe->fetch_assoc())
  {
      $existe=$row['existe'];
  }
}else{
  $existe=0;
}

if ($existe == 0){
  $hora_llegada =$hora_llegada.':00';
  $hora_salida = $hora_salida.':00'; 

  $query = "
  INSERT INTO `tm_lote_detalle`
              (`fk_id_empresa`,
              `id_lote`,`lote`,`hora_llegada`,`hora_salida`,`tem_ref`,`tem_amb`,
              `tem_con`,`t_d`,`t_r`,`t_m`,`t_a`,`t_sec_sue`,`t_sec_pla`,`fro_san`,
              `fro_eod`,`fro_cul`,`fro_cult`,`ego_uro`,`heces`,`bx_o_fco_esteril`,
              `ecg_traz`,`pap`,`med_stu`,`med_liq`,`estado`)
  VALUES (1,
          0,
          '$codigo','$hora_llegada','$hora_salida','$tem_ref','$tem_amb','$tem_con',
          '$t_d','$t_r','$t_m','$t_a','$t_sec_sue','$t_sec_pla','$fro_san','$fro_eod',
          '$fro_cul','$fro_cult','$ego_uro','$heces','$bx_o_fco_esteril','$ecg_traz',
          '$pap','$med_stu','$med_liq','A');
  ";
  $result = $conexion -> query($query);
  if ($result) {
      echo 1;
  }else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
  }
  $conexion->close();
}else{
      $q_upate="
      UPDATE `tm_lote_detalle`
      SET 
        `hora_llegada` = '$hora_llegada',
        `hora_salida` = '$hora_salida',
        `tem_ref` = '$tem_ref',
        `tem_amb` = '$tem_amb',
        `tem_con` = '$tem_con',
        `t_d` = '$t_d',
        `t_r` = '$t_r',
        `t_m` = '$t_m',
        `t_a` = '$t_a',
        `t_sec_sue` = '$t_sec_sue',
        `t_sec_pla` = '$t_sec_pla',
        `fro_san` = '$fro_san',
        `fro_eod` = '$fro_eod',
        `fro_cul` = '$fro_cul',
        `fro_cult` = '$fro_cult',
        `ego_uro` = '$ego_uro',
        `heces` = '$heces',
        `bx_o_fco_esteril` = '$bx_o_fco_esteril',
        `ecg_traz` = '$ecg_traz',
        `pap` = '$pap',
        `med_stu` = '$med_stu',
        `med_liq` = '$med_liq'
      WHERE lote = '$codigo'
    ";
    //echo $q_upate;
    $result1 = $conexion -> query($q_upate);
    if ($result1) {
        echo 1;
    }else{
      $codigo = mysqli_errno($conexion); 
      echo $codigo;
    }
    $conexion->close();
}





?>





































































