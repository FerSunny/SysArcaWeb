<?php
include("../../controladores/conex.php");


$idruta= $_POST["fn_ruta"];

$query = "UPDATE  cr_plantilla_ruta SET estado='S' where id_ruta = $idruta";
//echo $query;
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
      //echo "perfil almacenado. <br />";
      echo "<script>location.href='../tabla_ruta.php'</script>";
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