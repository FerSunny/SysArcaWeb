<?php
date_default_timezone_set('America/Mexico_City');
 //Agregamos la libreria FPDF
 require('../../fpdf/fpdf.php');
 require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

 $pdf = new FPDF(); //Creamos un objeto de la librería
   $pdf->AddPage(); //Agregamos una Pagina
   $pdf->SetFont('Arial','B',16); //Establecemos tipo de fuente, negrita y tamaño 16

$numero_factura=$_GET['numero_factura'];


if (isset($_GET["numero_factura"])) {
    //$row['id_medico']
    $sql="select so_factura.id_factura,
        CONCAT(so_clientes.nombre,' ',so_clientes.a_paterno,' ',so_clientes.a_materno) as nombre ,
        CONCAT(so_clientes.colonia,' ',so_clientes.calle,' #',so_clientes.numero_exterior) as direccion,
        so_clientes.telefono_fijo,
        CONCAT(so_medicos.nombre,' ',so_medicos.a_paterno,' ',so_medicos.a_materno) as nombre_medico,
        CASE
            WHEN so_clientes.`anios` > 0 THEN
                CONCAT(so_clientes.`anios`,' Anios')
            WHEN so_clientes.`meses` > 0 THEN
                CONCAT(so_clientes.`meses`,' Meses')
            WHEN so_clientes.`dias` > 0 THEN
                CONCAT(so_clientes.`dias`,' Dias')
        END AS edad,
        so_factura.fecha_entrega,
        imp_total,
        a_cuenta,
        resta,
        diagnostico,
        se_usuarios.nombre nombre_usuario,
        se_usuarios.a_paterno a_paterno_usuario,
        se_usuarios.a_materno a_materno_usuario 
    from so_factura
    inner join so_clientes on so_clientes.id_cliente=so_factura.fk_id_cliente
    inner join so_medicos on so_medicos.id_medico=so_factura.fk_id_medico
    inner join se_usuarios
    on se_usuarios.id_usuario=so_factura.fk_id_usuario 
    where id_factura=".$numero_factura;
 //echo $sql;
 
    //Nombre
     $pdf->SetFont('Arial','', 12);
     $pdf->SetXY(40,40);



     if ($result = mysqli_query($con, $sql)) {
     
 
        while($row = $result->fetch_assoc())
        {

            //Javier modifica aqui  las coordenadas, SETXY es donde tienes que moverle
            // la primera pociones es el eje Y y la segunda posicion el eje X

            // columna izquierda

            $pdf->SetXY(31, 45); 
            $pdf->Write(0,strtoupper($row['nombre']));

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(31, 56); 
            $pdf->Write(0,strtoupper($row['direccion']));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(31, 66); 
            $pdf->Write(0,$row['telefono_fijo']);

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(31, 76); 
            $pdf->Write(0,strtoupper($row['nombre_medico']));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(31, 86); 
            $pdf->Write(0,strtoupper($row['diagnostico']));

            //derecho
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(181,44);
            //$pdf->Write(0,$row['edad'].' Anios');
            $pdf->Write(0,$row['edad']);

            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(181,54);
            $pdf->Write(0,date("d-m-Y"));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(181,64);
            $pdf->Write(0,date("H:i"));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(181,90);
            $pdf->Write(0,$row['id_factura']);

            //datos de abajo
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(3,249);
            $pdf->Write(0,$row['fecha_entrega']);

            //atendio
            $paterno_usuario=$row['a_paterno_usuario']=="a_paterno"?"":$row['a_paterno_usuario'];
            $materno_usuario=$row['a_materno_usuario']=="a_materno"?"":$row['a_materno_usuario'];
           // $atendio=$row['nombre_usuario']." ".
            $atendio=$row['nombre_usuario']." ".$paterno_usuario." ".$materno_usuario;
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(3,263);
            $pdf->Write(0,$atendio);

            //total
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(182,242);
            $total_concat='$'.$row['imp_total'];
            $pdf->Write(0,$total_concat);

            //a cuenta
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(182,249);
            $cuenta_concat='$'.$row['a_cuenta'];
            $pdf->Write(0,$cuenta_concat);

            //resta
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(182,257);
            $resta_concat='$'.$row['resta'];
            $pdf->Write(0,$resta_concat);

        }

    }

    $sql="select cantidad,
    desc_estudio,
    precio_venta,
    km_indicaciones.desc_indicaciones 
    from so_detalle_factura
    inner join km_estudios on km_estudios.id_estudio=so_detalle_factura.fk_id_estudio
    INNER JOIN km_indicaciones ON km_indicaciones.id_indicaciones =  km_estudios.fk_id_indicaciones 
    where id_factura=".$numero_factura;
    //Y,X
    $linea_estudios=110;
    if ($resultadoEstudios = mysqli_query($con, $sql)) {
        while($row = $resultadoEstudios->fetch_assoc())
        {
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(18,$linea_estudios);
            $pdf->Write(0,$row['cantidad']);


            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(30,$linea_estudios);
            $pdf->Write(0,substr($row['desc_estudio'],0,48));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(180,$linea_estudios);
            $concat='$'.$row['precio_venta'];
            $pdf->Write(0,$concat);


            $linea_estudios=$linea_estudios+6;
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(30,$linea_estudios);
            $pdf->Write(0,'Indicaciones: '.substr($row['desc_indicaciones'],0,48));



            $linea_estudios=$linea_estudios+14;
        }
    }   


    $pdf->Output();
}
 

?>