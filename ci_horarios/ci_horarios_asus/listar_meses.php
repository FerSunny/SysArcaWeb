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
SELECT  su.`desc_sucursal`,
    YEAR(h.`dia_atencion`) anio,
    MONTHNAME(h.`dia_atencion`)  mes,
    COUNT(DISTINCT h.`dia_atencion`) dias,
    h.fk_id_sucursal,
    year(h.dia_atencion) as anio,
    month(h.dia_atencion) as mes
FROM ca_horarios h
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = h.`fk_id_sucursal`)
WHERE h.`estado` = 'A'
AND h.`fk_id_sucursal` $sucursal
GROUP BY 1,2
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

