<?php
include("../../controladores/conex.php");

$idcomision = $_POST["idcomision"];
$activo="A";
$suspendido="S";


$query="SELECT  estado FROM kg_comisiones WHERE id_comision='$idcomision'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
      $query1="UPDATE kg_comisiones SET  estado='$suspendido' WHERE id_comision='$idcomision'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_comisiones.php'</script>";
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
