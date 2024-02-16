<?php
if (isset($_GET['q'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{

	//$fetch = mysqli_query($con,"SELECT * FROM so_clientes where nombre like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' and a_paterno  like '%" .  mysqli_real_escape_string($con,($_GET['q'])) . "%'");
		$fetch = mysqli_query($con,"SELECT c.id_cliente,c.a_paterno,c.a_materno,c.nombre,c.telefono_fijo,
/*
			case
				when c.fecha_nac is null then
					c.anios
				else
					-- caluculos de años  
					(YEAR( CURDATE( ) ) - YEAR( c.fecha_nac )) - IF( MONTH( CURDATE( ) ) < MONTH( c.fecha_nac), 1,
					IF ( MONTH(CURDATE( )) = MONTH(c.fecha_nac),
					IF (DAY( CURDATE( ) ) < DAY( c.fecha_nac ),1,0 ),0))
			end AS mail
*/
			c.fecha_nac as mail,
			c.mail as correo,
			colonia,
			cp,
			calle,
			numero_exterior,
			telefono_movil
			FROM so_clientes c where c.activo = 'A' AND CONCAT_WS(' ', c.nombre, c.a_paterno,c.a_materno)  like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' or c.a_paterno  like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' or c.a_materno like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%';
");

	/* Retrieve and store in array the results of the query.*/
	$a_paterno="";
	$a_materno="";
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['id_cliente'];
		$a_paterno=$row['a_paterno']=="a_paterno"?"":$row['a_paterno'];
		$a_materno=$row['a_materno']=="a_materno"?"":$row['a_materno'];
		$nombre_final=$row['nombre'] ." ". $a_paterno ." ". $a_materno;
		$row_array['value'] = $nombre_final;
		$row_array['id_cliente']=$id_cliente;
		$row_array['nombre']=$nombre_final;
		$row_array['telefono_fijo']=$row['telefono_fijo'];
		$row_array['mail']=$row['mail'];
		$row_array['correo']=$row['correo'];
		$row_array['colonia']=$row['colonia'];
		$row_array['cp']=$row['cp'];
		$row_array['calle']=$row['calle'];
		$row_array['numero_exterior']=$row['numero_exterior'];
		$row_array['telefono_movil']=$row['telefono_movil'];

		array_push($return_arr,$row_array);
    }

}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>
