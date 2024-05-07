<?php
// Utilizaremos conexion PDO PHP
function conexion() {
	//Declaramos el servidor, la BD, el usuario Mysql y Contraseña BD.
    return new PDO('mysql:host=localhost;dbname=labora41_bd_arca', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //return new PDO('mysql:host=localhost;dbname=labora41_bd_arca', 'labora41_root', 'ArcaRoot_2017', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = conexion();
$keyword = '%'.$_POST['palabra'].'%';
//$sql = "SELECT * FROM lista_paises WHERE pais_nombre LIKE (:keyword) ORDER BY pais_id ASC LIMIT 0, 7";
$sql = "SELECT concat(nombre,' ',a_paterno,' ',a_materno) as nombre FROM so_clientes WHERE concat(nombre,' ',a_paterno,' ',a_materno) LIKE (:keyword) ORDER BY nombre ASC LIMIT 0, 7";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
	// Colocaremos negrita a los textos
	$nombre = str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $milista['nombre']);
	// Aquì, agregaremos opciones
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $milista['nombre']).'\')">'.$nombre.'</li>';
}
?>