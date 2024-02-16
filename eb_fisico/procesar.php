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

$resultado=0;

if($estatus==0){
    // Leemos el inventario fisico
    $sql_fisico="select  fi.* from eb_fisico fi where fi.estado = 'P'";
    if ($result_fisico = mysqli_query($conexion, $sql_fisico)) {
        while($row_fisico = $result_fisico->fetch_assoc())
        {
            $cod_producto=$row_fisico['fk_cod_producto'];
            $cantidad=$row_fisico['cantidad'];

            //VERIFICAMOS SI EXISTE EN EL ALMACEN CENTRAL
            $stm_almacent = mysqli_query($conexion,"SELECT ac.*  FROM eb_almacen_central ac,eb_productos pr
            WHERE ac.fk_id_producto = pr.id_producto
            AND pr.cod_producto = $cod_producto ");
            $nr = mysqli_num_rows($stm_almacent); 
            if($nr == 1){
                // EXISTE, ACTUALIZAMOS EXISTENCIAS
                $row_almacent = mysqli_fetch_array($stm_almacent);
                $fk_id_producto = $row_almacent['fk_id_producto'];
                $stm_up_almacent = "UPDATE eb_almacen_central SET existencias = $cantidad                           WHERE fk_id_producto = $fk_id_producto";
                $exe_up_almacent = mysqli_query($conexion,$stm_up_almacent);
                if($exe_up_almacent){
                    // CAMBIAMOS EL ESTATUS DEL FISICO
                    $stm_up_fis="UPDATE eb_fisico SET estado = 'A' WHERE fk_cod_producto = $cod_producto";
                    $exe_up_fis = mysqli_query($conexion,$stm_up_fis);
                    if($exe_up_fis){
                        $resultado = 0;
                    }else{
                        $resultado = 3;
                    }
                }else{
                    $resultado = 1;
                }
            }else{ // no existe en almacen harenos un INSERT
                    //DAMOS DE ALTA UN NUEVO PRODUCTO EN EL ALMACEN
                    $stm_exi_pro="SELECT * FROM eb_productos WHERE cod_producto = '$cod_producto' ";
                  
                     if ($result_exi_pro = mysqli_query($conexion, $stm_exi_pro)) {
                        while($row_exi_pro = $result_exi_pro->fetch_assoc())
                        {
                            $pro=$row_exi_pro['id_producto'];
                            $cod_pro=$row_exi_pro['cod_producto'];
                            $prove=$row_exi_pro['fk_id_proveedor'];
                            $costo=$row_exi_pro['costo_producto'];
                            $resultado = 5;
                            
                            $stm_ins_almacent=
                            "
                            INSERT INTO eb_almacen_central
                                        (fk_id_empresa,
                                         fk_id_sucursal,
                                         id_central,
                                         fk_id_producto,
                                         fk_id_proveedor,
                                         costo_producto,
                                         existencias,
                                         min,
                                         max,
                                         fecha_actualizacion,
                                         estado)
                            VALUES (1,
                                    1,
                                    0,
                                    '$pro',
                                    $prove,
                                    $costo,
                                    $cantidad,
                                    0,
                                    0,
                                    now(),
                                    'A')
                            ";
                            $exe_ins_almacent = mysqli_query($conexion,$stm_ins_almacent);
                            if($exe_ins_almacent){
                                $resultado=0;


                                $stm_up_fis="UPDATE eb_fisico SET estado = 'A' WHERE fk_cod_producto = $cod_producto";
                                $exe_up_fis = mysqli_query($conexion,$stm_up_fis);
                                if($exe_up_fis){
                                    $resultado = 0;
                                }else{
                                    $resultado = 3;
                                }


                                
                            }else{
                                $resultado=4;
                            }




                        }//
                    }else{
                        $resultado=6;
                    }
                   
                }
            }
        }    
    }else{  //cierre de no leyo el fisico
        $resultado=2;
    }


switch ($resultado) {
    case '0':
        echo"<script>alert('Se actualizaron las existencis')</script>"; 
        echo "<script>location.href='fisico.php'</script>";
        break;
    
    case '1':
        echo"<script>alert('Error al actualizar la existencia')</script>"; 
         echo "<script>location.href='fisico.php'</script>";
        break;
    
    case '2':
        echo"<script>alert('No leyo el fisico')</script>"; 
         echo "<script>location.href='fisico.php'</script>";
        break;
    
    case '3':
        echo"<script>alert('Error no cambio el estatus del FISICO')</script>";
         echo "<script>location.href='fisico.php'</script>"; 
        break;
    case '4':
        echo"<script>alert('Error al guardar nuevo producto en alamacen central')</script>";
         echo "<script>location.href='fisico.php'</script>"; 
        break;
    case '5':
        echo"<script>alert('si existe en productos')</script>";
         echo "<script>location.href='fisico.php'</script>"; 
        break;
    case '6':
        echo"<script>alert('NO existe en productos')</script>";
         echo "<script>location.href='fisico.php'</script>"; 
        break;
    default:
        // code...
        break;
}


