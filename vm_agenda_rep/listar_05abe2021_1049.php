<?php

  session_start();

	include ("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');

  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  

  
  
  if ($fk_id_perfil==1){
	$id_usuario = '> 0 OR ag.fk_id_usuario IS NULL';
  }else
  {
	$id_usuario= ' = '.$_SESSION['id_usuario'];
  }
  



	$query = "
  SELECT fecha,
  fk_id_usuario,
  COUNT(*) as medicos
  FROM vm_agenda	
  WHERE estado = 'A'
  and fk_id_usuario  ".$id_usuario."
  GROUP BY fecha
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
