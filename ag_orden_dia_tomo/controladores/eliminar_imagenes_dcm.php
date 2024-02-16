<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");

$idimagen = $_POST["idimagen"];
$activo="A";
$suspendido="S";

$numero_factura= $_SESSION['numero_factura'];
$studio= $_SESSION['studio'];

$ftp_server="108.175.7.121";
$ftp_usuario="tomo_ftp";
$ftp_pass="Iqsv85$2";

// SE ABRE LA CONEXION 
$con_id=ftp_connect($ftp_server);
// SE ESTABLECE LA COMEXION
$lr=ftp_login($con_id,$ftp_usuario,$ftp_pass);
if( (!$con_id) || (!$lr) ){
    $estatus = "No se conecto";
  }else{
    $query="SELECT  * FROM cr_plantilla_tomo_img WHERE id_imagen='$idimagen'";
    $resultado = mysqli_query($conexion, $query);
    if($row = mysqli_fetch_array($resultado)){
      if($row['estado'] == $activo){
          $file=$row['fk_id_factura']."/".$row['nombre'];
          $mode = ftp_pasv($con_id, TRUE);
          if (ftp_delete($con_id, $file)) {
            echo "$file se ha eliminado satisfactoriamente\n";
            $query1="UPDATE cr_plantilla_tomo_img SET  estado='$suspendido' WHERE id_imagen='$idimagen'";
            $resultado1 = mysqli_query($conexion, $query1);
            if ($resultado1) 
              {
                echo "<script>location.href='../tabla_imagenes_dcm.php?numero_factura=$numero_factura&studio=$studio'</script>";
              }
              else 
              {
                echo "error en la ejecución de la consulta. <br />";
                die('Error de Conexion: ' . mysqli_connect_errno());
              }
          } else {
            echo "No se pudo eliminar $file\n";
          }
        }
      }
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

 ?>
