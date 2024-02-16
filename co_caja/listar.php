<?php


    include ("../controladores/conex.php");
    session_start();
    $id_modulo=$_SESSION['id_modulo'];
    $fk_id_perfil=$_SESSION['fk_id_perfil'];
    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
      $condicion=' > 0';
      $diasatras= 25;
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
      $diasatras= 7;
    }


  $query = "SELECT ".$fk_id_perfil." as id_perfil,   su.`desc_sucursal` AS sucursal, su.id_sucursal, date(fa.fecha_factura) as fecha_factura,
   DAY(fecha_factura) AS dia,
   CASE
	WHEN DATE(fa.`fecha_factura`) = CURDATE() THEN
		1
	ELSE
		0
END AS se_imprime,
   
   COUNT(*) AS numfolios,SUM(fa.`imp_total`) importe,SUM(fa.`resta`) saldo,SUM(fa.imp_total-fa.`resta`) AS efectivo
FROM so_factura fa,
     kg_sucursales su
WHERE DATE_SUB(CURDATE(), INTERVAL ".$diasatras." DAY) <= DATE(fecha_factura)
  -- and fa.fk_id_sucursal <> '10'
  AND fa.fk_id_sucursal = su.id_sucursal
  -- AND fa.estado_concilia = 'A'
  AND fa.fk_id_sucursal".$condicion."
GROUP BY su.`desc_sucursal`,
		su.id_sucursal, 
        date(fa.fecha_factura),
        DAY(fecha_factura),
        CASE
        WHEN DATE(fa.`fecha_factura`) = CURDATE() THEN
          1
        ELSE
          0
      END
ORDER BY 1,4
";
//LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra) where estatus in ('A','S')";
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
    
?>
