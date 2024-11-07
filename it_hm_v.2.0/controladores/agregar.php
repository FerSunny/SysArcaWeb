<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];


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
$date_v=$_POST['date_v'];

$query ="
INSERT INTO hm_recepcion_nx_550
            (id,
             nickname,
             instrument_id,
             date_v,
             time_v,
             adapter,
             position_v,
             sample_no,
             reception_date,
             wbctotales,
             rbctotales,
             hgb,
             hct,
             mcv,
             mchpg,
             mchcgdl,
             plt,
             rdwsd,
             rdwcv,
             mpv,
             neutabs,
             lymphabs,
             monoabs,
             eoabs,
             basoabs,
             neutporc,
             lymphporc,
             monoporc,
             eoporc,
             basoporc,
             estado)
VALUES (0,
        'XN-L',
        'XN-550-24918',
        '$date_v',
        '0',
        '0',
        '0',
        '$codigo',
        '0',
        '$wbctotales',
        '$rbctotales',
        '$hgb',
        '$hct',
        '$mcv',
        '$mchpg',
        '$mchcgdl',
        '$plt',
        '$rdwsd',
        '$rdwcv',
        '$mpv',
        '$neutabs',
        '$lymphabs',
        '$monoabs',
        '$eoabs',
        '$basoabs',
        '$neutporc',
        '$lymphporc',
        '$monoporc',
        '$eoporc',
        '$basoporc',
        'A'
)";
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

