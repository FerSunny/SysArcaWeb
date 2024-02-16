
<?php
	session_start();
	include ("../controladores/conex.php");
	//$id_usuario=$_SESSION['id_usuario'];
	//$usuario=$_SESSION['usuario'];
	$perfil=$_SESSION['fk_id_perfil'];

	//$perfil=1;
	/*$fk_id_perfil=$_SESSION['fk_id_perfil'];*/
	/*$fk_id_sucursal=$_SESSION['fk_id_sucursal'];*/

	$query = "SELECT
			'$perfil' perfil,
			c.id_cliente,
			c.rfc,
			c.nombre,
			c.a_paterno,
			c.a_materno,
			-- c.anios,
			-- c.meses,
			-- c.dias,
			s.desc_sexo,
			v.desc_estado_civil,
			c.fk_id_ocupacion,
			c.mail,
			c.fk_id_estado,
			c.fk_id_municipio,
			c.fk_id_localidad,
			c.colonia,
			c.cp,
			c.calle,
			c.numero_exterior,
			c.telefono_fijo,
			c.telefono_movil,
			c.fecha_registro,
			c.activo,
			c.publicidad,
			c.fk_id_sexo,
			c.fk_id_estado_civil,
			c.fecha_nac,
			case
				when c.fecha_nac is null then
					c.anios
				else
					-- caluculos de años  
					(YEAR( CURDATE( ) ) - YEAR( c.fecha_nac )) - IF( MONTH( CURDATE( ) ) < MONTH( c.fecha_nac), 1,
					IF ( MONTH(CURDATE( )) = MONTH(c.fecha_nac),
					IF (DAY( CURDATE( ) ) < DAY( c.fecha_nac ),1,0 ),0))
			end AS anios,

			case
				when c.fecha_nac is null then
					c.meses
				else
					MONTH(CURDATE()) - MONTH( c.fecha_nac ) + 12 *
					IF( MONTH(CURDATE())<MONTH(c.fecha_nac), 1,IF(MONTH(CURDATE())=MONTH(c.fecha_nac),IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0),0)
					) - IF(MONTH(CURDATE())<>MONTH(c.fecha_nac),(DAY(CURDATE())<DAY(c.fecha_nac)), IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0 ) )
			end AS meses,

			case
				when c.fecha_nac is null then
					c.dias
				else
					(DAY( CURDATE() ) - DAY( c.fecha_nac ) +30 * ( DAY(CURDATE()) < DAY(c.fecha_nac) )) 
			end AS dias,

			case
				when c.fecha_nac is null then
					CONCAT(c.anios,'a',c.meses,'m',c.dias,'d') 
				else
					CONCAT(( (YEAR( CURDATE( ) ) - YEAR( c.fecha_nac )) - IF( MONTH( CURDATE( ) ) < MONTH( c.fecha_nac), 1,
					IF ( MONTH(CURDATE( )) = MONTH(c.fecha_nac),
					IF (DAY( CURDATE( ) ) < DAY( c.fecha_nac ),1,0 ),0)) ),'a',( MONTH(CURDATE()) - MONTH( c.fecha_nac ) + 12 *
					IF( MONTH(CURDATE())<MONTH(c.fecha_nac), 1,IF(MONTH(CURDATE())=MONTH(c.fecha_nac),IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0),0)
					) - IF(MONTH(CURDATE())<>MONTH(c.fecha_nac),(DAY(CURDATE())<DAY(c.fecha_nac)), IF (DAY(CURDATE())<DAY(c.fecha_nac),1,0 ) ) ),'m',( (DAY( CURDATE() ) - DAY( c.fecha_nac ) +30 * ( DAY(CURDATE()) < DAY(c.fecha_nac) )) ),'d')
				end AS edad



			FROM  so_clientes c
			LEFT OUTER JOIN so_sexo s ON (s.id_sexo= c.fk_id_sexo)
			LEFT OUTER JOIN kg_estado_civil v ON (v.id_estado_civil = c.fk_id_estado_civil)
			WHERE c.fecha_actualizacion >= DATE_SUB(CURDATE(), INTERVAL 45 DAY)
			and c.activo = 'A'
			";

	$resultado = mysqli_query($conexion, $query);

	if(!$resultado){
		die("Error");

	}else{
		while($data=mysqli_fetch_assoc($resultado)){
			$arreglo["data"][]=$data;
		}
		echo json_encode($arreglo);
	}

	mysqli_free_result($resultado);
	mysqli_close($conexion);
