<?php

include ("../../controladores/conex.php");

	$id_estudio = $_POST['id_estudio'];
	$estudio_orig=$_POST['estudio_orig'];
	$iniciales  = $_POST['iniciales'];
	$desc_estudio = $_POST['desc_estudio'];
	$fk_id_tipo_estudio = $_POST['tipo_estudio'];
	$id_plantilla = $_POST['tipo_plantilla'];
	$urgente = $_POST['urgente'];
	$tiempo_entrega = $_POST['tiempo_entrega'];
	$id_comision = $_POST['id_comision'];
	$observaciones = $_POST['observaciones'];
	$per_perfil = $_POST['per_perfil'];
	$per_paquete = $_POST['per_paquete'];
	$costo = $_POST['costo'];
	$id_descuento = $_POST['id_descuento'];
	$id_promocion = $_POST['id_promocion'];
	$id_indicaciones = $_POST['id_indicaciones'];
	$origen = $_POST['origen'];
	$cubiculo = $_POST['cubiculo'];
	$maquila = $_POST['maquila'];
	$estado=$_POST['estatus'];
	$id_muestras=$_POST['id_muestras'];
	$id_muestras_1=$_POST['id_muestras_1'];
	$id_muestras_2=$_POST['id_muestras_2'];
	$id_muestras_3=$_POST['id_muestras_3'];
	$id_muestras_4=$_POST['id_muestras_4'];

	$empresa=1;
	$id_estudio=0;

	 $query="INSERT INTO km_estudios (fk_empresa,id_estudio,iniciales,desc_estudio,fk_id_tipo_estudio,urgente,tiempo_entrega,fk_id_comision,observaciones,per_perfil,per_paquete,costo,fk_id_descuento,fk_id_promosion,fk_id_indicaciones,origen,cubiculo,maquila,estatus,fk_id_muestra,fk_id_muestra_1,fk_id_muestra_2,fk_id_muestra_3,fk_id_muestra_4,fk_id_plantilla,fk_id_estudio_ori,grupo_estudio)
							 VALUES ('$empresa','$id_estudio','$iniciales','$desc_estudio','$fk_id_tipo_estudio','$urgente','$tiempo_entrega','$id_comision','$observaciones','$per_perfil','$per_paquete','$costo','$id_descuento','$id_promocion','$id_indicaciones','$origen','$cubiculo','$maquila','$estado','$id_muestras','$id_muestras_1','$id_muestras_2','$id_muestras_3','$id_muestras_4','$id_plantilla','$estudio_orig',1)";

	/*
	$query="INSERT INTO km_estudios (fk_empresa,id_estudio,iniciales,desc_estudio,fk_id_tipo_estudio,urgente,tiempo_entrega,fk_id_comision,observaciones,per_perfil,costo,fk_id_descuento,fk_id_promosion,fk_id_indicaciones) VALUES ('$empresa',$id_estudio','$iniciales','$desc_estudio','$fk_id_tipo_estudio','$urgente','$tiempo_entrega','$fk_id_comision','$observaciones','$per_perfil','$costo','$fk_id_descuento','$fk_id_promosion','$fk_id_indicaciones')";
	*/
	$resultado=$conexion->query($query);
	if($resultado)
	{
		header("Location: ../km_estudios_t.php");
	}
	else
	{
		echo "inserccion no exitosa, error: ".$query.' '.mysqli_connect_errno();
	};

 ?>
