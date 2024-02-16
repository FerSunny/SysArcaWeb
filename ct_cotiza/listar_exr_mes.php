  <?php

session_start();
	include ("../controladores/conex.php");

  //$id_modulo=$_SESSION['id_modulo'];
  //$fk_id_perfil=$_SESSION['fk_id_perfil'];
  //$fk_id_sucursal=$_SESSION['fk_id_sucursal'];


	$query = "SELECT  'Todas' AS unidad, 
  MONTH(fa.fecha_factura) AS mes,
  YEAR(fa.fecha_factura) AS anio,  
  CONCAT(MONTHNAME(fa.fecha_factura),'-',YEAR(fa.fecha_factura)) AS periodo_mes,  
  CONCAT(MIN(DAY(fa.`fecha_factura`)),' - ',MAX(DAY(fa.fecha_factura))) AS periodo_dia,
  SUM(CASE WHEN fa.estado_factura = 5 THEN 0 ELSE 1 END) AS numnotas,
  SUM(CASE WHEN fa.estado_factura = 5 THEN 0 ELSE  fa.`imp_total` END ) AS importe,
  SUM(CASE WHEN fa.estado_factura=5 THEN 0 ELSE fa.`resta` END) saldo,
  SUM((CASE WHEN fa.estado_factura = 5 THEN 0 ELSE  fa.`imp_total` END )-(CASE WHEN fa.estado_factura=5 THEN 0 ELSE fa.`resta` END)) AS efectivo
FROM so_factura_pre fa,
     kg_sucursales su
WHERE fa.fk_id_sucursal = su.id_sucursal
  AND fa.fk_id_sucursal > 0
GROUP BY MONTH(fa.fecha_factura)";
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
