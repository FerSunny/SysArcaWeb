<?php
include("../../controladores/conex.php");

$fk_id_detalle = $_POST['fk_id_detalle'];

	//Obtenemos todos los productos de la solicitud
	$query = "SELECT fk_id_producto,cantidad FROM eb_solicitudes WHERE fk_id_detalle = $fk_id_detalle";
	$resultado = $conexion -> query($query);

	//Recorremos cada uno de ellos
	while ($row = mysqli_fetch_array($resultado))
	{
		//Obtenemos la cantidad
		$can = $row['cantidad'];
		//y el ID del producto
		$producto = $row['fk_id_producto'];

		//Hacemos el update a la tabla almacen central para disminuir las existencias
		$query = "UPDATE eb_almacen_central SET existencias = existencias- $can WHERE fk_id_producto = $producto";
		$result = $conexion->query($query);

	}

	if ($result) {
		echo "Se envio el pedido";

	}else{
		$codigo = mysqli_errno($conexion);
		echo "Eror en MySQL #".$codigo;
	}


$conexion->close();

?>
