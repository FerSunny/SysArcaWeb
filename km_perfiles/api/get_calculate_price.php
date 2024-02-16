<?php

date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../db/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../db/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);


$sTable = "km_estudios";
$total=0;
$valueTemp=0;


for($i=0; $i<count($data['ids']); $i++) {
    //echo "Rating is " . $data['ids'][$i]["id"] . " and the excerpt is " . $data['ids'][$i]["cantidad"] . "<BR>";

    $sql="SELECT costo FROM  $sTable where id_estudio=".$data['ids'][$i]["id"];

    $resultado = mysqli_query($con, $sql);
    $row_rsmyQuery = mysqli_fetch_assoc($resultado);

    $img = $row_rsmyQuery['costo'];
    $sql="";
    //echo $img;
   // echo 'cantidad '. $data['ids'][$i]["cantidad"];
    $valueTemp=$img*$data['ids'][$i]["cantidad"];
   // echo 'el valor de img es '.$img;
   // echo 'la multiplicacion es '.$valueTemp;
    $total=$total+$valueTemp;
    $valueTemp=0;
}


header('Content-Type: application/json');
echo json_encode(array('subtotal' => $total));

?>
