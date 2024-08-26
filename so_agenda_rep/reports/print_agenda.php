<?php
date_default_timezone_set('America/Mexico_City');
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$fk_id_sucursal=$_GET['fk_id_sucursal'];
$fk_id_area=$_GET['fk_id_area'];
$fecha=$_GET['fecha'];

// actualiza las veces que se ha impreso el resultado

$sql_max="
select * from km_areas a
where a.`estado` = 'A'
and a.`id_area` = $fk_id_area
";
// echo $sql_max;

if ($result = mysqli_query($con, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $desc_area=$row['desc_area'];
  }
}

$stm_sucursal="
select * from kg_sucursales su
where su.`estado` = 'A'
AND su.`id_sucursal` = $fk_id_sucursal
";
// echo $sql_max;

if ($result_suc = mysqli_query($con, $stm_sucursal)) {
  while($row_suc = $result_suc->fetch_assoc())
  {
      $desc_sucursal=$row_suc['desc_sucursal'];
  }
}
//Obtener los datos, de la cabecera, (datos del estudio)




class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    global  $desc_area,
            $desc_sucursal,
            $fecha;

    $this->Image('../imagenes/logo_arca.png',15,5,50,0);
    $this->Image('../imagenes/pacal.jpg',160,5,40,0);
    //$this->Image('../imagenes/codigo1.jpg',170,50,30,30);
    $this->Ln(18);
    $this->Cell(5);
    $this->SetFont('Arial','B',15);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,0,255);
    //$this->Cell(185,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'C');
    //$this->Ln(5);
    $this->SetFont('Arial','',10);
    $this->Cell(185,5,'Josefa Ortiz de Dominguez No. 5 San Isidro Tulyehualco, Xochimilco, CDMX',0,0,'C');
    $this->Ln(3);
    $this->Cell(185,5,'________________________________________________________________________________________________',0,0,'C');
    $this->SetTextColor(0,0,0);

// Primer columna de titulos
    $this->Ln(5);
    $this->Cell(2);
    $this->SetFont('Arial','',11);
    $this->Cell(60,5,'Agenda: '.utf8_decode($desc_area),0,0,'L');
    $this->Cell(60,5,'Sucursal: '.utf8_decode($desc_sucursal),0,0,'L');
    $this->Cell(22,5,'Fecha: '.utf8_decode($fecha),0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Ln(3);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'________________________________________________________________________________________________',0,0,'C');
    $this->SetTextColor(0,0,0);

  

    $this->Cell(5);
    //$this->SetFont('Arial','',14);


   
    $this->ln(5);  
    $this->Cell(4);
    $this->SetFont('Arial','',9);
    $this->Cell(30,5,'Horario',0,0,'L');
    $this->Cell(30,5,'Paciente',0,0,'C');
    $this->Cell(20);
    $this->Cell(40,5,'Tel. Fijo    Tel. Movil',0,0,'C');
    $this->Cell(40,5,'Estudio',0,0,'C');
    $this->Cell(40,5,'Reservo',0,0,'C');
    $this->Ln(5);

}

// Pie de página
  function Footer()
  {

    //global $studio,$con,$verificado,$tamfuev,$tipfuev,$numero_factura,$posiniv;

    $this->SetY(-50); //
    //$this->ln(10);
    //$this->Cell($posiniv);

    $this->SetFont('Arial','',12);
    //$this->Cell(30,5,$verificado,0,0,'L'); 
    $this->ln(10); // aqui

    $this->ln(-2);
    $this->Cell(5);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'_______________________________________________________________________________________________________',0,0,'L');

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',16);
    $this->SetXY(65,257); 
    $this->Write(0,'www.laboratoriosarca.com.mx');

    $this->Image('../imagenes/whatsapp.jpg',10,258,7,0);
    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(16,262); 
    $this->Write(0,'55 3121 0700');
    $this->SetTextColor(0,0,0);

    $this->Image('../imagenes/telefono.jpg',50,258,7,0);
    $this->SetTextColor(230,81,0); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(56,262); 
    $this->Write(0,'ARCATEL: 216 141 44');
    $this->SetTextColor(0,0,0);

    $this->Image('../imagenes/email.jpg',105,259,7,0);
    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',11);
    $this->SetXY(110,262); 
    $this->Write(0,'atencion.cliente@laboratoriosarca.com.mx');
    $this->SetTextColor(0,0,0);

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(20,267); 
    $this->Write(0,'Tulyehualco - San Gregorio - Xochimilco - Santiago - San Pablo - San Pedro - Tecomitl - Tetelco');
    $this->SetTextColor(0,0,0);
    $this->ln(-10);//subir codigo de seguridad


    }
  }
//}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,50);

$pdf->AliasNbPages();
$pdf->AddPage();

$hay_obs='';
$observaciones='';
$nle='0';
$blanco=' ';

$sql="
SELECT 
a.*,
b.`desc_corta`,
CONCAT(c.`nombre`,' ',c.`a_paterno`,' ',c.`a_materno`) AS paciente,
d.`desc_area`,
e.`iniciales`,
c.telefono_fijo,
c.telefono_movil,
concat(us.`nombre`,' ',us.`a_paterno`) reservo
FROM so_agenda a
LEFT OUTER JOIN kg_sucursales b ON (b.`id_sucursal` = a.`fk_id_sucursal`)
LEFT OUTER JOIN so_clientes c ON (c.`id_cliente` = a.`fk_id_paciente`)
LEFT OUTER JOIN km_areas d ON (d.`id_area` = a.`fk_id_area`)
LEFT OUTER JOIN km_estudios e ON (e.`id_estudio` = a.`fk_id_estudio`)
left outer join se_usuarios us on (us.`id_usuario` = a.`fk_id_usuario`)
WHERE a.estado = 'A'
AND a.`fecha` = '$fecha'
AND a.`fk_id_sucursal` = $fk_id_sucursal
AND a.`fk_id_area` = $fk_id_area
order by 5
  ";
  $pdf->SetFont('Arial', '', 7);
  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {

             // $pdf->SetFont('Arial', 'B', 14);
              $pdf->Cell(30,5,utf8_decode($row['hora'].' - '.$row['hora_termino']),0,0,'L');
             // echo 'tamano:'.strlen(trim($row['paciente']));
              if (strlen(trim($row['paciente'])) == 0){
                $pdf->Cell(60,5,utf8_decode($row['observaciones']),0,0,'L'); 
              }else{
                $pdf->Cell(60,5,utf8_decode($row['paciente']),0,0,'L'); 
              }
                 
              $pdf->Cell(23,5,utf8_decode($row['telefono_fijo']),0,0,'L');  
              $pdf->Cell(23,5,utf8_decode($row['telefono_movil']),0,0,'L');  
              $pdf->Cell(40,5,utf8_decode($row['iniciales']),0,0,'L');  
              $pdf->Cell(40,5,utf8_decode($row['reservo']),0,0,'L'); 
              $pdf->ln(5);


      }

  }

//for($i=1;$i<=20;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);

$pdf->Output();
?>