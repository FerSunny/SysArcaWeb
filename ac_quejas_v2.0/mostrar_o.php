<?php
// Utilizaremos conexion PDO PHP
function conexion() {
	//Declaramos el servidor, la BD, el usuario Mysql y Contraseña BD.
    //return new PDO('mysql:host=localhost;dbname=bd_arca', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return new PDO('mysql:host=localhost;dbname=labora41_bd_arca', 'labora41_root', 'ArcaRoot_2017', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = conexion();
$keyword = '%'.$_POST['palabra'].'%';
//$sql = "SELECT * FROM lista_paises WHERE pais_nombre LIKE (:keyword) ORDER BY pais_id ASC LIMIT 0, 7";
$sql = "SELECT id_factura FROM so_factura WHERE id_factura LIKE (:keyword) ORDER BY id_factura ASC LIMIT 0, 7";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
	// Colocaremos negrita a los textos
	$id_factura = str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $milista['id_factura']);
	// Aquì, agregaremos opciones
    echo '<li onclick="set_item_o(\''.str_replace("'", "\'", $milista['id_factura']).'\')">'.$id_factura.'</li>';
}
?>