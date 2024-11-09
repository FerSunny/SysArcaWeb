<?php
session_start();
date_default_timezone_set('America/Mexico_City');
//ini_set("default_charset", "UTF-8");
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos\
include "NumeroLetras/letras.php";


date_default_timezone_set('America/Mexico_City');
ini_set("default_charset", "UTF-8");

$id_sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['id_usuario'];

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];

//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
select  so_factura.id_factura,
        so_factura.numero_factura,
        so_factura.fk_id_sucursal,
        case
          when so_clientes.fk_id_sexo = '1' THEN
            'Mujer'
          else
              'Hombre'
        end as sexo,
        CONCAT(so_clientes.nombre,' ',so_clientes.a_paterno,' ',so_clientes.a_materno) as paciente ,
        CONCAT(IF(so_clientes.colonia = '0','                                                                               ',so_clientes.colonia),' ',IF(so_clientes.calle = '0','',so_clientes.calle),' #',IF(so_clientes.numero_exterior = '0','',so_clientes.numero_exterior)) AS direccion,
        -- CONCAT(so_clientes.colonia,' ',so_clientes.calle,' #',so_clientes.numero_exterior) as direccion,
        -- CONCAT(so_clientes.telefono_fijo,' - ',so_clientes.telefono_movil) AS telefono,
        CONCAT(if(so_clientes.telefono_fijo='','         ',so_clientes.telefono_fijo),' - ',if(so_clientes.telefono_movil='00','              ',so_clientes.telefono_movil)) AS telefono,
        CASE
        WHEN id_medico = 1607 AND LENGTH(vmedico) > 0 THEN
        vmedico
        ELSE
            CONCAT(so_medicos.nombre,' ',so_medicos.a_paterno,' ',so_medicos.a_materno) 
        END AS nombre_medico,
	    if(so_clientes.fecha_nac = '0001-01-01','    Años',
        CASE
            WHEN so_clientes.`anios` > 0 THEN
                CONCAT(so_clientes.`anios`,' Años')
            WHEN so_clientes.`meses` > 0 THEN
                CONCAT(so_clientes.`meses`,' Meses')
            WHEN so_clientes.`dias` > 0 THEN
                CONCAT(so_clientes.`dias`,' Dias')
        END) AS edad,
        so_clientes.rfc,
        so_factura.fecha_entrega,
        so_factura.fecha_factura,
        imp_total,
        a_cuenta,
        resta,
        diagnostico,
        CONCAT(se_usuarios.nombre,' ',se_usuarios.a_paterno,' ',se_usuarios.a_materno) AS usuario,
        se_usuarios.iniciales,
        so_clientes.id_cliente,
        CASE
        WHEN so_clientes.pass_word IS NULL OR so_clientes.pass_word = '' THEN
            SUBSTRING(MD5(RAND()),-8)
        ELSE
            ''
        END AS pass_word,
        su.desc_corta,
        so_factura.observaciones,
        LENGTH(TRIM((so_factura.observaciones))) as hay_observa,
        su.desc_sucursal,
        datos_clinicos,
        so_medicos.fk_id_sexo as sexo_medico,
        urgente,
        pendiente
    from so_factura
    left outer  join so_clientes on so_clientes.id_cliente=so_factura.fk_id_cliente
    left outer  join so_medicos on so_medicos.id_medico=so_factura.fk_id_medico
    left outer join se_usuarios on se_usuarios.id_usuario=so_factura.fk_id_usuario 
    LEFT OUTER JOIN kg_sucursales su ON su.id_sucursal = so_factura.`fk_id_sucursal`
    where id_factura=".$numero_factura;
 //echo $sql;

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $paciente=($row['paciente']);
            $medico=($row['nombre_medico']);
            $fecha=$row['fecha_factura'];
            $edad=($row['edad']);
            $usuario=$row['usuario'];
            $id_factura=$row['id_factura'];
            $direccion=$row['direccion'];
            $sexo=$row['sexo'];
            $telefono=$row['telefono'];
            $fecha_factura=$row['fecha_factura'];
            $fecha_entrega=$row['fecha_entrega'];
            $diagnostico=$row['diagnostico'];
            $imp_total=$row['imp_total'];
            $a_cuenta=$row['a_cuenta'];
            $resta=$row['resta'];
            $usuario=$row['usuario'];
            $fk_id_sucursal=$row['fk_id_sucursal'];
            $rfc_p = $row['rfc'];
            $iniciales = $row['iniciales'];
            $id_cliente=$row['id_cliente'];
            $pass_word=$row['pass_word'];
            $desc_corta=$row['desc_corta'];
            $observaciones=$row['observaciones'];
            $hay_observa=$row['hay_observa'];
            $folio=$row['numero_factura'];
            $desc_sucursal=$row['desc_sucursal'];
            $datos_clinicos=$row['datos_clinicos'];
            $sexo_medico=$row['sexo_medico'];
            $urgente=$row['urgente'];
            $pendiente=$row['pendiente'];
        }
    }

