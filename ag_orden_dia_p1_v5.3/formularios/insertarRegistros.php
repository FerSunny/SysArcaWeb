<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);

$eritrocitos='0';
$hematocrito='0';
$hemoglobina='0';
foreach($data as $objeto){
    $orden=$objeto['orden'];
    $tipo=$objeto['tipo'];
    $concepto=$objeto['concepto'];
    $resultado=$objeto['resultado'];
    
    $verificado=$objeto['verificado'];

    $observaciones=$objeto['observaciones'];
    $id_factura=$objeto['id_factura'];
    $id_studio=$objeto['id_studio'];

    $valor_refe=$objeto['valor_refe'];
    $unidad_medida=$objeto['unidad_medida'];

    $tamfue=$objeto['tamfue'];
    $tipfue=$objeto['tipfue'];
    $posini=$objeto['posini'];

//echo 'valor=** '.$verificado.' **';
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

// se incluye la fecha-Hora de impresion del resultado
    $fecha_registro=date("y/m/d :H:i:s");
    $fecha_impresion=0;

    $sql="INSERT INTO cr_plantilla_1_re(fk_id_empresa,fk_id_factura,fk_id_estudio,orden,tipo,concepto,valor,verificado,valor_refe,unidad_medida,observaciones,num_imp,tamfue,tipfue,posini,fecha_registro,fecha_impresion,origen) VALUES (1,'$id_factura','$id_studio','$orden','$tipo','$concepto','$resultado','$verificado','$valor_refe','$unidad_medida','$observaciones',0,'$tamfue','$tipfue','$posini','$fecha_registro',null,'C')";
    //echo $sql;
    $query_new_insert = mysqli_query($con,$sql);

    //echo $sql;
    
}

header('Content-Type: application/json');
//Guardamos los datos en un array
$datos = array(
'insertado' => 'ok'
);
//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);



?>
