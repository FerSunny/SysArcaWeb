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
    $sql="select so_factura.id_factura,so_clientes.nombre,so_clientes.a_paterno,so_clientes.a_materno,so_clientes.calle,so_clientes.telefono_fijo,so_medicos.nombre as nombre_medico,so_medicos.a_paterno as apellido_paterno_medico,so_medicos.a_materno as apellido_materno_medico,CONCAT(so_clientes.anios,'.',so_clientes.meses,'.',so_clientes.dias) as edad,so_factura.fecha_entrega,imp_total,a_cuenta,resta,se_usuarios.nombre nombre_usuario,se_usuarios.a_paterno a_paterno_usuario,se_usuarios.a_materno a_materno_usuario from so_factura
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

            $pdf->SetXY(26, 45); 
            $pdf->Write(0,strtoupper($row['nombre']));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(26, 55); 
            $pdf->Write(0,strtoupper($row['calle']));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(26, 66); 
            $pdf->Write(0,$row['telefono_fijo']);

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(26, 76); 
            $pdf->Write(0,strtoupper($row['nombre_medico']));

            //derecho
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(175,44);
            //$pdf->Write(0,$row['edad'].' Anios');
            $pdf->Write(0,$row['edad']);

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(175,54);
            $pdf->Write(0,date("d-m-Y"));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(175,64);
            $pdf->Write(0,date("H:i"));

            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(175,90);
            $pdf->Write(0,$row['id_factura']);

            //datos de abajo
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(1,250);
            $pdf->Write(0,$row['fecha_entrega']);

            //atendio
            $paterno_usuario=$row['a_paterno_usuario']=="a_paterno"?"":$row['a_paterno_usuario'];
            $materno_usuario=$row['a_materno_usuario']=="a_materno"?"":$row['a_materno_usuario'];
           // $atendio=$row['nombre_usuario']." ".
            $atendio=$row['nombre_usuario']." ".$paterno_usuario." ".$materno_usuario;
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(1,265);
            $pdf->Write(0,$atendio);

            //total
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(176,242);
            $total_concat='$'.$row['imp_total'];
            $pdf->Write(0,$total_concat);

            //a cuenta
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(176,249);
            $cuenta_concat='$'.$row['a_cuenta'];
            $pdf->Write(0,$cuenta_concat);

            //resta
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(176,257);
            $resta_concat='$'.$row['resta'];
            $pdf->Write(0,$resta_concat);

        }

    }

    $sql="select cantidad,desc_estudio,precio_venta from so_detalle_factura
    inner join km_estudios
    on km_estudios.id_estudio=so_detalle_factura.fk_id_estudio
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
            $pdf->SetXY(178,$linea_estudios);
            $concat='$'.$row['precio_venta'];
            $pdf->Write(0,$concat);

            $linea_estudios=$linea_estudios+15;
        }
    }   


    $pdf->Output();
}
 

?>