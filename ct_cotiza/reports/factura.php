<?php
session_start();
date_default_timezone_set('America/Mexico_City');
//ini_set("default_charset", "UTF-8");
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

date_default_timezone_set('America/Mexico_City');
ini_set("default_charset", "UTF-8");

$id_sucursal = $_SESSION['fk_id_sucursal'];

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];

$pass_word='';
//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
select so_factura_pre.id_factura,so_factura_pre.fk_id_sucursal,
        case
          when so_clientes.fk_id_sexo = '1' THEN
            'Mujer'
          else
              'Hombre'
        end as sexo,
        CONCAT(so_clientes.nombre,' ',so_clientes.a_paterno,' ',so_clientes.a_materno) as paciente ,
        CONCAT(so_clientes.colonia,' ',so_clientes.calle,' #',so_clientes.numero_exterior) as direccion,
         CONCAT(so_clientes.telefono_fijo,' - ',so_clientes.telefono_movil) AS telefono,
        CASE
        WHEN id_medico = 1607 AND LENGTH(vmedico) > 0 THEN
        vmedico
        ELSE
            CONCAT(so_medicos.nombre,' ',so_medicos.a_paterno,' ',so_medicos.a_materno) 
    END AS nombre_medico,
        CASE
            WHEN so_clientes.`anios` > 0 THEN
                CONCAT(so_clientes.`anios`,' Años')
            WHEN so_clientes.`meses` > 0 THEN
                CONCAT(so_clientes.`meses`,' Meses')
            WHEN so_clientes.`dias` > 0 THEN
                CONCAT(so_clientes.`dias`,' Dias')
        END AS edad,
        so_clientes.rfc,
        so_factura_pre.fecha_entrega,
        so_factura_pre.fecha_factura,
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
	    END AS pass_word

    from so_factura_pre
    left outer  join so_clientes on so_clientes.id_cliente=so_factura_pre.fk_id_cliente
    left outer  join so_medicos on so_medicos.id_medico=so_factura_pre.fk_id_medico
    left outer join se_usuarios
    on se_usuarios.id_usuario=so_factura_pre.fk_id_usuario 
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
        }
    }

    if($pass_word <> ''){
        $sql_update="UPDATE so_clientes SET pass_word = '$pass_word' 
        WHERE id_cliente = ".$id_cliente;
        //echo $sql_update;
        $execute_query_update = mysqli_query($con,$sql_update);        
    }

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
    }

