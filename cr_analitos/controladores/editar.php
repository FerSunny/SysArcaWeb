<?php 





session_start();

include ("../../controladores/conex.php");




$codigo  = $_POST['codigo'];


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
$leyenda=$_POST['leyenda'];
$bibliografia=$_POST['bibliografia'];


$query = "
UPDATE   cr_analitos  
SET    
    desc_analito   = '$desc_analito',
    abreviacion   = '$abreviacion',
    fk_id_sexo   = '$fk_id_sexo',
    edad_inicial   = '$edad_inicial',
    edad_final   = '$edad_final',
    limite_inferior   = '$limite_inferior',
    limite_superior   = '$limite_superior',
    fk_id_unidad_medida   = '$fk_id_unidad_medida',
    qs_680   = '$qs_680',
    xn_550   = '$xn_550',
    h8   = '$h8',
    alinity   = '$alinity',
    uro   = '$uro',
    leyenda   = '$leyenda',
    bibliografia   = '$bibliografia'
WHERE   id_analito   = '$codigo'
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





































































