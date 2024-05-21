<?php
date_default_timezone_set('America/Mexico_City');
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
//include("../../controladores/conex.php");
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

global $firma_med;

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];

// actualiza las veces que se ha impreso el resultado
$sql_max="select max(num_imp) as num_imp FROM cr_plantilla_tomo_rad_re
where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
// echo $sql_max;
$veces='0';
if ($result = mysqli_query($con, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $veces=$row['num_imp']+1;
      //echo $veces;
      $sql_update="UPDATE cr_plantilla_tomo_rad_re SET num_imp = '".$veces."'
      where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
      //echo $sql_update;
      $execute_query_update = mysqli_query($con,$sql_update);
  }
}

// OBTENEMOS LOS DATOS DE LA ESTUDIO REGISTRADO
$sql_usg="SELECT us.nombre_plantilla, us.titulo_desc, us.descripcion,  
  us.t_otros_allazgos,
  us.d_otros_allazgos,
  us.t_diagnostico,
  us.d_diagnostico,
  us.t_comentarios,
  us.d_comentarios,
  us.firma_med,
  us.ced_medico,
  us.firma_rl,
  us.ced_rl
FROM cr_plantilla_tomo_rad_re us 
WHERE us.estado = 'A'
AND fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;

//echo $sql_usg;

if ($result = mysqli_query($con, $sql_usg)) {
  while($row = $result->fetch_assoc())
  {
      $titulo_desc=$row['titulo_desc'];
      $descripcion=utf8_decode($row['descripcion']);

      $t_otros_allazgos=utf8_decode($row['t_otros_allazgos']);
      $d_otros_allazgos=utf8_decode($row['d_otros_allazgos']);

      $t_diagnostico=utf8_decode($row['t_diagnostico']);
      $d_diagnostico=utf8_decode($row['d_diagnostico']);
     //$firma=$row['firma'];
      $t_comentarios=utf8_decode($row['t_comentarios']);
      $d_comentarios=utf8_decode($row['d_comentarios']);

      $firma_med=utf8_decode($row['firma_med']);
      $ced_medico=utf8_decode($row['ced_medico']);
      $firma_rl=utf8_decode($row['firma_rl']);
      $ced_rl=utf8_decode($row['ced_rl']);

  }
}


//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
SELECT fa.id_factura,
  SUBSTR(es.desc_estudio,1,32) AS estudio,
  SUBSTR(es.desc_estudio,33,100) AS estudio1,
  es.desc_estudio AS estudio2,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
  CASE
    WHEN LENGTH(fa.vmedico) > 0 THEN
      trim(fa.vmedico)
    ELSE
      CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) 
  END AS medico,
  DATE(fa.`fecha_factura`) AS fecha,
  CASE WHEN cl.anios > 0 THEN 
    CONCAT(cl.anios,' Años') 
        WHEN cl.meses > 0 THEN 
    CONCAT(cl.meses,' Meses') 
        WHEN cl.dias > 0 THEN 
    CONCAT(cl.dias,' Dias') 
  END AS edad
FROM so_factura fa
     LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
     LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico),
     so_detalle_factura df, 
     km_perfil_detalle dp,
     km_estudios es
WHERE fa.`id_factura` = ".$numero_factura."
  AND fa.`id_factura` = df.`id_factura`
  AND df.`fk_id_estudio`= dp.`fk_id_perfil`
  AND dp.`fk_id_estudio` = es.`id_estudio`
  AND dp.fk_id_estudio = ".$studio."
UNION

    SELECT df.id_factura,
       SUBSTR(es.desc_estudio,1,32) AS estudio,
       SUBSTR(es.desc_estudio,33,100) AS estudio1, 
       es.desc_estudio AS estudio2,
       CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
      CASE
        WHEN LENGTH(fa.vmedico) > 0 THEN
          trim(fa.vmedico)
        ELSE
          CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) 
      END AS medico,
    date(fa.`fecha_factura`) AS fecha,
    CASE WHEN cl.anios > 0 THEN 
        CONCAT(cl.anios,' Años') 
         WHEN cl.meses > 0 THEN 
        CONCAT(cl.meses,' Meses') 
         WHEN cl.dias > 0 THEN 
        CONCAT(cl.dias,' Dias') 
    END AS edad 
