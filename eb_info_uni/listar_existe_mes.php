<?php


    include ("../controladores/conex.php");
   session_start();
 /* 
    $id_modulo=$_SESSION['id_modulo'];
    $fk_id_perfil=$_SESSION['fk_id_perfil'];
*/    
    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

/*
if ($fk_id_perfil==1) 
    {
      $condicion=' > 0';
      $diasatras= 25;
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
      $diasatras= 7;
    }
*/

	$query = "
	SELECT
   ac.fk_id_sucursal,
su.`desc_sucursal`,
YEAR(ac.`fecha_actualizacion`) AS anio,
MONTHNAME(ac.`fecha_actualizacion`) AS mes_nombre,
MONTH(ac.`fecha_actualizacion`) AS mes,
COUNT(ac.fk_id_producto) AS numprod, 
COUNT(ac.fk_id_proveedor) AS numprov, 
SUM(ac.`existencias`) AS existen, 
MIN(ac.`fecha_actualizacion`) AS minfecha,
MAX(ac.`fecha_actualizacion`) AS maxfecha
FROM eb_almacen_unidades ac
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = ac.`fk_id_sucursal`)
WHERE ac.estado ='A'
and ac.fk_id_sucursal = ".$fk_id_sucursal."
GROUP BY ac.fk_id_sucursal,su.`desc_sucursal`,
YEAR(ac.`fecha_actualizacion`),
MONTHNAME(ac.`fecha_actualizacion`),
MONTH(ac.`fecha_actualizacion`)
";
//echo $query;
//LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra) where estatus in ('A','S')";
	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error-->".$query);

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
    
?>