// Obtenemos el metodo

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {
      ini_set("default_charset", "UTF-8");
      global  $paciente,
              $rfc_p,
              $medico,
              $id_factura,
              $fecha,
              $direccion,
              $edad,
              $sexo,
              $telefono,
              $fecha_factura,
              $fecha_entrega,
              $diagnostico,
              $id_sucursal,
              $nombre_con,
              $direccion1,
              $direccion2,
              $cp,
              $rfc,
              $id_cliente,
              $pass_word;

      //$this->Image('../imagenes/logo_arca.png',15,5,140,0);
      //$this->Image('../imagenes/pacal.jpg',160,5,40,0);
      //$this->Image('../imagenes/firma.gif',153,225,40,0);
      $this->Ln(0);
      $this->Cell(1);
      $this->SetFont('Arial','B',23);
      //$this->SetDrawColor(0,80,180);
      //$this->SetFillColor(230,230,0);
      $this->SetTextColor(0,0,255);
      //$this->Cell(185,5,'ARCA',0,0,'C');

      $this->Ln(6);
      $this->SetTextColor(0,100,0);
      $this->SetFont('Arial','B',15);
      $this->Cell(185,5,'LABORATORIOS DE ANALISIS CLINICOS',0,0,'C');

      $this->Ln(5);
      $this->SetTextColor(95,158,160);
      $this->SetFont('Arial','',13);
      $this->Cell(185,5,utf8_decode($nombre_con." RFC: ".$rfc),0,0,'C');

      $this->Ln(5);
      $this->Cell(170,5,utf8_decode("Lugar de Expedición: ".$direccion1),0,0,'C');

      $this->Ln(5);
      $this->Cell(185,5,utf8_decode($direccion2." C.P.".$cp),0,0,'C');

      $this->Image('../imagenes/codigo1.jpg',170,10,30,30);
      $this->Image('../imagenes/logo_arca.png',10,10,33,15);
      $this->Image('../imagenes/whatsapp.jpg',12,40,7,0);
      $this->Image('../imagenes/telefono.jpg',47,40,7,0);

      $this->Image('../../imagenes/logo_arca_sys_web.jpg',80,150,73,55);

      $this->Ln(6);

      $this->SetFont('Arial','B',17);
      $this->SetTextColor(0,0,255);
      $this->Cell(185,5,'COTIZACION DE ESTUDIO',0,0,'C');

      $this->Ln(5);
      $this->Cell(10);
      $this->SetFont('Arial','',10);
      $this->Cell(23,6,'55 3121 0700',0,0,'L');
      $this->Cell(12);
      $this->Cell(23,6,'ARCATEL: 216 141 44',0,0,'L');

      $this->Cell(65);
      $this->SetFont('Arial','B',14);
      $this->SetTextColor(0,0,0);
      $this->Cell(43,6,utf8_decode('Cotización No:'),0,0,'L');
      $this->Cell(15,6,$id_factura,0,0,'L');

      $this->Ln(8);
      $this->Cell(3);
      $this->SetFillColor(230,230,250);
      $this->SetDrawColor(0,0,255);
      $this->rect(12, 49.7,95,35);
      $this->rect(111, 49.7,95,35);
      $espacio = "";
      $cantidad = strlen($paciente);
      for($i = 1; $i < $cantidad; $i++)
      {
        $espacio .= " "; 
      }
      $this->SetFont('Arial','B',10);
      $this->Cell(94,5,'Paciente'.$espacio.'RFC',0,0,'L',true);
      $this->Cell(4);
      $this->Cell(94,5,'Solicito',0,1,'L',true);

      $this->Ln(1);
      $this->SetFont('Arial','',9);
      $this->Cell(3);
      
      $this->Cell(94,4,$id_cliente.' '.utf8_decode($paciente.' '.$rfc_p),0,0,'L');
      $this->Cell(4);
      $this->Cell(94,4,utf8_decode($medico),0,0,'L');

      $this->Ln(5);
      $this->SetFont('Arial','B',10);
      $this->Cell(3);
      $this->Cell(94,5,utf8_decode('Dirección'),0,0,'L',true);
      $this->Cell(4);
      $this->Cell(94,5,utf8_decode('Fecha de Expedición'),0,1,'L',true);

      $this->Ln(1);
      $this->SetFont('Arial','',9);
      $this->Cell(3);
      $this->Cell(94,4,$direccion,0,0,'L');
      $this->Cell(4);
      $this->Cell(94,4,$fecha_factura,0,0,'L');

      $this->Ln(5);
      $this->SetFont('Arial','B',10);
      $this->Cell(3);
      $this->Cell(94,5,'Edad            Sexo             Telefono',0,0,'L',true);
      $this->Cell(4);
      $this->Cell(94,5,'Fecha Entrega',0,1,'L',true);

      $this->Ln(1);
      $this->SetFont('Arial','',9);
      $this->Cell(3);
      $this->Cell(21,4,utf8_decode($edad),0,0,'L');
      $this->Cell(22,4,$sexo,0,0,'L');
      $this->Cell(27,4,$telefono,0,0,'L');
      $this->Cell(28);
      $this->Cell(30,4,$fecha_entrega,0,0,'L');

      $this->Ln(7);
      $this->SetFont('Arial','B',10);
      $this->Cell(3);
      $this->Cell(25,5,'DX:',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(25,5,$diagnostico,0,0,'L');
      $this->Cell(128);
      $this->Cell(8,5,$pass_word,0,0,'L');

      $this->Ln(5);
      $this->SetTextColor(0,0,255);
      $this->SetFont('Arial','B',11);
      $this->Cell(3);
      $this->Cell(194,7,'ESTUDIOS SOLICITADOS',0,0,'C',true);


      $this->Ln(10);

  }

// Pie de página
  function Footer()
  {

    global  $imp_total,
            $a_cuenta,
            $resta,
            $usuario,
            $iniciales;

    include "NumeroLetras/letras.php";
    $iva = 0.16;
    $resta_iva = number_format(($imp_total*$iva),2);
    $subtotal = number_format(($imp_total-$resta_iva),2);

    $this->SetY(-40);

    $this->Ln(-3);
    $this->SetFont('Arial','B',11);
    $this->Cell(3);
    $this->Cell(27,5,'Atendido por:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(50,5,$iniciales,0,0,'L');
    $this->ln();

    $this->SetFont('Arial','B',9);
    $this->Cell(3);
    $this->Cell(27,5,'CANTIDAD EN LETRA: '. $letras = NumeroALetras::convertir($imp_total, 'pesos', 'centavos') ,0,0,'L');
    $this->ln(-10);


    $this->SetFont('Arial','B',12);
    $this->SetFillColor(230,230,250);
    $this->SetX(90);
    $this->Cell(75);
    $this->Cell(20,5,'SubTotal',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,5,'$'.$subtotal,0,0,'R');
    $this->Ln();

    $this->SetFont('Arial','B',12);
    $this->SetFillColor(230,230,250);
    $this->SetX(90);
    $this->Cell(75);
    $this->Cell(20,5,'IVA',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,5,"$".number_format(($resta_iva),2),0,0,'R');
    $this->Ln();

    $this->SetFont('Arial','B',12);
    $this->SetFillColor(230,230,250);
    $this->SetX(90);
    $this->Cell(75);
    $this->Cell(20,5,'Total',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,5,'$'.number_format($imp_total,2),0,0,'R');

    $this->SetTextColor(120,0,0);
    $this->SetFont('Arial','B',8);
    $this->Ln(4);
    $this->Cell(3);
    //$this->Cell(125,5,'Es indispensable traer este comprobante para la entrega de sus estudios',0,0,'L');
    $this->Cell(125);
    $this->Cell(27);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','B',12);
    $this->Cell(20,7,'A cuenta',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,7,'$'.number_format($a_cuenta,2),0,0,'R');

    $this->SetTextColor(120,0,0);
    $this->SetFont('Arial','B',8);
    
    $this->Ln(5);
    $this->Cell(3);
    //$this->Cell(148,5,'Despues de 30 dias el laboratorio no se hace responsable de los estudios no recogidos',0,0,'L');

    $this->Cell(148);

//$this->Cell(27);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','B',12);
    $this->Cell(4);
    $this->Cell(20,7,'Resta',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,7,'$'.number_format($resta,2),0,0,'R');

    $this->Ln(1);
    $this->Cell(3);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','I',10);
    $this->Cell(70,7,'____________________________________________________________________________________________________',0,0,'L');
    $this->Ln(5);
    $this->Cell(3);
    $this->Cell(70,7,utf8_decode('Cotización valida en la sucursal de su preferencia'),0,0,'L');
    //$this->Cell(70,7,'Efectos fiscales al pago',0,0,'L');
    //$this->Cell(70,7,'Regimen de incorporacion fiscal',0,0,'L');
    $this->Ln(1);
    $this->Cell(3);
    $this->SetTextColor(0,0,0);
    $this->Cell(70,7,'____________________________________________________________________________________________________',0,0,'L');

    $this->Ln(5);
    $this->SetTextColor(0,0,205);
    $this->SetFont('Arial','',8);
    
    //$this->Cell(3);
    $this->Cell(33,5,'Tulyehualco 7095 7168' ,0,0,'L');
    $this->Cell(3);
    $this->Cell(28,5,'San Pablo 5862 6736' ,0,0,'L');
    $this->Cell(3);
    $this->SetFont('Arial','',7);
    $this->SetTextColor(120,0,0);
    $this->Cell(15,5,utf8_decode('De conformidad con lo dispuesto por la Ley Federal de Protección de Datos Personales en posesión de los particulares'),0,0,'L');
    $this->SetFont('Arial','',8);
    $this->SetTextColor(0,0,205);

    $this->Ln(4);
    //$this->Cell(3);
    $this->Cell(33,5,'San Gregorio 5843 6228' ,0,0,'L');
    $this->Cell(3);
    $this->Cell(28,5,'San Pedro 5844 3374' ,0,0,'L');
    $this->Cell(3);
    $this->SetFont('Arial','',7);
    $this->SetTextColor(120,0,0);
    $this->Cell(15,5,utf8_decode('(LFPDPPP), LABORATORIOS CLINICOS ARCA está comprometido en manejar los datos personales que usted le'),0,0,'L');
    $this->SetFont('Arial','',8);
    $this->SetTextColor(0,0,205);

    $this->Ln(4);
    //$this->Cell(3);
    $this->Cell(33,5,'Xochimilco 5603 2161' ,0,0,'L');
    $this->Cell(3);
    $this->Cell(28,5,'Tecomitl 5847 6013' ,0,0,'L');
    $this->Cell(3);
    $this->SetFont('Arial','',7);
    $this->SetTextColor(120,0,0);
    $this->Cell(15,5,utf8_decode('proporcione, observando en todo momento los principios de licitud, consentimiento, información, calidad, finalidad, lealtad'),0,0,'L');
    $this->SetFont('Arial','',8);
    $this->SetTextColor(0,0,205);

    $this->Ln(3.5);
    //$this->Cell(3);
    $this->Cell(33,5,'Santiago 2586 0220' ,0,0,'L');
    $this->Cell(3);
    $this->Cell(28,5,'Tetelco 5843 0462' ,0,0,'L');
    $this->Cell(3);
    $this->SetFont('Arial','',7);
    $this->SetTextColor(120,0,0);
    $this->Cell(15,5,utf8_decode('y proporcionalidad previstos en la LFPDPPP y conforme al presente Aviso de Privacidad publicado en nuestra pagina WEB'),0,0,'L');
    $this->SetFont('Arial','',8);
    $this->SetTextColor(0,0,205);   
    // $this->Cell(194,7,'Tulyehualco 7095 7168 - San Gregorio 5843 6228 - Xochimilco 5603 2161 - Santiago 2586 0220 - San Pablo 5862 6736',0,0,'C');
   // $this->Ln(5);
   // $this->Cell(194,7,'San Pedro 5844 3374 - Tecomitl 5847 6013 -  Tetelco 5843 0462',0,0,'C');
   // $this->Ln(5);
   // $this->SetFont('Arial','',10);
   // $this->Cell(194,7,'www.laboratoriosarca.com.mx',0,0,'C'); 

  }
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,30);

$pdf->AliasNbPages();
$pdf->AddPage();

$total_ahorro=0;

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
    cantidad
    from so_detalle_factura_pre
    inner join km_estudios on km_estudios.id_estudio=so_detalle_factura_pre.fk_id_estudio
    INNER JOIN km_indicaciones ON km_indicaciones.id_indicaciones =  km_estudios.fk_id_indicaciones 
    INNER JOIN kg_descuentos d ON d.id_descuento = km_estudios.fk_id_descuento 
    WHERE id_factura=".$numero_factura;
  if ($result = mysqli_query($con, $sql)) {


    $pdf->Cell(7);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(13,5,"Cantidad",0,0,'R');
    $pdf->Cell(15);
    $pdf->Cell(13,5,"Descripcion",0,0,'R');
    $pdf->Cell(110);
    $pdf->Cell(13,5,"Costo unitario",0,0,'R');
    $pdf->Cell(7);
    $pdf->Cell(13,5,"Importe",0,0,'R');
    $pdf->ln(7);
    while($row = $result->fetch_assoc())
      {
             // $this->ln(5);
              $pdf->Cell(7);
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(13,5,$row['cantidad'],0,0,'R');
              $pdf->Cell(13,5,$row['fk_id_estudio'],0,0,'R');
              $pdf->Cell(1);
              $pdf->Cell(70,5,$row['desc_estudio'],0,0,'L');
              $pdf->Cell(40);
              $pdf->Cell(24,5,'$'.number_format($row['precio_venta'],2),0,0,'R');
              $pdf->Cell(24,5,'$'.number_format($row['precio_venta'],2),0,0,'R');
              if (strlen($row['desc_indicaciones'])>0){
                $pdf->ln(4);
                $pdf->SetFont('Arial','',9);
                $pdf->Cell(30);
                $pdf->Cell(190,5,'Indicaciones: '.utf8_decode($row['desc_indicaciones']),0,0,'L');
              }
              if (strlen($row['descuento'])>0){
                $pdf->ln(4);
                $pdf->SetFont('Arial','',9);
                $pdf->Cell(18);
                $pdf->Cell(190,5,$row['descuento'],0,0,'L');
              }

              if ($row['fk_id_promosion']<>7){
                //$fecha_system=date("Y-m-d");
                $fecha_system=$fecha_factura;
                $sql_p="SELECT id_promocion , CONCAT('Estudio en promocion (',porcentaje,'%) -',desc_promocion,'-') AS promocion ,   porcentaje ,   fecha_inicio ,
                        fecha_final , lunes , martes , miercoles , jueves , viernes , sabado , domingo , tuly , tuly2 , greg , xochi , sant , pablo , pedro , teco , tete , dino, estado ,DAYNAME('".$fecha_system."') as dia_semana, fecha_final
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
                                    $pdf->ln(5);
                                    $pdf->SetTextColor(120,0,0);
                                    $pdf->SetFont('Arial','B', 9);
                                    $pdf->Cell(18);
                                    $pdf->MultiCell(170,5,$rowp['promocion'].
                                        ', su precio real es de: '.
                                        '$'.number_format( ($row['precio_venta']*($rowp['porcentaje'])/100)+$row['precio_venta'] ,2).
                                        ' Ud esta ahorrando: '.'$'.number_format( ($row['precio_venta']*($rowp['porcentaje'])/100) ,2).
                                        ' Promocion valida hasta el dia: '.$rowp['fecha_final']
                                        ,0,'L');
                                    //$pdf->Cell(170,5,'ud ahorra:',0,0,'L');
                                    $pdf->SetTextColor(0,0,0);

                                    $total_ahorro = $total_ahorro+($row['precio_venta']*($rowp['porcentaje'])/100);

                                }
                            }
                        }
                }
            
              }

              $pdf->ln(6);
        }
    /*
    $pdf->SetY(180);

    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'"MI FAMILIA"',0,0,'C');

    $pdf->ln(6);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'PROMOCION!!!!',0,0,'C');

    $pdf->ln(6);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'10 % DE DESCUENTO',0,0,'C');

    $pdf->ln(6);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'SI PRESENTA ESTA NOTA  EN SUS',0,0,'C');

    $pdf->ln(6);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'PROXIMOS ESTUDIOS, ANALISIS, RX,',0,0,'C');

    $pdf->ln(6);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'ULTRASONIDO, ETC',0,0,'C');
*/
    if($total_ahorro > 0){
        $pdf->SetTextColor(47,30,199);
        $pdf->ln(6);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(10); 
        $pdf->Cell(70,5,'UD ESTA AHORRANDO EN SU ORDEN UN TOTAL DE: '.'$'.number_format($total_ahorro,2),0,0,'L');
        $pdf->SetTextColor(0,0,0);
    }
    $pdf->ln(10);
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(30); 
    $pdf->Cell(70,5,'- Un estudio confiable, garantiza un excelente diagnostico -',0,0,'C');
    $pdf->ln(-10);
  }  

$pdf->Output();
?>