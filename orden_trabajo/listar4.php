<?php

    include ("../controladores/conex.php");
    $query = "SELECT id_solicitud, fecha_recepcion,hora_recepcion,fecha_aplicacion,hora_aplicacion,fecha_entrega,hora_entrega,observaciones,diagnostico,cantidad_estudios,imp_subtotal,porc_descuento,porc_incremento,imp_total,a_cuenta,resta,
  afecta_comision,impresa,fecha_hora_impresa,entregada,estado,fecha_hora_entrega,origen,
  d.id_sucursal,
  d.des_sucursal,
  c.id_cliente,
  c.nombre cliente,
  c.a_paterno paterno,
  c.a_materno materno,
  c.edad,
  c.fk_id_sexo,
  b.id_medico,
  b.nombre,
  b.a_paterno,
  b.a_materno
    FROM so_cabezal e
INNER JOIN kg_sucursales d ON (d.id_sucursal = e.fk_id_empresa)
INNER JOIN so_clientes c ON (c.id_cliente = e.fk_id_cliente) 
INNER JOIN so_medicos b ON (b.id_medico = e.fk_id_medico) WHERE estado IN ('A')";



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