FROM km_paquetes pq
     LEFT OUTER JOIN km_estudios es ON (es.id_estudio = pq.fk_id_estudio),
     so_detalle_factura df,
     so_factura fa
     LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente) 
     LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico) 
WHERE  pq.id_paquete = df.fk_id_estudio
   AND df.id_factura = fa.id_factura
   AND df.id_factura = ".$numero_factura." AND pq.fk_id_estudio = ".$studio."
    UNION
    SELECT  df.id_factura,
    substr(es.desc_estudio,1,32) AS estudio,
    substr(es.desc_estudio,33,100) AS estudio1,
    es.desc_estudio AS estudio2,
    CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
      CASE
        WHEN LENGTH(fa.vmedico) > 0 THEN
          trim(fa.vmedico)
        ELSE
          CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) 
      END AS medico,
    date(fa.fecha_factura) AS fecha,
    CASE
        WHEN cl.anios > 0 THEN 
            CONCAT(cl.anios,' Años')
        WHEN cl.meses > 0 THEN 
            CONCAT(cl.meses,' Meses')
        WHEN cl.dias > 0 THEN 
            CONCAT(cl.dias,' Dias') 
    END AS edad
  FROM so_detalle_factura df
  LEFT OUTER JOIN so_factura fa ON (fa.id_factura=df.id_factura)
  LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
  LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
  LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
  WHERE df.id_factura = ".$numero_factura." AND df.fk_id_estudio=".$studio;
 //echo $sql;

  $paciente='0';

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $paciente=$row['paciente'];
            $medico=$row['medico'];
            $fecha=$row['fecha'];
            //$estudio=$row['estudio'];
            $edad=utf8_decode($row['edad']);
            $estudio2=$row['estudio2'];
            //$estudio1=$row['estudio1'];
        }
    }




class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    global $paciente,
            $medico,
            $numero_factura,
            $fecha,
            $estudio2,
            $studio,
            $edad,
            $metodo,
            $posinim,
            $tipfuem,
            $tamfuem,
            $titulo_desc;

    $this->Image('../imagenes/logo_arca.png',15,5,140,0);
    $this->Image('../imagenes/pacal.jpg',160,5,40,0);
    $this->Image('../imagenes/codigo1.jpg',170,50,30,30);
    $this->Ln(18);
    $this->Cell(5);
    $this->SetFont('Arial','B',15);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,0,255);
    //$this->Cell(185,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'C');
    //$this->Ln(5);
    $this->SetFont('Arial','I',10);
    $this->Cell(185,5,'Josefa Ortiz de Dominguez No. 5 San Isidro Tulyehualco, Xochimilco, CDMX',0,0,'C');
    $this->Ln(3);
    $this->Cell(185,5,'________________________________________________________________________________________________',0,0,'C');
    $this->SetTextColor(0,0,0);

// Primer columna de titulos
    $this->Ln(15);
    $this->Cell(2);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'PACIENTE:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(88,5,utf8_decode($paciente),0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'DR(A):',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(70,5,utf8_decode($medico),0,0,'L');
// Segunda linea
    $this->ln(5);
    $this->Cell(2);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'FOLIO:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(88,5,$numero_factura,0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'FECHA:',0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(81,5,$fecha,0,0,'L');

// Tercer linea
    $this->ln(5);
    $this->Cell(2);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'ESTUDIO:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->MultiCell(88,5,utf8_decode($estudio2),0,'L');
 
    $this->SetFont('Arial','B',11);
    $this->SetXY(122, 59); 
    $this->Write(0,'EDAD:'); 
    $this->SetFont('Arial','',11);
    $this->SetXY(137,59); 
    $this->Write(0,$edad);

// Cuarta linea (nombre del estudio - plantilla -)
    $this->ln(15);
    $this->Cell(5);
    $this->SetFont('Arial','B',14);
    $this->Cell(170,5,utf8_decode($titulo_desc),0,0,'C'); 
   

    $this->Ln(15);

}