// Guardamos la contraseña para el paciente
    $pas=bin2hex(openssl_random_pseudo_bytes(4)); // se genera la contraseña
    $str_insert_01="INSERT INTO ce_acceso_pac
                (fk_id_empresa,
                 id_acceso_pac,
                 fk_id_paciente,
                 pas,
                 fecha_asigna,
                 estado)
                VALUES (1,
                        0,
                        $id_cliente,
                        '$pas',
                        NOW(),
                        'A')";
//echo $str_insert_01;

                $result_01 = $con -> query($str_insert_01);
// fin




// Rutina para agregar las tomas de mustras al modulo

            $sql_df=
            "
            SELECT 
            df.`fk_id_empresa`,
            df.`id_factura`,
            df.`fk_id_estudio`,
            em.`control`
            
            FROM so_detalle_factura  df, km_estudios es, vw_estudios_muestras_deta em
            WHERE df.id_factura = $numero_factura
            AND df.`fk_id_estudio` = es.`id_estudio`
            AND es.`cubiculo` = 'S'
            AND es.`per_paquete` = 'No'
            AND es.`id_estudio` = em.id_estudio
          
            UNION
            
            SELECT 
              df.`fk_id_empresa`,
              df.`id_factura`,
              esp.`id_estudio`,
              em.`control`
            FROM so_detalle_factura  df, km_paquetes pq, km_estudios es, km_estudios esp, vw_estudios_muestras_deta em
            WHERE df.id_factura = $numero_factura
            AND df.`fk_id_estudio` = pq.`id_paquete`
            AND df.`fk_id_estudio` = es.`id_estudio`
            AND pq.`fk_id_estudio` = esp.id_estudio
            AND es.`per_paquete` = 'Si'
            AND esp.`cubiculo` = 'S'    
            AND esp.`id_estudio` = em.id_estudio     
            ";
//echo $sql_df;
            if ($result_df = mysqli_query($con, $sql_df)) {
              while($row_df = $result_df->fetch_assoc())
              {
                $fk_id_factura = $row_df['id_factura'];
                $id_estudio =    $row_df['fk_id_estudio'];
                $control =    $row_df['control'];




                $queryusuario = mysqli_query($con,"SELECT * FROM tm_agenda WHERE fk_id_factura = $fk_id_factura and fk_id_estudio = $id_estudio and control = $control  ");
                $nr     = mysqli_num_rows($queryusuario);  
                  
                if ($nr == 0) {
                        $query_ag = "INSERT INTO tm_agenda
                        (fk_id_empresa,
                        id_agenda,
                        fk_id_factura,
                        fk_id_estudio,
                        fk_id_sucursal,
                        cubiculo,
                        fk_id_usuario,
                        fecha,
                        hora,
                        estado,
                        control)
                        VALUES (1,
                                0,
                                $fk_id_factura,
                                $id_estudio,
                                $fk_id_sucursal,
                                '1',
                                $id_usuario,
                                now(),
                                time(now()),
                                'A',
                                $control)
                                ";
                        //echo $query_ag;
                        $result_ag = $con -> query($query_ag);
                }

              }
            }


