<?php

include ("../../controladores/conex.php");

	$id_estudio = $_POST['id_estudio'];
	$iniciales  = $_POST['iniciales'];
	$desc_estudio = $_POST['desc_estudio'];
	$fk_id_tipo_estudio = $_POST['tipo_estudio'];
	$urgente = $_POST['urgente'];
	$tiempo_entrega = $_POST['tiempo_entrega'];
	$id_comision = $_POST['id_comision'];
	$observaciones = $_POST['observaciones'];
	$per_perfil = $_POST['per_perfil'];
	$costo = $_POST['costo'];
	$id_descuento = $_POST['id_descuento'];
	$id_promocion = $_POST['id_promocion'];
	$id_indicaciones = $_POST['id_indicaciones'];
	$estado=$_POST['estatus'];
	$id_muestras=$_POST['id_muestras'];

	$empresa=1;
	$id_estudio=0;

	 $query="INSERT INTO km_estudios (fk_empresa,id_estudio,iniciales,desc_estudio,fk_id_tipo_estudio,urgente,tiempo_entrega,fk_id_comision,observaciones,per_perfil,costo,fk_id_descuento,fk_id_promosion,fk_id_indicaciones,estatus,fk_id_muestra)
							 VALUES ('$empresa','$id_estudio','$iniciales','$desc_estudio','$fk_id_tipo_estudio','$urgente','$tiempo_entrega','$id_comision','$observaciones','$per_perfil','$costo','$id_descuento','$id_promocion','$id_indicaciones','$estado','$id_muestras')";

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
		echo "inserccion no exitosa, error: ".mysqli_connect_errno();
	};

 ?>
