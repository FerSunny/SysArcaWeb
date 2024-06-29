<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$id_equipo=$_SESSION['id_equipo'];
$id_usuario=$_SESSION['id_usuario'];
$id_manto=$_SESSION['id_manto'];



//$codigo  = $_POST['codigo'];

$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad']; 
$pieza = $_POST['pieza']; 
$autorizo = $_POST['autorizo']; 



$query ="

INSERT INTO eb_piezas 
	(fk_id_empresa, 
	id_pieza, 
	fk_id_equipo, 
	fk_id_manto, 
	fk_id_producto, 
	desc_cambio, 
	cantidad, 
	fecha_cambio, 
	fk_id_usuario_aut, 
	fecha_ins, 
	fk_id_usuario_ins, 
	fecha_upd, 
	fk_id_usuario_upd, 
	estado
	)
	VALUES
	(1, 
	0, 
	'$id_equipo', 
	'$id_manto', 
	'$pieza', 
	'$descripcion', 
	'$cantidad', 
	NOW(), 
	'$id_usuario', 
	NOW(), 
	'$id_usuario', 
	NOW(), 
	'$id_usuario', 
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

