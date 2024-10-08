<?php 



session_start();

include ("../../controladores/conex.php");

$fk_id_usuario = $_SESSION['id_usuario'];
$id_numeral_1=$_SESSION['id_numeral_1'];
$id_numeral_2=$_SESSION['id_numeral_2'];



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

//$descripcion=$descripcion.$id_numeral_2;

$query ="
INSERT INTO sgc_lista_maestra
            (fk_id_empresa,
             id_doc,

             fk_id_numeral_1,
             fk_id_numeral_2,

             fk_id_docu,

             fk_id_grupo,
             fk_id_tipo,
             fk_id_modulo,
             consecutivo,
             desc_doc,

             ele_numcopias,
             ele_ubica,

             imp_numcopias,
             imp_ubica,

             num_revision,
             num_version,

             fecha_emision,
             fecha_pro_rev,

             fk_id_usuario,
             fecha_registro,
             estado)
VALUES (1,
        0,

        '$id_numeral_1',
        $id_numeral_2,

        '$fk_id_docu',

        '$grupo',
        '$tipo',
        '$modulo',
        '$consecutivo',
        '$descripcion',

        '$encopias',
        '$eubicacion',

        '$fncopias',
        '$fubicacion',

        '$revision',
        '$version',

        '$femision',
        '$frevision',
        
        '$fk_id_usuario',
        now(),
        'A');
";

//echo $query;

$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>

