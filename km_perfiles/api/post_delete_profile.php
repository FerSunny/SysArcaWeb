<?php



require_once ("../db/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../db/conexion.php");//Contiene funcion que conecta a la base de datos

 header('Content-Type: application/json');
    if( isset($_POST['id_perfil']) ) {
      $del1="update km_perfil set estado='B' where id_perfil=".$_POST['id_perfil'];
      //$del2="delete from so_detalle_factura where numero_factura='".$numero_factura."'";

      if ($delete1=mysqli_query($con,$del1)){
          echo json_encode('{"success":"Perfil eliminado correctamente"}');
      
      }else {
        
      }
    } else {
      die("Solicitud no válida.");
    }
?>

