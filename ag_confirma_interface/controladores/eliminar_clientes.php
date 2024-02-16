<?php
include("../../controladores/conex.php");

$idcliente = $_POST["idcliente"];
$activo="A";
$suspendido="S";


$query="SELECT  activo as estado FROM so_clientes WHERE id_cliente='$idcliente'";
$resultado = mysqli_query($conexion, $query);

//echo $query;

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
      $query1="UPDATE so_clientes SET  activo='$suspendido' WHERE id_cliente='$idcliente'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_clientes.php'</script>";
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
