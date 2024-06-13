<?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$id_usuario=$_SESSION['id_usuario'];

$fn_titulo_desc = $_POST['fn_titulo_desc'];
$fn_descripcion = $_POST['fn_descripcion']; 

$fn_t_allazgos = $_POST['fn_t_allazgos'];
$fn_d_allazgos = $_POST['fn_d_allazgos'];

$fn_t_diagnostico = $_POST['fn_t_diagnostico'];
$fn_d_disgnostico = $_POST['fn_d_disgnostico'];

$fn_t_comenta = $_POST['fn_t_comenta'];
$fn_d_comenta = $_POST['fn_d_comenta'];

$fn_id_factura = $_POST['fn_id_factura']; 
$fn_fk_id_estudio = $_POST['fn_fk_id_estudio'];

// se obtiene la firma
$sql_firma="
SELECT * FROM cr_plantilla_4 p4
WHERE p4.`fk_id_estudio` = ".$fn_fk_id_estudio."
AND p4.`tipo` = 'F'
AND p4.`estado` = 'A'";

 //echo $sql_firma;

$cuenta=1;
$fme='';

if ($result = mysqli_query($conexion, $sql_firma)) {
  while($row = $result->fetch_assoc())
  {
      if($cuenta==1){
        $fme=$row['concepto'];
      }elseif ($cuenta==2) {
        $cpm=$row['concepto'];
      }elseif ($cuenta==3) {
        $frl=$row['concepto'];
      }elseif ($cuenta==4) {
        $cpr=$row['concepto'];
      }else{
        $dumy=$row['error'];
      }
      $cuenta=$cuenta+1;
  }
}


$query = "INSERT INTO cr_plantilla_rx_rad_re
            (fk_id_empresa,
             fk_id_medico,
             fk_id_plantilla,
             fk_id_factura,
             fecha_registro,
             nombre_plantilla,
             fk_id_estudio,
             titulo_desc,
             descripcion,

              t_otros_allazgos,
              d_otros_allazgos,
              t_diagnostico,
              d_diagnostico,
              t_comentarios,
              d_comentarios,  

              firma_med,
              ced_medico,
              firma_rl,
              ced_rl,

             estado,
             num_imp)
 VALUES ('$empresa','$id_usuario','14','$fn_id_factura',now(),'n/a','$fn_fk_id_estudio','$fn_titulo_desc','$fn_descripcion','$fn_t_allazgos','$fn_d_allazgos','$fn_t_diagnostico','$fn_d_disgnostico','$fn_t_comenta','$fn_d_comenta','$fme','$cpm','$frl','$cpr','A','0')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_agenda.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecucion de la consulta. <br />";
			echo $query;
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
