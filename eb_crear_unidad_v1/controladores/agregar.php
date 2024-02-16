<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];
$usuario =$_SESSION['id_usuario'];


$festima  = $_POST['festima'];



$query ="
INSERT INTO eb_detalle_solicitud
            (fk_id_empresa,
             fk_id_sucursal,
             id_detalle,
             fk_id_usuario,
             importe_total,
             importe_real_total,
             estatus,
             fecha_registro,
             estado,
             tipo,
             fecha_libera)
VALUES (1,
        $sucursal,
        0,
        $usuario,
        0,
        0,
        'L',
        NOW(),
        'A',
        '2',
        '$festima')
";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

/*
$query ="INSERT INTO eb_departamento
            (fk_id_empresa,fk_id_sucursal,desc_departamento,descripcion,responsable,fk_sucursal)
VALUES (1,'$sucursal','$depto','$descrip','$respon','$suc')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();
*/
?>
