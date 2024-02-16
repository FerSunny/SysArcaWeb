<?php
include("../../controladores/conex.php");

$idregistro = $_POST["idregistro"];
$activo="E";
$suspendido="S";


$query="SELECT  estado FROM ga_registro_arca WHERE id_registro='$idregistro'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
      $query1="UPDATE ga_registro_arca SET  estado='$suspendido' WHERE id_registro='$idregistro'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_registro.php'</script>";
    		}
    		else 
        {
    			echo "error en la ejecución de la consulta. <br />";
          die('Error de Conexion: ' . mysqli_connect_errno());
    		}

    		if (mysqli_close($conexion))
        {
    			echo "desconexion realizada. <br />";
    		}
    		else 
        {
    			echo "error en la desconexión";
          die('Error de Conexión: ' . mysqli_connect_errno());
    		}
      }
    }
else
{
echo "error en la ejecución del borrado. <br />";
die('Error de Conexión: ' . mysqli_connect_errno());
}
 ?>
