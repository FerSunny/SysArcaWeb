<?php
session_start();


	include ("../controladores/conex.php");

  $id_sucursal=$_SESSION['id_sucursal'];
  $id_estudio=$_SESSION['id_estudio'];
  $fecha_toma=$_SESSION['fecha_toma'];


 

  $query = "
    SELECT  t.`id_toma`,
       t.`fk_id_factura`,
       es.`iniciales`,
       t.`fecha_toma`,
       t.`fk_id_usuario`,
       mu.`desc_muestra`,
       CASE
       WHEN check_in = 0 AND fk_id_rechazo = 0 THEN
        'Pendiente'
       WHEN check_in = 1 AND fk_id_rechazo = 0 THEN
        'Aceptada'
       WHEN check_in IN(1,2) AND fk_id_rechazo > 0 THEN
        CONCAT('Rechazada por: ',' ',re.desc_rechazo)
    END AS estatus,
    t.check_in,
    t.fk_id_rechazo,
    cl.mail as email_paciente,
    me.e_mail as email_medico,
    su.mail as email_sucursal,
    su.desc_corta
FROM tm_tomas t
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = t.`fk_id_estudio`)
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = t.`fk_id_muestra`)
LEFT OUTER JOIN kg_rechazos re ON (re.id_rechazo = t.fk_id_rechazo)
LEFT OUTER JOIN so_factura fa ON (fa.id_factura = t.fk_id_factura)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
WHERE DATE(t.`fecha_toma`) = curdate()
-- limit 100
-- AND t.fk_id_sucursal = $id_sucursal
-- AND t.fk_id_estudio = $id_estudio
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

