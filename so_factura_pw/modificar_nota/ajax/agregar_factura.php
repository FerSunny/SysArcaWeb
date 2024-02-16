<?php
require_once ("../config/db.php");
require_once ("../config/conexion.php");
date_default_timezone_set('America/Mexico_City');
$f_nombre = $_POST['f_nombre'];
$f_rfc = $_POST['f_rfc'];
$f_dom = $_POST['f_dom'];
$f_mail = $_POST['f_mail'];
$f_usos = $_POST['f_usos'];
$fecha = date("Y-m-d H:i:s");

$stmt = $con->prepare("INSERT INTO so_facturacion(nombre,rfc,domicilio,email,fk_id_usos,fecha_registro)
                        VALUES (?,?,?,?,?,?)");

$stmt->bind_param("ssssis",$f_nombre,$f_rfc,$f_dom,$f_mail,$f_usos,$fecha);
if($stmt->execute()){
	$last_id = $con->insert_id;
	header('Content-Type: application/json');
	$datos = array(
      'id' => $last_id,
      'ok' => '1'
      );
      //Devolvemos el array pasado a JSON como objeto
      echo json_encode($datos, JSON_FORCE_OBJECT);

}else {
	header('Content-Type: application/json');
  $codigo = mysqli_errno($con);
  $datos = array(
      'codigo' => $codigo
      );
      //Devolvemos el array pasado a JSON como objeto
      echo json_encode($datos, JSON_FORCE_OBJECT);
}


?>
