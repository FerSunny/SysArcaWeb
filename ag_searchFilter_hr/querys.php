<?php
    /*
    *Funcion que retorna el query especificado por el tipo de busqueda a realizar
    *@param $tipoConsulta-string
    */
    function getQuery($tipoConsulta,$fk_id_perfil) {
        switch($tipoConsulta){
            case "clientes":
                return "
                select a.* from
                (
                SELECT DISTINCT $fk_id_perfil AS perfil,
                fa.id_factura,
                df.fk_id_estudio,
                DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
                DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
                su.desc_sucursal AS sucursal,
                CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
                es.desc_estudio AS estudio,
                fa.resta,
                es.fk_id_plantilla as num_plantilla,
                CASE
                    WHEN es.fk_id_plantilla = 1 THEN
                        CASE
                            WHEN p1.fk_id_estudio IS NULL THEN
                                'No'
                                ELSE
                                'Si'
                        END 
            
                    WHEN es.fk_id_plantilla = 2 THEN
                        CASE
                            WHEN p2.fk_id_estudio IS NULL THEN
                                'No'
                                ELSE
                                'Si'
                        END 			
            
                    WHEN es.fk_id_plantilla = 5 THEN
                        CASE
                            WHEN p5.fk_id_estudio IS NULL THEN
                                'No'
                                ELSE
                                'Si'
                        END 
                  
                    WHEN es.fk_id_plantilla = 6 THEN
                        CASE
                        WHEN p6.fk_id_estudio IS NULL THEN
                            'No'
                            ELSE
                            'Si'
                        END 
                   
                    WHEN es.fk_id_plantilla = 7 THEN
                        CASE
                        WHEN p7.fk_id_estudio IS NULL THEN
                            'No'
                            ELSE
                            'Si'
                        END 
                END AS Registrado,
                email_medico,
                email_paciente,
                CASE
                    WHEN es.fk_id_plantilla = 1 THEN
                        p1.validado
                    WHEN es.fk_id_plantilla = 2 THEN
                        p2.validado
                    WHEN es.fk_id_plantilla = 3 THEN
                        p2.validado
                    ELSE
                        1
                END AS revisado
                FROM so_factura fa
                LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
                LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
                LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
                LEFT OUTER JOIN cr_plantilla_1_re p1 ON (p1.fk_id_factura = df.id_factura AND p1.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_cvo_re p3 ON (p3.fk_id_factura = df.id_factura AND p3.fk_id_estudio = df.fk_id_estudio)
            
                LEFT OUTER JOIN cr_plantilla_ekg_re p5 ON (p5.fk_id_factura = df.id_factura AND p5.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_rx_re p6 ON (p6.fk_id_factura = df.id_factura AND p6.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_usg_re p7 ON (p7.fk_id_factura = df.id_factura AND p7.fk_id_estudio = df.fk_id_estudio),
                km_estudios es
                WHERE fa.estado_factura <> 5
                AND es.fk_id_plantilla IN (1,2,3,5,6,7)
                AND es.id_estudio = df.fk_id_estudio
                
                AND cl.nombre like '%#nombreBusqueda#%'
                AND cl.a_paterno like '%#apellidoPaterno#%'
                AND cl.a_materno like '%#apellidoMaterno#%'
                ) a
                WHERE a.revisado = 1
                AND a.registrado = 'Si'
                AND (a.resta = 0 or a.resta < 0)
                ";
                break;
            case "clientes_h":
                return "
                select a.* from
                (
                SELECT DISTINCT $fk_id_perfil AS perfil,
                fa.id_factura,
                df.fk_id_estudio,
                DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
                DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
                su.desc_sucursal AS sucursal,
                CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
                es.desc_estudio AS estudio,
                fa.resta,
                es.fk_id_plantilla as num_plantilla,
                CASE
                    WHEN es.fk_id_plantilla = 1 THEN
                        CASE
                            WHEN p1.fk_id_estudio IS NULL THEN
                                'No'
                                ELSE
                                'Si'
                        END 
            
                    WHEN es.fk_id_plantilla = 2 THEN
                        CASE
                            WHEN p2.fk_id_estudio IS NULL THEN
                                'No'
                                ELSE
                                'Si'
                        END 			
            
                    WHEN es.fk_id_plantilla = 5 THEN
                        CASE
                            WHEN p5.fk_id_estudio IS NULL THEN
                                'No'
                                ELSE
                                'Si'
                        END 
                  
                    WHEN es.fk_id_plantilla = 6 THEN
                        CASE
                        WHEN p6.fk_id_estudio IS NULL THEN
                            'No'
                            ELSE
                            'Si'
                        END 
                   
                    WHEN es.fk_id_plantilla = 7 THEN
                        CASE
                        WHEN p7.fk_id_estudio IS NULL THEN
                            'No'
                            ELSE
                            'Si'
                        END 
                END AS Registrado,
                email_medico,
                email_paciente,
                CASE
                    WHEN es.fk_id_plantilla = 1 THEN
                        p1.validado
                    WHEN es.fk_id_plantilla = 2 THEN
                        p2.validado
                    WHEN es.fk_id_plantilla = 3 THEN
                        p2.validado
                    ELSE
                        1
                END AS revisado
                FROM so_factura fa
                LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
                LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
                LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
                LEFT OUTER JOIN cr_plantilla_1_re p1 ON (p1.fk_id_factura = df.id_factura AND p1.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_cvo_re p3 ON (p3.fk_id_factura = df.id_factura AND p3.fk_id_estudio = df.fk_id_estudio)
            
                LEFT OUTER JOIN cr_plantilla_ekg_re p5 ON (p5.fk_id_factura = df.id_factura AND p5.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_rx_re p6 ON (p6.fk_id_factura = df.id_factura AND p6.fk_id_estudio = df.fk_id_estudio)
                LEFT OUTER JOIN cr_plantilla_usg_re p7 ON (p7.fk_id_factura = df.id_factura AND p7.fk_id_estudio = df.fk_id_estudio),
                km_estudios es
                WHERE fa.estado_factura <> 5
                AND es.fk_id_plantilla IN (1,2,3,5,6,7)
                AND es.id_estudio = df.fk_id_estudio
                AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
                AND fa.fk_id_sucursal = 2
                ) a
                WHERE a.revisado = 1
                AND a.registrado = 'Si'
                AND (a.resta = 0 or a.resta < 0)
                "
                ;

                /*
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
                */
                break;
            default:
                return "";
        }

    }
?>
