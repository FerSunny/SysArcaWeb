<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal'];

$usuario = $_POST['usuario']; 

$fecha = $_POST['fecha']; 

$importe = $_POST['importe']; 

$beneficiario = $_POST['beneficiario']; 









$query ="
INSERT INTO ga_registro
            (fk_id_empresa,
             fk_id_sucursal,
             id_registro,
             fk_id_gasto,
             importe,
             fecha_mov,
             nota,
             estado,
             fk_id_beneficiario,
             num_comprobante,
             num_autoriza,
             autorizo,
             fecha_aut,
             fk_id_usuario)
VALUES (1,
        $sucursal,
        0,
        3,
        $importe,
        '$fecha',
        'Caja Inicial Sistematizada',
        'A',
        $beneficiario,
        0,
        0,
        0,
        NOW(),
        $usuario);
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

