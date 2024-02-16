<?php
session_start();
include ("../controladores/conex.php");
$fk_id_perfil=$_SESSION['fk_id_perfil'];
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

if($fk_id_perfil==1){
	$sucursal = ' > 0';
}else{
	$sucursal = ' = '.$fk_id_sucursal;
}

$query = "
SELECT fa.id_factura,
fa.fecha_factura,
fa.fecha_entrega,
	concat(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) as nombre,
	df.fk_id_estudio, 
	es.desc_estudio,
	CASE
	WHEN re.fk_id_factura IS NULL THEN
	1 -- sin interpretacion
	WHEN re.entregada IS NULL THEN
	2 -- pendiente de entregar
	ELSE
	3 -- entregado
	END AS realizado,
	re.validado,
	re.grupo,
	su.desc_corta,
	us.iniciales,
	date(re.entregada) as entregada
	FROM so_factura fa
	LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
	LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
	LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
	LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
	LEFT OUTER JOIN vw_resultado re ON (re.fk_id_factura = fa.id_factura AND re.fk_id_estudio = df.fk_id_estudio)
	LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = re.usuario)
	WHERE fa.estado_factura <> 5
	AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
	-- AND es.fk_id_plantilla IN (1,2,3,5,6,7)
	AND fa.fk_id_sucursal ".$sucursal
	;
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
