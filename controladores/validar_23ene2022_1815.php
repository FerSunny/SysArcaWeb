<?php

include("conex.php");
$usuario = $_POST['usua'];
$pass = $_POST['contra'];
$sucursal = $_POST['fn_sucursal'];

date_default_timezone_set('America/Mexico_City');
$hora=date("H:i:s");
$la_hora=str_replace(":","",$hora);
$el_dia=date("D");

//echo $el_dia;

//$query = "SELECT * FROM se_usuarios where id_usr= '" . $usuario . "' ";
$query = "SELECT us.*,
	pe.desc_perfil,
	mo.desc_modulo,
	mo.id_modulo,
	pe.admin
FROM se_usuarios us
LEFT OUTER JOIN se_perfiles pe ON (pe.id_perfil = us.fk_id_perfil)
LEFT OUTER JOIN se_modulos mo ON (mo.id_modulo = pe.fk_id_modulo) where us.activo = 'A' and id_usr= '" . $usuario . "' ";

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
{
	if($row['pass'] == $pass)
	{
// obtenemos los datos de la sucursal, para validar horarios
		$query="SELECT  * FROM kg_sucursales  WHERE id_sucursal ='$sucursal'";
		$resultado = mysqli_query($conexion, $query);
		if($row1 = mysqli_fetch_array($resultado))
  			{
  				$hora_entra_s = str_replace(":","",$row1['hor_hab_ape']);
				$hora_salida_s= str_replace(":","",$row1['hor_hab_cie']);

  				$hora_entra_sa = str_replace(":","",$row1['hor_sab_ape']);
				$hora_salida_sa= str_replace(":","",$row1['hor_sab_cie']);

  				$hora_entra_do = str_replace(":","",$row1['hor_dom_ape']);
				$hora_salida_do= str_replace(":","",$row1['hor_dom_cie']);

  			}else{
					echo '<script> alert("Sucursal no autorizada")</script>';
					echo "<script>location.href='../index.html'</script>";
  			}
// fin
//echo $row1['hor_hab_ape'].' -';
//se valida el horario de acceso al sistema, por sucursal y dia
		if($row['fk_id_perfil'] == '1' or $row['fk_id_perfil'] == '12' or $row['fk_id_perfil'] == '19' or $row['fk_id_perfil'] == '21' or $row['fk_id_perfil'] == '45'){

		}else{

			if($el_dia=='Mon' or $el_dia=='Tue' or $el_dia=='Wed' or $el_dia=='Thu' or $el_dia=='Fri')
			{
				if($la_hora >= $hora_entra_s  && $la_hora <= $hora_salida_s){
					//echo '<script> alert("Su horario es" + '.$la_hora.' + " y es correcto") </script>';
					//echo '<script> alert("Horario correcto")</script>';
				}else{
					echo '<script> alert("Fuera de Horario")</script>';
					//echo 'hs= '.$la_hora.'- he= '.$hora_entra_s.'- hs= '.$hora_salida_s;
					//echo '<script> alert("Fuera de horario" + '.$la_hora.' + " su horario es:") </script>';
					echo "<script>location.href='../index.html'</script>";
				}

			}
			elseif($el_dia=='Sat')
					{
						if($la_hora >= $hora_entra_sa  && $la_hora <= $hora_salida_sa){

						}else{
						echo '<script> alert("Fuera de Horario")</script>';
						echo "<script>location.href='../index.html'</script>";
						}

					}
			elseif($el_dia=='Sun')
					{
						if($la_hora >= $hora_entra_do  && $la_hora <= $hora_salida_do){

						}else{
							echo '<script> alert("Fuera de Horario")</script>';
							echo "<script>location.href='../index.html'</script>";
						}

					}
					/*
					else{
						echo '<script> alert("Error en el dia de la semana, comuniquese con su area de sistemas")</script>';
						echo "<script>location.href='../index.html'</script>";
						}
                    */
			}

		session_start();
  		$_SESSION['ingreso']='YES';
  		$_SESSION['nombre']=$usuario;

  		$_SESSION['fk_id_sucursal_usr']=$row['fk_id_sucursal'];
// se cambia la sucursal del usaurio, por la sucursal de acceso //
  		$_SESSION['fk_id_sucursal']=$sucursal;
		if ($sucursal <1 || $sucursal > 10){
			$err_empresa=1;
			$err_modulo='controladores/valida.php';
			$err_desc_error= 'sucursal fuera de rengo valido (1-10)';
			$err_id_usuario= $row['id_usuario'];
			$err_fk_id_sucursal=$sucursal;
			
			
			echo '<script> alert("ATENCION: Sucursal de inicio erronea, vuelva a iniciar sesion")</script>';
			$ins_errores="INSERT INTO tb_errores (fk_id_empresa,id_error,modulo,desc_error,id_usuario,fk_id_sucursal,fecha_hora) 
			VALUES('$err_empresa',0,'$err_modulo','$err_desc_error','$err_id_usuario','$err_fk_id_sucursal',NOW())";
			$resultado = mysqli_query($conexion, $ins_errores);
		}
// fin
		$_SESSION['nombre_completo']=$row['nombre'] .' '. $row['a_paterno'] . ' '. $row['a_materno'];
		$_SESSION['fk_id_perfil']=$row['fk_id_perfil'];
		$_SESSION['id_modulo']=$row['id_modulo'];
		$_SESSION['desc_perfil']=$row['desc_perfil'];
		$_SESSION['id_usuario']=$row['id_usuario'];
		$_SESSION['admin']=$row['admin'];

		$fk_id_sucursal_usr=$row['fk_id_sucursal'];

		$fk_id_sucursal=$sucursal;

		$fecha_inicio=date("y/m/d :H:i:s");

		//$ip=$_SERVER['SERVER_ADDR'];
		$ip_publica=$_SERVER['REMOTE_ADDR'];
		$navegador=getenv('HTTP_USER_AGENT');

		$exec = exec("hostname");
		$hostname = trim($exec);
		$ip_local = gethostbyname($hostname);

		$nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);


		//$ip=$_SERVER[‘HTTP_CLIENT_IP’];

		$insert="INSERT INTO au_session (fk_id_sucursal,fk_id_sucursal_ini,fk_id_usuario,ip_publica,nombre_pc,fecha_inicio,fecha_fin,navegador,ip_local) VALUES('$fk_id_sucursal_usr','$fk_id_sucursal','$usuario','$ip_publica','$nombre_host',NOW(),NOW(),'$navegador','$ip_local')";

//echo $insert;

		$resultado = mysqli_query($conexion, $insert);

		if($fk_id_sucursal_usr == $fk_id_sucursal){

		}else{


			echo '<script> alert("ATENCION: Sucursal de inicio es diferente a la sucursal asignada al usuario")</script>';
		}

  		if( $row['fk_id_perfil'] == 1 || $row['fk_id_perfil'] == 11 || $row['fk_id_perfil'] == 12 || $row['fk_id_perfil'] == 13 || $row['fk_id_perfil'] == 27 || $row['fk_id_perfil'] == 28 || $row['fk_id_perfil'] == 29 || $row['fk_id_perfil'] == 30 || $row['fk_id_perfil'] == 31 || $row['fk_id_perfil'] == 33 || $row['fk_id_perfil'] == 19 || $row['fk_id_perfil'] == 36 || $row['fk_id_perfil'] == 25 || $row['fk_id_perfil'] == 35 ||
  		      $row['fk_id_perfil'] == 9 || $row['fk_id_perfil'] == 21 || $row['fk_id_perfil'] == 37 || $row['fk_id_perfil'] == 38 ||
              $row['fk_id_perfil'] == 39 || $row['fk_id_perfil'] == 40 || $row['fk_id_perfil'] == 41 || $row['fk_id_perfil'] == 42 || $row['fk_id_perfil'] == 43 || $row['fk_id_perfil'] == 45)
  		{
  				echo "<script>location.href='../xx_menu_unico/menu_principal'</script>";
		}
			elseif ($row['fk_id_perfil']==3)
			{
				echo "<script>location.href='../xx_menu/menu_3'</script>";
			}
			elseif ($row['fk_id_perfil']==8)
			{
				echo "<script>location.href='../xx_menu/menu_8.php'</script>";
			}
			elseif ($row['fk_id_perfil']==4)
			{
				echo "<script>location.href='../xx_menu/menu_4.php'</script>";
			}
			elseif ($row['fk_id_perfil']==12)
			{
				echo "<script>location.href='../xx_menu/menu_12.php'</script>";
			}
			elseif ($row['fk_id_perfil']==6)
			{
				echo "<script>location.href='../xx_menu/menu_6.php'</script>";
			}
			elseif ($row['fk_id_perfil']==9)
			{
				echo "<script>location.href='../xx_menu/menu_9.php'</script>";
			}
			elseif ($row['fk_id_perfil']==14)
			{
				echo "<script>location.href='../xx_menu/menu_00.php'</script>";
			}
			elseif ($row['fk_id_perfil']==17)
			{
				echo "<script>location.href='../xx_menu/menu_fac.php'</script>";
			}
			elseif ($row['fk_id_perfil']==18)
			{
				echo "<script>location.href='../xx_menu/menu_18.php'</script>";
			}
			elseif ($row['fk_id_perfil']==19)
			{
				echo "<script>location.href='../xx_menu/menu_19'</script>";
			}
			elseif ($row['fk_id_perfil']==20)
			{
				echo "<script>location.href='../xx_menu/menu_20'</script>";
			}
			elseif ($row['fk_id_perfil']==21)
			{
				echo "<script>location.href='../xx_menu/menu_21'</script>";
			}
			elseif ($row['fk_id_perfil']==22)
			{
				echo "<script>location.href='../xx_menu/menu_22'</script>";
			}
			elseif ($row['fk_id_perfil']==23)
			{
				echo "<script>location.href='../xx_menu/menu_23'</script>";
			}
			elseif ($row['fk_id_perfil']==25)
			{
				echo "<script>location.href='../xx_menu/menu_25'</script>";
			}
			elseif ($row['fk_id_perfil']==26)
			{
				echo "<script>location.href='../xx_menu/menu_26'</script>";
			}
			else
			{
				echo '<script> alert("Perfil no asignado")</script>';
				echo "<script>location.href='../index.html'</script>";
			}
	}
	else
	{
		echo '<script> alert("Contraseña incorrecta")</script>';
		echo "<script>location.href='../index.html'</script>";
	}
}
else
{
		echo '<script> alert("usuario incorrecto")</script>';
		echo "<script>location.href='../index.html'</script>";
}

?>
