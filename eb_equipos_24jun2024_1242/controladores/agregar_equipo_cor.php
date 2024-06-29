<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$id_equipo=$_SESSION['id_equipo'];
$id_usuario=$_SESSION['id_usuario'];



//$codigo  = $_POST['codigo'];

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
INSERT INTO  eb_manto  
	( 
	 id_manto,
	 fk_id_equipo , 
	 fk_id_proveedor , 
	 fk_id_tipo , 
	 fk_id_origen , 
	 fk_id_usuario_con , 
	 fk_id_usuario_res , 
	 fecha_reporte , 
	 fecha_inicio , 
	 fecha_fin , 
	 problema , 
	 solucion , 
	 observaciones,
	  fecha_insert , 
	  fk_id_usuario_ins , 
	  fecha_update , 
	  fk_id_usuario_upd , 
	  estado 

	)
	VALUES
	(
	0, 
	'$id_equipo', 
	'$proveedor', 
	'$tipo', 
	'$origen', 
	'$contacto', 
	'$responsable', 
	'$reporte', 
	'$fecha_inicio', 
	'$fecha_final', 
	'$problema', 
	'$solucion', 
	'$observaciones', 
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

