<?php

	include ("../controladores/conex.php");
    session_start();

    $sucursal =$_SESSION['fk_id_sucursal'];
  
 
  $query = "SELECT
    ds.id_detalle,
    'Tulyehualco' empresa,
    suc.desc_sucursal,
    CONCAT(us.nombre,' ',us.a_paterno, ' ',us.a_materno) usuario,
    ds.importe_total,
    ds.fecha_registro,
    ds.estatus,
    ds.estado
    FROM eb_detalle_solicitud ds
    LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = ds.fk_id_sucursal)
    LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ds.fk_id_usuario)
    LEFT OUTER JOIN eb_productos pd ON (pd.id_producto = ds.fk_id_sucursal)
    LEFT OUTER JOIN eb_solicitudes es ON (es.id_solicitud = ds.fk_id_usuario) where 
    ds.estado='A'";


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
