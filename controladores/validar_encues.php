<?php
//session_start()
include("conex.php");

$sucursal = $_POST['fn_sucursal'];
$_SESSION['fk_id_sucursal']=$sucursal;

// obtenemos los datos de la sucursal, 
		$query="SELECT  * FROM kg_sucursales  WHERE id_sucursal ='$sucursal'";
		$resultado = mysqli_query($conexion, $query);
		if($row1 = mysqli_fetch_array($resultado))
  			{
                echo "<script>location.href='../en_encuesta/formulario/form_internet.php'</script>";
	

                //echo'bien echo';
                //echo $sucursal;
  			}else{
					echo '<script> alert("Sucursal no autorizada")</script>';
					echo "<script>location.href='././en_encuesta/formulario/form.php'</script>";
  			}
// se almacena los valores en la variables de session
//session_start();
//$_SESSION['fk_id_sucursal_usr']=$row1['fk_id_sucursal'];
// se cambia la sucursal del usaurio, por la sucursal de acceso //
?>
