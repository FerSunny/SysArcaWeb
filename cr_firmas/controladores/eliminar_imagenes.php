<?php
session_start();
include("../../controladores/conex.php");

$idimagen = $_POST["idimagen"];
$activo="A";
$suspendido="S";




$query="SELECT  * FROM cr_firmas WHERE id_firma='$idimagen'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
       $imagen="../img_firmas/".$row['fk_id_usuario']."/".$row['nombre'];

        if (!unlink($imagen))
          {
          echo "<script> ('Error deleting '.$imagen.') </script>" ;
          }
        else
          {
          //echo ("Deleted $imagen");
          };

      $query1="UPDATE cr_firmas SET  estado='$suspendido' WHERE id_firma='$idimagen'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_firmas.php'</script>";
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
