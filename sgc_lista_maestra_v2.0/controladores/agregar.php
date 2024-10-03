<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$desc_numeral_1 = $_POST['desc_numeral_1'];


$query ="
insert into `sgc_indice_uno`
            (`fk_id_empresa`,
             `id_numeral_1`,
             `desc_numeral_1`,
             `estado`)
values (1,
       '$codigo',
        '$desc_numeral_1',
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

