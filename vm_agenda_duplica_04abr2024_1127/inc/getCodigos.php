<?php

require 'database.php';

$con = new Database();
$pdo = $con->conectar();

$campo = $_POST["campo"];

$sql = "SELECT id_medico, concat(nombre,' ',a_paterno,' ',a_materno) nombre FROM so_medicos WHERE (id_medico LIKE ? OR concat(nombre,' ',a_paterno,' ',a_materno) LIKE ?) and estado = 'A' ORDER BY 1 ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	//echo 'php';
	$html .= "<li onclick=\"mostrar('" . $row["id_medico"] . "')\">" . $row["id_medico"] . " - " . $row["nombre"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
