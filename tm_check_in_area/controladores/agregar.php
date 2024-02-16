<?php 



session_start();

include ("../../controladores/conex.php");
require('../../fpdf/fpdf.php');

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['id_usuario'];
$clave=$_SESSION['clave'];

$codigo  = $_POST['codigo'];

$tulye = $_POST['tulye'];
$box_tulye = $_POST['box_tulye'];

$tlahuac = $_POST['tlahuac'];
$box_tlahuac= $_POST['box_tlahuac'];  


$gregorio = $_POST['gregorio']; 
$box_gregorio= $_POST['box_gregorio'];  

$xochimilco = $_POST['xochimilco']; 
$box_xochimilco = $_POST['box_xochimilco'];  

$dino = $_POST['dino']; 
$box_dino= $_POST['box_dino'];  

$santiago = $_POST['santiago']; 
$box_santiago= $_POST['box_santiago'];  

$pablo = $_POST['pablo']; 
$box_pablo= $_POST['box_pablo'];  

$pedro = $_POST['pedro']; 
$box_pedro= $_POST['box_pedro'];  

$milpa = $_POST['milpa']; 
$box_milpa= $_POST['box_milpa'];  

$tecomitl = $_POST['tecomitl']; 
$box_tecomitl= $_POST['box_tecomitl'];  

$tetelco = $_POST['tetelco']; 
$box_tetelco= $_POST['box_tetelco'];  

// verificamos que exista la informacion del order by por usuario y area
$stmt_existe = mysqli_query($conexion,"SELECT * FROM tm_orden WHERE fk_id_usuario  ='$id_usuario' and fk_id_clave = '$clave' AND estado ='A'");
$nr     = mysqli_num_rows($stmt_existe);  
if($nr > 0){
  $stmt_update=
  "
  UPDATE  tm_orden 
    SET  
      tulye  =   $tulye  ,
      imp_tulye = $box_tulye,

      tlahuac  =   $tlahuac  ,
      imp_tlahuac = $box_tlahuac,

      gregorio  =   $gregorio  ,
      imp_gregorio  =   $box_gregorio  ,

      xochimilco  =   $xochimilco  ,
      imp_xochimilco  =   $box_xochimilco  ,

      dino  =   $dino  ,
      imp_dino  =   $box_dino  ,

      santiago  =   $santiago  ,
      imp_santiago  =   $box_santiago  ,

      pablo  =   $pablo  ,
      imp_pablo  =   $box_pablo  ,

      pedro  =   $pedro  ,
      imp_pedro  =   $box_pedro  ,

      milpa  =   $milpa  ,
      imp_milpa  =   $box_milpa  ,

      tecomitl  =   $tecomitl  ,
      imp_tecomitl  =   $box_tecomitl  ,

      tetelco  =   $tetelco  ,
      imp_tetelco  =   $box_tetelco  

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
              imp_tulye,

              tlahuac ,
              imp_tlahuac,

              gregorio ,
              imp_gregorio ,

              xochimilco ,
              imp_xochimilco ,

              dino ,
              imp_dino ,

              santiago ,
              imp_santiago ,

              pablo ,
              imp_pablo ,

              pedro ,
              imp_pedro ,

              milpa ,
              imp_milpa ,

              tecomitl ,
              imp_tecomitl ,

              tetelco ,
              imp_tetelco ,

              estado )
VALUES (  1  ,
          0  ,
          $id_usuario  ,
          '$clave'  ,

          $tulye  ,
          $box_tulye,

          $tlahuac  ,
          $box_tlahuac,

          $gregorio  ,
          $box_gregorio  ,

          $xochimilco  ,
          $box_xochimilco,

          $dino  ,
          $box_dino  ,

          $santiago  ,
          $box_santiago  ,

          $pablo  ,
          $box_pablo  ,

          $pedro  ,
          $box_pedro  ,

          $milpa  ,
          $box_milpa  ,

          $tecomitl  ,
          $box_tecomitl  ,

          $tetelco  ,
          $box_tetelco  ,
          'A'  );

  ";
  $result = $conexion -> query($stmt_insert);
  if ($result) {
    $estatus = 1;
  }else{
    $estatus = mysqli_errno($conexion);
  }
}




    echo $estatus;


$conexion->close();



?>

