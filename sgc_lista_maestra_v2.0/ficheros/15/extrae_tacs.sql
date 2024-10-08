SELECT fa.fecha_factura, df.`precio_venta`, es.`desc_estudio`
FROM so_factura fa,
so_detalle_factura df,
km_estudios es
WHERE fa.`estado_factura` <> 5
AND fa.`id_factura` = df.`id_factura`
AND df.`fk_id_estudio` = es.`id_estudio`
AND es.`desc_estudio` LIKE '%tac%'
AND fa.`fecha_factura` BETWEEN  '2024-09-01' AND '2024-09-31'  