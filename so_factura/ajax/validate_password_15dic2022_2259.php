<?php
//$data=json_decode($_POST['validatedate']);
date_default_timezone_set('America/Mexico_City');

/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

if(isset($_POST['password'])){
  $query="select clave_autoriza from se_autorizacion where id=1";
  if ($passwordDB = mysqli_query($con, $query)) {
        $password="";
        while ($iterate = mysqli_fetch_row($passwordDB)) {
          $password= $iterate[0];
        }
        /* free result set */
        mysqli_free_result($passwordDB);

      if($password==$_POST['password']){
        echo true;
      }else{
        echo false;
      }
  }
}
?>
