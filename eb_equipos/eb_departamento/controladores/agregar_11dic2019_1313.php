<?php 
session_start();
include ("../../controladores/conex.php");
$sucursal =$_SESSION['fk_id_sucursal'];



$depto  = $_POST['depto'];
$descrip = $_POST['descrip']; 
$respon = $_POST['respon']; 
$suc = $_POST['suc'];

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
	}
}
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
