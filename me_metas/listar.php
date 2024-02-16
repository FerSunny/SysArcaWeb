<?php



	include ("../controladores/conex.php");



  

 

  $query = "
        SELECT me.*,
            su.`desc_sucursal`,
            m.desc_mes
        FROM me_metas me
        LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = me.`fk_id_sucursal`)
        LEFT OUTER JOIN kg_meses m on (m.id_mes = me.fk_id_mes)
        WHERE me.`estado` = 'A'
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

