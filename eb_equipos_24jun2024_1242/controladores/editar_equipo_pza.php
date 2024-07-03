<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$id_equipo=$_SESSION['id_equipo'];
$id_usuario=$_SESSION['id_usuario'];
$id_manto=$_SESSION['id_manto'];



$codigo  = $_POST['codigo'];

$desc_cambio = $_POST['descripcion'];
$cantidad = $_POST['cantidad']; 
$pieza = $_POST['pieza']; 
$autorizo = $_POST['autorizo']; 

$query ="
UPDATE eb_piezas 
	SET



	fk_id_producto = '$pieza', 
	desc_cambio = '$desc_cambio', 
	cantidad = '$cantidad', 

	fk_id_usuario_aut = '$autorizo', 

	fecha_upd = NOW(), 
	fk_id_usuario_upd = '$id_usuario'
	
	WHERE
	id_pieza = '$codigo' ;
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

