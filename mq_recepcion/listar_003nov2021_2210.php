<?php

	include ("../controladores/conex.php");

    include ("../controladores/conex_dino.php");

  
 
  $query = "
SELECT 11 AS fk_id_sucursal,
ma.fk_id_factura,
ma.fecha_envio,
ma.fk_id_estudio,
ma.observa,
ma.costo_maq
FROM ma_maquila ma
WHERE ma.`estado` = 'A'
";
//echo $query;
	$resultado = mysqli_query($conexion_dino, $query);

    if(!$resultado){
        die("Error");

    }else{
        while($data=mysqli_fetch_assoc($resultado)){

// Extraemos los datos de la sucursal ARCA sucursal
            $id_sucursal = $data['fk_id_sucursal'];
            $querysucursal = mysqli_query($conexion,"SELECT su.desc_sucursal FROM kg_sucursales su WHERE su.id_sucursal = $id_sucursal");
            $muestra = mysqli_fetch_array($querysucursal);
            $desc_sucursal = $muestra['desc_sucursal'];
//

// Extraemos los datos de ARCA estudios
            $id_estudio = $data['fk_id_estudio'];
            $queryestudio = mysqli_query($conexion,"SELECT es.fk_id_estudio_maq FROM km_estudios es WHERE es.id_estudio = $id_estudio");
            $nr = mysqli_num_rows($queryestudio); 
            if($nr == 1){
                $muestra = mysqli_fetch_array($queryestudio);
                $fk_id_estudio_maq = $muestra['fk_id_estudio_maq'];
				if($fk_id_estudio_maq== NULL){
					$desc_estudio = 'No hay estudio de maquila 2 => '.$id_estudio;
				}else{
					$queryestudio_m = mysqli_query($conexion,"SELECT es.costo, es.desc_estudio FROM km_estudios es WHERE es.id_estudio = $fk_id_estudio_maq");
					$nrm = mysqli_num_rows($queryestudio_m);
					if($nrm == 1){
						$muestra_m = mysqli_fetch_array($queryestudio_m);
						$desc_estudio = $muestra_m['desc_estudio'];
						$costo_maq = $muestra_m['costo'];
					}else{
						$desc_estudio = 'No hay estudio de maquila 2 => '.$id_estudio;
					}
				}				
            }else{
                $desc_estudio = 'No hay estudio de maquila => '.$id_estudio;
            }


//
// Extraemos los datos de la factura ARCA
            $id_factura = $data['fk_id_factura'];
            $queryfactura = mysqli_query($conexion,"
										 SELECT fa.id_factura
										 FROM so_factura fa, so_detalle_factura df
										 WHERE df.estado_factura <> 5
										 AND fa.id_factura = df.id_factura
										 AND fa.fk_id_factura_maq = $id_factura
										 AND df.fk_id_estudio = $fk_id_estudio_maq
										 ");
            $muestra = mysqli_fetch_array($queryfactura);
            $nr = mysqli_num_rows($queryfactura); 
            if($nr == 1){           
                $fk_id_factura_maq = $muestra['id_factura'];
            }else{
                $fk_id_factura_maq = 'Folio aun no asignado';
            }
//

            $datos = [
                'fk_id_sucursal' => $data['fk_id_sucursal'],
                'id_factura'  => $data['fk_id_factura'],
                'fecha_envio'    => $data['fecha_envio'],
                'fk_id_estudio'    => $data['fk_id_estudio'],
				'observa'    => $data['observa'],
                'desc_sucursal'  => $desc_sucursal,
                'desc_estudio'   => $desc_estudio,
                'fk_id_factura_maq' => $fk_id_factura_maq,
				'fk_id_estudio_maq' => $fk_id_estudio_maq,
				'costo_maq' => $data['costo_maq']
            ];
            

            $arreglo["data"][]=$datos;

        }
        echo json_encode($arreglo);

    }

    mysqli_free_result($resultado);
    mysqli_close($conexion_dino);
