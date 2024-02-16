<?php

	include ("../controladores/conex.php");
    session_start();

    $sucursal =$_SESSION['fk_id_sucursal'];
  
 
  $query = "SELECT 
    f.id_facturacion,
    fa.id_factura,
    fa.numero_factura,
    f.nombre,
    f.rfc,
    f.domicilio,
    f.email,
    tp.desc_tipo_pago,
    u.desc_uso,
    fa.fk_id_tipo_pago,
    f.fk_id_usos
    FROM so_facturacion f
    INNER JOIN kg_usos u ON f.fk_id_usos=u.id_uso
    INNER JOIN so_factura fa ON fa.id_factura=f.fk_id_factura
    INNER JOIN kg_tipo_pago tp ON tp.id_tipo_pago=fa.fk_id_tipo_pago ";



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
