<?php
//session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$id_sucursal=$_GET['id_sucursal'];
$fecha_factura=$_GET['fecha_factura'];


$ing_otros='0';
$ing_num='0';
$num_mov_egr='0';
$num_imp_egr='0';
$num_mov_egr_o='0';
$num_imp_egr_o='0';

//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
SELECT su.`desc_sucursal` AS sucursal, COUNT(*) AS numfolios, 
SUM(case when fa.estado_factura = 5 then 0 else  fa.`imp_total` end ) as importe,
SUM(case when fa.estado_factura=5 then 0 else fa.`resta` end) as saldo,
SUM((case when fa.estado_factura = 5 then 0 else  fa.`imp_total` end )-(case when fa.estado_factura=5 then 0 else fa.`resta` end)) AS efectivo,
SUM(CASE WHEN fa.fk_id_tipo_pago = 1 and fa.estado_factura <> 5 THEN fa.`imp_total` ELSE 0 END) AS pago_efe,
SUM(CASE WHEN fa.fk_id_tipo_pago = 2 and fa.estado_factura <> 5 THEN fa.`imp_total` ELSE 0 END) AS pago_che,
SUM(CASE WHEN fa.fk_id_tipo_pago = 3 and fa.estado_factura <> 5 THEN fa.`imp_total` ELSE 0 END) AS pago_tra,
SUM(CASE WHEN fa.fk_id_tipo_pago = 4 and fa.estado_factura <> 5 THEN fa.`imp_total` ELSE 0 END) AS pago_cre
FROM so_factura fa, kg_sucursales su 
WHERE DATE(fecha_factura) = '".$fecha_factura."' 
AND fa.fk_id_sucursal = '".$id_sucursal."'
AND fa.`fk_id_sucursal` = su.`id_sucursal`
GROUP BY su.`desc_sucursal`";
 //echo $sql;

  $paciente='0';

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $sucursal=$row['sucursal'];
            $numfolios=$row['numfolios'];
            $importe=$row['importe'];
            $saldo=($row['saldo']);
            $efectivo=$row['efectivo'];
            $pago_efe=$row['pago_efe'];
            $pago_che=$row['pago_che'];
            $pago_tra=$row['pago_tra'];
            $pago_cre=$row['pago_cre'];
        }
    }


class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    global $sucursal,
            $numfolios,
            $importe,
            $saldo,
            $efectivo,
            $fecha_factura,
            $pago_efe,
            $pago_che,
            $pago_tra,
            $pago_cre,
            $ing_num,
            $ing_otros,
            $num_mov_egr,
            $num_imp_egr,
            $num_mov_egr_o,
            $num_imp_egr_o;


    $this->Image('../imagenes/logo_arca.png',15,5,30,10);
    //$this->Ln(20);
    $this->Cell(35);
    $this->SetFont('Arial','B',10);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,0,255);
    $this->Cell(125,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'L');
    $this->Ln(1);
    $this->Cell(6);
    $this->Cell(185,5,'___________________________________________________________________________________',0,0,'L');
    $this->Ln(5);
    $this->Cell(6);
    $this->SetFont('Courier','B',12);
    $this->Cell(180,5,'CORTE DE CAJA',0,0,'C');
    $this->SetTextColor(0,0,0);
