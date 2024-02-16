<?php
include("../../controladores/conex.php");

$usuario = $_POST["idusuario"];
$activo="A";
$suspendido="S";
$baja="B";
echo $usuario;
$query="SELECT  activo FROM km_indicaciones_nvo WHERE id_indicaciones='$usuario'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado)){
if($row['activo'] == $activo || $row['activo']==$suspendido ){
  $query1="UPDATE km_indicaciones_nvo SET  activo='$suspendido' WHERE id_indicaciones='$usuario'";
  $resultado1 = mysqli_query($conexion, $query1);
  if ($resultado1) {
        echo "<script>location.href='../tabla_indicaciones.php'</script>";
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
}else
if($row['activo'] == $baja ){
  $query2="UPDATE se_usuarios SET activo='$activo' WHERE pass='$usuario'";
  $resultado2 = mysqli_query($conexion, $query2);
  if ($resultado2) {
  			echo "perfil almacenado. <br />";
        header("location: ../tabla_usuarios.php");
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
