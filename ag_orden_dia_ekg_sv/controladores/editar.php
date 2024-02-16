<?php 

session_start();

include ("../../controladores/conex.php");

$id_usuario=$_SESSION['id_usuario'];

$fecha = $_POST['fecha'];
$peso  = $_POST['peso'];
$talla = $_POST['talla'];
$diabetes = $_POST['diabetes']; 
$dislpemia = $_POST['dislpemia'];
$hipertension = $_POST['hipertension']; 
$infartos = $_POST['infartos']; 
$angina_pecho = $_POST['angina']; 
$palpitaciones = $_POST['palpitaciones'];
$dolor = $_POST['dolor'];
$fuma = $_POST['fuma'];
$alcohol=$_POST['alcohol'];
$observaciones=$_POST['observaciones'];

$fk_id_factura = $_POST['folio'];
$id_signos = $_POST['id_signos'];

$fk_id_estudio = $_POST['fk_id_estudio'];
// $fk_id_usuario = $_POST['fk_id_usuario'];
$fk_id_medico = $_POST['id_medico'];

if($id_signos == null or $id_signos == '')
{
  $id_signos=0;
}

$busca= "select count(*) as existe from ag_ekg_sv where id_signos = '$id_signos'";
$resulta = $conexion -> query($busca);
$rec=mysqli_query($conexion,$busca);
while ($row=mysqli_fetch_array($rec))
{
  
  $existe =  $row['existe'];

}




if ($existe == 1) {
    $query = "UPDATE ag_ekg_sv
    SET
    fecha = '$fecha',
    peso = '$peso',
    talla = '$talla',
    diabetes = '$diabetes',
    dislpemia = '$dislpemia',
    hipertension = '$hipertension',
    infartos = '$infartos',
    angina_pecho = '$angina_pecho',
    palpitaciones = '$palpitaciones',
    dolor = '$dolor',
    fuma = '$fuma',
    alcohol = '$alcohol',
    observaciones = '$observaciones'
    WHERE id_signos = '$id_signos'";
    $result = $conexion -> query($query);
    if ($result) {
        echo 1;
    }else{
      $codigo = mysqli_errno($conexion); 
      echo $codigo;
    }
    $conexion->close();
}else{
  $query = "insert into  ag_ekg_sv (
  fk_id_empresa,
  id_signos,
  fk_id_factura,
  fk_id_estudio,
  fk_id_usuario,
  fecha,
  fk_id_medico,
  peso,
  talla,
  diabetes,
  dislpemia,
  hipertension,
  infartos,
  angina_pecho,
  palpitaciones,
  dolor,
  fuma,
  alcohol,
  observaciones,
  estado
  )
  values
  (
    0,
    0,
    $fk_id_factura,
    $fk_id_estudio,
    $id_usuario,
    '$fecha',
    $fk_id_medico,
    $peso,
    $talla,
    '$diabetes',
    '$dislpemia',
    '$hipertension',
    '$infartos',
    '$angina_pecho',
    '$palpitaciones',
    '$dolor',
    '$fuma',
    '$alcohol',
    '$observaciones',
    'A'
  )
  ";
 

  $result = $conexion -> query($query);
  if ($result) {
      echo 1;
  }else{
    $codigo = mysqli_errno($conexion); 
     echo $query;
     echo $codigo;
  }
  $conexion->close();


}



?>