// Primer columna de titulos
    $this->Ln(5);
    $this->Cell(5);
    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'Unidad:',0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(40,5,$sucursal,0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(25,5,'Fecha corte:',0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(25,5,$fecha_factura,0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'Fecha:',0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(25,5,date('l jS \of F Y h:i:s A'),0,0,'L');

    $this->ln(5);
    $this->Cell(140);
    $this->SetFont('Arial','B',13);
    $this->Cell(27,5,'BALANCE:',0,0,'L');
    $this->SetFont('Arial','',13);
    $this->Cell(12,5,'$'.number_format((($efectivo+$ing_otros-$num_imp_egr+$num_imp_egr_o)),2),0,0,'L');
// Segunda linea

    $this->ln(3);
    $this->Cell(30);
    $this->Cell(185,5,'_________________________________________________________________',0,0,'L');
    $this->ln(5);
    $this->Cell(5);
    $this->SetFont('Arial','B',13);
    $this->Cell(13,5,'INGRESOS',0,0,'L');


    $this->Cell(15);
    $this->SetFont('Arial','',10);
    $this->Cell(13,5,'Ventas:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,$numfolios.' (notas)',0,0,'L');

    $this->Cell(15);
    $this->SetFont('Arial','',10);
    $this->Cell(11,5,'Total:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(22,5,'$'.number_format($importe,2),0,0,'L');

    $this->Cell(5);
    $this->SetFont('Arial','',10);
    $this->Cell(20,5,'Pendiente:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(22,5,'$'.number_format($saldo,2),0,0,'L');

    $this->Cell(5);
    $this->SetFont('Arial','',10);
    $this->Cell(20,5,'Efectivo:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(22,5,'$'.number_format($efectivo,2),0,0,'L');

// Tercer linea (otros)

    $this->ln(5);
    $this->Cell(33);
    $this->SetFont('Arial','',10);
    $this->Cell(15,5,'Otros:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(7,5,$ing_num.' (mov)',0,0,'L');

    $this->Cell(16);
    $this->SetFont('Arial','',10);
    $this->Cell(11,5,'Total:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(22,5,'$'.number_format($ing_otros,2),0,0,'L');

// Tercer linea (desglose)
    $this->ln(5);
    $this->Cell(33);
    $this->SetFont('Arial','',10);
    $this->Cell(18,5,'Desglose ventas:',0,0,'L');

    $this->Cell(12);
    $this->SetFont('Arial','',10);
    $this->Cell(15,5,'Efectivo:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,'$'.number_format($pago_efe,2),0,0,'L');

    $this->Cell(12);
    $this->SetFont('Arial','',10);
    $this->Cell(18,5,'Cheques:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,'$'.number_format($pago_che,2),0,0,'L');

    $this->Cell(5);
    $this->SetFont('Arial','',10);
    $this->Cell(18,5,'Transfer:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,'$'.number_format($pago_tra,2),0,0,'L');

    $this->Cell(5);
    $this->SetFont('Arial','',10);
    $this->Cell(18,5,'Credito:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,'$'.number_format($pago_cre,2),0,0,'L');

    $this->ln(3);
    $this->Cell(30);
    $this->Cell(185,5,'____________________________________________________________________________________',0,0,'L');
    $this->SetFont('Arial','B', 12);
    $this->SetXY(17, 42); 
    $this->Write(0,'$'.number_format((($efectivo+$ing_otros)),2));

// linea egresos

    $this->ln(10);
    $this->Cell(5);
    $this->SetFont('Arial','B',13);
    $this->Cell(13,5,'EGRESOS',0,0,'L');

    $this->Cell(15);
    $this->SetFont('Arial','',10);
    $this->Cell(20,5,'Operativos:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,$num_mov_egr.' (mov)',0,0,'L');

    $this->Cell(15);
    $this->SetFont('Arial','',10);
    $this->Cell(11,5,'Total:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(22,5,'$'.number_format($num_imp_egr,2),0,0,'L');

    $this->Cell(12);
    $this->SetFont('Arial','',10);
    $this->Cell(12,5,'Otros:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(10,5,$num_mov_egr_o.' (mov)',0,0,'L');

    $this->Cell(15);
    $this->SetFont('Arial','',10);
    $this->Cell(11,5,'Total:',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Cell(22,5,'$'.number_format($num_imp_egr_o,2),0,0,'L');

    $this->ln(8);
    $this->Cell(30);
    $this->Cell(185,5,'____________________________________________________________________________________',0,0,'L');
    $this->SetFont('Arial','B', 12);
    $this->SetXY(17, 61); 
    $this->Write(0,'$'.number_format((($num_imp_egr+$num_imp_egr_o)),2));

// titulos 
    $this->ln(8);
    $this->Cell(5);
    $this->SetTextColor(0,130,200);
    $this->Cell(185,5,'DETALLE DE INGRESOS',0,0,'C');

    $this->ln(10);
    $this->Cell(9);

    $this->SetTextColor(0,130,200);    
    $this->SetFont('Arial','','8');

    $this->Cell(5,5,'#',0,0,'R');
    $this->Cell(12,5,'Id',0,0,'C');
    $this->Cell(10,5,'Hora',0,0,'L');
    $this->Cell(65,5,'Cliente',0,0,'C');
    $this->Cell(7,5,'Edo',0,0,'C');
    $this->Cell(8,5,'T.P.',0,0,'C');
    $this->Cell(5,5,'%',0,0,'C');
    $this->Cell(15,5,'Imoprte',0,0,'C');
    $this->Cell(15,5,'A cuenta',0,0,'C');
    $this->Cell(15,5,'Resta',0,0,'C');
    $this->Cell(40,5,'Conciliado',0,0,'C');
    $this->ln(1);
    $this->Cell(9);
    $this->Cell(185,5,'________________________________________________________________________________________________________________________',0,0,'L');
    $this->Ln();

}

// Pie de página
  function Footer()
  {

    $this->SetY(-10);

    $this->Cell(20);
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
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

$num='0';
//$id_factura='0';

$sql="SELECT fa.`id_factura`,
fa.estado_factura,
CASE 
  WHEN fa.`estado_factura` = 1 THEN
    'EL'
  WHEN fa.`estado_factura` = 2 THEN
    'TE'
  WHEN fa.`estado_factura` = 3 THEN
    'EN'
  WHEN fa.`estado_factura` = 4 THEN
    'IM'
  WHEN fa.`estado_factura` = 5 THEN
    'CA'
END AS estado,
SUBSTR(tp.desc_tipo_pago,1,2) AS tipopago,
fa.`imp_total`,
fa.`a_cuenta`,
fa.`resta`,
CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS cliente,
DATE_FORMAT(fa.fecha_factura,'%H:%i') AS hora,
fa.fecha_factura,
fa.porc_descuento
FROM so_factura fa,kg_tipo_pago tp,so_clientes cl
WHERE DATE(fa.fecha_factura)='".$fecha_factura."'
AND fa.fk_id_sucursal = '".$id_sucursal."'
AND fa.fk_id_tipo_pago=tp.id_tipo_pago
AND fa.fk_id_cliente = cl.id_cliente
-- AND fa.estado_concilia = 'A'
";
//echo $sql;
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {

/*
      $estado_concilia='C';
      $numero_factura=$row['id_factura'];
      //echo $veces;
      $sql_update="UPDATE so_factura SET estado_concilia = '".$estado_concilia."'
      where id_factura=".$numero_factura;
      //echo $sql_update;
      $execute_query_update = mysqli_query($con,$sql_update);
*/



      $num+=1;
      $pdf->Cell(9);
      if($row['estado_factura']==5){
        $pdf->SetTextColor(255,0,0);
      }else{
        $pdf->SetTextColor(0,130,200); 
      }

      if($row['resta']>0){
        $pdf->SetFont('Arial','B','8');
      }else{
        $pdf->SetFont('Arial','','8'); 
      }
      
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
      $pdf->Cell(10,5,$row['hora'],0,0,'L');
      $pdf->Cell(65,5,utf8_decode($row['cliente']),0,0,'L');
      $pdf->Cell(7,5,$row['estado'],0,0,'C');
      $pdf->Cell(8,5,$row['tipopago'],0,0,'C');
      $pdf->Cell(5,5,$row['porc_descuento'],0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['imp_total'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['a_cuenta'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['resta'],2),0,0,'R');
      $pdf->Cell(15,5,'Si',0,0,'R');
      $pdf->Cell(15,5,'No',0,0,'R');

      $pdf->ln(5);
    } 

// Detalle de gastos
    $pdf->ln(8);
    $pdf->Cell(5);
    $pdf->SetTextColor(139,130,200);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Cell(185,5,'DETALLE DE EGRESOS',0,0,'C');
    $pdf->ln(4);
    $pdf->SetFont('Arial','I', 8);
    $pdf->Cell(195,5,'(Escriba el detalle de sus gastos)',0,0,'C');
    $pdf->SetFont('Arial','B', 12);
    $pdf->ln(15);
    $i=1;
    while ($i <= 5){
      $pdf->Cell(5);
      $pdf->SetFont('Arial','','8');
      $pdf->Cell(5,5,$i,0,0,'L');
      $pdf->Cell(97,5,'-----------------------------------------------------------------------------------------------------',0,0,'L');
      $pdf->Cell(20);
      $pdf->Cell(30,5,'$'.'------------------',0,0,'L');
      $i+=1;
      $pdf->ln(7);
    }
    $pdf->Cell(117);
    $pdf->SetFont('Arial','','10');
    $pdf->Cell(5,5,'Total:',0,0,'L');
// Observaciones
    $pdf->ln(5);
    $pdf->Cell(5);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','','9');
    $pdf->Cell(30,5,'OBSERVACIONES',0,0,'C');
    $pdf->ln(5);
    $pdf->Cell(5);
    $pdf->Cell(175,45,'',1,0,'C');



// Firmas
      $pdf->ln(50);
      $pdf->Cell(20);
       $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Arial','','10');
      $pdf->Cell(30,5,'ELABORO',0,0,'C');
      $pdf->Cell(90);
      $pdf->Cell(30,5,'RECIBIO',0,0,'C');

      $pdf->ln(10);
      $pdf->Cell(20);
      $pdf->SetFont('Arial','','8');
      $pdf->Cell(30,5,'---------------------------------',0,0,'C');
      $pdf->Cell(90);
      $pdf->Cell(30,5,'---------------------------------',0,0,'C');

      $pdf->ln(5);
      $pdf->Cell(20);
      $pdf->SetFont('Arial','','8');
      $pdf->Cell(30,5,'Nombre y Firma',0,0,'C');
      $pdf->Cell(90);
      $pdf->Cell(30,5,'Nombre y Firma',0,0,'C');

  }

$pdf->Output();
?>