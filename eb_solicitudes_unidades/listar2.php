<?php



    include ("../controladores/conex.php");



    session_start();

    $sucursal =$_SESSION['fk_id_sucursal'];





    $query = "SELECT dsol.id_detalle,suc.desc_sucursal,CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_paterno) nombre,

        dsol.fecha_registro, dsol.estatus

        FROM eb_detalle_solicitud dsol

        LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = dsol.fk_id_sucursal)

        LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = dsol.fk_id_usuario)

        WHERE dsol.fk_id_sucursal = $sucursal AND tipo = 2";

//echo $query;

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

