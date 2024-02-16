                                                                  <?php

	include ("../controladores/conex.php");

	$query = "SELECT   CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
  DATE_FORMAT(fa.fecha_factura,'%Y-%m') AS periodo,
  CONCAT(max(DATE_FORMAT(fa.fecha_factura,'%Y')),'-',max(DATE_FORMAT(fa.fecha_factura,'%M')),'(',MAX(DATE_FORMAT(fa.fecha_factura,'%d')),')') AS mes,
  me.id_medico,
  SUM(CASE
    WHEN es.costo = df.precio_venta THEN
      es.costo
    ELSE
      CONCAT(es.costo)
  END) AS costo,
  SUM(ROUND((df.precio_venta*(CASE
            WHEN es.costo = df.precio_venta THEN
              co.porcentaje
            ELSE
              10
            END))/100,2)) AS participacion
FROM so_factura fa,
     so_medicos me,
     kg_zonas zo,
     kg_sucursales su,
     so_detalle_factura df,
     km_estudios es,
     kg_comisiones co
-- WHERE DATE(fa.fecha_factura) >= (CONCAT(YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)),'-',MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)),'-01' ))
  WHERE fa.fk_id_medico = me.id_medico
  AND me.fk_id_zona = zo.id_zona
  AND su.id_sucursal = fa.fk_id_sucursal
  AND fa.id_factura = df.id_factura
  AND df.fk_id_estudio = es.id_estudio
  AND es.fk_id_comision = co.id_comision
  and fa.afecta_comision = 1
  AND fa.estado_factura <> '5'
GROUP BY CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno),
  DATE_FORMAT(fa.fecha_factura,'%Y-%m'),
  DATE_FORMAT(fa.fecha_factura,'%M'),
  me.id_medico";
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
