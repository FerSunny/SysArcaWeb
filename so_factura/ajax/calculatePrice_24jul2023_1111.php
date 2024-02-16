<?php
session_start();
date_default_timezone_set('America/Mexico_City');
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

$data=json_decode($_POST['datas'],true);

$descuento=$data['descuento'];
$incremento=$data['incremento'];
$acuenta=$data['acuenta'];
$id_factura=$data['accion'];

$sTable = "km_estudios";
$total=0;
$valueTemp=0;

$totalMenosDescuento=0;
$totalMasIncremento=0;
$totalMasMenosIncrementos=0;
$saldo=0;

$arregloDescuentosXEstudio=array();
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

$fecha_system="";




function aplicarPromocion($dia,$sucursal,$datos) {
  if($datos[$dia]=='S'){

    //validar la sucursal, esto no se debe hacer debido a que aqui se esta comparando
    //manualmente el id de la sucursal y si agregaran otra sucursal al sistema tendrian que venir
    //a agregar la sucursal a esta validacion  
    //
    //la causa de esto es 
    //
    //cuando se va aplicar una promosion, se debe validar si esa sucursal aplica para esa promosion,
    //para saber eso se consulta en la tabla de kg_promosiones y lo malo aqui es que 
    // la tabla muestra los resultados asi  id_promocion|tyly|tuly2|greg|xochi|sant|pablo|teco
    //                                                     S     S     N    S     S    N    S
    //en la descripcion de la sucursal es asi San pablo,Xochimilco,San Pedro

    //no se sabe como comparar los datos de la  tabla de promocion con la descripcion de la sucursal
    //ejemplo  pablo,San pablo
    //         xochi,Xochimilco

    switch($sucursal){
      case 1:
      //  echo 'tuly';
        if($datos['tuly']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 2:
        //echo 'tuly2';
        if($datos['tuly2']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 3:
       // echo 'greg';
        if($datos['greg']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 4:
        //echo 'xochi';
        if($datos['xochi']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 5:
        //echo 'sant';
        if($datos['sant']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 6:
        //echo 'pablo';
        if($datos['pablo']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 7:
        //echo 'pedro';
        if($datos['pedro']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 8:
       // echo 'teco';
        if($datos['teco']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 9:
        //echo 'tete';
        if($datos['tete']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 11:
        //echo 'dino';
        if($datos['dino']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 12:
        //echo 'tla';
        if($datos['tla']=='S'){
          return true;
        }else{
          return false;
        }
      break;
      case 13:
        //echo 'milpa';
        if($datos['milpa']=='S'){
          return true;
        }else{
          return false;
        }
      break;
    }
  }else{
    return false;
  }

}


function obtenerPrecioConPromocion($precio,$promocion) {
  $dividiendoENTRE100_promocion=$promocion/100;
  $multiplicandoXprecio=$precio*$dividiendoENTRE100_promocion;
  $resultado_precio_menos_promocion=$precio-$multiplicandoXprecio;
  
  return round($resultado_precio_menos_promocion,2);
}



for($i=0; $i<count($data['ids']); $i++) {
    //echo "Rating is " . $data['ids'][$i]["id"] . " and the excerpt is " . $data['ids'][$i]["cantidad"] . "<BR>";

    $sql="SELECT costo,fk_id_descuento,fk_id_promosion FROM  $sTable where id_estudio=".$data['ids'][$i]["id"];

    $resultado = mysqli_query($con, $sql);
    $row_rsmyQuery = mysqli_fetch_assoc($resultado);

    $img = $row_rsmyQuery['costo'];
    $sql="";
    $valueTemp=$img*$data['ids'][$i]["cantidad"];

    // obteniendo descuento 
    $sqlDescuentoXEstudio="SELECT por_desc FROM kg_descuentos where id_descuento=".$row_rsmyQuery['fk_id_descuento']." and estado='A'";


    $resultadoDescuentoXEstudio = mysqli_query($con, $sqlDescuentoXEstudio);
    $descuentoXestudio=  mysqli_fetch_assoc($resultadoDescuentoXEstudio);
    $multiplicandoX100=$descuentoXestudio['por_desc']/100;
    $estudioMenosDescuento=$valueTemp*$multiplicandoX100;
    $valueTemp=$valueTemp-$estudioMenosDescuento;




    //aplicando promocion
      $sqlPromocionXEstudio="select porcentaje,fecha_inicio,fecha_final,lunes,martes,miercoles,jueves,viernes,sabado,domingo,tuly,tuly2,greg,xochi,sant,pablo,pedro,teco,tete,tla,estado from kg_promociones
      where id_promocion=".$row_rsmyQuery['fk_id_promosion']." and estado='A'";

      $resultadoSQLpromocion = mysqli_query($con, $sqlPromocionXEstudio);
      $datosPromocion=  mysqli_fetch_assoc($resultadoSQLpromocion);

      if(empty($id_factura)){
        $fecha_system=date("Y-m-d");
        $dia_system=date("l");
      }else{
        //en dado caso que sea una actualizacion, obtenemos la fecha de la factura para saber si aplica o no
        //la promocion

        $sqlGetDateBill="SELECT fecha_factura,DAYNAME(fecha_factura) as dia_semana FROM so_factura where id_factura=".$id_factura;
        //echo $sqlGetDateBill;
        $executeSQL= mysqli_query($con, $sqlGetDateBill);
        $getDataSQL=mysqli_fetch_assoc($executeSQL);

        $fecha_system=date($getDataSQL['fecha_factura']);
        $dia_system=$getDataSQL['dia_semana'];
      //  echo $fecha_system;
      }
      $fecha_inicio =  date( $datosPromocion['fecha_inicio']);
      $fecha_final =  date( $datosPromocion['fecha_final']);

      //echo 'fecha_system '.$fecha_system;
      if($fecha_system>=$fecha_inicio && $fecha_system<=$fecha_final){

        //$fechaSpliteada = explode("-", $fecha_system);

        //echo 'en fecha ***'.date('w', strtotime($fechaSpliteada[2])).' ***';
        //date('w', strtotime($fechaSpliteada[2]) obtiene el dia de la semana 
        //echo 'aqui '.$dia_system;
        switch($dia_system){
          case 'Wednesday':
           // echo 'miercoles';
            if(aplicarPromocion('miercoles',$fk_id_sucursal,$datosPromocion)){
              $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
            } 
            break;
          case 'Thursday':
           // echo 'jueves';
            if($datosPromocion['jueves']  ){
              if(aplicarPromocion('jueves',$fk_id_sucursal,$datosPromocion)){
              //  echo 'aplicar promosion';
                $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
              } 
            }
            break;
          case 'Friday':
           // echo 'viernes';
            if($datosPromocion['viernes']){
              if(aplicarPromocion('viernes',$fk_id_sucursal,$datosPromocion)){
              //  echo 'aplicar promosion';
                $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
              }
            }
            break;
          case 'Saturday':
           // echo 'sabado';
            if($datosPromocion['sabado']){
              if(aplicarPromocion('sabado',$fk_id_sucursal,$datosPromocion)){
              //  echo 'aplicar promosion';
                $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
              }
            }
            break;
          case 'Sunday':
           // echo 'domingo';
            if($datosPromocion['domingo']){
              if(aplicarPromocion('domingo',$fk_id_sucursal,$datosPromocion)){
                //echo 'aplicar promosion';
                $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
              }
            }
            break;
          case 'Monday':
            //echo 'lunes';
            if($datosPromocion['lunes']){
              if(aplicarPromocion('lunes',$fk_id_sucursal,$datosPromocion)){
                //echo 'aplicar promosion';
                //echo 'p1='.$valueTemp.'=';
                //echo 'p2='.$datosPromocion['porcentaje'].'=';
                $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
                //echo 'p3='.$valueTemp.'=';
              }
            }
            break;
          case 'Tuesday':
            //echo 'martes';
            if($datosPromocion['martes']){
              if(aplicarPromocion('martes',$fk_id_sucursal,$datosPromocion)){
              //  echo 'aplicar promosion';
                $valueTemp=obtenerPrecioConPromocion($valueTemp,$datosPromocion['porcentaje']);
              }
            }
          break;
        }
      }


    //lista de descuentos por estudio 
    
    array_push($arregloDescuentosXEstudio,$valueTemp);

    $total=$total+$valueTemp;


    $valueTemp=0;
}
//echo 'el total es '. $total;
//echo 'valor= ****'.$total;
if($descuento>0){
  $multiplicando=$total*$descuento;
  $valorPorcentajeDescuento=$multiplicando/100;
  $totalMenosDescuento=$total-$valorPorcentajeDescuento;
  //echo 'suma descuento='.$totalMenosDescuento;
}else{
  $totalMenosDescuento=$total;
  //echo 'no suma descuento='.$totalMenosDescuento;
}

if($incremento>0){
  
  $multiplicando=$totalMenosDescuento*$incremento;
  $valorPorcentajeIncremento=$multiplicando/100;
  $totalMasIncremento=$totalMenosDescuento+$valorPorcentajeIncremento;
  //echo 'suma incremento'.$totalMasIncremento;
}else{
  $totalMasIncremento=$totalMenosDescuento;
  //echo 'no suma incremento='.$totalMasIncremento;
}

//este es el total , a este se le aplicara a/cuenta
$totalMasMenosIncrementos=$totalMasIncremento;

if($acuenta>0){
  $saldo=$totalMasMenosIncrementos-$acuenta;
}else{
  $saldo=$totalMasMenosIncrementos;
}
//echo 'saldo='.$saldo;
header('Content-Type: application/json');
echo json_encode(array('subtotal' => $total,'descuento'=>$totalMenosDescuento,'incremento'=>$totalMasIncremento,'total'=>$totalMasMenosIncrementos,'saldo'=>$saldo,'array_descuentos'=>$arregloDescuentosXEstudio));

?>
