<?php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
 //Agregamos la libreria FPDF
 require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

 $pdf = new FPDF(); //Creamos un objeto de la librería
   $pdf->AddPage(); //Agregamos una Pagina
   $pdf->SetFont('Arial','B',16); //Establecemos tipo de fuente, negrita y tamaño 16

$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];


if (isset($_GET["numero_factura"]) && isset($_GET["studio"])) {
    
    $sql="SELECT  df.id_factura,
    df.fk_id_estudio,
    substr(es.desc_estudio,1,32) AS estudio,
    substr(es.desc_estudio,33,100) AS estudio1,
    es.desc_estudio AS estudio2,
    CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
    CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
    fa.fecha_factura AS fecha,
    CASE
        WHEN cl.anios > 0 THEN 
            CONCAT(cl.anios,' Anios')
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
 

    $tfe=11;
    $nle=60; // numero de linea inicial del encabezado

     if ($result = mysqli_query($con, $sql)) {
     
 
        while($row = $result->fetch_assoc())
        {
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(15, $nle); 
            $pdf->Write(0,'PACIENTE:');            

            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(37, $nle); 
            $pdf->Write(0,strtoupper($row['paciente']));  

            //Etiqueta Medico
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(118, $nle); 
            $pdf->Write(0,'DR.(A):');   

            //Medico
            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(134, $nle); 
            $pdf->Write(0,strtoupper($row['medico']));


            //=========================================================OTRA LINEA
            $nle+=5;
            //Etiqueta Folio
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(15,$nle); 
            $pdf->Write(0,'FOLIO:');            

            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(37, $nle); 
            $pdf->Write(0,$numero_factura);  


            //Etiqueta Fecha
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(118, $nle); 
            $pdf->Write(0,'FECHA:');            
            
            //Fecha
            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(134, $nle); 
            setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
            //$pdf->Write(0,date("F j, Y, g:i a"));
            $pdf->Write(0,$row['fecha']);
            //=======================================================>

            $nle+=5;
            //Etiqueta Estudio
            $pdf->SetFont('Arial','B', $tfe);
            $pdf->SetXY(15, $nle); 
            $pdf->Write(0,'ESTUDIO:');  

            // Estudio
            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(37, $nle); 
            $pdf->Write(0,$row['estudio']); 

            if($row['estudio1']<>' '){
                $nle+=5;
                $pdf->SetFont('Arial','', $tfe);
                $pdf->SetXY(37, $nle); 
                $pdf->Write(0,$row['estudio1']) ; 
                $nle-=5;
            }


            //Etiqueta Edad
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(118, $nle); 
            $pdf->Write(0,'EDAD:');    
            
            //Edad
            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(134, $nle); 
            $pdf->Write(0,strtoupper($row['edad']));

        //====================================== TITULO DEL ESTUDIO==========================>
            $nle+=33;
            // centrar el titulo
            $r=85/2;
            $t=strlen($row['estudio2'])/2;
            $p=$r-$t; 
//echo $r.' '.$t.' '.$p;
            // Estudio
            $pdf->SetFont('Arial','B', 14);
            $pdf->SetXY(($p+15), $nle); 
            $pdf->Write(0,strtoupper($row['estudio2'])); 
  
        }

    }

    //$sql="select concepto,valor,verificado,observaciones from cr_plantilla_2_re
    //where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;

    $sql="(select tipo,orden,concepto,valor,verificado,observaciones from cr_plantilla_2_re
    where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.") UNION
(SELECT p2.tipo,p2.orden,p2.concepto,null,null,null FROM cr_plantilla_2 p2
WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo IN ('T','B')) ORDER BY orden";
 
//echo $sql;

    $observaciones="";
     if ($result = mysqli_query($con, $sql)) {
     
        $row_suma=$nle+5;
        while($row = $result->fetch_assoc())
        {
/*  
            if ($row['observaciones']<>null){
                $observaciones=$row['observaciones'];
            }
*/
            $tft=12;
            $pir=46;
            if($row['tipo']=='T'){
                $tft=9;
                $pir=15;
            }
            if($row['concepto']<>'B'){
                $pdf->SetFont('Arial','', $tft);
                $pdf->SetXY($pir, $row_suma); 
                $pdf->Write(0,$row['concepto']) ; 
            }

            if(strlen($row['valor'])>0){
                $pdf->SetFont('Arial','B', 12);
                $pdf->SetXY(115, $row_suma); 
                $pdf->Write(0,'"'.$row['valor'].'"'); 
            }
            
            if(strlen($row['verificado'])>0){
                $pdf->SetFont('Arial','B', 12);
                $pdf->SetXY(155, $row_suma); 
                $pdf->Write(0,' '.strtoupper($row['verificado']).' ');  
            }


            $row_suma+=5;

        }
    }
/*
    $row_suma+=2;
    $pdf->SetFont('Arial','B', 9);
    $pdf->SetXY(26, $row_suma); 
    $pdf->Write(0,'OBSERVACIONES'); 

    $row_suma+=5;
    $pdf->SetFont('Arial','', 9);
    $pdf->SetXY(26, $row_suma); 
    $pdf->Write(0,strtoupper($observaciones)); 
*/

// firmas

    $row_last=(250-$row_suma);

//echo $row_last;

    $row_suma+=$row_last;

    $sql="SELECT p2.concepto FROM cr_plantilla_2 p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F'";
 
//echo $sql;
     $pdf->Image('../imagenes/firma.gif',150,240,40,0);
     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(15, $row_suma); 
            $pdf->Write(0,$row['concepto']); 

            $row_suma+=4;
        }     
  
    }

    $pdf->Output();
}
 

?>