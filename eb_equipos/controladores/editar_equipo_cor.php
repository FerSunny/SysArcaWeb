<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$id_equipo=$_SESSION['id_equipo'];
$id_usuario=$_SESSION['id_usuario'];



$codigo  = $_POST['codigo'];

$problema = $_POST['problema'];
$solucion = $_POST['solucion']; 
$observaciones = $_POST['observaciones']; 
$reporte = $_POST['reporte']; 
$fecha_inicio = $_POST['hora_inicio']; 
$fecha_final = $_POST['hora_final']; 
$proveedor = $_POST['proveedor']; 
$responsable = $_POST['responsable']; 
$contacto = $_POST['contacto']; 
$tipo = $_POST['tipo']; 
$origen = $_POST['origen']; 

$query ="

UPDATE eb_manto 
	SET

	fk_id_proveedor = '$proveedor', 
	fk_id_tipo = '$tipo', 
	fk_id_origen = '$origen', 
	fk_id_usuario_con = '$contacto', 
	fk_id_usuario_res = '$responsable', 
	fecha_reporte = '$reporte', 
	fecha_inicio = '$fecha_inicio', 
	fecha_fin = '$fecha_final', 
	problema = '$problema', 
	solucion = '$solucion', 
	observaciones = '$observaciones', 

	fecha_update = now(), 
	fk_id_usuario_upd = '$id_usuario'
	
	WHERE
	id_manto = '$codigo' ;
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

