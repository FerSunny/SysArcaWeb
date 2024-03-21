<?php
session_start();
include ("../controladores/conex.php");

$fk_id_perfil=$_SESSION['fk_id_perfil'];

  $query = "
  SELECT 
  '$fk_id_perfil' as fk_id_perfil,
  te.*,
  eq.`descripcion`,
  pr.`razon_social`
 FROM 
 eb_termohigrometros te,
 eb_equipos eq,
 eb_proveedores pr
 WHERE te.`estado` = 'A'
 AND te.`fk_id_equipo` = eq.`id_equipo`
 AND te.`fk_id_proveedor` = pr.`id_proveedor`
  ";


	$resultado = mysqli_query($conexion, $query);
    if(!$resultado){
        die("Error");
    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);