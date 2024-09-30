<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$desc_analito  = $_POST['desc_analito'];

$abreviacion = $_POST['abreviacion'];

$fk_id_sexo = $_POST['fk_id_sexo']; 

$edad_inicial = $_POST['edad_inicial']; 

$edad_final = $_POST['edad_final']; 

$limite_inferior = $_POST['limite_inferior']; 

$limite_superior = $_POST['limite_superior']; 

$fk_id_unidad_medida = $_POST['fk_id_unidad_medida'];

$qs_680 = $_POST['qs_680'];

$xn_550 = $_POST['xn_550'];

$h8=$_POST['h8'];
$alinity=$_POST['alinity'];
$uro=$_POST['uro'];
$bibliografia=$_POST['bibliografia'];


$query ="
INSERT INTO  cr_analitos 
            ( fk_id_empresa ,
              id_analito ,
              desc_analito ,
              abreviacion ,
              fk_id_sexo ,
              edad_inicial ,
              edad_final ,
              limite_inferior ,
              limite_superior ,
              fk_id_unidad_medida ,
              qs_680 ,
              xn_550 ,
              h8 ,
              alinity ,
              uro ,
              bibliografia ,
              estado )
VALUES (1,
        0,
        '$desc_analito',
        '$abreviacion',
        '$fk_id_sexo',
        '$edad_inicial',
        '$edad_final',
        '$limite_inferior',
        '$limite_superior',
        '$fk_id_unidad_medida',
        '$qs_680',
        '$xn_550',
        '$h8',
        '$alinity',
        '$uro',
        '$bibliografia',
        'A');
";



$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>

