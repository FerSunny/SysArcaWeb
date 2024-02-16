<?php
include("../../controladores/conex.php");

$idbeneficiario = $_POST["idbeneficiario"];
$activo="A";
$suspendido="S";


$query="SELECT  estado FROM ga_beneficiarios WHERE id_beneficiario ='$idbeneficiario'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
    //echo $row['activo'];
  if($row['estado'] == $activo)
    {
      //echo 'aqui2';
      $query1="UPDATE ga_beneficiarios SET  estado='$suspendido' WHERE id_beneficiario ='$idbeneficiario'";

      //echo $query1;

      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_beneficia.php'</script>";
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
