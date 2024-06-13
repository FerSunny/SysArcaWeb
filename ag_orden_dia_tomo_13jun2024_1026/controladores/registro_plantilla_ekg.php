
 <?php
date_default_timezone_set('America/Chihuahua');
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$fn_id_plantilla=$_POST["fn_id_plantilla"];

//echo "<script> alert('hola')</script>" ;

$fn_descripcion=$_POST["fn_descripcion"];

$numero_factura= $_SESSION['numero_factura'];
$studio= $_SESSION['studio'];
$fecha_registro=date("y/m/d :H:i:s");
$estado='A';
$num_imp=0;

$fk_id_medico=0;
$nombre_plantilla='0';
$titulo_desc='0';
$firma='0';

$sql_max="SELECT  us.* FROM cr_plantilla_rx us WHERE id_plantilla=".$fn_id_plantilla;
// echo $sql_max;
$veces='0';
if ($result = mysqli_query($conexion, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $fk_id_medico=$row['fk_id_medico'];
      $nombre_plantilla=$row['nombre_plantilla'];
      $titulo_desc=$row['titulo_desc'];
      $firma=$row['firma'];
  }
}


$query= "INSERT INTO cr_plantilla_rx_re
            (fk_id_empresa,
             fk_id_medico,
             fk_id_plantilla,
             fk_id_factura,
             fecha_registro,
             nombre_plantilla,
             fk_id_estudio,
             titulo_desc,
             descripcion,
             firma,
             estado,
             num_imp)
VALUES ('$empresa',
        '$fk_id_medico',
        '$fn_id_plantilla',
        '$numero_factura',
        NOW(),
        '$nombre_plantilla',
        '$studio',
        '$titulo_desc',
        '$fn_descripcion',
        '$firma',
        '$estado',
        '$num_imp')
        ";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			//header("location: ../tabla_plantillas.php?numero_factura=34523&studio=625");
			//header("location: ../tabla_agenda.php");
			echo "<script> location.href='../tabla_agenda.php' </script> ";
		}
		else 
		{
			echo "error en la ejecucion de la consulta. <br />";
			echo "Error en el scrip --> ".$query;
      		die('Error de Conexion: ' . mysqli_connect_errno());
      		//die('Error de Conexión (INSERT): ' . mysqli_error());
		}

	if (mysqli_close($conexion))
		{
			echo "desconexion realizada. <br />";
			//$dummy='desconexion realizada';
			header("location: ../tabla_agenda.php");
		}
		else 
		{
			echo "error en la desconexión";
      		die('Error de Conexión: ' . mysqli_connect_errno());

		}
	//	header("location: ../tabla_agenda.php");
?>
