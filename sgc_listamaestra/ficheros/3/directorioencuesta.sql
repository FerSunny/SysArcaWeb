SELECT 
c.id_cliente,
c.nombre,
c.a_paterno,
c.a_materno ,
c.telefono_fijo,
MIN(fa.fecha_factura) AS primer,
MAX(fa.fecha_factura) AS ultimo
FROM 
so_clientes c
LEFT OUTER JOIN so_factura fa ON (fa.fk_id_cliente = c.id_cliente)
WHERE CHAR_LENGTH(c.telefono_fijo) = 10 
AND c.telefono_fijo REGEXP '^[0-9]+$'
GROUP BY 1,2,3,4,5