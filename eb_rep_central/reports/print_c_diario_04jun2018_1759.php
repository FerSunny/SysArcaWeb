<?php
// modificacion para justar:
// 21may18 sumar al saldo los pagos de adeudos del mismo dia

//session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$id_sucursal=$_GET['id_sucursal'];
$fecha_factura=$_GET['fecha_factura'];

/*
$ing_otros='0';
$ing_num='0';
$num_mov_egr='0';
$num_imp_egr='0';
$num_mov_egr_o='0';
$num_imp_egr_o='0';
*/

//Obtener los datos, de la cabecera, (datos del estudio)

/*$sql="
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
*/
//echo $sql;
$sql= "SELECT  
        su.id_sucursal,su.desc_sucursal
      FROM kg_sucursales su
  WHERE su.estado = 'A'
    AND su.id_sucursal = '".$id_sucursal."'";
//echo $sql;

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $sucursal=$row['desc_sucursal'];
            $id=$row['id_sucursal'];
        }
    }


class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    global $sucursal,
            $id,
            $fecha_factura;


    $this->Image('../imagenes/logo_arca.png',15,5,30,10);
    //$this->Ln(20);
    $this->Cell(35);
    $this->SetFont('Arial','B',10);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,0,255);
    $this->Cell(125,5,'LABORATORIOS ARCA',0,0,'L');
    $this->Ln(1);
    $this->Cell(6);
    $this->Cell(185,5,'_________________________________________________________________________________________________________________________',0,0,'L');
// linea 1
    $this->Ln(5);
    $this->Cell(6);
    $this->SetFont('Times','B',15);
    $this->Cell(230,10,'CORTE DE CAJA',0,0,'C');

// linea 2   
    $this->SetFillColor(0,0,153);
    $this->SetTextColor(255,255,255);

    $this->Ln(10);
    $this->Cell(5);
    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'Unidad:',0,0,'L',true);
    $this->SetFont('Arial','',9);
    $this->Cell(55,5,$id.' - '.$sucursal,0,0,'L',true);

    $this->SetFont('Arial','B',11);
    $this->Cell(25,5,'Fecha corte:',0,0,'L',true);
    $this->SetFont('Arial','',9);
    $this->Cell(45,5,$fecha_factura,0,0,'L',true);

    $this->SetFont('Arial','B',11);
    $this->Cell(40,5,'Fecha Impresion:',0,0,'L',true);
    $this->SetFont('Arial','',9);
    $this->Cell(60,5,date('l jS \of F Y h:i:s A'),0,0,'L',true);
    $this->SetFillColor(0,0,0);
    $this->SetFillColor(0,0,0);
    $this->SetTextColor(0,0,255);
    $this->ln(10);
// linea 3    

/*

    $this->Cell(5);
    $this->SetFont('Arial','',10);
    $this->Cell(13,5,'Efectivo Inicial:',0,0,'L');
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
*/
// titulos 
    //$this->ln(2);
    /*
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
    $this->Cell(15,5,'Importe',0,0,'C');
    $this->Cell(15,5,'A cuenta',0,0,'C');
    $this->Cell(15,5,'Resta',0,0,'C');
    $this->Cell(40,5,'Status Pago',0,0,'C');
    $this->ln(1);
    $this->Cell(9);
    $this->Cell(185,5,'________________________________________________________________________________________________________________________',0,0,'L');
    $this->Ln();
    */

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
$pdf = new PDF('L','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,10);

$pdf->AliasNbPages();
$pdf->AddPage();

$num='0';

// Resumen del corte de caja
//  (EFECTIVO INICIAL)
$efe_ini='0';
$sql="SELECT su.desc_sucursal, ga.desc_gasto, re.importe 
FROM ga_registro re, 
  ga_gasto ga, 
  ga_tipo_gasto tg, 
  kg_sucursales su 
WHERE re.estado = 'A' 
AND re.fk_id_gasto = ga.id_gasto 
AND ga.fk_id_tipo_gasto = tg.id_tipo_gasto 
AND tg.id_tipo_gasto='1' 
AND re.fk_id_sucursal = su.id_sucursal 
AND re.fk_id_sucursal = '".$id_sucursal."'
AND DATE(re.fecha_mov) = '".$fecha_factura."'";

$pdf->Cell(5);
$pdf->SetFont('Arial','B','10');       
$pdf->Cell(100,5,'ENTRADAS EN EFECTIVO',0,0,'L');
$pdf->Cell(45,5,'O B S E R V A C I O N E S',0,0,'C');
$pdf->ln(5);
$pdf->SetFont('Arial','','9');
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      $efe_ini=$efe_ini+$row['importe'];
      $pdf->Cell(10);
      $pdf->Cell(35,5,$row['desc_gasto'],0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($row['importe'],2),0,0,'R');
      $pdf->ln(5);
    }
}
$pdf->Cell(44);
$pdf->Cell(25,2,'-------------------',0,0,'L');
$pdf->ln(2);
$pdf->Cell(45);
$pdf->Cell(20,5,'$'.number_format($efe_ini,2),0,0,'R');
$pdf->ln(10);

