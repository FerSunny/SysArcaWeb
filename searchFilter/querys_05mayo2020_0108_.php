<?php
    /*
    *Funcion que retorna el query especificado por el tipo de busqueda a realizar
    *@param $tipoConsulta-string
    */
    function getQuery($tipoConsulta,$fk_id_perfil) {
        switch($tipoConsulta){
            case "clientes":
                return "SELECT $fk_id_perfil AS perfil, c.*,CONCAT(c.anios,'a',c.meses,'m',c.dias,'d') AS edad,
                            s.desc_sexo,ec.desc_estado_civil
                        FROM so_clientes c
                        LEFT OUTER JOIN so_sexo s
                        ON (s.fk_id_empresa= 1 AND s.id_sexo = c.fk_id_sexo)
                        LEFT OUTER JOIN kg_estado_civil ec
                        ON (ec.fk_id_empresa=1 AND ec.id_estado_civil = c.fk_id_estado_civil)
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
