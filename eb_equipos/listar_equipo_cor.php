<?php

session_start();

	include ("../controladores/conex.php");


$id_equipo=$_SESSION['id_equipo'];
  

 

  $query = "
  SELECT 
  a.*,
  date(a.fecha_reporte) as freporte,
  b.desc_tipo,
  c.desc_origen,
  d.razon_social,
  CONCAT(e.nombre,' ',e.a_paterno,' ',e.a_materno) AS usuario_res,
  CONCAT(f.nombre,' ',f.a_paterno,' ',f.a_materno) AS usuario_con
  FROM 
  eb_manto a,
  eb_tipos_mto b,
  eb_origen_mto c,
  eb_proveedores d,
  se_usuarios e,
  se_usuarios f
  WHERE a.estado = 'A'
  AND a.fk_id_equipo = $id_equipo
  AND a.fk_id_tipo = b.id_tipo
  AND a.fk_id_origen = c.id_origen
  AND a.fk_id_proveedor = d.id_proveedor
  AND a.fk_id_usuario_res = e.id_usuario
  AND a.fk_id_usuario_con = f.id_usuario
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

