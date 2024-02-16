<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);


foreach($data as $objeto){
    $orden=$objeto['orden'];
    $tipo=$objeto['tipo'];
    $concepto=$objeto['concepto'];
    $resultado=$objeto['resultado'];
    $verificado=$objeto['verificado'];
    $observaciones=$objeto['observaciones'];
    $id_factura=$objeto['id_factura'];
    $id_studio=$objeto['id_studio'];

    $sql="INSERT INTO cr_plantilla_2_re(fk_id_empresa,fk_id_factura,fk_id_estudio,orden,tipo,concepto,valor,verificado,observaciones) VALUES (0,$id_factura,$id_studio,$orden,'$tipo','$concepto','$resultado','$verificado','$observaciones')";
    //echo $sql;
    $query_new_insert = mysqli_query($con,$sql);
    
}

header('Content-Type: application/json');
//Guardamos los datos en un array
$datos = array(
'insertado' => 'ok'
);
//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);



?>