// NOTAS PAGADAS DE OTRA UNIDAD
$sql="SELECT COUNT(*) AS num_notas, SUM(pa.imp_pagado) AS imp_pagado FROM so_pagos pa,so_factura fa
WHERE DATE(fecha_pago) = '".$fecha_factura."'
  AND pa.fk_id_sucursal_pag = '".$id_sucursal."'
  AND pa.fk_id_sucursal_ori <> pa.fk_id_sucursal_pag
  AND pa.`fk_id_factura`=fa.`id_factura`
  AND fa.`estado_factura` <> 5
  ";
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
  {
      $num_notas=$row['num_notas'];
      $imp_pagado=$row['imp_pagado'];
  }
}

// NOTAS PAGADAS EN OTRA UNIDAD
$sql="SELECT COUNT(*) AS num_notas, SUM(pa.imp_pagado) AS imp_pagado FROM so_pagos pa,so_factura fa
WHERE DATE(fa.fecha_factura) = '".$fecha_factura."'
  AND pa.fk_id_sucursal_ori = '".$id_sucursal."'
  AND pa.fk_id_sucursal_pag <> pa.fk_id_sucursal_ori
  AND pa.`fk_id_factura`=fa.`id_factura`
  AND fa.`estado_factura` <> 5
  ";
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
  {
      $num_npenou =$row['num_notas'];
      $imp_npenou=$row['imp_pagado'];
  }
}

// SALDOS PAGADOS EN LA AUNIDAD
$sql="SELECT sum(pa.imp_pagado) AS pago
FROM so_factura fa,
     so_pagos pa,
     so_clientes cl,
     kg_sucursales suo,
     kg_sucursales sup
WHERE fa.id_factura = pa.fk_id_factura
  AND fa.fk_id_cliente = cl.id_cliente
  AND fa.`estado_factura` <> 5
  AND pa.`fk_id_sucursal_ori` = suo.id_sucursal
  AND pa.`fk_id_sucursal_pag` = sup.id_sucursal
  AND DATE(pa.fecha_pago)='".$fecha_factura."'
  AND pa.fk_id_sucursal_pag = ".$id_sucursal."
  AND pa.fk_id_sucursal_ori = ".$id_sucursal;
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
  {
      $atras_pago =$row['pago'];
  }
}

