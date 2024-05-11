SELECT 
su.`desc_corta`,
fa.`turno_num`,
DATE(fa.`fecha_factura`) AS FechaFactura,
COUNT(*) AS NumOt
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = fa.`fk_id_sucursal`)
WHERE fa.`estado_factura` <> 5
AND fa.`fecha_factura` BETWEEN '2023-02-20' AND CURDATE()
-- AND fa.`fk_id_sucursal` = 1
AND fa.`turno_num` <> 0