                                                                  <?php

	include ("../controladores/conex.php");

	$query = "SELECT   
    id_estudio,
    desc_estudio,
    tiempo_entrega,
    costo,
    d.desc_descuento,
    p.desc_promocion,
    i.desc_indicaciones,
    j.desc_comision,
    e.fk_id_plantilla,
    CASE 
        WHEN e.per_paquete = 'No' AND e.per_perfil = 'No' THEN
            'nr'
        WHEN e.per_paquete = 'Si' THEN
            'pq'
        WHEN e.per_perfil = 'Si' THEN
            'pe'
        ELSE
            'na'
    END AS tipoestudio,
    DAYOFWEEK(CURDATE()) as dia_hoy,
    p.lunes,
    p.martes,
    p.miercoles,
    p.jueves,
    p.viernes,
    p.sabado,
    p.domingo,
    p.tuly,
    p.tuly2,
    p.greg,
    p.xochi,
    p.sant,
    p.pablo,
    p.pedro,
    p.teco,
    p.tete,
    p.estado,
    p.dino,
    p.tla,
	p.mil,
    p.porcentaje
    FROM km_estudios e
LEFT OUTER JOIN kg_descuentos d ON (d.id_descuento = e.fk_id_descuento) 
LEFT OUTER JOIN kg_promociones p ON (p.id_promocion = e.fk_id_promosion and ((CURDATE() BETWEEN p.fecha_inicio AND p.fecha_final) OR e.`fk_id_promosion` = 7))
LEFT OUTER JOIN km_indicaciones i ON (i.id_indicaciones = e.fk_id_indicaciones) 
LEFT OUTER JOIN kg_comisiones j ON (j.id_comision = e.fk_id_comision ) 
WHERE estatus IN ('A')
AND substr(e.desc_estudio,1,5) <> 'MAQDN'{
    /*
AND e.id_estudio NOT IN (
	151, 152, 153, 904, 905, 625, 307, 314, 628, 275, 301, 304, 876, 1155, 486, 274, 
	616, 586, 587, 217, 410, 870, 622, 412, 632, 640, 235, 641, 720, 886, 731, 585, 
	566, 528, 130, 749, 1997, 1120, 1122, 1121, 1124, 678, 679, 661, 663, 646, 645, 
	2137, 680, 848,494
	)
    */
";

	$resultado = mysqli_query($conexion, $query);
    if(!$resultado){
        die("Error");
    }else{
        while($data=mysqli_fetch_assoc($resultado))
        {
//validamos la promocion.
            if ($data['desc_promocion']== null){
                $promocion = 'Sin Promocion';
            }else{
                $promocion = $data['desc_promocion'].'('.$data['porcentaje'].'%)';
                if($data['porcentaje'] > 0.0){
                    $imp_pro=0;
                    if ($data['dia_hoy'] == 1 ){
                        if($data['domigo'] == 'S'){
                            $imp_pro= ($data['costo']*$data['porcentaje'])/100;
                        }
                    }

                    if ($data['dia_hoy'] == 2 ){
                        if($data['lunes'] == 'S'){
                            $imp_pro= ($data['costo']*$data['porcentaje'])/100;
                        }
                    }

                    if ($data['dia_hoy'] == 3 ){
                        if($data['martes'] == 'S'){
                            $imp_pro= round((($data['costo']*$data['porcentaje'])/100),1);
                        }
                    }

                    if ($data['dia_hoy'] == 4 ){
                        if($data['miercoles'] == 'S'){
                            $imp_pro= ($data['costo']*$data['porcentaje'])/100;
                        }
                    }

                    if ($data['dia_hoy'] == 5 ){
                        if($data['jueves'] == 'S'){
                            $imp_pro= ($data['costo']*$data['porcentaje'])/100;
                        }
                    }

                    if ($data['dia_hoy'] == 6 ){
                        if($data['viernes'] == 'S'){
                            $imp_pro= ($data['costo']*$data['porcentaje'])/100;
                        }
                    }

                    if ($data['dia_hoy'] == 7 ){
                        if($data['sabado'] == 'S'){
                            $imp_pro= ($data['costo']*$data['porcentaje'])/100;
                        }
                    }

                    
                }else{
                    $imp_pro = 0;
                }
            }

            $datos = [
                'id_estudio'        => $data['id_estudio'],
                'desc_estudio'      => $data['desc_estudio'],
                'tiempo_entrega'    => $data['tiempo_entrega'],
                'costo'             => $data['costo'],
                'precio'             => $data['costo']-$imp_pro,
                'desc_descuento'    => $data['desc_descuento'],
               // 'desc_promocion'    => $data['desc_promocion'],
                'desc_promocion'    => $promocion,
                'desc_indicaciones'    => $data['desc_indicaciones'],
                'desc_comision'    => $data['desc_comision'],
                'fk_id_plantilla'    => $data['fk_id_plantilla'],
                'tipoestudio'    => $data['tipoestudio']


            ];




            $arreglo["data"][]=$datos;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
