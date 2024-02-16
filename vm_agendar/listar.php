<?php
  session_start();
	include ("../controladores/conex.php");


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  

  switch ($fk_id_perfil) {
      case '1':
          $id_usuario = '> 0 OR me.fk_id_usuario IS NULL';
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
	$id_usuario = '> 0 OR ag.fk_id_usuario IS NULL';
  }else
  {
	$id_usuario= ' = '.$_SESSION['id_usuario'];
  }
  */
  
	$query = "
	SELECT  
	me.`id_medico`,
  me.`a_paterno`,
  me.`a_materno`,
  me.`nombre`,
  a.veces,
  a.ultima_fecha ,
  a.primer_fecha,
  a.hora,
  ra.`Numfact` AS actual,
  ra1.`Numfact` AS uno,
  ra2.`Numfact` AS dos,
  ra3.`Numfact` AS tres,
  ra4.`Numfact` AS cuatro


FROM so_medicos me

LEFT OUTER JOIN 
(
SELECT va.fk_id_medico, va.fk_id_usuario, COUNT(*) AS veces, MIN(va.fecha) AS primer_fecha, 
MAX(va.fecha) AS ultima_fecha, MAX(va.hora) as hora
FROM vm_agenda va
WHERE va.estado IN ('A','E')
GROUP BY va.fk_id_medico, va.fk_id_usuario
) a  ON (a.fk_id_medico = me.`id_medico` AND a.fk_id_usuario = me.`fk_id_usuario`)
LEFT OUTER JOIN vw_record_notas_medico ra ON (ra.`fk_id_medico` = me.`id_medico` AND ra.`anio_factura` = YEAR(NOW()) AND ra.`mes_factura` = MONTH(NOW()))
LEFT OUTER JOIN vw_record_notas_medico ra1 ON (ra1.`fk_id_medico` = me.`id_medico` AND ra1.`anio_factura` = YEAR(NOW()) AND ra1.`mes_factura` = MONTH(DATE_SUB(NOW(),INTERVAL 1 MONTH)))
LEFT OUTER JOIN vw_record_notas_medico ra2 ON (ra2.`fk_id_medico` = me.`id_medico` AND ra2.`anio_factura` = YEAR(NOW()) AND ra2.`mes_factura` = MONTH(DATE_SUB(NOW(),INTERVAL 2 MONTH)))
LEFT OUTER JOIN vw_record_notas_medico ra3 ON (ra3.`fk_id_medico` = me.`id_medico` AND ra3.`anio_factura` = YEAR(NOW()) AND ra3.`mes_factura` = MONTH(DATE_SUB(NOW(),INTERVAL 3 MONTH)))
LEFT OUTER JOIN vw_record_notas_medico ra4 ON (ra4.`fk_id_medico` = me.`id_medico` AND ra4.`anio_factura` = ( CASE WHEN MONTH(NOW()) < MONTH(DATE_SUB(NOW(),INTERVAL 4 MONTH)) THEN YEAR(DATE_SUB(NOW(),INTERVAL 1 YEAR)) ELSE YEAR(NOW()) END ) AND ra4.`mes_factura` = MONTH(DATE_SUB(NOW(),INTERVAL 4 MONTH)))


WHERE me.`estado` = 'A'
AND me.`fk_id_usuario`".$id_usuario;
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
