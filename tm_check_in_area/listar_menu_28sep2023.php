                                                                  <?php

	include ("../controladores/conex.php");

	$query = "
    SELECT
    ar.clave,
    ar.`desc_area`,
    COUNT(DISTINCT df.`id_factura`) AS ot,
    COUNT(DISTINCT df.fk_id_estudio) AS estudios
    FROM 
    so_detalle_factura df,
    so_factura fa,
    km_estudios_area ea,
    km_areas ar
    WHERE DATE(fa.`fecha_factura`) = CURDATE()-25
    AND df.`id_factura` = fa.id_factura
    AND ea.`fk_id_estudio` = df.`fk_id_estudio`
    AND ea.`fk_id_clave_area` = ar.`clave` AND ar.`estado` = 'A'
    GROUP BY 1,2
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