//





//$si_hay = $hay_observa;

// Obtenemos los datos de la unidad donde se imprime la nota
$query = "SELECT * FROM kg_emision em WHERE fk_id_sucursal = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i",$fk_id_sucursal);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) 
{
  $nombre_con = $row['nombre']." ".$row['a_paterno']." ".$row['a_materno'];
  $direccion1 = $row['direccion1'];
  $direccion2 = $row['direccion2'];
  $cp = $row['cp'];
  $rfc = $row['rfc'];

  $tfijo = $row['tel_fijo'];
  $tmovil = $row['tel_movil'];
  $semail = $row['email'];

  $horario_habil = $row['horario_habil'];
  $horario_festivo = $row['horario_festivo'];
  $horario_sabado = $row['horario_sabado'];
  $horario_domingo = $row['horario_domingo'];

}



// Obtenemos el metodo

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {
      ini_set("default_charset", "UTF-8");
      global  $paciente,
              $nombre_con,
              $direccion1,
              $direccion2,
              $cp,
              $rfc,
              $desc_sucursal,

              $medico,
              $fecha_factura,
              $fecha_entrega,

              $paciente,
              $direccion,
              $edad,
              $sexo,
              $telefono,
              $rfc_p,
              $folio,
              $numero_factura,
              $diagnostico,
              $datos_clinicos,

              $horario_habil,
              $horario_festivo,
              $horario_sabado,
              $horario_domingo,
              $sexo_medico,
              $id_cliente,
              $urgente,
              $pendiente,
              $pas; //,
              // $num_factura;

    $this->Image('../imagenes/logo_arca.png',1,1,28,15);
    $this->Image('../../imagenes/logo_arca_sys_web.jpg',80,50,53,35);



    $this->Ln(5);
    $this->SetTextColor(0,64,255);
    //$this->Cell(1);
    $this->setxy(0,15);
    $this->SetFont('Arial','',7);
    $this->Cell(5,5,utf8_decode($nombre_con),0,0,'L');
    $this->Ln(3);
    $this->Cell(-10);
    $this->SetTextColor(0,0,204);
    $this->Cell(5,5,utf8_decode('SUC. '.$desc_sucursal),0,0,'L');
    $this->Ln(4);
    $this->Cell(-10);
    $this->MultiCell(28,3,trim(utf8_decode($direccion1)),0,'J');
    $this->Ln(1);
    $this->Cell(-10);
    $this->MultiCell(28,3,trim(utf8_decode($direccion2)),0,'J');
    $this->Ln(0);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('RFC: '.$rfc),0,0,'L');
    $this->Ln(5);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('Sucursales'),0,0,'L');
    $this->Cell(42);
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('TLAHUAC'),0,0,'L');

    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('SAN GREGORIO'),0,0,'L');
    
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('XOCHIMILCO'),0,0,'L');
        
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('DIVISION NORTE'),0,0,'L');
            
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('SANTIAGO'),0,0,'L');
                
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('SAN PABLO'),0,0,'L');
                    
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('SAN PEDRO'),0,0,'L');
                    
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('MILPA ALTA'),0,0,'L');
                      
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('TECOMITL'),0,0,'L');
                      
    $this->Ln(4);
    $this->Cell(-10);
    $this->Cell(5,5,utf8_decode('TETELCO'),0,0,'L');
   // $this->Cell(15,5,$pas,0,0,'R');
    $this->Line(30, 1, 30, 90);

    $this->setxy(30 ,1);
    $this->Cell(5,5,utf8_decode('Paciente: '.$id_cliente.'-'.$paciente.', Edad: '.$edad.', '.$sexo.', Tel.: '.$telefono.' rfc:'.$rfc_p.', PSW:  '.$pas),0,0,'L');
    $this->Ln(4);
    $this->Cell(20);
    $this->Cell(5,5,utf8_decode($direccion),0,0,'L');

    $this->Ln(4);
    $this->Cell(20);
    $this->SetFont('Arial','B',7);
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(0, 0, 204);
    $this->Cell(184,4,utf8_decode('Horarios Atencion:  Dia Habil '.$horario_habil.'   Dia Festivo: '.$horario_festivo.'    Sabados: '.$horario_sabado.'    Domingo: '.$horario_domingo),0,0,'C',true);

    if($sexo_medico == 1){
        $sm='Dra. ';
    }else{
        $sm='Dr. ';
    };
    $this->SetFont('Arial','',7);
    $this->SetTextColor(0,102,255);
    $this->Ln(4);
    $this->Cell(20);
    $this->Cell(5,5,utf8_decode('Solicitio: '.$sm.$medico),0,0,'L');
    $this->Cell(75);
    $this->Cell(5,5,utf8_decode('Fecha Expedicion: '.$fecha_factura),0,0,'L');
    $this->Cell(50);
    $this->Cell(3,5,utf8_decode('Fecha Entrega: '.$fecha_entrega),0,0,'L');
    $this->Ln(1);
    $this->Cell(20);
    $this->Cell(3,5,'_____________________________________________________________________________________________________________________________________',0,0,'L');    
    
    
    $this->Ln(3);
    $this->Cell(20);
    $this->SetFont('Arial','B',8);
    $this->Cell(5,5,utf8_decode('FOLIO: '.$folio),0,0,'L');
    $this->Cell(20);
    $this->Cell(117,5,utf8_decode('ORDEN DE ESTUDIO'),0,0,'C');
    //$this->SetFont('Arial','',9);
    $this->Cell(5);
    $this->Cell(5,5,utf8_decode('OT: '.$numero_factura),0,0,'L');

    $this->SetTextColor(0,102,51);
    $this->Ln(4);
    $this->Cell(20);
    $this->SetFont('Arial','B',7);
    $this->Cell(5,4,utf8_decode('DX: '.$diagnostico),0,0,'L');
    if($urgente == 1){
        $this->Cell(136);
        $this->SetTextColor(255,0,0);
        $this->Cell(5,4,utf8_decode('Urgente'),0,0,'L');
        $this->SetTextColor(51,0,0);
    }
    $this->Ln(3);
    $this->Cell(20);
    $this->SetFont('Arial','B',7);
    $this->Cell(5,4,utf8_decode('Datos Clinicos: '.$datos_clinicos),0,0,'L');
    if($pendiente == 1){
        $this->Cell(136);
        $this->SetTextColor(0,204,0);
        $this->Cell(5,4,utf8_decode('Pendiente'),0,0,'L');
        $this->SetTextColor(51,0,0);
    }
    $this->Ln(1);
    $this->Cell(20);
    $this->Cell(3,5,'_____________________________________________________________________________________________________________________________________',0,0,'L');    
    
    /*




    $this->Ln(4);
    $this->Cell(28);
    $this->Cell(5,5,utf8_decode($direccion1),0,0,'L');
    $this->Cell(88);
    $this->SetFont('Arial','B',10);
    $this->SetTextColor(8,41,138);
    $this->Cell(5,5,utf8_decode($id_cliente.'-'.$paciente),0,0,'L');
    $this->SetFont('Arial','',8);
    $this->SetTextColor(0,64,255);

    $this->Ln(4);
    $this->Cell(28);
    $this->Cell(5,5,utf8_decode($direccion2.', cp'.$cp),0,0,'L');
    $this->Cell(88);
    $this->Cell(5,5,utf8_decode($direccion),0,0,'L');

    $this->Ln(4);
    $this->Cell(28);
    $this->Cell(5,5,utf8_decode('RFC: '.$rfc),0,0,'L');
    $this->Cell(86);
    $this->SetFont('Arial','B',10);
    $this->Cell(14,5,utf8_decode($edad),0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(5,5,utf8_decode($sexo.', Tel.: '.$telefono.' rfc:'.$rfc_p),0,0,'L');

    $this->Ln(4);
    $this->Cell(-4);
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(255,255,255);
    $this->SetFillColor(0, 128, 255);
    $this->Cell(203,4,utf8_decode('Horarios:  Dia Habil '.$horario_habil.'   Dia Festivo: '.$horario_festivo.'    Sabados: '.$horario_sabado.'    Domingo: '.$horario_domingo),0,0,'C',true);



    if($sexo_medico == 1){
        $sm='Dra. ';
    }else{
        $sm='Dr. ';
    };


    $this->SetFont('Arial','',9);
    $this->SetTextColor(0,102,255);
    $this->Ln(2);
    //$this->Cell(-5);
    //$this->Cell(5,5,'___________________________________________________________________________________________________________________',0,0,'L');
    $this->Ln(2);
    $this->Cell(-5);
    $this->Cell(5,5,utf8_decode('Solicitio: '.$sm.$medico),0,0,'L');
    $this->Cell(83);
    $this->Cell(5,5,utf8_decode('Fecha Expedicion: '.$fecha_factura),0,0,'L');
    $this->Cell(58);
    $this->Cell(5,5,utf8_decode('Fecha Entrega: '.$fecha_entrega),0,0,'L');
    $this->Ln(2);
    $this->Cell(-5);
    $this->Cell(5,5,'___________________________________________________________________________________________________________________',0,0,'L');    

    $this->Ln(5);
    $this->Cell(1);
    $this->SetFont('Arial','B',12);
    $this->Cell(5,5,utf8_decode('FOLIO: '.$folio),0,0,'L');
    $this->Cell(25);
    $this->Cell(125,5,utf8_decode('ORDEN DE ESTUDIO'),0,0,'C');
    //$this->SetFont('Arial','',9);
    $this->Cell(5);
    $this->Cell(5,5,utf8_decode('OT: '.$numero_factura),0,0,'L');

    $this->SetTextColor(0,102,51);
    $this->Ln(5);
    $this->Cell(1);
    $this->SetFont('Arial','B',9);
    $this->Cell(5,4,utf8_decode('DX: '.$diagnostico),0,0,'L');
    if($urgente == 1){
        $this->Cell(156);
        $this->SetTextColor(255,0,0);
        $this->Cell(5,4,utf8_decode('Urgente'),0,0,'L');
        $this->SetTextColor(51,0,0);
    }
    $this->Ln(4);
    $this->Cell(1);
    $this->SetFont('Arial','B',9);
    $this->Cell(5,4,utf8_decode('Datos Clinicos: '.$datos_clinicos),0,0,'L');
    if($pendiente == 1){
        $this->Cell(156);
        $this->SetTextColor(0,204,0);
        $this->Cell(5,4,utf8_decode('Pendiente'),0,0,'L');
        $this->SetTextColor(51,0,0);
    }
*/
    $this->Ln(4);

  }

