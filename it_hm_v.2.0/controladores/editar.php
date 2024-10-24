<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];
$codigo  = $_POST['codigo'];

$wbctotales =$_POST['wbctotales'];
$rbctotales = $_POST['rbctotales']; 
$hgb = $_POST['hgb'];
$hct = $_POST['hct']; 
$mcv = $_POST['mcv']; 
$mchpg = $_POST['mchpg']; 
$mchcgdl = $_POST['mchcgdl'];
$plt = $_POST['plt'];
$rdwsd = $_POST['rdwsd'];
$rdwcv=$_POST['rdwcv'];
$mpv=$_POST['mpv'];
$neutabs=$_POST['neutabs'];
$lymphabs=$_POST['lymphabs'];
$monoabs=$_POST['monoabs'];
$eoabs=$_POST['eoabs'];
$basoabs=$_POST['basoabs'];
$neutporc=$_POST['neutporc'];
$lymphporc=$_POST['lymphporc'];
$monoporc=$_POST['monoporc'];
$eoporc=$_POST['eoporc'];
$basoporc=$_POST['basoporc'];


$sql_update = "UPDATE hm_recepcion_nx_550 
set 

wbctotales='".$wbctotales."',
rbctotales='".$rbctotales."',
hgb='".$hgb."',
hct='".$hct."',
mcv='".$mcv."',
mchpg='".$mchpg."',
mchcgdl='".$mchcgdl."',
plt='".$plt."',
rdwsd='".$rdwsd."',
rdwcv='".$rdwcv."',
mpv='".$mpv."',
neutabs='".$neutabs."',
lymphabs='".$lymphabs."',
monoabs='".$monoabs."',
eoabs='".$eoabs."',
basoabs='".$basoabs."',
neutporc='".$neutporc."',
lymphporc='".$lymphporc."',
monoporc='".$monoporc."',
eoporc='".$eoporc."',
basoporc='".$basoporc."' WHERE sample_no = '".$codigo."'";

$result = $conexion -> query($sql_update);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































