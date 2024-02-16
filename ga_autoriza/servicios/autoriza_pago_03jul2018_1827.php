<?php
session_start();
$fk_id_sucursal_pag=$_SESSION['fk_id_sucursal'];

 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
//$fk_id_sucursal_pag='100';


//se recibe los paramteros
$id_registro=$_GET['id_registro'];
$resta=$_GET['importe'];


// Actualiza el pago

$num_autoriza=rand(1,9);

$sql_update="UPDATE ga_registro SET estado = 'A' ,num_autoriza = ".$num_autoriza." 
            where id_registro=".$id_registro;
     // echo $sql_update;
$exe_sql_update = mysqli_query($con,$sql_update);

if($exe_sql_update){
  echo"<script>alert('El pago ha sido autorizado')</script>";  
}else{
  echo $sql_update;
  echo"<script>alert('ERRO AL PAGAR LA NOTA, PONGASE EN CONTACTO CON EL AREA DE SISTEMAS')</script>";
}

//mysqli_free_result($exe_sql_insert);
mysqli_close($con);
echo "<script>location.href='../tabla_autoriza.php'</script>";


?>