// Pie de página
  function Footer()
  {

    global  $imp_total,
            $tfijo,
            $tmovil,
            $semail,
            $iniciales,
            $resta,
            $a_cuenta,
            $imp_total,
            $desc_corta;

    $this->SetY(-55);

// lineas de importes
    $iva = 0.16;
    $resta_iva = ($imp_total*$iva);
    $subtotal = number_format(($imp_total-$resta_iva),2);
//echo 'subtotal:'.$subtotal;
    $this->SetFont('Arial','B',7);

    $this->Cell(165);
    $this->Cell(18,5,'Sub Total',0,0,'L');
    $this->Cell(1);
    $this->Cell(15,5,'$'.$subtotal,0,0,'R');


    $this->ln(4);

    $this->Ln(1);



    $this->Cell(165);
    $this->Cell(18,5,'Iva',0,0,'L');
    $this->Cell(1);
    $this->Cell(15,5,'$'.number_format($resta_iva,2),0,0,'R');


    $this->ln(4);

    $this->Ln(1);
    


    $this->Cell(165);
    $this->Cell(18,5,'Total',0,0,'L');
    $this->Cell(1);
    $this->Cell(15,5,'$'.number_format($imp_total,2),0,0,'R');


    $this->ln(4);

    $this->Ln(1);
    
    $this->Cell(3);
    $this->Cell(27,5,'Atendido por:',0,0,'L');
    //$this->SetFont('Arial','',8);
    $this->Cell(50,5,$desc_corta.'/'.$iniciales,0,0,'L');

    $this->Cell(85);
    $this->Cell(18,5,'A cuenta',0,0,'L');
    $this->Cell(1);
    $this->Cell(15,7,'$'.number_format($a_cuenta,2),0,0,'R');


    $this->ln(5);

    $this->SetFont('Arial','',7);
    $this->Cell(3);
    $this->Cell(27,5,'CANTIDAD EN LETRA: '. $letras = NumeroALetras::convertir($imp_total, 'pesos', 'centavos') ,0,0,'L');
    //$this->SetFont('Arial','',8);
    $this->Cell(135);
   // $this->Cell(18,5,'Resta',0,0,'L');
   // $this->Cell(1);
    if($resta == 0){
        $this->Cell(18,5,'Resta',0,0,'L');
        $this->Cell(1);
        $this->Cell(15,7,'$'.number_format($resta,2),0,0,'R');
    }else{
        $this->Cell(18,5,'Resta',0,0,'L');
        $this->Cell(1);        
        $this->SetTextColor(255, 73, 51);
        $this->SetFillColor(243, 255, 51);

        $this->Cell(15,5,'$'.number_format($resta,2),0,0,'C',true);
    }
    
    
    if($resta == 0){
        $this->Image('../imagenes/sello_pagado2.jpg',130,80,20,5);  
    }
    

// lineas de leyenda

    $this->Ln(5);
    $this->Cell(-5);
    $this->SetTextColor(120,0,0);
    $this->SetFont('Arial','I',7);
    $this->MultiCell(190,3,utf8_decode('Es indispensable traer este comprobante para la entrega de sus estudios después de 30 días el laboratorio no se hace responsable de los estudios no recogidos después de 7 días de la fecha de expedición; el laboratorio no se hace responsable por toma o entrega de muestras pendientes.  (Excepto COLPOSCOPIAS máximo 30 días)'),0,'J');


    $this->Ln(1);
    $this->Cell(-5);
    $this->SetTextColor(0,102,255);
    $this->SetFont('Arial','I',7);
    /*
    $this->MultiCell(200,3,utf8_decode('De conformidad con lo dispuesto por la Ley Federal de protección de Datos Personales en Posesión de los Particulares (LFPDPPP), LABORATORIOS CLINICOS ARCA está comprometido en manejar los datos personales que usted le proporcione, observando en todo momento los principios de licitud, consentimiento, información, calidad, finalidad, lealtad y proporcionalidad previstos en la LFPDPPP y conforme al presente Aviso de Privacidad publicado en nuestra pagina WEB. (www.laboratoriosarca.com.mx)'),0,'J');
*/
    $this->MultiCell(200,3,utf8_decode('Laboratorio de Análisis Clínicos ARCA manifiesta su compromiso de salvaguardar la confidencialidad de la información, en cumplimiento a la Ley Federal de Protección de Datos Personales en Posesión de Particulares y Art. 56 de la Ley de Infraestructura de la Calidad. Ver AVISO DE PRIVACIDAD en www.laboratoriosarca.com.mx'),0,'J');
    $this->Ln(-3);
    $this->Cell(3);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','I',7);
    $this->Cell(70,5,'_____________________________________________________________________________________________________________',0,0,'L');
    $this->Ln(5);
    $this->Cell(3);
    $this->Cell(70,5,'PUE Pago en una solo exhibicion',0,0,'L');
    $this->Cell(70,5,'Efectos fiscales al pago',0,0,'L');
    $this->Cell(70,5,'Regimen de incorporacion fiscal',0,0,'L');
    $this->Ln(1);
    $this->Cell(3);
    $this->SetTextColor(0,0,0);
    $this->Cell(70,5,'_____________________________________________________________________________________________________________',0,0,'L');
    $this->SetTextColor(0,102,255);
    $this->Ln(4);
    $this->Cell(3);
    $this->Cell(25,5,'Telefono: '.$tfijo,0,0,'L');
    $this->Cell(45);
    $this->Cell(25,5,'Celular: '.$tmovil,0,0,'L');
    $this->Cell(30);
    $this->Cell(25,5,'Email: '.$semail,0,0,'L');

    $this->Ln(4);
    $this->Cell(1);
    $this->Cell(25,5,'FOR-REC-02',0,0,'C');
    $this->Cell(150,5,'www.laboratoriosarca.com.mx',0,0,'C');
    $this->Cell(1, 5, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    $this->SetTextColor(0,0,0);


 

  }
}
//
// Creación del objeto de la clase heredada
//
//$pdf = new PDF('P','mm','Letter'); array(100,150)
$pdf = new PDF('L','mm','A5');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,45);

