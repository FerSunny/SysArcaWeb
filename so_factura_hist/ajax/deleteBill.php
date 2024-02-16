<?php

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

 header('Content-Type: application/json');
    if( isset($_POST['numero_factura']) ) {
      $numero_factura=intval($_POST['numero_factura']);
      $del1="update so_factura set estado_factura=5 where id_factura='".$numero_factura."'";
      //$del2="delete from so_detalle_factura where numero_factura='".$numero_factura."'";

      if ($delete1=mysqli_query($con,$del1)){
          echo json_encode('{"success":"factura eliminada correctamente"}');
        ?>
        <?php
      }else {
        ?>
        <?php
      }
    } else {
      die("Solicitud no válida.");
    }
?>
