<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$id_equipo=$_SESSION['id_equipo'];
$id_usuario=$_SESSION['id_usuario'];



$codigo  = $_POST['codigo'];

$descripcion = $_POST['descripcion'];



$mes = $_POST['mes']; 

$dia = $_POST['dia']; 

$hora_inicio = $_POST['hora_inicio']; 
$hora_final = $_POST['hora_final']; 

$proveedor = $_POST['proveedor']; 
$responsable = $_POST['responsable']; 

$contacto = $_POST['contacto']; 


$query ="

UPDATE  eb_calendario_mto  
	SET

	 desc_manto  = '#$descripcion', 
	 fk_id_proveedor  = '$proveedor', 
	 fk_id_usuario_mto  = '$responsable', 
	 fk_id_usuario_con  = '$contacto', 
	 mes_manto  = '$mes', 
	 dia_manto  = '$dia', 
	 hora_inicio  = '$hora_inicio', 
	 hora_final  = '$hora_final'
	WHERE
	 id_manto  = $codigo;
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

