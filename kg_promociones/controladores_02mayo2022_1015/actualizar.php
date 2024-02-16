<?php
include("../../controladores/conex.php");
$id_us=$_POST["idpromocion"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];
$edit3=$_POST['edit3'];
$edit4=$_POST['edit4'];
$edit5=$_POST['edit5'];
$lunes=$_POST['fn_lunes'];
$martes=$_POST['fn_martes'];
$miercoles=$_POST['fn_miercoles'];
$jueves=$_POST['fn_jueves'];
$viernes=$_POST['fn_viernes'];
$sabado=$_POST['fn_sabado'];
$domingo=$_POST['fn_domingo'];
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

$query = " UPDATE  kg_promociones SET fk_empresa='1', desc_promocion='$edit1',porcentaje='$edit3', estado='$edit2',fecha_inicio='$edit4',fecha_final='$edit5',lunes='$lunes',martes='$martes',miercoles='$miercoles',jueves='$jueves',viernes='$viernes',sabado='$sabado',domingo='$domingo',tuly='$fn_tul',tuly2='$fn_tu2',greg='$fn_gre',xochi='$fn_xoc',sant='$fn_san',pablo='$fn_pab',pedro='$fn_ped',teco='$fn_tec',tete='$fn_tet', dino = '$fn_din' where id_promocion='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_promociones.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
      die('Error de Conexión: '.$query . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: '.$query . mysqli_connect_errno());

		}


 ?>
