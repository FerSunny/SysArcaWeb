<?php
    session_start();
	include ("../controladores/conex.php");
    $sucursal =$_SESSION['fk_id_sucursal'];
    
 
$query = "SELECT pro.id_producto,pro.cod_producto,pro.desc_producto,prv.razon_social,au.id_unidades,au.existencias,au.min,au.max, au.fk_id_proveedor FROM eb_almacen_unidades au 
LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = au.fk_id_producto)
LEFT OUTER JOIN eb_proveedores prv ON (prv.id_proveedor = au.fk_id_proveedor) 
WHERE au.estado = 'A'
AND au.fk_id_sucursal = $sucursal
";



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
