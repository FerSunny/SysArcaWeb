<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";


$edit1 = $_POST['edit1']; // des_promocion
$edit2 = $_POST['edit2']; // estado
$edit3 = $_POST['edit3']; // procentaje
$edit4 = $_POST['edit4']; // Fecha_inicio
$edit5 = $_POST['edit5']; // fecha_final
$fn_lunes = $_POST['fn_lunes'];
$fn_martes = $_POST['fn_martes'];
$fn_miercoles = $_POST['fn_miercoles'];
$fn_jueves = $_POST['fn_jueves'];
$fn_viernes = $_POST['fn_viernes'];
$fn_sabado = $_POST['fn_sabado'];
$fn_domingo = $_POST['fn_domingo'];
$fn_tul = $_POST['fn_tul'];
$fn_tu2 = $_POST['fn_tu2'];
$fn_gre = $_POST['fn_gre'];
$fn_xoc = $_POST['fn_xoc'];
$fn_san = $_POST['fn_san'];
$fn_pab = $_POST['fn_pab'];
$fn_tec = $_POST['fn_tec'];
$fn_tet = $_POST['fn_tet'];
$fn_ped = $_POST['fn_ped'];
$fn_din = $_POST['fn_din'];


$query = "INSERT INTO kg_promociones(fk_empresa,desc_promocion,porcentaje,fecha_inicio,fecha_final,lunes,martes,miercoles,jueves,viernes,sabado,domingo,tuly,tuly2,greg,xochi,sant,pablo,pedro,teco,tete,estado,dino) VALUES ('$empresa','$edit1','$edit3','$edit4','$edit5','$fn_lunes','$fn_martes','$fn_miercoles','$fn_jueves','$fn_viernes','$fn_sabado','$fn_domingo', '$fn_tul','$fn_tu2','$fn_gre','$fn_xoc','$fn_san','$fn_pab','$fn_tec','$fn_tet','$fn_ped','$edit2','$fn_din')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_promociones.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}
?>
