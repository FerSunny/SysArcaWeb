<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");

$idimagen = $_POST["idimagen"];
$activo="A";
$suspendido="S";

$numero_factura= $_SESSION['numero_factura'];
$studio= $_SESSION['studio'];


$query="SELECT  * FROM cr_plantilla_usg_img WHERE id_imagen='$idimagen'";
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
  if($row['estado'] == $activo)
    {
       $imagen="../img_usg/".$row['fk_id_factura']."/".$row['nombre'];

        if (!unlink($imagen))
          {
          echo "<script> ('Error deleting '.$imagen.') </script>" ;
          }
        else
          {
          //echo ("Deleted $imagen");
          };

      $query1="UPDATE cr_plantilla_usg_img SET  estado='$suspendido' WHERE id_imagen='$idimagen'";
      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1) 
        {
          echo "<script>location.href='../tabla_imagenes.php?numero_factura=$numero_factura&studio=$studio'</script>";
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
