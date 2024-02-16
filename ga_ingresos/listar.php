<?php
 session_start();


	include ("../controladores/conex.php");

    $fk_id_perfil=$_SESSION['fk_id_perfil'];
    $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  
    if($fk_id_perfil == 1){
        $sucursal = " >= 0";
    }else{
        $sucursal = " = ".$fk_id_sucursal;
    }
 

  $query = "
  SELECT 
  i.*,
  date(i.fecha_mov) as fecha,
  time(i.fecha_mov) as tiempo,
  CONCAT(u.`nombre`,' ',u.`a_paterno`,' ',u.`a_materno`) AS cajero,
  g.`desc_gasto`
  FROM ga_ingreso i
  LEFT OUTER JOIN se_usuarios u ON (u.`id_usuario` = i.`fk_id_usuario_caj`)
  LEFT OUTER JOIN ga_gasto g ON(g.`id_gasto` = i.`fk_id_gasto`)
  WHERE i.estado = 'A'
  AND i.fk_id_sucursal $sucursal
  ";

//echo $query;s



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

