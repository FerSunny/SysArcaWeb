<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");

$idimagen = $_POST["idimagen"];
$activo="A";
$suspendido="S";

$id_usuario=$_SESSION['id_usuario'];
$id_doc= $_SESSION['id_doc'];
$num_version= $_SESSION['num_version'];
$desc_doc = $_SESSION['desc_doc'];


$query="SELECT  * FROM sgc_lista_ficheros WHERE id_imagen='$idimagen'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
       $imagen="../ficheros/".$row['fk_id_doc']."/".$row['nombre'];

        if (!unlink($imagen))
          {
          echo ("Error deleting $imagen");
          }
        else
          {
          echo ("Deleted $imagen");
          };

      $query1="UPDATE sgc_lista_ficheros SET  estado='$suspendido' WHERE id_imagen='$idimagen'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_ficheros.php?id_doc=$id_doc&num_version=$num_version&desc_doc=$desc_doc'</script>";
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
