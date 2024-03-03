<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");

$idimagen = $_POST["idimagen"];
$activo="A";
$suspendido="S";

$id_equipo= $_SESSION['id_equipo'];
//$studio= $_SESSION['studio'];


$query="SELECT  * FROM eb_equipos_img WHERE id_imagen='$idimagen'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
       $imagen="../pdfs/".$row['fk_id_equipo']."/".$row['nombre'];

        if (!unlink($imagen))
          {
          echo ("Error deleting $imagen");
          }
        else
          {
          echo ("Deleted $imagen");
          };

        $query1="UPDATE eb_equipos_img SET  estado='$suspendido' WHERE id_imagen='$idimagen'";
        $resultado1 = mysqli_query($conexion, $query1);
        if ($resultado1) 
          {
            echo "<script>location.href='../tabla_imagenes.php?id_equipo=$id_equipo'</script>";
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
      }else{
        echo "<script>location.href='../tabla_imagenes.php?id_equipo=$id_equipo'</script>";
      }
    }
else
{
echo "error en la ejecución del borrado. <br />";
die('Error de Conexión: ' . mysqli_connect_errno());
}
 ?>
