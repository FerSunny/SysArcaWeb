<?php
session_start();
date_default_timezone_set('America/Mexico_City');

//header('Content-Type: text/html; charset=ISO-8859-1');

header("Content-Type: text/html;charset=utf-8");

require('../../fpdf/fpdf.php');

 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos



//se recibe los paramteros para la generación del reporte

$id_plantilla=1;

$studio=1;
$id_usuario=$_SESSION['nombre'];
$lote=$_GET['lote'];


$query = "SELECT
  id_usuario,
  id_usr,
  fk_id_sucursal,
  nombre,
  a_paterno,
  a_materno,
  telefono_fijo,
  telefono_movil,
   us.mail,
  su.desc_sucursal
FROM se_usuarios us 
LEFT OUTER JOIN `kg_sucursales` su ON (su.id_sucursal = us.fk_id_sucursal)
WHERE us.activo = 'A' 
AND id_usr= '" . $id_usuario . "' ";

//echo $query;

$resultado = mysqli_query($con, $query);

if($row = mysqli_fetch_array($resultado))
{
  $sucursal=$row['desc_sucursal'];
  $fk_id_sucursal=$row['fk_id_sucursal'];
}



class PDF extends FPDF

{

// Cabecera de página

function Header()

{


    global $sucursal;
      // Logo
      //$this->Image('logo_pb.png',10,8,33);
      // Arial bold 15

      setlocale(LC_ALL,"es_ES");
      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
    
      $this->SetTextColor(0,0,0);
      $this->SetFont('Arial','B',14);
      // Movernos a la derecha
      $this->Cell(3);
      // Título
      $this->Cell(180,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(170,10,utf8_decode('Bitácora de traslado de muestras'),0,0,'C');
      $this->Cell(100,10,'(FOR-PRE-03)',0,0,'L');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(53,10,'GENERADO POR LA UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,$sucursal,0,0,'L');
      $this->Cell(57);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(100,10,'___________________________________________________________________________________________________________________',0,0,'L');

      $this->Ln(5);
}


// Pie de página

  function Footer()

  {



    global $id_plantilla,$studio,$con,$verificado,$tamfuev,$tipfuev,$posiniv;



    $this->SetY(-40); //

    //$this->ln(10);

    $this->Cell($posiniv);



    $this->SetFont('Arial','',10);

    $this->Cell(30,5,$verificado,0,0,'L'); 

    $this->ln(10); // aqui

    //$this->Cell(5);



    $this->ln(-2);

    $this->Cell(1);

    $this->SetTextColor(0,0,255);

    $this->Cell(185,5,'_____________________________________________________________________________________________',0,0,'L');



    $this->SetTextColor(26,35,126); 

    $this->SetFont('Arial','B',16);

    $this->SetXY(65,257); 

    $this->Write(0,'www.laboratoriosarca.com.mx');



    $this->Image('../../imagenes/whatsapp.jpg',10,262,7,0);

    $this->SetTextColor(27,94,32); 

    $this->SetFont('Arial','B',12);

    $this->SetXY(16,266); 

    $this->Write(0,'55 3121 0700');

    $this->SetTextColor(0,0,0);



    $this->Image('../../imagenes/telefono.jpg',50,262,7,0);

    $this->SetTextColor(230,81,0); 

    $this->SetFont('Arial','B',12);

    $this->SetXY(56,266); 

    $this->Write(0,'ARCATEL: 216 141 44');

    $this->SetTextColor(0,0,0);



    $this->Image('../../imagenes/email.jpg',105,262,7,0);

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



$hay_obs='';

$observaciones='';

$nle='0';



$sql="select * FROM tm_lote_detalle
  where lote= '$lote'";
//echo $sql;


  if ($result = mysqli_query($con, $sql)) {

    while($row = $result->fetch_assoc())

      {


        $pdf->ln(5);
        $pdf->Cell(3);

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(50,5,'Lote: '.$row['lote'],0,0,'L');
        $pdf->ln(10);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Hora LLegada Mensajero: '.$row['hora_llegada'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Hora Salida Mensajero: '.$row['hora_salida'],0,0,'L');
        $pdf->ln(10);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Temperatura Referencia: '.$row['tem_ref'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Temperatura Ambiente: '.$row['tem_amb'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Temperatura Refrigeracion: '.$row['tem_ref'],0,0,'L');
        $pdf->ln(10);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Tubos Dorados: '.$row['t_d'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Tubos Rojo: '.$row['t_r'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Tubos Morado: '.$row['t_m'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Tubos Azul: '.$row['t_a'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Tubos secundario con suero: '.$row['t_sec_sue'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Tubos secundario con plasma: '.$row['t_sec_pla'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Frotis Sanguineo: '.$row['fro_san'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Frotis para eosinofilos: '.$row['fro_eod'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Frotis para cultivos: '.$row['fro_cul'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Frasco con muestra de orina u otro liquido: '.$row['ego_uro'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Heces: '.$row['heces'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Biopsia: '.$row['bx_o_fco_esteril'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Trazo de electrocardiograma: '.$row['ecg_traz'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Papanicolao: '.$row['pap'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Medio de transporte stuart: '.$row['med_stu'],0,0,'L');
        $pdf->ln(6);
        $pdf->Cell(3);
        $pdf->Cell(50,5,'Medio de transporte liquido (vidrio): '.$row['med_liq'],0,0,'L');
/*

        $pdf->Cell(1);

        $pdf->SetFont('Arial','B',13);

        $pdf->Cell(160,5,utf8_decode(($row['titulo_desc'])),0,0,'L');

*/





       }

      }



$pdf->Output();

?>