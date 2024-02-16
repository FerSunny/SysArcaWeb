<?php
include("../../controladores/conex.php");

$idclasifica = $_POST["idclasifica"];
$activo="A";
$suspendido="S";


$query="SELECT  estado FROM ga_clasifica WHERE id_clasifica='$idclasifica'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
      $query1="UPDATE ga_clasifica SET  estado='$suspendido' WHERE id_clasifica='$idclasifica'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_clasifica.php'</script>";
    		}
    		else 
        {
    			echo "error en la ejecución de la consulta. <br />";
          die('Error de Conexión: ' . mysqli_connect_errno());
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
