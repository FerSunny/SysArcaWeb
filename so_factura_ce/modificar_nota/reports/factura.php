<?php
date_default_timezone_set('America/Mexico_City');
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];


//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
select so_factura.id_factura,so_factura.fk_id_sucursal,
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
        so_factura.fecha_entrega,
        so_factura.fecha_factura,
        imp_total,
        a_cuenta,
        resta,
        diagnostico,
        CONCAT(se_usuarios.nombre,' ',se_usuarios.a_paterno,' ',se_usuarios.a_materno) AS usuario 
    from so_factura
    inner join so_clientes on so_clientes.id_cliente=so_factura.fk_id_cliente
    inner join so_medicos on so_medicos.id_medico=so_factura.fk_id_medico
    inner join se_usuarios
    on se_usuarios.id_usuario=so_factura.fk_id_usuario 
    where id_factura=".$numero_factura;
 //echo $sql;

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $paciente=utf8_decode($row['paciente']);
            $medico=utf8_decode($row['nombre_medico']);
            $fecha=$row['fecha_factura'];
            $edad=utf8_decode($row['edad']);
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
            //$estudio1=$row['estudio1'];
        }
    }

// Obtenemos el metodo

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

      global  $paciente,
              $medico,
              $id_factura,
              $fecha,
              $direccion,
              $edad,
              $sexo,
              $telefono,
              $fecha_factura,
              $fecha_entrega,
              $diagnostico;

      //$this->Image('../imagenes/logo_arca.png',15,5,140,0);
      //$this->Image('../imagenes/pacal.jpg',160,5,40,0);
      //$this->Image('../imagenes/firma.gif',153,225,40,0);
      $this->Ln(0);
      $this->Cell(1);
      $this->SetFont('Arial','B',23);
      //$this->SetDrawColor(0,80,180);
      //$this->SetFillColor(230,230,0);
      $this->SetTextColor(0,0,255);
      $this->Cell(185,5,'ARCA',0,0,'C');

      $this->Ln(6);
      $this->SetTextColor(0,100,0);
      $this->SetFont('Arial','B',15);
      $this->Cell(185,5,'LABORATORIOS DE ANALISIS CLINICOS',0,0,'C');

      $this->Ln(5);
      $this->SetTextColor(95,158,160);
      $this->SetFont('Arial','',13);
      $this->Cell(185,5,'Matriz Tulyehualco',0,0,'C');

      $this->Ln(5);
      $this->Cell(185,5,'Josefa Ortiz de Dominguez No. 5 Col. San Isidro',0,0,'C');

      $this->Ln(5);
      $this->Cell(185,5,'Tulyehualco, Xochimilco, CDMX',0,0,'C');

      $this->Image('../imagenes/codigo1.jpg',170,10,30,30);
      $this->Image('../imagenes/logo_arca.png',10,12,33,15);
      $this->Image('../imagenes/whatsapp.jpg',12,40,7,0);
      $this->Image('../imagenes/telefono.jpg',47,40,7,0);

      $this->Ln(6);

      $this->SetFont('Arial','B',17);
      $this->SetTextColor(0,0,255);
      $this->Cell(185,5,'ORDEN DE ESTUDIO',0,0,'C');

      $this->Ln(5);
      $this->Cell(10);
      $this->SetFont('Arial','',10);
      $this->Cell(23,6,'55 3121 0700',0,0,'L');
      $this->Cell(12);
      $this->Cell(23,6,'ARCATEL: 216 141 44',0,0,'L');

      $this->Cell(65);
      $this->SetFont('Arial','B',14);
      $this->SetTextColor(0,0,0);
      $this->Cell(43,6,'Numero de orden:',0,0,'L');
      $this->Cell(15,6,$id_factura,0,0,'L');

      $this->Ln(8);
      $this->Cell(3);
      $this->SetFillColor(230,230,250);
      $this->SetDrawColor(0,0,255);
      $this->rect(12, 49.7,95,35);
      $this->rect(111, 49.7,95,35);

      $this->SetFont('Arial','B',10);
      $this->Cell(94,5,'Paciente',0,0,'L',true);
      $this->Cell(4);
      $this->Cell(94,5,'Solicito',0,1,'L',true);

      $this->Ln(1);
      $this->SetFont('Arial','',9);
      $this->Cell(3);
      $this->Cell(94,4,$paciente,0,0,'L');
      $this->Cell(4);
      $this->Cell(94,4,$medico,0,0,'L');

      $this->Ln(5);
      $this->SetFont('Arial','B',10);
      $this->Cell(3);
      $this->Cell(94,5,utf8_decode('Dirección'),0,0,'L',true);
      $this->Cell(4);
      $this->Cell(94,5,'Fecha',0,1,'L',true);

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
      $this->Cell(21,4,$edad,0,0,'L');
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
            $usuario;

    $this->SetY(-40);

    //$this->Ln(5);
    $this->SetFont('Arial','B',11);
    $this->Cell(3);
    $this->Cell(27,5,'Atendido por:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(50,5,$usuario,0,0,'L');

    $this->SetFont('Arial','B',12);
    $this->SetFillColor(230,230,250);
    $this->Cell(75);
    $this->Cell(20,5,'Total',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,5,'$'.number_format($imp_total,2),0,0,'R');

    $this->SetTextColor(120,0,0);
    $this->SetFont('Arial','B',10);
    $this->Ln(5);
    $this->Cell(3);
    $this->Cell(125,7,'Es indispensable traer este comprobante para la entrega de sus estudios',0,0,'L');

    $this->Cell(27);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','B',12);
    $this->Cell(20,7,'A cuenta',0,0,'L',true);
    $this->Cell(1);
    $this->Cell(24,7,'$'.number_format($a_cuenta,2),0,0,'R');

    $this->SetTextColor(120,0,0);
    $this->SetFont('Arial','B',10);
    $this->Ln(5);
    $this->Cell(3);
    $this->Cell(148,7,'Despues de 30 dias el laboratorio no se hace responsable de los estudios no recogidos',0,0,'L');

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
    $this->Cell(70,7,'Pago en una solo exhibicion',0,0,'L');
    $this->Cell(70,7,'Efectos fiscales al pago',0,0,'L');
    $this->Cell(70,7,'Regimen de incorporacion fiscal',0,0,'L');
    $this->Ln(1);
    $this->Cell(3);
    $this->SetTextColor(0,0,0);
    $this->Cell(70,7,'____________________________________________________________________________________________________',0,0,'L');

    $this->Ln(5);
    $this->SetTextColor(0,0,205);
    $this->SetFont('Arial','',8);
    $this->Cell(194,7,'Tulyehualco 7095 7168 - San Gregorio 5843 6228 - Xochimilco 5603 2161 - Santiago 2586 0220 - San Pablo 5862 6736',0,0,'C');
    $this->Ln(5);
    $this->Cell(194,7,'San Pedro 5844 3374 - Tecomitl 5847 6013 -  Tetelco 5843 0462',0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','',10);
    $this->Cell(194,7,'www.laboratoriosarca.com.mx',0,0,'C'); 
    //$this->Cell(55); 
    //$this->Cell(50,7,'Q.F.B Javier Carapia Avila CED. PROF. 3363477 U.A.M',0,0,'L');
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
    km_estudios.fk_id_promosion
    from so_detalle_factura
    inner join km_estudios on km_estudios.id_estudio=so_detalle_factura.fk_id_estudio
    INNER JOIN km_indicaciones ON km_indicaciones.id_indicaciones =  km_estudios.fk_id_indicaciones 
    INNER JOIN kg_descuentos d ON d.id_descuento = km_estudios.fk_id_descuento 
    WHERE id_factura=".$numero_factura;
  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {
             // $this->ln(5);
              $pdf->Cell(3);
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(13,5,$row['fk_id_estudio'],0,0,'R');
              $pdf->Cell(1);
              $pdf->Cell(70,5,$row['desc_estudio'],0,0,'L');
              $pdf->Cell(86);
              $pdf->Cell(24,5,'$'.number_format($row['precio_venta'],2),0,0,'R');
              if (strlen($row['desc_indicaciones'])>0){
                $pdf->ln(4);
                $pdf->SetFont('Arial','',9);
                $pdf->Cell(18);
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
                                    $pdf->ln(5);
                                    $pdf->SetTextColor(120,0,0);
                                    $pdf->SetFont('Arial','B', 9);
                                    $pdf->Cell(18);
                                    $pdf->Cell(170,5,$rowp['promocion'],0,0,'L');
                                    $pdf->SetTextColor(0,0,0);
                                }
                            }
                        }
                }
            
              }

              $pdf->ln(6);
        }
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

    $pdf->ln(6);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10); 
    $pdf->Cell(70,5,'(EXCEPTO PROMOCIONES)',0,0,'C');

    $pdf->ln(12);
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(50); 
    $pdf->Cell(70,5,'- Un estudio confiable, garantiza un excelente diagnostico -',0,0,'C');
  }  

$pdf->Output();
?>