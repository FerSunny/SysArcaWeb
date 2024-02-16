<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];


// Contamos la cantidad de imagenes que tiene el estudio
$sql_max="select count(id_imagen) as num_img FROM cr_plantilla_ekg_img
where estado = 'A' and fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
// echo $sql_max;
$num_img='0';
if ($result = mysqli_query($con, $sql_max)) {
	while($row = $result->fetch_assoc())
	{
			$num_img=$row['num_img'];
	}
}

//echo $num_img;

/*
// OBTENEMOS LOS DATOS DE LA ESTUDIO REGISTRADO
$sql_usg="SELECT us.nombre_plantilla, us.titulo_desc, us.descripcion, us.firma 
FROM cr_plantilla_usg_re us 
WHERE us.estado = 'A'
AND fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;

//echo $sql_usg;

if ($result = mysqli_query($con, $sql_usg)) {
	while($row = $result->fetch_assoc())
	{
			$titulo_desc=$row['titulo_desc'];
			$descripcion=$row['descripcion'];
			$firma=$row['firma'];

	}
}
*/

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
						$tamfuem;

    $this->Image('../imagenes/logo_lab.jpg',45,3,130,27);
    $this->Image('../imagenes/codigo3.png',179,37,20,20);

    $this->Cell(5);
    $this->SetFont('Arial','B',15);

    $this->SetTextColor(0,100,0);

    $this->Ln(13);

    $this->SetFont('Arial','I',10);

    $this->Ln(3);
    $this->SetTextColor(0,0,255);
    $this->Cell(193,5,'________________________________________________________________________________________________',0,0,'C');
    $this->SetTextColor(0,0,0);

// Primer columna de titulos
		$this->Ln(7);
		$this->Cell(2);
		$this->SetFont('Arial','B',11);
		$this->Cell(22,5,'PACIENTE:',0,0,'L');
		$this->SetFont('Arial','',11);
		$this->Cell(88,5,$paciente,0,0,'L');

		$this->SetFont('Arial','B',11);
		$this->Cell(15,5,'DR(A):',0,0,'L');
		$this->SetFont('Arial','',11);
		$this->Cell(70,5,$medico,0,0,'L');
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
		$this->MultiCell(88,5,$estudio2,0,'L');
 
		$this->SetFont('Arial','B',11);
		$this->SetXY(122, 46); 
		$this->Write(0,'EDAD:'); 
		$this->SetFont('Arial','',11);
		$this->SetXY(137,46); 
		$this->Write(0,$edad);

// Cuarta linea (nombre del estudio - plantilla -)
		/*
		$this->ln(15);
		$this->Cell(5);
		$this->SetFont('Arial','B',14);
		$this->Cell(170,5,$titulo_desc,0,0,'C'); 
		*/

		$this->Ln(15);

}

// Pie de página
	function Footer()
	{

		global $studio,$con,$verificado,$tamfuev,$tipfuev,$posiniv;

		$this->SetY(-39); //
		//$this->ln(10);
		$this->Cell($posiniv);

		$this->SetFont('Arial',$tipfuev,$tamfuev);
		$this->Cell(30,5,$verificado,0,0,'L'); 
		$this->ln(10); // aqui
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
    //$this->ln(2);
    $this->Cell(5);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'__________________________________________________________________________________________',0,0,'L');
    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(118,260); 
    $this->Write(0,'www.estudiosclinicosanbuenaventura.com.mx');

    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','',12);
    $this->SetXY(15,260); 
    $this->Write(0,'Matriz:');

    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','',10);
    $this->SetXY(15,264); 
    $this->Write(0,'Ixtapaluca');

    $this->SetXY(15,268); 
    $this->SetFont('Arial','',8);
    $this->Write(0,'Blvd. San Buenaventura No. 51');

    $this->SetXY(15,271);
    $this->Write(0,'Col. La Venta');
    
    $this->SetXY(15,274);
    $this->Write(0,'Ixtapaluca Edo. Mex.');

    $this->SetXY(15,277);
    $this->Write(0,'Tel. 55 5972 5169 - 55 6298 2670');

