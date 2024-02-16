<?php

	session_start();
  include ("../controladores/conex.php");
  
 // $id_modulo=$_SESSION['id_modulo'];
 /*
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  $id_usuario=$_SESSION['id_usuario'];
*/


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  
  switch ($fk_id_perfil) {
      case '1':
          $id_usuario = '> 0 ';
          break;
      case '42':
          $id_usuario = '> 0 ';
          break;      
      default:
          $id_usuario= ' = '.$_SESSION['id_usuario'];// code...
          break;
  }
  
  /*
  if ($fk_id_perfil==1){
	$id_usuario = '> 0 OR me.fk_id_usuario IS NULL';
  }else
  {
	$id_usuario= ' = '.$_SESSION['id_usuario'];
  }
	*/
  $query="
  SELECT 
  '".$fk_id_perfil."' AS perfil,
    me.id_medico,
    me.`nombre`,
    me.`a_paterno`,
    me.`a_materno`,
    me.`fecha_registro`,
    zo.`desc_zona`,
    vm.`primer_nota`,
    vm.`ultima_nota`,
    vm.`promedio`,
    us.`iniciales`,
    mc.antiguedad,
    mc.`categoria`
  FROM so_medicos me
  LEFT OUTER JOIN kg_zonas zo ON(zo.`id_zona` = me.`fk_id_zona`)
  LEFT OUTER JOIN vw_vm_medicos_notas vm ON (vm.`fk_id_medico` = me.`id_medico`)
  LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = me.`fk_id_usuario`)
  LEFT OUTER JOIN vw_medicoscategoria mc ON (mc.`id_medico` = me.`id_medico`),
  vm_agenda ag
  WHERE me.estado ='A'
  AND ag.`fecha` >= '2022-10-01'
  AND me.fk_id_usuario > 0
  AND ag.`fk_id_medico` = me.`id_medico`
  AND ag.`fk_id_usuario`".$id_usuario
;

//echo $query;

$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
        echo "<script>location.href='../ag_orden_dia_rad/tabla_medicos.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);