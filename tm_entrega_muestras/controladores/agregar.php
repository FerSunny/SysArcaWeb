<?php 

session_start();
include ("../../controladores/conex.php");
$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['nombre'];

$empresa=1;
$fecha=date("y/m/d H:i:s");

$codigo  = $_POST['codigo'];
$lote  = $_POST['lote'];
$id_toma = 0;
$fk_id_etapa='EN'; // etapa EN = Entregada por admision

$query="SELECT id_toma FROM tm_tomas
WHERE fk_id_factura = $codigo and lote = '$lote'";

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
    //echo $row['activo'];
  	$id_toma = $row['id_toma'];

	$query ="
	INSERT INTO `tm_sigue_muestra`
				(`fk_id_empresa`,
				 `id_sigue_muestra`,
				 `fk_id_toma`,
				 fk_id_etapa,
				 `fk_id_estado_muestra`,
				 `fecha`,
				 fk_id_usr,
				 `estado`)
	VALUES ('$empresa',
			0,
			'$id_toma',
			'$fk_id_etapa',
			1,
			'$fecha',
			'$id_usuario',
			'A');
	";

	$result = $conexion -> query($query);
	if ($result) {		
		echo 1;

	}else{
	  $codigo = mysqli_errno($conexion); 
	  echo $codigo;
	}
}else{
	echo 2;
};
$conexion->close();

?>
