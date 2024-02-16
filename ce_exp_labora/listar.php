<?php

  session_start();

	include ("../controladores/conex.php");
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  
  //$id_usuario= ' = '.$_SESSION['id_usuario'];
  $query="
SELECT fa.`fk_id_cliente`,
        cl.`nombre`,
        cl.`a_paterno`,
        cl.`a_materno`,
	COUNT(fa.`id_factura`) AS numnotas,
	MIN(fa.`fecha_factura`) AS primerestudio,
	MAX(fa.fecha_factura) AS ultimoestudio
FROM so_factura fa,so_detalle_factura df,so_clientes cl
WHERE fa.`estado_factura` <> 5
AND fa.`id_factura` = df.`id_factura`
AND fa.`fk_id_cliente` = cl.`id_cliente`
GROUP BY fa.`fk_id_cliente`,cl.`nombre`,cl.`a_paterno`,cl.`a_materno`
ORDER BY cl.`nombre`,cl.`a_paterno`,cl.`a_materno`
LIMIT 90000
";

//echo $query;

//echo “<script languaje=’javascript’>alert(‘Perfil : “.$fk_id_perfil.”‘)</script>”;

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
        echo "<script>location.href='../ce_exp_labora/tabla_pacientes.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
