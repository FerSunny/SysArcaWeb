<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');
//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

$fk_id_empresa ="1";
$fk_id_sucursal = $_POST['fn_sucursal'];
$fk_id_gasto = $_POST['gasto']; 
$importe = $_POST['fn_importe'];
$nota = $_POST['fn_nota'];
$fecha_mov = date("y/m/d H:i:s");
$estado = $_POST['estado'];
$fk_id_beneficiario = $_POST['beneficia'];
$num_comprobante = $_POST['fn_compro'];


// El mensaje
$mensaje = "Tiene una pago por autorizar\r\nLínea 2\r\nLínea 3";

// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
//$mensaje = wordwrap($mensaje, 70, "\r\n");

// Enviarlo
//mail("javier.carapia@laboratoriosarca.com.mx", "Solicitud de autorizacion", $mensaje);


$query= "INSERT INTO ga_registro_arca (fk_id_empresa, fk_id_sucursal, id_registro,fk_id_gasto, importe, fecha_mov, nota, estado,fk_id_beneficiario,num_comprobante,num_autoriza,autorizo,fecha_aut) VALUES('$fk_id_empresa', '$fk_id_sucursal',0, '$fk_id_gasto','$importe','$fecha_mov','$nota','$estado','$fk_id_beneficiario','$num_comprobante','0','0',null)";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_registro.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else 
		{
		    echo $query;
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexión: ' . mysqli_connect_errno());
      		//die('Error de Conexión (INSERT): ' . mysqli_error());
		}

	if (mysqli_close($conexion))
		{
			echo "desconexion realizada. <br />";
		}
		else 
		{
			echo "error en la desconexión";
      		die('Error de Conexión: ' . mysqli_connect_errno());

		}
?>
