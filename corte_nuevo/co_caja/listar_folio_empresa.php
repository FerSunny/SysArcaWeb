  <?php

session_start();
	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1) 
    {
      $condicion=' > 0';
      $diasatras= 30;
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
      $diasatras= 7;
    }


	$query = "SELECT 'Arca' AS sucursal, 
  0 as id_sucursal,
  DATE(fa.fecha_factura) AS fecha_factura, 
  COUNT(*) AS numfolios,
  SUM(fa.`imp_total`) importe,
  SUM(fa.`resta`) saldo,
  SUM(fa.imp_total-fa.`resta`) AS efectivo
FROM so_factura fa
WHERE DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= DATE(fa.fecha_factura)
GROUP BY DATE(fa.fecha_factura)
ORDER BY 1";
//echo $query;
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
