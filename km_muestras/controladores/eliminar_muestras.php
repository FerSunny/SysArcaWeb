<?php
include("../../controladores/conex.php");

$usuario = $_POST["idusuario"];
$activo="A";
$suspendido="S";
$baja="B";

$query="SELECT estado FROM km_muestras WHERE id_muestra='$usuario'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado)){
if($row['estado'] == $activo || $row['estado']==$suspendido ){
  $query1="UPDATE km_muestras SET estado ='$suspendido' WHERE id_muestra='$usuario'";
  $resultado1 = mysqli_query($conexion, $query1);
  if ($resultado1) {
  		
        echo "<script>location.href='../tabla_muestras.php'</script>";
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
}
else
{

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
