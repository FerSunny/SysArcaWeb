<?php
include("../../controladores/conex.php");
$idestudio=$_POST["idusuario"];
$activo="A";
$suspendido="S";
$baja="B";
$query="SELECT estatus FROM km_estudios WHERE id_estudio='$idestudio'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado)){
if($row['estatus'] == $activo || $row['estatus']==$suspendido ){
  $query1="UPDATE km_estudios SET estatus='$baja' WHERE id_estudio='$idestudio'";
  $resultado1 = mysqli_query($conexion, $query1);
  if ($resultado1) {
  			//echo "perfil almacenado. <br />";
        echo "<script>location.href='../km_estudios_t.php'</script>";
  		}
  		else {
  			echo "error en la ejecución de la consulta. <br />";
        die('Error de Conexión: ' . mysqli_connect_errno());
  		}

  		if (mysqli_close($conexion)){
  			echo "desconexion realizada. <br />";
  		}
  		else {
  			echo "error en la desconexión";

        die('Error de Conexión: ' . mysqli_connect_errno());

  		}
}else{
  echo '<script> alert("Algo Salio Mal")</script>';
  echo "<script>location.href='../tabla_estuidos.php'</script>";
}


}
if ($resultado) {
			echo "perfil almacenado. <br />";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}


 ?>
