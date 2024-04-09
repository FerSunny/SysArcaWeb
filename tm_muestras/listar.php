<?php

	include ("../controladores/conex.php");

  
 
  $query = "SELECT pd.*,pr.razon_social FROM eb_productos pd
  LEFT OUTER JOIN eb_proveedores pr ON (pr.id_proveedor = pd.fk_id_proveedor) WHERE   pd.estado='A'";


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
