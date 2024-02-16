<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

$fecha = date("Y-m-d H:i:s");

$in_fac = $_GET['in_fac'];
$in_est = $_GET['in_est'];

$existe = "SELECT COUNT(*) as veces FROM cr_plantilla_2_re WHERE fk_id_factura  = $in_fac AND fk_id_estudio = $in_est";
$query_new_insert = mysqli_query($con,$existe);
$row = mysqli_fetch_array($query_new_insert);
$veces = $row['veces'];

if($veces > 0)
{
    $val = 1;
}else
{
    $data=json_decode($_POST['datas'],true);

    foreach($data as $objeto)
    {
        $orden=$objeto['orden'];
        $tipo=$objeto['tipo'];
        $concepto=$objeto['concepto'];
        $resultado=$objeto['resultado'];
        $verificado=$objeto['verificado'];
        $observaciones=$objeto['observaciones'];
        $id_factura=$objeto['id_factura'];
        $id_studio=$objeto['id_studio'];

        if($id_studio == 307 || $id_studio == 939 || $id_studio == 1147 || $id_studio == 485 || $id_studio == 486 || $id_studio == 964 || $id_studio == 969 || $id_studio == 1205 || $id_studio == 1209)
        {
            $validado = 1;
        }else
        {
            $validado = 0;
        }

        $sql="INSERT INTO cr_plantilla_2_re(fk_id_empresa,fk_id_factura,fk_id_estudio,orden,tipo,concepto,valor,verificado,observaciones,origen,fecha_registro,validado,fecha_validacion) VALUES (0,$id_factura,$id_studio,$orden,'$tipo','$concepto','$resultado','$verificado','$observaciones','C','$fecha',$validado,'$fecha')";
        //echo $sql;
        $query_new_insert = mysqli_query($con,$sql);
    
    }

    $val = 2;
}


header('Content-Type: application/json');
//Guardamos los datos en un array
echo $val;
//Devolvemos el array pasado a JSON como objeto
//echo json_encode($datos, JSON_FORCE_OBJECT);



?>
