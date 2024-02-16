<?php
include '../../controladores/conex.php';
include '../../fpdf/fpdf.php';
session_start();
$id_usuario = $_SESSION['id_usuario'];

$stmt = $conexion->prepare("SELECT * FROM se_usuarios WHERE id_usuario = ?");
$stmt->bind_param("i",$id_usuario);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc())
{
    $nombre = utf8_decode($row['nombre'].' '.$row['a_paterno'].' '.$row['a_materno']);
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

    $this->Ln(15);

}

// Pie de página
  function Footer()
  {

    global $studio,$con,$verificado,$tamfuev,$tipfuev,$posiniv;

    $this->SetY(-50); //
    //$this->ln(10);

    $this->ln(22); // aqui

    $this->ln(-2);
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

    }


    function Tabla()
    {
    	date_default_timezone_set('America/Mexico_City');
    	global $conexion,$nombre;

        $tp = $_GET['tp'];
    	$f_inicio = $_GET['fi'];
        $i_dia = date("d", strtotime($f_inicio));
        $i_mes = date("n", strtotime($f_inicio));
        $i_mes-=1;
        $i_año = date("Y", strtotime($f_inicio));
    	$f_final = $_GET['ff'];
        $f_dia = date("d", strtotime($f_final));
        $f_mes = date("n", strtotime($f_final));
        $f_mes-=1;
        $f_año = date("Y", strtotime($f_final));
    	$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre' ,'Noviembre' ,'Diciembre' );
    	$dia = date("d");
    	$mes = date("n");
    	$mes-=1;
    	$año = date("Y");
    	$hora = date("H:i:s");

    	$this->SetX(140);
    	$this->Cell(50,5,'Ciudad de Mexico, a '.$dia.' de '.$meses[$mes].' de '.$año);
    	$this->ln(5);
    	$this->SetX(162);
    	$this->Cell(50,5,'Hora del reporte: '.$hora);
    	$this->ln(20);

    	$this->SetFont('Arial','B',16);
    	$this->Cell(190,0,'Reporte de egresos',0,0,'C');
    	$this->ln(10);
        $this->SetFont('Arial','',10);
        $this->Cell(190,0,'Reporto: '.$nombre,0,0,'L');
        $this->ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,0,'Fecha de reporte del: '.$i_dia.' de '.$meses[$i_mes].' de '.$i_año.' al '.$f_dia.' de '.$meses[$f_mes].' de '.$f_año,0,0,'L');
        $this->ln(5);
        $stmt = $conexion->prepare("SELECT * FROM kg_tipo_pago WHERE id_tipo_pago = ?");
        $stmt->bind_param("i",$tp);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc())
        {
            //Titulo
            $this->SetFont('Arial','',10);
            $this->Cell(190,0,'Tipo de pago: '.$row['desc_tipo_pago'],0,0,'L');
            $this->ln(10);
        }

    	//Titulos tabla
    	$this->SetFont('Arial','B',10);
    	$this->Cell(20,5,"ID",1,0,'C');
        $this->Cell(40,5,"Sucursal",1,0,'C');
        $this->Cell(40,5,"Fecha movimiento",1,0,'C');
        $this->Cell(40,5,utf8_decode("Fecha Autorización"),1,0,'C');
        $this->Cell(40,5,"Beneficiario",1,0,'C');
        $this->Cell(20,5,"Importe",1,0,'C');
        $this->ln();
        $query = "SELECT re.id_registro,suc.desc_sucursal,DATE_FORMAT(re.fecha_mov, '%d de %M de %Y') f_mov,DATE_FORMAT(re.fecha_aut, '%d de %M de %Y') f_aut,re.nota,ben.nombre,re.importe FROM ga_registro re
            LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = re.fk_id_sucursal)
            LEFT OUTER JOIN ga_beneficiarios ben ON (ben.id_beneficiario = re.fk_id_beneficiario)
            WHERE DATE(re.fecha_mov) >= ? AND DATE(re.fecha_mov) <= ?";

        $stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
		$stmt->execute();
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("ss",$f_inicio,$f_final);
		$stmt->execute();
		$result = $stmt->get_result();
		//if($result->num_rows === 0) exit('No inormacion que mostrar');
        $this->SetFont('Arial','B',8);
        while($row = $result->fetch_assoc())
	    {

		    //DAtos de la tabla
	       $this->Cell(20,5,$row['id_registro'],1,0,'C');
	       $this->Cell(40,5,$row['desc_sucursal'],1,0,'C');
	       $this->Cell(40,5,$row['f_mov'],1,0,'C');
           $this->Cell(40,5,$row['f_aut'],1,0,'C');
           $this->Cell(40,5,$row['nombre'],1,0,'C');
           $this->Cell(20,5,'$ '.$row['importe'],1,0,'R');
	       $this->ln();
	    }
        $query = "SELECT SUM(re.importe) total FROM ga_registro re
                WHERE DATE(re.fecha_mov) >= ? AND DATE(re.fecha_mov) <= ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ss",$f_inicio,$f_final);
        $stmt->execute();
        $result = $stmt->get_result();
        //if($result->num_rows === 0) exit('No inormacion que mostrar');

        while($row = $result->fetch_assoc())
        {

            //DAtos de la tabla
           $this->Cell(20,0,'',1,0,'C');
           $this->Cell(40,0,'',1,0,'C');
           $this->Cell(40,0,'',1,0,'C');
           $this->Cell(40,0,'',1,0,'C');
           $this->Cell(40,0,'',1,0,'C');
           $this->Cell(20,5,'$ '.$row['total'],1,0,'R');
           $this->ln();
        }


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
$pdf->Tabla();
$pdf->Output();

?>