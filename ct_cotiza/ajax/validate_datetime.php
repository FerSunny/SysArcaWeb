<?php
//$data=json_decode($_POST['validatedate']);
date_default_timezone_set('America/Mexico_City');

$date1 = new DateTime("now");
$date2 = new DateTime($_POST['fechaentrega']);


if($date2>$date1){
  echo "true";
}else{
  echo "false";
}

// if ((isset($_POST['fechaentrega']))) {
//   //echo 'hola'
//   $format="Y-m-d H:i:s";
//   $fecha_system=date("Y-m-d H:i:s");
//   echo $_POST['fechaentrega'];
//   if($_POST['fechaentrega']>$fecha_system){
//
//   //  header('Content-Type: application/json');
//     // $datos = array(
//     //   'estado' => 'ok'
//     // );
//     echo "true";
//   }else {
//            echo "false";
//   }
// }

//$date = DateTime::createFromFormat($format,$data['tiempo']);
// $sTableInsert = "so_factura_pre";
// $fk_id_empresa=1;
// $numero_factura=2;
// $fecha_factura=date("Y-m-d H:i:s");
// $id_cliente=$data['id_cliente'];

?>