// (VENTAS Y TIPOS DE VENTAS)
$saldo='0';
$sql="SELECT COUNT(*) AS numfolios, 
SUM(fa.imp_total ) AS importe,
SUM(fa.resta) AS saldo,
-- SUM( fa.imp_total- fa.resta ) AS efectivo,
SUM(CASE WHEN fa.fk_id_tipo_pago = 1 THEN fa.imp_total ELSE 0 END) AS pago_efe,
SUM(CASE WHEN fa.fk_id_tipo_pago = 2 THEN fa.imp_total ELSE 0 END) AS pago_che,
SUM(CASE WHEN fa.fk_id_tipo_pago = 3 THEN fa.imp_total ELSE 0 END) AS pago_tra,
SUM(CASE WHEN fa.fk_id_tipo_pago = 4 THEN fa.imp_total ELSE 0 END) AS pago_cre
FROM so_factura fa
WHERE DATE(fecha_factura) = '".$fecha_factura."' 
AND fa.fk_id_sucursal = '".$id_sucursal."'
AND fa.estado_factura <> '5'";

$pdf->Cell(5);
$pdf->SetFont('Arial','B','10');       
$pdf->Cell(100,5,'ENTRADAS POR VENTAS',0,0,'L');
$pdf->Cell(45,5,'TIPO DE VENTA',0,0,'L');
$pdf->ln(5);
$pdf->SetFont('Arial','','9');
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      $pdf->Cell(10);
      $pdf->Cell(35,5,'Notas',0,0,'L');
      $pdf->Cell(20,5,$row['numfolios'],0,0,'R');
      $pdf->Cell(64,5,'En efectivo',0,0,'R');
      $pdf->Cell(26,5,'$'.number_format($row['pago_efe'],2),0,0,'R');

      $pdf->ln(5);
      $pdf->Cell(10);
      $pdf->Cell(35,5,' + Ventas',0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($row['importe'],2),0,0,'R');
      $pdf->Cell(65,5,'En cheques',0,0,'R');
      $pdf->Cell(25,5,'$'.number_format($row['pago_che'],2),0,0,'R');
      $pdf->ln(5);

      $pdf->Cell(10);
      $pdf->Cell(35,5,' - Credito',0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($row['saldo'],2),0,0,'R');
      $pdf->Cell(65,5,'En Transfer',0,0,'R');
      $pdf->Cell(25,5,'$'.number_format($row['pago_tra'],2),0,0,'R');
      $pdf->ln(5);

      $pdf->Cell(10);
      $pdf->Cell(35,5,' + NPdeOU',0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($imp_pagado,2),0,0,'R');
      $pdf->Cell(57,5,'En TC',0,0,'R');
      $pdf->Cell(33,5,'$'.number_format($row['pago_cre'],2),0,0,'R');
      $pdf->ln(5);

      $pdf->Cell(10);
      $pdf->Cell(35,5,' - NPenOU',0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($imp_npenou,2),0,0,'R');
      $pdf->ln(5);

      $pdf->Cell(10);
      $pdf->Cell(35,5,' - PagosAtra',0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($atras_pago,2),0,0,'R');


      $pdf->Cell(90,2,'-------------------',0,0,'R');
      $pdf->ln(4);
      $pdf->Cell(65,2,'-------------------',0,0,'R');
      $pdf->Cell(90,5,'$'.number_format(($row['pago_efe']+$row['pago_che']+$row['pago_tra']+$row['pago_cre']),2),0,0,'R');
      $pdf->ln(1);


      $saldo=$row['importe']-$row['saldo']+$imp_pagado-$imp_npenou-$atras_pago;




      $pdf->Cell(45);
      $pdf->Cell(20,5,'$'.number_format($saldo,2),0,0,'R');

      
      $pdf->ln(5);
    }
}
$pdf->ln(5);
$pdf->Cell(5);
$pdf->SetFont('Arial','B','10');       
$pdf->Cell(40,5,'TOTAL ENTRADAS: ',0,0,'L');
$pdf->Cell(20,5,'$'.number_format($saldo+$efe_ini,2),0,0,'R');
$pdf->ln(10);

// GENERAR LOS GASTOS
$efe_gas='0';
$sql="SELECT su.desc_sucursal, ga.desc_gasto, re.importe,be.nombre
FROM ga_registro re, 
  ga_gasto ga, 
  ga_tipo_gasto tg, 
  kg_sucursales su,
  ga_beneficiarios be