// sucursal
    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','',12);
    $this->SetXY(65,260); 
    $this->Write(0,'Sucursal:');

    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','',10);
    $this->SetXY(65,264); 
    $this->Write(0,'Chalco');

    $this->SetXY(65,268); 
    $this->SetFont('Arial','',8);
    $this->Write(0,'Av. Cuauhutemoc No. 27 Local 6');

    $this->SetXY(65,271);
    $this->Write(0,'Col. Centro');
    
    $this->SetXY(65,274);
    $this->Write(0,'Chalco Edo. Mex.');

    $this->SetXY(65,277);
    $this->Write(0,'Tel. 55 8865 1720 - 55 8865 1721');


    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',9);
    $this->SetXY(114,266); 
    $this->Write(0,'atencion.cliente@estudiosclinicosanbuenaventura.com.mx');
    $this->SetXY(135,271); 
    $this->Write(0,'Estudios Clinicos San Buenaventura');    
    $this->Image('../imagenes/fb.png',130,268,5,5);

    $this->SetXY(142,276); 
    $this->Write(0,'estclinbuenaventura');
    $this->Image('../imagenes/instagram.png',137,273,5,5);  
    $this->SetTextColor(0,0,0);

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(90,272); 

    $this->SetTextColor(0,0,0);//subir codigo de seguridad
//    }
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


// rutina para verificar el numero de imagnes y asignar
// el tamaño de la imagen que le corresponda.

/*
$pdf->Cell(2);
$pdf->SetFont('Arial','',9);
*/
$leido=1;
$derecha=0;

$columna=13;
$renglon=58;
$sql_imagenes="select * FROM cr_plantilla_ekg_img
where estado = 'A' and fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
//echo $sql_imagenes;
if ($result = mysqli_query($con, $sql_imagenes)) {
	while($row = $result->fetch_assoc())
	{
			$nombre=$row['nombre'];
			$ruta=$row['ruta'];
			$v_alto=$row['alto'];
			$v_ancho=$row['ancho'];

			$imagen="../img_ekg/".$numero_factura."/".$row['nombre'];

// Ajusta tamaño de las imagenes, segun el numero de imagenes

			switch ($num_img){
				case '1':
					if($v_alto>192 && $v_ancho>148){
						$alto=192;
						$ancho=148;
					}else{
						$alto=$v_alto;
						$ancho=$v_ancho;          
					}
					break;
				default:
					if($v_alto>192 && $v_ancho>148){
						$alto=85;
						$ancho=60;
					}else{
						$alto=85; //$v_alto;
						$ancho=60; //$v_ancho;          
					}
					break;
			}

// impresion por lineas, segun numero de imagenes

			if($num_img == 1 && $leido==1){
				$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
			}

			if($num_img > 1){
				switch ($leido){
					case '1':
						$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
						break;
					case '2':
						$columna=110;
						$renglon=58;
						$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
						break;
					case '3':
						$columna=13;
						$renglon=122;
						$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
						break;
					case '4':
						$columna=110;
						$renglon=122;
						$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
						break;
					case '5':
						$columna=13;
						$renglon=188;
						$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
						break;
					case '6':
						$columna=110;
						$renglon=188;
						$pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
						break;
 /*         
					default:
						# code...
						break;
*/            
				}
			}

/*
			if($num_img=='1'){
				if($v_alto>192 && $v_ancho>148){
					$alto_i1=192;
					$ancho_i1=148;
				}else{
					$alto_i1=$v_alto;
					$ancho_i1=$v_ancho;          
				}
				$columna=13;
				$renglon=90;
				$pdf->Image($imagen,$columna,$renglon,$alto_i1,$ancho_i1);        
			}

			if($num_img=='2'){  
				if($v_alto>192 && $v_ancho>148){
					$alto_i2=88.4;
					$ancho_i2=68.6;
				}else{
					$alto_i2=$v_alto;
					$ancho_i2=$v_ancho;
				}
					$columna=$columna+$derecha;
					$renglon=72;
					$pdf->Image($imagen,$columna,$renglon,$alto_i2,$ancho_i2);    
					$derecha=$derecha+97;    
			}
// mas de una linea de impresion
			if($num_img>='3'){  
				if($v_alto>192 && $v_ancho>148){
					$alto_i2=88.4;
					$ancho_i2=68.6;
				}else{
					$alto_i2=$v_alto;
					$ancho_i2=$v_ancho;
				}
					$columna=$columna+$derecha;
					if($linea==3){
						$renglon=$renglon+96; 
						$columna=13;
					}else{
						$renglon=72;
					}

					$pdf->Image($imagen,$columna,$renglon,$alto_i2,$ancho_i2);    
					$derecha=$derecha+97;    
			}
*/      
		$leido=$leido+1;

	}
}





//$pdf->MultiCell(185,5,$descripcion,0,'L');

/*
$pdf->ln(10);
$pdf->Cell(2);
$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(50,5,trim($firma),0,'L');
*/

//for($i=1;$i<=20;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);

$pdf->Output();
?>