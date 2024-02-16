<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

$fecha = date("Y-m-d H:i:s");

$data=json_decode($_POST['datas'],true);



$flag=false;
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



    // $tamfue=$objeto['tamfue'];
    // $tipfue=$objeto['tipfue'];
    // $posini=$objeto['posini'];

    //el borrado de la tabla se ejecutara solo una ves
    if($flag!=true){
        $sql_delete_rows="delete from cr_plantilla_2_re where fk_id_factura=".$id_factura." and fk_id_estudio=".$id_studio;
      //  echo $sql_delete_rows;
        $execute_query_delete = mysqli_query($con,$sql_delete_rows);
        $flag=true;
    }
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

    $sql="INSERT INTO cr_plantilla_2_re(fk_id_empresa,fk_id_factura,fk_id_estudio,orden,tipo,concepto,valor,verificado,observaciones,num_imp,origen,fecha_registro) VALUES (0,'$id_factura','$id_studio','$orden','$tipo','$concepto','$resultado','$verificado','$observaciones',1,'C','$fecha')";
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
