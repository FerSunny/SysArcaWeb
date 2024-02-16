<?php 


session_start();
include ("../../controladores/conex.php");



$dep = $_POST['dep'];
$depto  = $_POST['depto'];
$descrip = $_POST['descrip']; 
$respon = $_POST['respon']; 
$suc = $_POST['suc'];
$fecha_actualizacion = date("Y-m-d H:i:s");


$query="SELECT COUNT(*) datos FROM eb_departamento
 WHERE desc_departamento = '$depto' AND fk_sucursal = $suc";
 $result = $conexion -> query($query);

 if ($row = mysqli_fetch_array($result)) 
 {
	$datos = $row['datos'];
	if($datos > 0)
	{
		echo 2;
	}else
	{
     
     $query = "UPDATE eb_departamento
	SET
	 fk_sucursal = '$suc',
	 desc_departamento = '$depto',
	 descripcion = '$descrip',
	 responsable = '$respon',
	 fecha_actualizacion = '$fecha_actualizacion'
	WHERE id_departamento = '$dep'";

	$result = $conexion -> query($query);
	if ($result) {
	    echo 1;
	}else{
	  $codigo = mysqli_errno($conexion); 
	  echo $codigo;
	}
	$conexion->close();
    }  
  }

	?>