$pdf->AliasNbPages();
$pdf->AddPage();

//global  $hay_observa;


$sql="select cantidad,
    desc_estudio,
    fk_id_estudio,
    precio_venta,
    km_indicaciones.desc_indicaciones,
    CASE
        WHEN d.por_desc <> 0 THEN 
            CONCAT('Aplicado el ',d.por_desc,'%', ' descuento por: ',d.desc_descuento)
    END AS descuento,
    fk_id_promosion,
    km_estudios.fk_id_promosion,
    cantidad,
    per_paquete,
    me.desc_metodo
    from so_detalle_factura
    inner join km_estudios on km_estudios.id_estudio=so_detalle_factura.fk_id_estudio
    INNER JOIN km_indicaciones ON km_indicaciones.id_indicaciones =  km_estudios.fk_id_indicaciones 
    INNER JOIN kg_descuentos d ON d.id_descuento = km_estudios.fk_id_descuento 
    LEFT OUTER JOIN km_metodos me ON (me.id_metodo = km_estudios.`fk_id_metodo`)
    WHERE id_factura=".$numero_factura;
  if ($result = mysqli_query($con, $sql)) {
    $pdf->Cell(20);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,5,"Cantidad",0,0,'R');
    $pdf->Cell(15);
    $pdf->Cell(13,5,"Descripcion",0,0,'R');
    $pdf->Cell(87);
    $pdf->Cell(13,5,"Costo unitario",0,0,'R');
    $pdf->Cell(7);
    $pdf->Cell(13,5,"Importe",0,0,'R');
    $pdf->ln(1);
    $pdf->Cell(19);
    $pdf->Cell(70,5,'_____________________________________________________________________________________________________________________',0,0,'L');
    $pdf->ln(4);
    while($row = $result->fetch_assoc())
      {
             // $this->ln(5);
              $pdf->Cell(20);
              $pdf->SetFont('Arial','',8);
              $pdf->Cell(13,5,$row['cantidad'],0,0,'R');
              $pdf->Cell(10,5,$row['fk_id_estudio'],0,0,'R');
              $pdf->Cell(1);
              $pdf->Cell(70,5,utf8_decode($row['desc_estudio']),0,0,'L');
              $pdf->Cell(20);
              $pdf->Cell(24,5,'$'.number_format($row['precio_venta'],2),0,0,'R');
              $pdf->Cell(24,5,'$'.number_format($row['precio_venta'],2),0,0,'R');
              // se activa nuevamente el metodo para cada estudio. 27abr20223 JPM para cubrir
              // el requerimiento de la acreditacion.


              if($row['desc_metodo'] == ''){
                
              }else{
                $pdf->ln(4);
                $pdf->Cell(30);
                $pdf->SetFont('Arial','I',7);                
                $pdf->Cell(70,5,'Metodo: '.utf8_decode($row['desc_metodo']),0,0,'L');
              }
              
              $pdf->SetFont('Arial','',7);
// verificamos si el estudio es paquete, para desglosarlo.
              $v_paquete = $row['fk_id_estudio'];
              if($row['per_paquete'] == 'Si'){
                $sql_pq="
                    SELECT p.fk_id_estudio ,
                    es.`desc_estudio`
                    FROM km_paquetes p,
                    km_estudios es 
                    WHERE p.`id_paquete` = '$v_paquete' 
                    AND es.`id_estudio` = p.`fk_id_estudio` 
                    AND p.estado = 'A'
                        ";
                  if ($result_pq = mysqli_query($con, $sql_pq)) {
                    while($row_pq = $result_pq->fetch_assoc())
                        {
                            $pdf->ln(4);
                            $pdf->Cell(40);
                            $pdf->SetFont('Arial','I',7);
                            //$pdf->Cell(13,5,utf8_decode($row_pq['desc_estudio'].' Metodo: '.$row_pq['desc_metodo']),0,0,'L');
                            $pdf->Cell(13,5,utf8_decode($row_pq['desc_estudio']),0,0,'L');
                            //$pdf->ln(3);
                        }

                  }




              }



              if (strlen($row['desc_indicaciones'])>0){
                $pdf->ln(4);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(30);
                //$pdf->Cell(190,5,'Indicaciones: '.utf8_decode($row['desc_indicaciones']),0,0,'L');
                $pdf->MultiCell(165,3,'Indicaciones: '.trim(utf8_decode($row['desc_indicaciones'])),0,'J');
              }
              if (strlen($row['descuento'])>0){
                $pdf->ln(2);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(20);
                $pdf->Cell(190,5,$row['descuento'],0,0,'L');
              }

              if ($row['fk_id_promosion']<>7){
                //$fecha_system=date("Y-m-d");
                $fecha_system=$fecha_factura;
                $sql_p="SELECT id_promocion , CONCAT('Aplica promocion (',porcentaje,'%) ',desc_promocion) AS promocion ,   porcentaje ,   fecha_inicio ,
                        fecha_final , lunes , martes , miercoles , jueves , viernes , sabado , domingo , tuly , tuly2 , greg , xochi , sant , pablo , pedro , teco , tete , dino, tla, mil, estado ,DAYNAME('".$fecha_system."') as dia_semana
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
                                case '11':
                                    if($rowp['dino']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '12':
                                    if($rowp['tla']=='S'){
                                       $sucursal_ok='1';
                                    }
                                    break;
                                case '13':
                                    if($rowp['Milpa']=='S'){
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
                                    $pdf->ln(0);
                                    $pdf->SetTextColor(120,0,0);
                                    $pdf->SetFont('Arial','B', 7);
                                    $pdf->Cell(30);
                                    $pdf->Cell(170,5,$rowp['promocion'],0,0,'L');
                                    $pdf->SetTextColor(0,0,0);
                                }
                            }
                        }
                }
            
              }

              $pdf->ln(6);
        }

    $pdf->ln(5);
    $pdf->SetFont('Arial','I',7);
    $pdf->Cell(35); 
    $pdf->Cell(70,5,'- Un estudio confiable, garantiza un excelente diagnostico -',0,0,'C');
    //$pdf->ln(-10);

//echo 'variable='.$hay_observa;
// Verificamos las observaciones
    /*
    if ($hay_observa > 0){
        $pdf->ln(8);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(5); 
        $pdf->Cell(70,5,'Observaciones:',0,0,'L'); 
        $pdf->ln(4);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(5);
        $pdf->MultiCell(170,5,$observaciones,0,'L');

    } 
*/
  }  







  

$pdf->Output();
?>