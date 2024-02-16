<?php



	include ("../controladores/conex.php");



  

 

  $query = "
    SELECT c.*,
        CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente,
        su.`desc_corta`,
        CONCAT(cl.`telefono_fijo`,' , ',cl.`telefono_movil`) AS telefono
    FROM so_factura_pre c
    LEFT OUTER JOIN so_clientes cl ON (cl.`id_cliente` = c.`fk_id_cliente`)
    LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = c.`fk_id_sucursal`)
    WHERE c.`fecha_factura` >= (DATE_SUB(NOW(), INTERVAL 15 DAY))
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

