<?php
if (isset($_GET['q'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{

	//$fetch = mysqli_query($con,"SELECT * FROM so_clientes where nombre like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' and a_paterno  like '%" .  mysqli_real_escape_string($con,($_GET['q'])) . "%'");
		$fetch = mysqli_query($con,"SELECT 
			`fk_id_empresa`,
			`id_medico`,
			`fk_id_zona`,

			`a_paterno`,
			CASE 
			WHEN fecha_registro >= DATE_SUB(NOW(),INTERVAL 30 DAY) THEN
				CONCAT('***',nombre)
			ELSE
				nombre
			END AS nombre,

			`a_materno`,
			`rfc`,
			`fk_id_sexo`,
			`fk_id_especialidad`,
			`fk_id_estado`,
			`fk_id_municipio`,
			`fk_id_localidad`,
			`colonia`,
			`cp`,
			`calle`,
			`numero_exterior`,
			`referencia`,
			`telefono_fijo`,
			`telefono_movil`,
			`horario`,
			`cuenta_banco`,
			`adscrito`,
			`fecha_registro`,
			`fecha_actuaizacion`,
			`estado`,
			`e_mail`,
			`fk_id_sucursal`,
			`fk_id_usuario`,
			`latitud`,
			`longitud`,
			`altitud`,
			`tipo_consul`,
			`observaciones`,
			`medico`,
			`otro_lab`,
			`usuario`,
			`pass`,
			`token`,
			`activado`,
			`fk_id_perfil`
			FROM so_medicos c where c.estado = 'A' AND CONCAT_WS(' ', c.nombre, c.a_paterno,c.a_materno)  like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' or c.a_paterno  like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' or c.a_materno like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%';
");

	/* Retrieve and store in array the results of the query.*/
	$a_paterno="";
	$a_materno="";
	while ($row = mysqli_fetch_array($fetch)) {
		$id_medico=$row['id_medico'];
		$a_paterno=$row['a_paterno']=="a_paterno"?"":$row['a_paterno'];
		$a_materno=$row['a_materno']=="a_materno"?"":$row['a_materno'];
		$nombre_final=$row['nombre'] ." ". $a_paterno ." ". $a_materno;
		$row_array['value'] = $nombre_final;
		$row_array['id_medico']=$id_medico;
		$row_array['nombre']=$nombre_final;
		//$row_array['telefono_fijo']=$row['telefono_fijo'];
		//$row_array['mail']=$row['mail'];
		array_push($return_arr,$row_array);
    }

}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>
