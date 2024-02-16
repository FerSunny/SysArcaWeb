<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set("America/Mexico_City");

$id_usuario = 	$_SESSION['id_usuario'];

$rfc =$_POST["rfc"];
$nombre =$_POST["nombre"];
$a_paterno =$_POST["a_paterno"];
$a_materno =$_POST["a_materno"];
$fecha_nac =$_POST["fecha_nac"];
$anios =$_POST["anios"];
$meses =$_POST["meses"];
$dias =$_POST["dias"];
$sexo =$_POST["sexo"];
$estado_civil =$_POST["estado_civil"];
$puesto =$_POST["puesto"];
$t_fijo =$_POST["t_fijo"];
$movil =$_POST["movil"];
$mail =$_POST["mail"];
$edo =$_POST["edo"];
$muni =$_POST["muni"];
$loca =$_POST["loca"];
$colonia =$_POST["colonia"];
$cp =$_POST["cp"];
$calle =$_POST["calle"];
$numero =$_POST["numero"];

$empresa =$_POST["empresa"];
$sucursal =$_POST["sucursal"];
$horario =$_POST["horario"];

$fecha_ing =$_POST["fecha_ing"];
$anios_ant =$_POST["anios_ant"];
$meses_ant =$_POST["meses_ant"];
$dias_ant =$_POST["dias_ant"];

$turno =$_POST["turno"];
$dpto =$_POST["dpto"];

$empresa = 1;


$query ="
INSERT INTO no_empleados
            (fk_id_empresa,id_empleado,rfc,nombre,a_paterno,a_materno,fecha_nac,anios,meses,dias,fk_id_sexo,fk_id_estado_civil,fk_id_puesto,telefono_fijo,
             telefono_movil, mail,fk_id_estado,fk_id_municipio,fk_id_localidad,colonia,cp,calle,numero_exterior,fecha_registro,fecha_actualiza,fk_id_grupo,
             fk_id_sucursal,fk_id_horario,fecha_ingreso,anios_ant,mes_ant,dia_ant,fk_id_turno,fk_id_dpto,estado)
VALUES (0,
        0,
        '$rfc',
        '$nombre',
        '$a_paterno',
        '$a_materno',
        '$fecha_nac',
        '$anios',
        '$meses',
        '$dias',
        '$sexo',
        '$estado_civil',
        '$puesto',
        '$t_fijo',
        '$movil',
        '$mail',
        '$edo',
        '$muni',
        '$loca',
        '$colonia',
        '$cp',
        '$calle',
        '$numero',
        now(),
        now(),
        '$empresa',
        '$sucursal',
        '$horario',
        '$fecha_ing',
        '$anios_ant',
        '$meses_ant',
        '$dias_ant',
        '$turno',
        '$dpto',
        'A');

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
