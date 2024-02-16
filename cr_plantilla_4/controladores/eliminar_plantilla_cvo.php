<?php
include("../../controladores/conex.php");

$idvalor = $_POST["idvalor"];
$activo="A";
$suspendido="S";


$query="SELECT  estado FROM cr_plantilla_4 WHERE id_valor ='$idvalor'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
    //echo $row['activo'];
  if($row['estado'] == $activo)
    {
      //echo 'aqui2';
      $query1="UPDATE cr_plantilla_4 SET  estado='$suspendido' WHERE id_valor ='$idvalor'";

      //echo $query1;

      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_plantilla_4.php'</script>";
    		}
    		else 
        {
    			echo "error en la ejecución de la consulta. <br />";
          die('Error de Conexion: ' . mysqli_connect_errno());
          echo $query1;
    		}

    		if (mysqli_close($conexion))
        {
    			echo "desconexion realizada. <br />";
    		}
    		else 
        {
    			echo "error en la desconexión";
          die('Error de Conexión: ' . mysqli_connect_errno());
          echo $query1;
    		}
      }
    }
else
{
echo "error en la ejecución del borrado. <br />";
die('Error de Conexión: ' . mysqli_connect_errno());
}
 ?>
