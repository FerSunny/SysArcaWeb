<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$puesto_c = $_POST['puesto_c'];

$puesto_l = $_POST['puesto_l']; 

$smi = $_POST['smi']; 

$nivel = $_POST['nivel']; 



$query ="

INSERT INTO no_puestos
            (fk_id_empresa,
             id_puesto,
             codigo,
             fk_id_nivel,
             desc_puesto,
             desc_puesto_larga,
             sdo_mes_integrado,
             fecha_registro,
             fecha_actualiza,
             estado)
VALUES (1,
        0,
        '$codigo',
        $nivel,
        '$puesto_c',
        '$puesto_l',
        $smi,
        now(),
        now(),
        'A'
      );

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

