<?php



	include ("../controladores/conex.php");



  

 

  $query = "
SELECT
  tu.id_turno,
  tu.fk_id_sucursal,
  tu.fecha,
  tu.caja,
  tu.turno,
  tu.estado,
  CASE
  WHEN
  fa.id_factura IS NULL THEN
    0
  ELSE
    fa.id_factura
  END AS estatus
FROM so_turnos tu
LEFT OUTER JOIN so_factura fa ON (fa.turno_num = tu.turno AND DATE(fa.fecha_factura) = DATE(tu.fecha))
WHERE tu.estado = 'A'
AND DATE(tu.fecha) = curdate()
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

