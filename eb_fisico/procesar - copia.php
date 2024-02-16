<?php
include ("../controladores/conex.php");

$contacto=$_POST['contacto'];
$cantidad=$_POST['cantidad'];
$estatus=0;

for($i=0;$i<count($contacto);$i++){

    $producto=$contacto[$i];
    $piezas=$cantidad[$i];

    $query ="
    INSERT INTO `eb_fisico`
    (`fk_id_empresa`,
     `id_fisico`,
     `fk_id_almacen`,
     `fk_cod_producto`,
     `cantidad`,
     `fecha`,
     `estado`)
    VALUES (1,
    0,
    1,
    '$producto',
    $piezas,
    NOW(),
    'P');
    ";

    $result = $conexion -> query($query);
    if ($result) {
        $estatus=0;
    }else{
        $estatus=1;
    }
}

if($estatus==0){
    $sql_fisico=
    "
    select  fi.* from eb_fisico fi 
    where fi.estado = 'P'
    ";
    if ($result_fisico = mysqli_query($conexion, $sql_fisico)) {
        while($row_fisico = $result_fisico->fetch_assoc())
        {
            $codigo_producto=$row_fisico['fk_cod_producto'];
            $cantidad=$row_fisico['cantidad'];
            $sql_existe="
            select ac.*  FROM eb_almacen_central ac,eb_productos pr
            where ac.fk_id_producto = pr.id_producto
            AND pr.cod_producto = '$codigo_producto'
            ";
            if ($result_existe = mysqli_query($conexion, $sql_existe)) {
                    while($row_existe = $result_existe->fetch_assoc())
                    {
                        $id_producto=$row_existe['fk_id_producto'];
                        $sql_update="UPDATE eb_almacen_central SET existencias = $cantidad WHERE fk_id_producto = $id_producto";
                        $execute_query_update = mysqli_query($conexion,$sql_update);
                        $sql_update="UPDATE eb_fisico SET estado = 'A' WHERE fk_cod_producto = $codigo_producto";
                        $execute_query_update = mysqli_query($conexion,$sql_update);                    
                    }else{
                        $sql_nuevo="select * from eb_productos pr where pr.cod_producto = '$codigo_producto'";
                        if ($result_nuevo = mysqli_query($conexion, $sql_nuevo)) {
                            while($row_nuevo = $result_nuevo->fetch_assoc())
                            {
                                $id_pro= $row_nuevo['id_producto'];
                                $prove=$row_nuevo['fk_id_proveedor'];
                                $costo=$row_nuevo['costo_producto'];

                                $insert_nuevo=
                                "
                                INSERT INTO `eb_almacen_central`
                                (`fk_id_empresa`,`fk_id_sucursal`,`id_central`,`fk_id_producto`,`fk_id_proveedor`,`costo_producto`,`existencias`,`min`,`max`,`fecha_actualizacion`,`estado`)
                                VALUES (1,0,0,$id_pro,$prove,$costo,$cantidad,0,0,now(),'A')";
                                $execute_query_nuevo = mysqli_query($conexion,$sql_nuevo); 
                            }
                        }else{
                            echo"<script>alert('no encontro el articulo nuevo')</script>"; 
                            $sql_f="UPDATE eb_fisico SET estado = 'F' WHERE fk_cod_producto = $codigo_producto";
                            $execute_query_f = mysqli_query($conexion,$sql_f);   
                        }
                    }
                }

        }
    }else{
        echo "no leyo fisico".$sql_fisico;
    }
    
}



/*
$sql_existe="
select ac.*  FROM eb_almacen_central ac,eb_productos pr
where ac.fk_id_producto = pr.id_producto
";
  if ($result_existe = mysqli_query($conexion, $sql_existe)) {
    while($row_existe = $result_existe->fetch_assoc())
    {
        $sql_update="UPDATE eb_almacen_central SET num_imp = $veces, fecha_impresion = '$fecha' WHERE fk_id_factura = $numero_factura AND fk_id_estudio = $studio";
        //echo $sql_update;
        $execute_query_update = mysqli_query($con,$sql_update);
    }
  }
*/