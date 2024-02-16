<?php
	include("../../config/db.php");
	include("../../config/conexion.php");

	$id = $_POST['id'];

	$query = "SELECT * FROM so_clientes WHERE id_cliente = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("i",$id);
	$stmt->execute();

	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc())
	{
		$data[]=$row;
	 }


	/* Toss back results as json encoded array. */
	echo json_encode($data);

?>
