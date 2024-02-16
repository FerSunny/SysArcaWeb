<?php

	include ("../controladores/conex.php");
    session_start();

    $sucursal =$_SESSION['fk_id_sucursal'];
  
 
 /* $query = "SELECT pro.id_producto,pro.cod_producto,pro.desc_producto,prv.razon_social,ac.id_central,ac.existencias,ac.min,ac.max, ac.fk_id_proveedor FROM eb_almacen_central ac 
LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = ac.fk_id_producto)
LEFT OUTER JOIN eb_proveedores prv ON (prv.id_proveedor = ac.fk_id_proveedor)
WHERE  ac.fk_id_sucursal = 1 AND ac.estado = 'A'
";*/

$query="SELECT pro.id_producto,pro.cod_producto,pro.desc_producto,prv.razon_social,pro.fecha_actualizacion,ac.id_central,ac.existencias,ac.min,ac.max, ac.fk_id_proveedor FROM eb_almacen_central ac 
LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = ac.fk_id_producto)
LEFT OUTER JOIN eb_proveedores prv ON (prv.id_proveedor = ac.fk_id_proveedor)
WHERE  ac.fk_id_sucursal = 1 AND ac.estado = 'A'";


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
