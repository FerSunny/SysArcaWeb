<?php
//$data=json_decode($_POST['validatedate']);
date_default_timezone_set('America/Mexico_City');

/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$bang_update = $_POST['bang_update'];
$id_factura = $_POST['id_factura'];
if($bang_update == 1){
  $id_busca = 2;
}else{
  $id_busca = 1;
}

if(isset($_POST['password'])){
  $query="select clave_autoriza from se_autorizacion where id=$id_busca";
  if ($passwordDB = mysqli_query($con, $query)) {
        $password="";
        while ($iterate = mysqli_fetch_row($passwordDB)) {
          $password= $iterate[0];
        }
        /* free result set */
        mysqli_free_result($passwordDB);

      if($password==$_POST['password']){
        if($bang_update == 1){
          $query3 ="UPDATE so_factura SET bang_update = 0
              WHERE id_factura  =$id_factura";
          $result2 = $con -> query($query3);
        }
        echo true;
      }else{
        echo false;
      }
  }
}
?>
