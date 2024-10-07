<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$fk_id_numeral_1=$_SESSION['id_numeral_1'];




$codigo  = $_POST['codigo'];

$desc_numeral_2 = $_POST['desc_numeral_2'];


$query ="
INSERT INTO sgc_indice_dos
            (fk_id_empresa,
             id_numeral_2,
             fk_id_numeral_1,
             desc_numeral_2,
             estado)
VALUES (1,
        $codigo,
        '$fk_id_numeral_1',
        '$desc_numeral_2',
        'A');
";

//echo 'Query:'.$query;

$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{
//echo 'erro:';
  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>

