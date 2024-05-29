<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set("America/Mexico_City");

$id_usuario = 	$_SESSION['id_usuario'];
$rfc =$_POST["rfc"];
$nombre =$_POST["nombre"];
$a_paterno =$_POST["a_paterno"];
$a_materno =$_POST["a_materno"];
$anios =$_POST["anios"];
$meses =$_POST["meses"];
$dias =$_POST["dias"];
$sexo =$_POST["sexo"];
$estado_civil =$_POST["estado_civil"];
$ocupacion =$_POST["ocupacion"];
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
$box_publicidad =$_POST["box_publicidad"];
$f_alta =$_POST["f_alta"];
$f_actu = date("Y-m-d H:m:s");
$estado =$_POST["estado"];
$fecha_nac =$_POST["fecha_nac"];
$empresa = 1;
$query = "INSERT INTO so_clientes
          ( fk_id_empresa,
          rfc,
          nombre,
          a_paterno,
          a_materno,
          anios,
          meses,
            dias,
            fk_id_sexo,
            fk_id_estado_civil,
            fk_id_ocupacion,
            telefono_fijo,
            telefono_movil,
            mail,
            fk_id_estado,
            fk_id_municipio,
            fk_id_localidad,
            colonia,
            cp,
            calle,
            numero_exterior,
            publicidad,
            fecha_registro,
            fecha_actualizacion,
            activo,
            fk_id_medico,
            fecha_nac)
VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conexion->prepare($query);
$stmt->bind_param("issssiiiiiisssiiisisiisssis",
	$empresa,
	$rfc,
	$nombre,
	$a_paterno,
	$a_materno,
	$anios,
	$meses,
	$dias,
	$sexo,
	$estado_civil,
	$ocupacion,
	$t_fijo,
	$movil,
	$mail,
	$edo,
	$muni,
	$loca,
	$colonia,
	$cp,
	$calle,
	$numero,
	$box_publicidad,
	$f_alta,
	$f_actu,
	$estado,
	$id_usuario,
	$fecha_nac);

if($stmt->execute()){
    echo "Datos Agregados Correctamente";
}else{
    $codigo = mysqli_errno($conexion);
  echo $codigo;
}

$stmt->close();

?>
