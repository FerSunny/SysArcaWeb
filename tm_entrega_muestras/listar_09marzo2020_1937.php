<?php
session_start();
	include ("../controladores/conex.php");

  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1 or $fk_id_perfil==13) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }
  
 
  $query = "SELECT 
  tt.lote,
	tt.`fecha_toma`,
	tt.fk_id_factura,
	CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',a_materno) AS nombre,
	sm.`fk_id_toma`
FROM tm_tomas tt, so_factura fa, so_clientes cl, tm_sigue_muestra sm
WHERE tt.fk_id_factura = fa.`id_factura`
AND fa.fk_id_cliente = cl.`id_cliente`
AND tt.`id_toma` = sm.`fk_id_toma`
AND sm.`estado` = 'A'
AND sm.fk_id_etapa = 'EN'
AND sm.fk_id_estado_muestra = 1
AND tt.fk_id_sucursal $condicion
";
//echo $query;

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