WHERE re.estado = 'A' 
AND re.fk_id_gasto = ga.id_gasto 
AND re.fk_id_beneficiario = be.id_beneficiario
AND ga.fk_id_tipo_gasto = tg.id_tipo_gasto 
AND tg.id_tipo_gasto='2' 
AND re.fk_id_sucursal = su.id_sucursal 
AND re.fk_id_sucursal = '".$id_sucursal."'
AND DATE(re.fecha_mov) = '".$fecha_factura."'";

$pdf->Cell(5);
$pdf->SetFont('Arial','B','10');       
$pdf->Cell(100,5,'SALIDAS',0,0,'L');
$pdf->ln(5);
$pdf->SetFont('Arial','','9');
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      $efe_gas=$efe_gas+$row['importe'];
      $pdf->Cell(10);
      $pdf->Cell(60,5,$row['desc_gasto'].'  ('.$row['nombre'].')',0,0,'L');
      $pdf->Cell(20,5,'$'.number_format($row['importe'],2),0,0,'R');
      $pdf->ln(5);
    }
}
$pdf->Cell(44);
$pdf->Cell(25,2,'-------------------',0,0,'L');
$pdf->ln(2);
$pdf->Cell(45);
$pdf->Cell(20,5,'$'.number_format($efe_gas,2),0,0,'R');
$pdf->ln(5);

$pdf->SetFont('Arial','B','15');       
$pdf->Cell(150,5,'BALANCE: ',0,0,'R');
$pdf->Cell(30,5,'$'.number_format(($saldo+$efe_ini)-$efe_gas,2),0,0,'R');

