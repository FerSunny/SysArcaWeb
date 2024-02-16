<?php

session_start();

	include ("../controladores/conex.php");

  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

    if ($fk_id_perfil==1 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
       $sucursal = "> 0"; 
    }ELSE{
        $sucursal = " = ".$fk_id_sucursal;
    }

 

  $query = "
SELECT  
    su.`desc_sucursal`,
    h.fk_id_sucursal,
    YEAR(h.`dia_atencion`) anio,
    MONTHNAME(h.`dia_atencion`)  mes,
    MONTH(h.dia_atencion) AS mes_num,
    COUNT(h.`dia_atencion`) dias
    -- COUNT(DISTINCT h.`dia_atencion`) dias
FROM ca_horarios h
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = h.`fk_id_sucursal`)
WHERE h.`estado` = 'A'
AND h.`fk_id_sucursal` $sucursal
GROUP BY 1,3,4
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

