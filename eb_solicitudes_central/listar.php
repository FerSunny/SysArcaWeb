<?php

    include ("../controladores/conex.php");

    session_start();
    $sucursal =$_SESSION['fk_id_sucursal'];
        $perfil =$_SESSION['fk_id_perfil'];


    /*$query = "SELECT '$perfil' perfil, dsol.fk_id_sucursal, dsol.id_detalle,suc.desc_sucursal,CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_paterno) nombre,
        dsol.fk_id_sucursal,
        dsol.fecha_registro, dsol.estatus,dsol.fk_id_usuario,dsol.tipo
        FROM eb_detalle_solicitud dsol
        LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = dsol.fk_id_sucursal)
        LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = dsol.fk_id_usuario)
        WHERE dsol.fk_id_sucursal > 0 AND dsol.estado = 'A' ";*/

    $query = "SELECT dsol.fk_id_sucursal, dsol.id_detalle,suc.desc_sucursal,CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_paterno) nombre,
            dsol.fk_id_sucursal,
                dsol.fecha_registro, dsol.estatus,dsol.fk_id_usuario,dsol.tipo,
               IFNULL(prov.razon_social,'Tulyehualco') AS proveedor
        FROM eb_detalle_solicitud dsol
        LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = dsol.fk_id_sucursal)
        LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = dsol.fk_id_usuario)
        LEFT OUTER JOIN eb_solicitudes sol ON (sol.fk_id_detalle = dsol.id_detalle)
        LEFT OUTER JOIN eb_proveedores prov ON (prov.`id_proveedor` = sol.`fk_id_proveedor`)
        WHERE dsol.fk_id_sucursal > 0 AND dsol.estado = 'A' GROUP BY id_detalle;" ;

    /*
    prov.razon_social
    LEFT OUTER JOIN kg_sucursales suc ON (suc.fk_id_sucursal= dsol.fk_id_sucursal)
    */
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
