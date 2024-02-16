<?php 



session_start();

include ("../../controladores/conex.php");
require('../../fpdf/fpdf.php');

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['id_usuario'];
$clave=$_SESSION['clave'];

$codigo  = $_POST['codigo'];

$tulye = $_POST['tulye'];
$tlahuac = $_POST['tlahuac']; 
$gregorio = $_POST['gregorio']; 

$xochimilco = $_POST['xochimilco']; 
$dino = $_POST['dino']; 
$santiago = $_POST['santiago']; 

$pablo = $_POST['pablo']; 
$pedro = $_POST['pedro']; 
$milpa = $_POST['milpa']; 

$tecomitl = $_POST['tecomitl']; 
$tetelco = $_POST['tetelco']; 

// verificamos que exista la informacion del order by por usuario y area
$stmt_existe = mysqli_query($conexion,"SELECT * FROM tm_orden WHERE fk_id_usuario  ='$id_usuario' and fk_id_clave = '$clave' AND estado ='A'");
$nr     = mysqli_num_rows($stmt_existe);  
if($nr > 0){
  $stmt_update=
  "
  UPDATE  tm_orden 
    SET  
      tulye  =   $tulye  ,
      tlahuac  =   $tlahuac  ,
      gregorio  =   $gregorio  ,
      xochimilco  =   $xochimilco  ,
      dino  =   $dino  ,
      santiago  =   $santiago  ,
      pablo  =   $pablo  ,
      pedro  =   $pedro  ,
      milpa  =   $milpa  ,
      tecomitl  =   $tecomitl  ,
      tetelco  =   $tetelco  
    WHERE  fk_id_usuario  =   $id_usuario
    AND fk_id_clave = '$clave'
  ";
  //echo $stmt_update;

  $result_update = $conexion -> query($stmt_update);
  if($result_update){
    $estatus = 1;
  }else{
    $estatus = mysqli_errno($conexion);
  }
}else{
  $stmt_insert =
  "
  INSERT INTO  tm_orden 
            ( fk_id_empresa ,
              id_orden ,
              fk_id_usuario ,
              fk_id_clave ,
              tulye ,
              tlahuac ,
              gregorio ,
              xochimilco ,
              dino ,
              santiago ,
              pablo ,
              pedro ,
              milpa ,
              tecomitl ,
              tetelco ,
              estado )
VALUES (  1  ,
          0  ,
          $id_usuario  ,
          '$clave'  ,
          $tulye  ,
          $tlahuac  ,
          $gregorio  ,
          $xochimilco  ,
          $dino  ,
          $santiago  ,
          $pablo  ,
          $pedro  ,
          $milpa  ,
          $tecomitl  ,
          $tetelco  ,
          'A'  );

  ";
  $result = $conexion -> query($stmt_insert);
  if ($result) {
    $estatus = 1;
  }else{
    $estatus = mysqli_errno($conexion);
  }
}




    echo 1;


$conexion->close();



?>

