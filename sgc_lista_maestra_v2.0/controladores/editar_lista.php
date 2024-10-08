<?php 

session_start();

include ("../../controladores/conex.php");
$fk_id_usuario = $_SESSION['id_usuario'];
$id_numeral_1=$_SESSION['id_numeral_1'];
$id_numeral_2=$_SESSION['id_numeral_2'];

$codigo  = $_POST['codigo'];

$fk_id_docu  = $_POST['lista'];
$grupo  = $_POST['grupo'];
$tipo = $_POST['tipo'];
$modulo = $_POST['modulo']; 
$descripcion = $_POST['descripcion']; 
$consecutivo = $_POST['consecutivo']; 
$encopias = $_POST['encopias']; 
$eubicacion = $_POST['eubicacion']; 
$fncopias = $_POST['fncopias'];
$fubicacion = $_POST['fubicacion'];
$revision = $_POST['revision'];
$version=$_POST['version'];
$femision=$_POST['femision'];
$frevision=$_POST['frevision'];

//$id_numeral_2=99.99;

$query = "
UPDATE sgc_lista_maestra
SET 

  fk_id_numeral_1 = $id_numeral_1,
  fk_id_numeral_2 = $id_numeral_2,

  fk_id_docu = $fk_id_docu,
  fk_id_grupo = '$grupo',
  fk_id_tipo = '$tipo',
  fk_id_modulo = '$modulo',
  consecutivo = '$consecutivo',
  desc_doc = '$descripcion',
  ele_numcopias = '$encopias',
  ele_ubica = '$eubicacion',
  imp_numcopias = '$fubicacion',
  imp_ubica = '$fubicacion',
  num_revision = '$revision',
  num_version = '$version',
  fecha_emision = '$femision',
  fecha_pro_rev = '$frevision',
  fk_id_usuario_act = '$fk_id_usuario',
  fecha_actualiza = NOW()
WHERE id_doc = '$codigo';
";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