// Pie de página
  function Footer()
  {

    global $firma_med,$ced_medico,$firma_rl,$ced_rl,$numero_factura,$studio,$con;

// OBTENEMOS LOS DATOS DE LA ESTUDIO REGISTRADO
$sql_usg="SELECT us.nombre_plantilla, us.titulo_desc, us.descripcion,  
  us.t_otros_allazgos,
  us.d_otros_allazgos,
  us.t_diagnostico,
  us.d_diagnostico,
  us.t_comentarios,
  us.d_comentarios,
  us.firma_med,
  us.ced_medico,
  us.firma_rl,
  us.ced_rl
FROM cr_plantilla_tomo_rad_re us 
WHERE us.estado = 'A'
AND fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;

//echo $sql_usg;
$this->SetY(-40);

if ($result = mysqli_query($con, $sql_usg)) {
  while($row = $result->fetch_assoc())
  {

      $firma_med=utf8_decode($row['firma_med']);
      $ced_medico=utf8_decode($row['ced_medico']);
      $firma_rl=utf8_decode($row['firma_rl']);
      $ced_rl=utf8_decode($row['ced_rl']);


          $this->Cell(10);
          $this->SetFont('Arial','B',8);
          $this->Cell(90,5,$firma_med,0,0,'L');
          $this->Cell(50,5,$firma_rl,0,0,'L');
          $this->ln(5);
          $this->Cell(10);
          $this->Cell(90,5,$ced_medico,0,0,'L');
          $this->Cell(50,5,$ced_rl,0,0,'L');
          $this->ln(5);

  }
}
  $this->SetFont('Arial','B',9);
    //$this->SetY(-30); //
    //$this->ln(10);
 
   // $this->Cell($posiniv);

    //$this->SetFont('Arial','B','9');
    //$this->Cell(30,5$firma_med,0,0,'L'); 
    //$this->ln(10); // aqui
    //$this->Cell(5);

/*
    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F' order by orden";
    if ($result = mysqli_query($con, $sql)) {
      while($row = $result->fetch_assoc())
        {
          $this->Cell(($row['posini']-=6));
          $firma=$row['concepto'];
          $this->Image('../imagenes/firma.gif',153,225,40,0);
          $this->SetFont('Arial','',$row['tamfue']);
          $this->Cell(170,5,$firma,0,0,'L');
          $this->ln(4);
        }
*/
    //$this->ln(-1);
    $this->Cell(5);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'_______________________________________________________________________________________________________',0,0,'L');

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',16);
    $this->SetXY(65,257); 
    $this->Write(0,'www.laboratoriosarca.com.mx');

    $this->Image('../imagenes/whatsapp.jpg',10,262,7,0);
    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(16,266); 
    $this->Write(0,'55 3121 0700');
    $this->SetTextColor(0,0,0);

    $this->Image('../imagenes/telefono.jpg',50,262,7,0);
    $this->SetTextColor(230,81,0); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(56,266); 
    $this->Write(0,'ARCATEL: 216 141 44');
    $this->SetTextColor(0,0,0);

    $this->Image('../imagenes/email.jpg',105,262,7,0);
    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',11);
    $this->SetXY(110,266); 
    $this->Write(0,'atencion.cliente@laboratoriosarca.com.mx');
    $this->SetTextColor(0,0,0);

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(20,274); 
    $this->Write(0,'Tulyehualco - San Gregorio - Xochimilco - Santiago - San Pablo - San Pedro - Tecomitl - Tetelco');
    $this->SetTextColor(0,0,0);


    //}
  }
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,50);

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(2);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode($descripcion),0,'J');


$pdf->ln(6);
$pdf->Cell(2);
$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(185,5,trim(utf8_decode($t_otros_allazgos)),0,'L');

$pdf->ln(2);
$pdf->Cell(2);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode($d_otros_allazgos),0,'J');

$pdf->ln(6);
$pdf->Cell(2);
$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(185,5,trim(utf8_decode($t_diagnostico)),0,'L');

$pdf->ln(2);
$pdf->Cell(2);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode($d_diagnostico),0,'J');

$pdf->ln(6);
$pdf->Cell(2);
$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(185,5,trim(utf8_decode($t_comentarios)),0,'L');

$pdf->ln(2);
$pdf->Cell(2);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode($d_comentarios),0,'J');

$pdf->Output();
?>