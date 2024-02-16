<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos


$in_fac = $_GET['in_fac'];
$in_est = $_GET['in_est'];

$existe = "SELECT COUNT(*) as veces FROM cr_plantilla_cvo_re WHERE fk_id_factura  = $in_fac AND fk_id_estudio = $in_est";
$query_new_insert = mysqli_query($con,$existe);
$row = mysqli_fetch_array($query_new_insert);
$veces = $row['veces'];


if($veces > 0)
{
    $val = 1;
}else
{
    $data=json_decode($_POST['datas'],true);
    $fecha = date("Y-m-d H:i:s");


    //$eritrocitos='0';
    //$hematocrito='0';
    //$hemoglobina='0';
    foreach($data as $objeto){
        $orden=$objeto['orden'];
        $tipo=$objeto['tipo'];
        $concepto=$objeto['concepto'];
        $resultado=$objeto['resultado'];

        //$verificado=$objeto['verificado'];

        $observaciones=$objeto['observaciones'];
        $id_factura=$objeto['id_factura'];
        $id_studio=$objeto['id_studio'];

        //$valor_refe=$objeto['valor_refe'];
        //$unidad_medida=$objeto['unidad_medida'];

        $tamfue=$objeto['tamfue'];
        $tipfue=$objeto['tipfue'];
        $posini=$objeto['posini'];

    //echo 'valor=** '.$verificado.' **';
        /*
        if($concepto=='Eritrocitos'){
            $eritrocitos=$resultado;
        }

        if($concepto=='Hematocrito'){
            $hematocrito=$resultado;
        }

        if($concepto=='Hemoglobina'){
            $hemoglobina=$resultado;
        }

        if($concepto=='Volumen Corpuscular Medio (VCM)'){
            $resultado=bcdiv((($hematocrito/($eritrocitos/1000000))*10),'1',2);    }

        if($concepto=='Conc Media de Hemoglobina (CMH)'){
            $resultado=bcdiv((($hemoglobina/($eritrocitos/1000000))*10),'1',2);    }

        if($concepto=='Conc Media de Hemoglobina Corpuscular (CMHC)'){
            $resultado=bcdiv((($hemoglobina/$hematocrito)*100),'1',2);    }
    */
        $sql="INSERT INTO cr_plantilla_cvo_re(fk_id_empresa,fk_id_factura,fk_id_estudio,orden,tipo,concepto,valor,observaciones,num_imp,tamfue,tipfue,posini,fecha_registro) VALUES (1,'$id_factura','$id_studio','$orden','$tipo','$concepto','$resultado','$observaciones',0,'$tamfue','$tipfue','$posini','$fecha')";
        //echo $sql;
        $query_new_insert = mysqli_query($con,$sql);

    }

    $val = 2;

}


header('Content-Type: application/json');
//Guardamos los datos en un array
echo $val;
//Devolvemos el array pasado a JSON como objeto
//&echo json_encode($datos, JSON_FORCE_OBJECT);



?>
