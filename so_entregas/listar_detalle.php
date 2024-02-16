<?php
session_start();
include ("../controladores/conex.php");
$id_sucursal=$_SESSION['id_sucursal'];
$servicio=$_SESSION['servicio'];

$query = "
SELECT
fa.`id_factura`,
cl.`anios`,
CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) paciente,
es.`desc_estudio`,
TIME(fa.`fecha_entrega`) AS hora_entrega
FROM so_factura fa, so_detalle_factura df,so_clientes cl, km_estudios es
WHERE fa.`estado_factura` <> 5
AND DATE(fa.`fecha_entrega`) = CURDATE()
AND fa.`id_factura` = df.`id_factura`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND df.`fk_id_estudio` = es.`id_estudio`
AND fa.fk_id_sucursal = $id_sucursal
AND es.`fk_id_tipo_estudio` = $servicio

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