$pdf->ln(5);
$pdf->Cell(5);
$pdf->SetFont('Arial','B','10');       
$pdf->Cell(40,5,'TOTAL SALIDAS: ',0,0,'L');
$pdf->Cell(20,5,'$'.number_format($efe_gas,2),0,0,'R');
$pdf->ln(5);
$pdf->Cell(25,2,'----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

$pdf->ln(10);


$sql="
SELECT fa.id_factura,
  DATE_FORMAT(fa.fecha_factura,'%H:%i') AS hora,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS cliente,
  SUBSTR(tp.desc_tipo_pago,1,2) AS tipopago,
  fa.porc_descuento,
  fa.`imp_total`,
  fa.a_cuenta AS pagado,
  fa.`resta`,
  CASE
    WHEN fa.resta = 0 THEN
      'Pagado'
    ELSE
      'Pendiente'
  END AS estado_pago,
  CASE
    WHEN pa.imp_pagado > 0  THEN
      CONCAT(su.desc_corta,'-',DATE(pa.fecha_pago),' ',DATE_FORMAT(pa.fecha_pago,'%H:%i'))
    ELSE
      'Tiempo'
  END AS TiempoPago,
  fa.estado_factura
FROM so_factura fa
  LEFT OUTER JOIN so_pagos pa ON (pa.fk_id_factura = fa.id_factura 
          AND DATE(pa.fecha_pago) = DATE(fa.fecha_factura)
          AND pa.fk_id_sucursal_ori = fa.fk_id_sucursal 
          AND pa.fk_id_sucursal_pag = fa.fk_id_sucursal
          ),
  so_clientes cl,
  kg_tipo_pago tp,
  kg_sucursales su
WHERE DATE(fa.fecha_factura)='".$fecha_factura."'
AND fa.fk_id_sucursal =".$id_sucursal." 
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND fa.`fk_id_tipo_pago` = tp.`id_tipo_pago`
AND fa.fk_id_sucursal = su.id_sucursal
AND fa.`estado_factura` <> 5
ORDER BY fa.`id_factura`";
//echo $sql;

    $pdf->Cell(5);
    $pdf->SetTextColor(0,130,200);
    $pdf->Cell(185,5,'DETALLE ENTRADAS POR VENTAS',0,0,'C');

    $pdf->ln(10);
    $pdf->Cell(9);

    $pdf->SetTextColor(0,130,200);    
    $pdf->SetFont('Arial','','8');

    $pdf->Cell(5,5,'#',0,0,'R');
    $pdf->Cell(12,5,'Id',0,0,'C');
    $pdf->Cell(10,5,'Hora',0,0,'L');
    $pdf->Cell(65,5,'Cliente',0,0,'C');

    $pdf->Cell(8,5,'T.P.',0,0,'C');
    $pdf->Cell(5,5,'%',0,0,'C');
    $pdf->Cell(15,5,'Importe',0,0,'C');
    $pdf->Cell(15,5,'A cuenta',0,0,'C');
    $pdf->Cell(15,5,'Resta',0,0,'C');
    $pdf->Cell(15,5,'Status Pago',0,0,'C');
    $pdf->Cell(15,5,'Pago en',0,0,'C');
    $pdf->ln(1);
    $pdf->Cell(9);
    $pdf->Cell(185,5,'________________________________________________________________________________________________________________________',0,0,'L');
    $pdf->Ln();

$t_pagado='0';
$t_resta='0';
$t_imp_total='0';

if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {

      $t_pagado=$t_pagado+$row['pagado'];
      $t_resta=$t_resta+$row['resta'];
      $t_imp_total=$t_imp_total+$row['imp_total'];

      $num+=1;
      $pdf->Cell(9);
      if($row['estado_factura']==5){
        $pdf->SetTextColor(255,0,0);
      }else{
        $pdf->SetTextColor(0,130,200); 
      }

      if($row['resta']>0){
        // se coloco en rojo para los sldos pendientes
        $pdf->SetTextColor(255,0,0);
      }else{
        $pdf->SetTextColor(0,130,200); 
      }


      $pdf->SetFont('Arial','','8');       
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
      $pdf->Cell(10,5,$row['hora'],0,0,'L');
      $pdf->Cell(65,5,utf8_decode($row['cliente']),0,0,'L');
      
      $pdf->Cell(8,5,$row['tipopago'],0,0,'C');
      $pdf->Cell(5,5,$row['porc_descuento'],0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['imp_total'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['pagado'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['resta'],2),0,0,'R');
      $pdf->Cell(15,5,$row['estado_pago'],0,0,'L');
      $pdf->Cell(15,5,$row['TiempoPago'],0,0,'L');

      $pdf->ln(5);
    } 
    //$pdf->ln(5);
    // LINEA DE TOTALES
    $pdf->Cell(115);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B','8');
    $pdf->Cell(15,2,'-------------',0,0,'L');
    //$pdf->Cell(1);
    $pdf->Cell(15,2,'-------------',0,0,'R');
    $pdf->Cell(10);
    $pdf->Cell(5,2,'-------------',0,0,'R');
    $pdf->ln(2);
    $pdf->Cell(115);
    $pdf->Cell(15,5,'$'.number_format($t_imp_total,2),0,0,'R');
    $pdf->Cell(15,5,'$'.number_format($t_pagado,2),0,0,'R');
    $pdf->Cell(15,5,'$'.number_format($t_resta,2),0,0,'R');
    $pdf->ln(10);


// pago de saldos pendientes
$sql="SELECT fa.id_factura,
  DATE_FORMAT(pa.fecha_pago,'%H:%i') AS hora,
  date(fa.fecha_factura) as fecha_factura,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS cliente,
  suo.desc_sucursal AS suc_ori,
  sup.desc_sucursal AS suc_pag,
  fa.`imp_total`,
  fa.`imp_total`- pa.`imp_pagado` AS acuenta,
  pa.imp_pagado AS saldo,
  pa.imp_pagado AS pago
FROM so_factura fa,
     so_pagos pa,
     so_clientes cl,
     kg_sucursales suo,
     kg_sucursales sup
WHERE fa.id_factura = pa.fk_id_factura
  AND fa.fk_id_cliente = cl.id_cliente
  AND fa.`estado_factura` <> 5
  AND pa.`fk_id_sucursal_ori` = suo.id_sucursal
  AND pa.`fk_id_sucursal_pag` = sup.id_sucursal
  AND DATE(pa.fecha_pago)='".$fecha_factura."'
  AND pa.fk_id_sucursal_pag = ".$id_sucursal."
  AND pa.fk_id_sucursal_ori = ".$id_sucursal;

  //echo $sql;


      
      $pdf->ln(3);
      $pdf->Cell(9);
      $pdf->SetTextColor(0,153,0);
      $pdf->SetFont('Arial','B', 12);
      $pdf->Cell(185,5,'DETALLE DE SALDOS PAGADOS',0,0,'C');
      $pdf->ln(4);
      $pdf->SetFont('Arial','', 8);

      $pdf->ln(3);
      $pdf->Cell(9);
      $pdf->Cell(5,5,'#',0,0,'R');
      $pdf->Cell(12,5,'Id',0,0,'C');
      $pdf->Cell(10,5,'Hora',0,0,'L');
      $pdf->Cell(60,5,'Cliente',0,0,'C');
      $pdf->Cell(25,5,'Fecha',0,0,'C');
      $pdf->Cell(20,5,'Unidad',0,0,'C');
      $pdf->Cell(15,5,'Importe',0,0,'C');
      $pdf->Cell(15,5,'A cuenta',0,0,'C');
      $pdf->Cell(15,5,'Resta',0,0,'C');
      $pdf->Cell(15,5,'Pago',0,0,'C');
      $pdf->ln(3);
      $pdf->Cell(185,5,'___________________________________________________________________________________________________________________________',0,0,'L');
      $pdf->ln(4);

if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      $num+=1;

      $pdf->Cell(9);
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
      $pdf->Cell(10,5,$row['hora'],0,0,'L');
      $pdf->Cell(60,5,utf8_decode($row['cliente']),0,0,'L');
      $pdf->Cell(25,5,$row['fecha_factura'].'-'.$row['hora'],0,0,'L');
      $pdf->Cell(20,5,$row['suc_ori'],0,0,'L');
      $pdf->Cell(15,5,'$'.number_format($row['imp_total'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['acuenta'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['saldo'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['pago'],2),0,0,'R');
      $pdf->ln(4);
    }
}
$pdf->ln(10);
// PAGO DE NOTAS DE OTRA UNIDAD (detalle)
$sql="
SELECT  fa.id_factura,
  DATE_FORMAT(pa.fecha_pago,'%H:%i') AS hora,
  DATE(fa.fecha_factura) AS fecha_factura,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS cliente,
  suo.desc_sucursal AS suc_ori,
  sup.desc_sucursal AS suc_pag,
  fa.`imp_total`,
  fa.`imp_total`- pa.`imp_pagado` AS acuenta,
  pa.imp_pagado AS saldo,
  pa.imp_pagado AS pago
FROM so_pagos pa,
  so_factura fa,
  so_clientes cl,
  kg_sucursales suo,
  kg_sucursales sup
WHERE DATE(fecha_pago) ='".$fecha_factura."'
  AND pa.fk_id_sucursal_pag = ".$id_sucursal."
  AND pa.fk_id_sucursal_ori <> pa.fk_id_sucursal_pag
  AND pa.`fk_id_factura`=fa.`id_factura`
  AND fa.`estado_factura` <> 5
  AND fa.fk_id_cliente = cl.id_cliente
  AND pa.`fk_id_sucursal_ori` = suo.id_sucursal
  AND pa.`fk_id_sucursal_pag` = sup.id_sucursal";

  //echo $sql;


      
      $pdf->ln(3);
      $pdf->Cell(9);
      $pdf->SetTextColor(0,153,0);
      $pdf->SetFont('Arial','B', 12);
      $pdf->Cell(185,5,'DETALLE DE NOTAS PAGADAS DE OTRA UNIDAD',0,0,'C');
      $pdf->ln(4);
      $pdf->SetFont('Arial','', 8);

      $pdf->ln(3);
      $pdf->Cell(9);
      $pdf->Cell(5,5,'#',0,0,'R');
      $pdf->Cell(12,5,'Id',0,0,'C');
      $pdf->Cell(10,5,'Hora',0,0,'L');
      $pdf->Cell(60,5,'Cliente',0,0,'C');
      $pdf->Cell(25,5,'Fecha',0,0,'C');
      $pdf->Cell(20,5,'Uni. Origen',0,0,'C');
      $pdf->Cell(15,5,'Importe',0,0,'C');
      $pdf->Cell(15,5,'A cuenta',0,0,'C');
      $pdf->Cell(15,5,'Resta',0,0,'C');
      $pdf->Cell(15,5,'Pago',0,0,'C');
      $pdf->ln(3);
      $pdf->Cell(185,5,'___________________________________________________________________________________________________________________________',0,0,'L');
      $pdf->ln(4);

if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      $num+=1;

      $pdf->Cell(9);
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
      $pdf->Cell(10,5,$row['hora'],0,0,'L');
      $pdf->Cell(60,5,utf8_decode($row['cliente']),0,0,'L');
      $pdf->Cell(25,5,$row['fecha_factura'].'-'.$row['hora'],0,0,'L');
      $pdf->Cell(20,5,$row['suc_ori'],0,0,'L');
      $pdf->Cell(15,5,'$'.number_format($row['imp_total'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['acuenta'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['saldo'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['pago'],2),0,0,'R');
      $pdf->ln(4);
    }
}


$pdf->ln(5);
// PAGO DE NOTAS DE en otra UNIDAD (detalle)
$sql="
SELECT  fa.id_factura,
  DATE_FORMAT(pa.fecha_pago,'%H:%i') AS hora,
  DATE(fa.fecha_factura) AS fecha_factura,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS cliente,
  suo.desc_sucursal AS suc_ori,
  sup.desc_sucursal AS suc_pag,
  fa.`imp_total`,
  fa.`imp_total`- pa.`imp_pagado` AS acuenta,
  pa.imp_pagado AS saldo,
  pa.imp_pagado AS pago
FROM so_pagos pa,
  so_factura fa,
  so_clientes cl,
  kg_sucursales suo,
  kg_sucursales sup
WHERE DATE(fa.fecha_factura) ='".$fecha_factura."'
  AND pa.fk_id_sucursal_ori = ".$id_sucursal."
  AND pa.fk_id_sucursal_pag <> pa.fk_id_sucursal_ori
  AND pa.`fk_id_factura`=fa.`id_factura`
  AND fa.`estado_factura` <> 5
  AND fa.fk_id_cliente = cl.id_cliente
  AND pa.`fk_id_sucursal_ori` = suo.id_sucursal
  AND pa.`fk_id_sucursal_pag` = sup.id_sucursal";

  //echo $sql;


      
      $pdf->ln(3);
      $pdf->Cell(9);
      $pdf->SetTextColor(0,153,0);
      $pdf->SetFont('Arial','B', 12);
      $pdf->Cell(185,5,'DETALLE DE NOTAS PAGADAS EN OTRA UNIDAD',0,0,'C');
      $pdf->ln(4);
      $pdf->SetFont('Arial','', 8);

      $pdf->ln(3);
      $pdf->Cell(9);
      $pdf->Cell(5,5,'#',0,0,'R');
      $pdf->Cell(12,5,'Id',0,0,'C');
      $pdf->Cell(10,5,'Hora',0,0,'L');
      $pdf->Cell(60,5,'Cliente',0,0,'C');
      $pdf->Cell(25,5,'Fecha',0,0,'C');
      $pdf->Cell(20,5,'Uni. Pago',0,0,'C');
      $pdf->Cell(15,5,'Importe',0,0,'C');
      $pdf->Cell(15,5,'A cuenta',0,0,'C');
      $pdf->Cell(15,5,'Resta',0,0,'C');
      $pdf->Cell(15,5,'Pago',0,0,'C');
      $pdf->ln(3);
      $pdf->Cell(185,5,'___________________________________________________________________________________________________________________________',0,0,'L');
      $pdf->ln(4);

if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      $num+=1;

      $pdf->Cell(9);
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
      $pdf->Cell(10,5,$row['hora'],0,0,'L');
      $pdf->Cell(60,5,utf8_decode($row['cliente']),0,0,'L');
      $pdf->Cell(25,5,$row['fecha_factura'].'-'.$row['hora'],0,0,'L');
      $pdf->Cell(20,5,$row['suc_pag'],0,0,'L');
      $pdf->Cell(15,5,'$'.number_format($row['imp_total'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['acuenta'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['saldo'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['pago'],2),0,0,'R');
      $pdf->ln(4);
    }
}



//Detalle de folios pendientes
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
DATE(fa.fecha_factura) as fecha_factura,
fa.porc_descuento
FROM so_factura fa,kg_tipo_pago tp,so_clientes cl
WHERE DATE_SUB('".$fecha_factura."', INTERVAL 30 DAY) <= DATE(fa.fecha_factura)
AND fa.fk_id_sucursal = '".$id_sucursal."'
AND fa.resta > 0
AND fa.estado_factura = 2
AND fa.fk_id_tipo_pago=tp.id_tipo_pago
AND fa.fk_id_cliente = cl.id_cliente
AND fa.`estado_factura` <> 5
";
//echo $sql;
// encabezados
      $pdf->ln(5);
      $pdf->Cell(9);
      $pdf->SetTextColor(255,0,0);
      $pdf->SetFont('Arial','B', 12);
      $pdf->Cell(185,5,'DETALLE DE SALDOS PENDIENTES (Ultimos 30 dias)',0,0,'C');
      $pdf->ln(5);
      $pdf->Cell(9);
      $pdf->SetFont('Arial','','8');
      $pdf->Cell(5,5,'#',0,0,'R');
      $pdf->Cell(12,5,'Id',0,0,'C');
      $pdf->Cell(10,5,'Hora',0,0,'L');
      $pdf->Cell(55,5,'Cliente',0,0,'C');
      $pdf->Cell(25,5,'Fecha',0,0,'C');
      $pdf->Cell(15,5,'Edo',0,0,'C');
      $pdf->Cell(8,5,'T.P.',0,0,'C');
      $pdf->Cell(5,5,'%',0,0,'C');
      $pdf->Cell(15,5,'Importe',0,0,'C');
      $pdf->Cell(15,5,'A cuenta',0,0,'C');
      $pdf->Cell(15,5,'Resta',0,0,'C');
      $pdf->ln(1);
      $pdf->Cell(9);
      $pdf->Cell(185,5,'________________________________________________________________________________________________________________________',0,0,'L');
      $pdf->Ln(5);
// fin encabezados
      $num=0;
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {

      $num+=1;
      $pdf->Cell(9);
      $pdf->SetFont('Arial','','8');       
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
      $pdf->Cell(10,5,$row['hora'],0,0,'L');
      $pdf->Cell(50,5,utf8_decode($row['cliente']),0,0,'L');
      $pdf->Cell(35,5,$row['fecha_factura'].' '.$row['hora'],0,0,'L');
      $pdf->Cell(7,5,$row['estado'],0,0,'C');
      $pdf->Cell(8,5,$row['tipopago'],0,0,'C');
      $pdf->Cell(5,5,$row['porc_descuento'],0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['imp_total'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['a_cuenta'],2),0,0,'R');
      $pdf->Cell(15,5,'$'.number_format($row['resta'],2),0,0,'R');

      $pdf->ln(5);
    }
}

//Fin de detalle de folios pendientes







// Firmas
      $pdf->ln(30);
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