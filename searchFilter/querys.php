<?php
    /*
    *Funcion que retorna el query especificado por el tipo de busqueda a realizar
    *@param $tipoConsulta-string
    */
    function getQuery($tipoConsulta,$fk_id_perfil) {
        switch($tipoConsulta){
            case "clientes":
                return "SELECT $fk_id_perfil AS perfil, 
                c.*,
                -- CONCAT(c.anios,'a',c.meses,'m',c.dias,'d') AS edad,
                    s.desc_sexo,ec.desc_estado_civil,
                        case
                            when c.fecha_nac is null then
                                c.anios
                            else
                                -- caluculos de años  
                                (YEAR( CURDATE( ) ) - YEAR( c.fecha_nac )) - IF( MONTH( CURDATE( ) ) < MONTH( c.fecha_nac), 1,
                                IF ( MONTH(CURDATE( )) = MONTH(c.fecha_nac),
                                IF (DAY( CURDATE( ) ) < DAY( c.fecha_nac ),1,0 ),0))
                        end AS anios,

                        case
                            when c.fecha_nac is null then
                                c.meses
                            else
                                MONTH(CURDATE()) - MONTH( c.fecha_nac ) + 12 *
                                IF( MONTH(CURDATE())<MONTH(c.fecha_nac), 1,IF(MONTH(CURDATE())=MONTH(c.fecha_nac),IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0),0)
                                ) - IF(MONTH(CURDATE())<>MONTH(c.fecha_nac),(DAY(CURDATE())<DAY(c.fecha_nac)), IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0 ) )
                        end AS meses,

                        case
                            when c.fecha_nac is null then
                                c.dias
                            else
                                (DAY( CURDATE() ) - DAY( c.fecha_nac ) +30 * ( DAY(CURDATE()) < DAY(c.fecha_nac) )) 
                        end AS dias,

                        case
                            when c.fecha_nac is null then
                                CONCAT(c.anios,'a',c.meses,'m',c.dias,'d') 
                            else
                                CONCAT(( (YEAR( CURDATE( ) ) - YEAR( c.fecha_nac )) - IF( MONTH( CURDATE( ) ) < MONTH( c.fecha_nac), 1,
                                IF ( MONTH(CURDATE( )) = MONTH(c.fecha_nac),
                                IF (DAY( CURDATE( ) ) < DAY( c.fecha_nac ),1,0 ),0)) ),'a',( MONTH(CURDATE()) - MONTH( c.fecha_nac ) + 12 *
                                IF( MONTH(CURDATE())<MONTH(c.fecha_nac), 1,IF(MONTH(CURDATE())=MONTH(c.fecha_nac),IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0),0)
                                ) - IF(MONTH(CURDATE())<>MONTH(c.fecha_nac),(DAY(CURDATE())<DAY(c.fecha_nac)), IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0 ) ) ),'m',( (DAY( CURDATE() ) - DAY( c.fecha_nac ) +30 * ( DAY(CURDATE()) < DAY(c.fecha_nac) )) ),'d')
                        end AS edad,
                        f.id_factura,
                        f.fk_id_sucursal,
                        f.fecha_factura,
                        NOW(),
                        DATE_SUB(NOW(), INTERVAL 24 HOUR),
                        CASE
                        WHEN DATE(f.fecha_factura) = CURDATE() THEN -- BETWEEN NOW() AND DATE_SUB(NOW(), INTERVAL 24 HOUR) THEN
                        'S'
                        ELSE
                        'N'
                        END AS editable

                        FROM so_clientes c
                        LEFT OUTER JOIN so_sexo s
                        ON (s.fk_id_empresa= 1 AND s.id_sexo = c.fk_id_sexo)
                        LEFT OUTER JOIN kg_estado_civil ec
                        ON (ec.fk_id_empresa=1 AND ec.id_estado_civil = c.fk_id_estado_civil)
                        LEFT OUTER JOIN	(SELECT `fk_id_cliente`,MAX(`fecha_factura`) ultima_nota FROM so_factura  GROUP BY 1) u ON (c.id_cliente = u.fk_id_cliente)
	                    LEFT OUTER JOIN so_factura f ON (f.fecha_factura = u.ultima_nota)


                        WHERE c.activo = 'A'
                        AND nombre like '%#nombreBusqueda#%'
                        AND a_paterno like '%#apellidoPaterno#%'
                        AND a_materno like '%#apellidoMaterno#%'";
                break;
            case "clientes_h":
                return "SELECT c.*,CONCAT(c.anios,'a',c.meses,'m',c.dias,'d') AS edad,
                            s.desc_sexo,ec.desc_estado_civil
                        FROM so_clientes c
                        LEFT OUTER JOIN so_sexo s
                        ON (s.fk_id_empresa= 1 AND s.id_sexo = c.fk_id_sexo)
                        LEFT OUTER JOIN kg_estado_civil ec
                        ON (ec.fk_id_empresa=1 AND ec.id_estado_civil = c.fk_id_estado_civil)
                        WHERE c.activo = 'S'
                        AND nombre like '%#nombreBusqueda#%'
                        AND a_paterno like '%#apellidoPaterno#%'
                        AND a_materno like '%#apellidoMaterno#%'";
                break;
            default:
                return "";
        }

    }
?>
