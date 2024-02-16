<?php
session_start();
$fk_id_sucursal_pag=$_SESSION['fk_id_sucursal'];


include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_factura=$_POST["idfactura"];
$fn_resta=$_POST["fn_resta"];
$fn_f_pago=$_POST["fn_f_pago"];

$fn_factualiza=date("y/m/d :H:i:s");

//obtiene datos de la factura
$sql = "SELECT fk_id_sucursal,id_factura,imp_total,a_cuenta,resta FROM so_factura
WHERE id_factura = ".$id_factura;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
  {
    $a_cuenta=$row['a_cuenta'];
    $resta=$row['resta'];
    $fk_id_sucursal_ori=$row['fk_id_sucursal'];
    //echo $a_cuenta;
  }
}
mysqli_free_result($result);

// Actualiza el pago de la factura

$c_a_cuenta=$a_cuenta + $fn_resta;
$c_resta=$resta - $fn_resta;

$sql_update="UPDATE so_factura SET a_cuenta = ".$c_a_cuenta.",resta= ".$c_resta." 
            where id_factura=".$id_factura;
     //echo $sql_update;
$exe_sql_update = mysqli_query($conexion,$sql_update);

if($exe_sql_update){
  echo"<script>alert('La nota ha sido pagada')</script>";  
}else{
  echo"<script>alert('ERRO AL PAGAR LA NOTA, PONGASE EN CONTACTO CON EL AREA DE SISTEMAS')</script>";
}

// graba el pago que saldo la factura
$fecha_pago=date("y/m/d :H:i:s");


$sql_insert="INSERT INTO so_pagos(fk_id_factura,fk_id_sucursal_ori,fk_id_sucursal_pag,imp_pagado,fecha_pago,tipo_pago) VALUES ('$id_factura','$fk_id_sucursal_ori','$fk_id_sucursal_pag','$fn_resta','$fecha_pago','$fn_f_pago')";
$exe_sql_insert = mysqli_query($conexion,$sql_insert);

if($exe_sql_insert){
  //echo"<script>alert('La nota ha sido pagada')</script>";  
}else{
  echo"<script>alert('ERRO AL CONCILIAR LA NOTA, PONGASE EN CONTACTO CON EL AREA DE SISTEMAS')</script>";
}
//mysqli_free_result($exe_sql_insert);
mysqli_close($conexion);
echo "<script>location.href='../tabla_saldos.php'</script>";


/*
$query = "UPDATE  so_medicos SET fk_id_zona ='$zona', nombre = '$fn_nombre', a_paterno = '$fn_apaterno', a_materno = '$fn_amaterno' , rfc = '$fn_rfc', fk_id_sexo='$fn_sexo', fk_id_especialidad = '$especialidad', fk_id_estado = '$Estado_fed', fk_id_municipio = '$Municipio', fk_id_localidad = '$Localidad', colonia='$fn_colonia', cp = '$fn_cp', calle='$fn_calle', numero_exterior='$fn_numero', referencia = '$fn_referencia', telefono_fijo = '$fn_tfijo', telefono_movil = '$fn_movil', horario='$fn_horario', cuenta_banco='$fn_cbanco', adscrito='$adscrito', fecha_registro='$fn_falta', fecha_actuaizacion = '$fn_factualiza', estado='$estado_reg',e_mail='$fn_mail',fk_id_sucursal='$fn_sucursal' WHERE fk_id_empresa = 1 and  id_medico='$id_medico'";

echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_medicos.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}

*/

 ?>
