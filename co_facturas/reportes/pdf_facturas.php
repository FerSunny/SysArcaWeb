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
    	$tipo = $_GET['tipo'];
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
    	$grupo = $_GET['grupo'];
    	$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre' ,'Noviembre' ,'Diciembre' );
    	$dia = date("d");
    	$mes = date("n");
    	$mes-=1;
    	$año = date("Y");
    	$hora = date("H:i:s");

    	$this->SetX(140);
    	$this->Cell(50,5,utf8_decode('Ciudad de México, a '.$dia.' de '.$meses[$mes].' de '.$año));
    	$this->ln(5);
    	$this->SetX(162);
    	$this->Cell(50,5,'Hora del reporte: '.$hora);
    	$this->ln(20);
    	$stmt = $conexion->prepare("SELECT * FROM kg_grupos WHERE clave_grupo = ?");
    	$stmt->bind_param("s",$grupo);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) exit('No hay documentos proximos');
			while($row = $result->fetch_assoc())
	    {
	    	//Titulo
	    	$this->SetFont('Arial','B',16);
	    	$this->Cell(190,0,'Facturas por razon social: '.$row['desc_grupo'],0,0,'C');
	    	$this->ln(10);
	    }

        $this->SetFont('Arial','',10);
        $this->Cell(190,0,'Reporto: '.$nombre,0,0,'L');
        $this->ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,0,'Fecha de reporte del: '.$i_dia.' de '.$meses[$i_mes].' de '.$i_año.' al '.$f_dia.' de '.$meses[$f_mes].' de '.$f_año,0,0,'L');
        $this->ln(5);
        $this->SetFont('Arial','',10);
        $this->Cell(190,0,'Tipo: Facturas',0,0,'L');
        $this->ln(10);

    	//Titulos tabla
        $this->SetFont('Arial','B',10);
    	$this->Cell(20,5,"Tipo",1,0,'C');
        $this->Cell(40,5,"Tipo de Papgo",1,0,'C');
        $this->Cell(20,5,"#Folios",1,0,'C');
        $this->Cell(30,5,"Importe",1,0,'C');
        $this->Cell(30,5,"A cuenta",1,0,'C');
        $this->Cell(30,5,"Resta",1,0,'C');
        $this->ln();
      $query = "SELECT '3' tipo,'1' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
        WHERE DATE(fa.fecha_factura) >= ? AND DATE(fa.fecha_factura) <= ? AND fa.fk_id_tipo_pago = 1 AND fa.grupo = ? AND fa.requiere_factura = 1

        UNION ALL

        SELECT '3' tipo, '2' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
        WHERE DATE(fa.fecha_factura) >= ? AND DATE(fa.fecha_factura) <= ? AND fa.fk_id_tipo_pago = 2 AND fa.grupo = ? AND fa.requiere_factura = 1

        UNION ALL

        SELECT '3' tipo, '3' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
        WHERE DATE(fa.fecha_factura) >= ? AND DATE(fa.fecha_factura) <= ? AND fa.fk_id_tipo_pago = 3 AND fa.grupo = ? AND fa.requiere_factura = 1

        UNION ALL

        SELECT '3' tipo, '4' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
        WHERE DATE(fa.fecha_factura) >= ? AND DATE(fa.fecha_factura) <= ? AND fa.fk_id_tipo_pago = 4 AND fa.grupo = ? AND fa.requiere_factura = 1

        UNION ALL

        SELECT '3' tipo, '5' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
        WHERE DATE(fa.fecha_factura) >= ? AND DATE(fa.fecha_factura) <= ? AND fa.fk_id_tipo_pago = 5 AND fa.grupo = ? AND fa.requiere_factura = 1";
      $stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
			$stmt->execute();
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("sssssssssssssss",$f_inicio,$f_final,$grupo,$f_inicio,$f_final,$grupo,$f_inicio,$f_final,$grupo,$f_inicio,$f_final,$grupo,$f_inicio,$f_final,$grupo);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) exit('No hay documentos proximos');
			while($row = $result->fetch_assoc())
	    {
	    	if($row['tipo_pago'] == 1){$tipo_pago = "Efectivo";}else
		    if($row['tipo_pago'] == 2){$tipo_pago = "Cheque";}else
		    if($row['tipo_pago'] == 3){$tipo_pago = "Transferencia Bancaria";}
		    if($row['tipo_pago'] == 4){$tipo_pago = "Tarjeta de Debito";}else
		    if($row['tipo_pago'] == 5){$tipo_pago = "Tarjeta de Credito";}
		    else{$tipo = "No existe";}

		    if($row['total'] == null || $row['total'] == ''){$total = 0;}
		    else{$total = $row['total'];}

		    if($row['cuenta'] == null || $row['cuenta'] == ''){$cuenta = 0;}
		    else{$cuenta = $row['cuenta'];}

		    if($row['resta'] == null || $row['resta'] == ''){$resta = 0;}
		    else{$resta = $row['resta'];}
		    //DAtos de la tabla
	    	$this->Cell(20,5,'Facturas',1,0,'C');
	      $this->Cell(40,5,$tipo_pago,1,0,'C');
	      $this->Cell(20,5,$row['folios'],1,0,'C');
	      $this->Cell(30,5,'$ '.$total,1,0,'C');
	      $this->Cell(30,5,'$ '.$cuenta,1,0,'C');
	      $this->Cell(30,5,'$ '.$resta,1,0,'C');
	      $this->ln();
	    }

        $require = 1;
	    	$stmt = $conexion->prepare("SELECT COUNT(*) folios,SUM(fa.imp_total)total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios
					FROM so_factura fa
					WHERE DATE(fa.fecha_factura) >= ? AND DATE(fa.fecha_factura) <= ? AND fa.grupo = ? AND fa.requiere_factura = ?");
	    $stmt->bind_param("sssi",$f_inicio,$f_final,$grupo,$require);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) exit('No hay documentos proximos');
			while($row = $result->fetch_assoc())
	    {
	    	$this->Cell(20,0,'',1,0,'C');
	      $this->Cell(40,0,'',1,0,'C');
	      $this->Cell(20,0,'',1,0,'C');
	      $this->Cell(30,0,'',1,0,'C');
	      $this->Cell(30,0,'',1,0,'C');
	      $this->Cell(30,0,'',1,0,'C');
	      $this->ln();
        if($row['total'] == null || $row['total'] == ''){ $total = 0; }else{$total=$row['total'];}
        if($row['cuenta'] == null || $row['cuenta'] == ''){ $cuenta = 0; }else{$cuenta=$row['cuenta'];}
        if($row['resta'] == null || $row['resta'] == ''){ $resta = 0; }else{$resta=$row['resta'];}
	    	$this->Cell(20,0,'',1,0,'C');
	      $this->Cell(40,5,'Totales',1,0,'C');
	      $this->Cell(20,5,$row['folios'],1,0,'C');
	      $this->Cell(30,5,'$ '.$total,1,0,'C');
	      $this->Cell(30,5,'$ '.$cuenta,1,0,'C');
	      $this->Cell(30,5,'$ '.$resta,1,0,'C');
	      $this->ln();
	    }
    }
  }

//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,10);

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Tabla();
$pdf->Output();

?>
