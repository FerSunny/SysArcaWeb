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
$fk_id_etapa = 'RE'; // recibida por el recolector
$id_sigue_muestra=0;

$query="SELECT tm.id_toma, sm.id_sigue_muestra FROM tm_tomas tm, tm_sigue_muestra sm
WHERE tm.id_toma = sm.fk_id_toma
and tm.fk_id_factura = $codigo 
and tm.lote = '$lote' 
and sm.fk_id_etapa = 'EN' 
and sm.fk_id_estado_muestra = 1
";

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
    //echo $row['activo'];
  	$id_toma = $row['id_toma'];
	$id_sigue_muestra = $row['id_sigue_muestra'];

	$query ="
	INSERT INTO `bd_arca`.`tm_sigue_muestra`
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
		$query ="UPDATE tm_sigue_muestra SET fk_id_estado_muestra = 0 WHERE id_sigue_muestra = $id_sigue_muestra ";
		$result = $conexion -> query($query);

	}else{
	  $codigo = mysqli_errno($conexion); 
	  echo $codigo;
	}
}else{
	echo 2;
};
$conexion->close();

?>
