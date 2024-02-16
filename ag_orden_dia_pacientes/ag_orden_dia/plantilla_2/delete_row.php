<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);


    $id_factura=$data['id_factura'];
    $id_studio=$data['id_studio'];

    $sql_delete_rows="delete from cr_plantilla_2_re where fk_id_factura=".$id_factura." and fk_id_estudio=".$id_studio;
    //  echo $sql_delete_rows;
    $execute_query_delete = mysqli_query($con,$sql_delete_rows);


header('Content-Type: application/json');
//Guardamos los datos en un array
$datos = array(
'eliminado' => 'ok'
);
//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);



?>
