                                                                  <?php

	include ("../controladores/conex.php");

	$query = "SELECT   zo.desc_zona,
  su.desc_sucursal,
  CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
  -- substr(DATE_FORMAT(fa.fecha_factura,'%M'),1,3) mescomision,
  --DATE_FORMAT(fa.fecha_factura,'%d') AS fecha,
  DATE(fa.fecha_factura) AS fecha,
  fa.id_factura,
  es.desc_estudio,
  CASE
    WHEN es.costo = df.precio_venta THEN
      es.costo
    ELSE
      CONCAT(es.costo,'*')
  END AS costo,
  CASE
    WHEN es.costo = df.precio_venta THEN
      co.porcentaje
    ELSE
      10
  END AS porcentaje,
  ROUND((df.precio_venta*(CASE
            WHEN es.costo = df.precio_venta THEN
              co.porcentaje
            ELSE
              10
            END))/100,2) AS participacion,
  CASE
  WHEN fa.afecta_comision = 0 THEN
    'No'
  ELSE
    'Si'
  END AS afecta_comision
FROM so_factura fa,
     so_medicos me,
     kg_zonas zo,
     kg_sucursales su,
     so_detalle_factura df,
     km_estudios es,
     kg_comisiones co
WHERE MONTH(fa.fecha_factura) IN ( MONTH(CURDATE())) -- ,MONTH(CURDATE() - INTERVAL 3 MONTH))
AND fa.fk_id_medico = me.id_medico
  AND me.fk_id_zona = zo.id_zona
  AND su.id_sucursal = fa.fk_id_sucursal
  AND fa.id_factura = df.id_factura
  AND df.fk_id_estudio = es.id_estudio
  AND es.fk_id_comision = co.id_comision 
  and fa.estado_factura <> '5'";
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
