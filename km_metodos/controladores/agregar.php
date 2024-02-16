<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];







$desc_corta = $_POST['desc_corta']; 

$desc_larga = $_POST['desc_larga']; 




$query ="
INSERT INTO km_metodos
            (fk_id_empresa,
             id_metodo,
             desc_metodo,
             desc_corta,
             estado)
VALUES (1,
        0,
        '$desc_larga',
        '$desc_corta',
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

