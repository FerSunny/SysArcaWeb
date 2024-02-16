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
    $sql="select so_factura.id_factura,so_factura.fk_id_sucursal,
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
        so_factura.fecha_factura,
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

     $fk_id_sucursal=$row['fk_id_sucursal'];           
     $fecha_factura=$row['fecha_factura'];
// columna izquierda
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(31, 47); 
            $pdf->Write(0,strtoupper($row['nombre']));

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(31, 57); 
            $pdf->Write(0,strtoupper($row['direccion']));

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(31, 68); 
            $pdf->Write(0,$row['telefono_fijo']);

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(31, 77); 
            $pdf->Write(0,strtoupper($row['nombre_medico']));

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(31, 88); 
            $pdf->Write(0,strtoupper($row['diagnostico']));

            //derecho
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(181,45);
            //$pdf->Write(0,$row['edad'].' Anios');
            $pdf->Write(0,$row['edad']);

            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(181,55);
            $pdf->Write(0,date("d-m-Y"));

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(181,66);
            $pdf->Write(0,date("H:i"));

            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(181,92);
            $pdf->Write(0,$row['id_factura']);

            //datos de abajo
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(3,251);
            $pdf->Write(0,$row['fecha_entrega']);

            //atendio
            $paterno_usuario=$row['a_paterno_usuario']=="a_paterno"?"":$row['a_paterno_usuario'];
            $materno_usuario=$row['a_materno_usuario']=="a_materno"?"":$row['a_materno_usuario'];
           // $atendio=$row['nombre_usuario']." ".
            $atendio=$row['nombre_usuario']." ".$paterno_usuario." ".$materno_usuario;
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(3,265);
            $pdf->Write(0,$atendio);

            //total
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(182,245);
            $total_concat='$'.$row['imp_total'];
            $pdf->Write(0,$total_concat);

            //a cuenta
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(182,251);
            $cuenta_concat='$'.$row['a_cuenta'];
            $pdf->Write(0,$cuenta_concat);

            //resta
            $pdf->SetFont('Arial','', 10);
            $pdf->SetXY(182,258);
            $resta_concat='$'.$row['resta'];
            $pdf->Write(0,$resta_concat);

        }

    }

    $sql="select cantidad,
    desc_estudio,
    precio_venta,
    km_indicaciones.desc_indicaciones,
    CASE
        WHEN d.por_desc <> 0 THEN 
            CONCAT('Aplicado el ',d.por_desc,'%', ' descuento por: ',d.desc_descuento)
    END AS descuento,
    fk_id_promosion,
    km_estudios.fk_id_promosion
    from so_detalle_factura
    inner join km_estudios on km_estudios.id_estudio=so_detalle_factura.fk_id_estudio
    INNER JOIN km_indicaciones ON km_indicaciones.id_indicaciones =  km_estudios.fk_id_indicaciones 
    INNER JOIN kg_descuentos d ON d.id_descuento = km_estudios.fk_id_descuento 
    WHERE id_factura=".$numero_factura;

//echo $sql;

    $linea_estudios=112;
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


            if (strlen($row['desc_indicaciones'])>0){
                $linea_estudios=$linea_estudios+6;
                $pdf->SetFont('Arial','B', 9);
                $pdf->SetXY(30,$linea_estudios);
                $pdf->Write(0,'Indicaciones: '.substr($row['desc_indicaciones'],0,48));
            }

            if (strlen($row['descuento'])>0){
                $linea_estudios=$linea_estudios+6;
                $pdf->SetFont('Arial','B', 9);
                $pdf->SetXY(30,$linea_estudios);
                $pdf->Write(0,substr($row['descuento'],0,48));
            }

            if ($row['fk_id_promosion']<>7){
                //$fecha_system=date("Y-m-d");
                $fecha_system=$fecha_factura;
                $sql_p="SELECT id_promocion , CONCAT('Aplica promocion (',porcentaje,'%) ',desc_promocion) AS promocion ,   porcentaje ,   fecha_inicio ,
                        fecha_final , lunes , martes , miercoles , jueves , viernes , sabado , domingo , tuly , tuly2 , greg , xochi , sant , pablo , pedro , teco , tete , estado ,DAYNAME('".$fecha_system."') as dia_semana
                        FROM  kg_promociones 
                        WHERE '".$fecha_system."' BETWEEN fecha_inicio AND fecha_final 
                         and id_promocion=".$row['fk_id_promosion'];
                $sucursal_ok='0';
                //echo $sql_p;
                if ($row_promo = mysqli_query($con, $sql_p)) {
                    while($rowp = $row_promo->fetch_assoc())
                        {
                            
                            switch ($fk_id_sucursal) {
                                case '1':
                                    if($rowp['tuly']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '2':
                                    if($rowp['tuly2']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '3':
                                    if($rowp['greg']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '4':
                                    if($rowp['xochi']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '5':
                                    if($rowp['sant']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '6':
                                    if($rowp['pablo']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '7':
                                    if($rowp['pedro']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '8':
                                    if($rowp['teco']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '9':
                                    if($rowp['tete']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                            };
                            if ($sucursal_ok=='1'){
                                $dia_ok='0';
                                //echo $rowp['dia_semana'];
                                switch ($rowp['dia_semana']) {
                                    case 'Monday':
                                        if($rowp['lunes']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Tuesday':
                                        if($rowp['martes']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Tuesday':
                                        if($rowp['martes']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Wednesday':
                                        if($rowp['miercoles']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Thursday':
                                        if($rowp['jueves']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Friday':
                                        if($rowp['viernes']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Saturday':
                                        if($rowp['sabado']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    case 'Sunday':
                                        if($rowp['domingo']=='S'){
                                            $dia_ok='1';
                                        }
                                        break;
                                    default:
                                        $dia_ok='0';
                                        break;
                                }
                                if ($dia_ok=='1'){
                                    $linea_estudios=$linea_estudios+6;
                                    $pdf->SetFont('Arial','B', 9);
                                    $pdf->SetXY(30,$linea_estudios);
                                    $pdf->Write(0,substr($rowp['promocion'],0,75));
                                }
                            }
                        }
                }


            $linea_estudios=$linea_estudios+14;
        }
    }   
    $pdf->SetFont('Arial','B',20);
    $pdf->SetXY(37, 200); 
    $pdf->Write(0,'"MI FAMILIA"'); 

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(45, 205); 
    $pdf->Write(0,'PROMOCION!!!!');

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(40, 210); 
    $pdf->Write(0,'10 % DE DESCUENTO');

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(32, 215); 
    $pdf->Write(0,'SI PRESENTA ESTA NOTA  EN SUS');

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(30, 220); 
    $pdf->Write(0,'PROXIMOS ESTUDIOS, ANALISIS, RX,');

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(39, 225); 
    $pdf->Write(0,'ULTRASONIDO, ETC');

    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(33, 230); 
    $pdf->Write(0,'(EXCEPTO PROMOCIONES)');
}
    $pdf->Output();
}
 

?>