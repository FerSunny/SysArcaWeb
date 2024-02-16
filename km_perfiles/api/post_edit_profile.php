<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../db/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../db/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);

$sTableInsert = "km_perfil";
$fk_id_empresa=1;

$id_perfil=$data['id_perfil'];
$iniciales=$data['iniciales'];
$urgente=$data['urgente'];
$tiempo_entrega=$data['tiempo_entrega'];
//$costo=$data['costo'];
$costo=0;
$fk_id_comision=$data['fk_id_comision'];
$fk_id_descuento=$data['fk_id_descuento'];
$fk_id_promosiones=$data['fk_id_promosion'];
$estado=$data['estado'];
$desc_perfil=$data['desc_perfil'];
$observaciones=$data['observaciones'];

$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

/*if(strlen($fechaentrega)>0){

}*/

 $sql="UPDATE km_perfil SET iniciales='$iniciales', desc_perfil='$desc_perfil', urgente='$urgente',tiempo_entrega='$tiempo_entrega',costo='$costo',observaciones='$observaciones',fk_id_comision='$fk_id_comision',fk_id_descuento='$fk_id_descuento',fk_id_promosion='$fk_id_promosiones',estado='$estado' WHERE id_perfil=".$id_perfil;
 //echo $sql;
 $query_update = mysqli_query($con,$sql);
   if ($query_update){
     
        $sql="delete from km_perfil_detalle where fk_id_perfil=".$id_perfil;
        $query_delete = mysqli_query($con,$sql);

        if($query_delete){
            for($i=0; $i<count($data['estudios']); $i++) {
                  $studio_id=$data['estudios'][$i]['id'];
                  $estudio_cantidad=$data['estudios'][$i]['cantidad'];
                  $estudio_precio_venta=$data['estudios'][$i]['precio_venta'];
          
                  $sql="INSERT INTO km_perfil_detalle(fk_id_perfil,fk_id_estudio,cantidad,precio_venta)VALUES
                  ('$id_perfil','$studio_id','$estudio_cantidad','$estudio_precio_venta')";
                  //echo $sql;
                  $query_new_insert = mysqli_query($con,$sql);
                }
          
                header('Content-Type: application/json');
                //Guardamos los datos en un array
                $datos = array(
                'estado' => 'ok'
                );
                //Devolvemos el array pasado a JSON como objeto
                echo json_encode($datos, JSON_FORCE_OBJECT);
        }

      

   }else{
     echo 'error al guardar la factura';
   }


?>
