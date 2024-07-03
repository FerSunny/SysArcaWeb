<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$id_equipo=$_SESSION['id_equipo'];
$id_usuario=$_SESSION['id_usuario'];



//$codigo  = $_POST['codigo'];

$descripcion = $_POST['descripcion'];



$mes = $_POST['mes']; 

$dia = $_POST['dia']; 

$hora_inicio = $_POST['hora_inicio']; 
$hora_final = $_POST['hora_final']; 

$proveedor = $_POST['proveedor']; 
$responsable = $_POST['responsable']; 

$contacto = $_POST['contacto']; 


$query ="
INSERT INTO  eb_calendario_mto  
	( fk_id_empresa , 
	 id_manto , 
	 desc_manto , 
	 fk_id_equipo , 
	 fk_id_proveedor , 
	 fk_id_usuario_mto , 
	 fk_id_usuario_con , 
	 mes_manto , 
	 dia_manto , 
	 hora_inicio , 
	 hora_final , 
	 fecha_insert , 
	 fecha_update , 
	 fk_id_usuario_ins , 
	 fk_id_usuaerio_upd , 
	 estado 
	)
	VALUES
	(1, 
	0, 
	'$descripcion', 
	'$id_equipo', 
	'$proveedor', 
	'$responsable', 
	'$contacto', 
	'$mes', 
	'$dia', 
	'$hora_inicio', 
	'$hora_final', 
	NOW(), 
	NOW(), 
	'$id_usuario', 
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

