<?php

session_start();

	include ("../controladores/conex.php");


$id_equipo=$_SESSION['id_equipo'];
  

 

  $query = "
  SELECT 
  a.*,
  CONCAT(a.hora_inicio,'-',a.hora_final,' Hrs') AS horario,
  b.descripcion,
  c.razon_social,
  CONCAT(d.nombre,' ',d.a_paterno) AS usuario_mto,
  CONCAT(e.nombre,' ',e.a_paterno) AS usuario_con
  FROM 
  eb_calendario_mto a,
  eb_equipos b,
  eb_proveedores c,
  se_usuarios d,
  se_usuarios e
  WHERE a.estado = 'A'
  and a.fk_id_equipo = $id_equipo
  AND a.fk_id_equipo = b.id_equipo
  AND a.fk_id_proveedor = c.id_proveedor
  AND a.fk_id_usuario_mto = d.id_usuario
  AND a.fk_id_usuario_con = e.id_usuario
  ";

//echo $query;



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

