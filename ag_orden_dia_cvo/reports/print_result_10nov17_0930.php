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
    substr(es.desc_estudio,1,32) AS estudio,
    substr(es.desc_estudio,33,100) AS estudio1,
    es.desc_estudio AS estudio2,
    SUBSTR(es.desc_estudio,1,34) AS estudio,
    CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
    CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
    fa.fecha_factura AS fecha,
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
// echo $sql;
 
    $tfe=11;
    $nle=50; // numero de linea inicial del encabezado


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
            $pdf->SetXY(15,$nle ); 
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
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(15, $nle); 
            $pdf->Write(0,'ESTUDIO:');  

            // Estudio
            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(37, $nle); 
            $pdf->Write(0,$row['estudio']);  

            //Etiqueta Edad
            $pdf->SetFont('Arial','B',$tfe);
            $pdf->SetXY(118, $nle); 
            $pdf->Write(0,'EDAD:');    
            
            //Edad
            $pdf->SetFont('Arial','',$tfe);
            $pdf->SetXY(134, $nle); 
            $pdf->Write(0,utf8_decode(($row['edad'])));

        //====================================== TITULO DEL ESTUDIO==========================>
            $nle+=22;
            // centrar el titulo
            $r=90/2;
            $t=strlen($row['estudio2'])/2;
            $p=$r-$t; 
//echo $r.' '.$t.' '.$p;
            // Estudio
            $pdf->SetFont('Arial','B', 14);
            $pdf->SetXY(($p+18), $nle); 
            $pdf->Write(0,strtoupper($row['estudio2']));

        //================================================================>
        // Encabezados

            $nle+=13;

            switch ($row['estudio2']) {
                case 'ANTIGENO ESPECIFICO DE PROSTATA':
                        $nle+=25;
                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(30, $nle); 
                        $pdf->Write(0,'CONCEPTO');   

                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(94, $nle); 
                        $pdf->Write(0,'RESULTADO');  

                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(141, $nle); 
                        $pdf->Write(0,'VALORES DE REFERENCIA');

                        $nle-=12;
                    break;

                case 'TRIGLICERIDOS':
                        $nle+=35;
                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(30, $nle); 
                        $pdf->Write(0,'CONCEPTO');   

                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(94, $nle); 
                        $pdf->Write(0,'RESULTADO');  

                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(141, $nle); 
                        $pdf->Write(0,'VALORES DE REFERENCIA');

                        $nle-=22;
                    break;

                
                default:
                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(30, $nle); 
                        $pdf->Write(0,'CONCEPTO');   

                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(94, $nle); 
                        $pdf->Write(0,'RESULTADO');  

                        $pdf->SetFont('Arial','B', 9);
                        $pdf->SetXY(141, $nle); 
                        $pdf->Write(0,'VALORES DE REFERENCIA');
                    break;
            }
        }

    }


    $sql="(select tipo,orden,concepto,concat(LPAD(trim(valor),15,' '),' ',unidad_medida,verificado) as valor,CONCAT(unidad_medida,verificado) as unidad_medida,verificado,observaciones,CONCAT(valor_refe,' ',unidad_medida) AS valor_refe,tamfue,posini,tipfue FROM cr_plantilla_1_re
    where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.") UNION
(SELECT p2.tipo,p2.orden,p2.concepto,null,null,null,null,CONCAT(valor_refe,' ',unidad_medida) as valor_refe, tamfue,posini,tipfue FROM cr_plantilla_1 p2
WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo IN ('V','T','B','M')) ORDER BY orden";
 
//echo $sql;

//echo $nle;
    $observaciones="";
    $ti_fu='';
    $hay_obs='0';
    $tamfuecon='12';
     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {

            $tamfuecon=$row['tamfue'];

            if (strlen($row['observaciones'])>0){
                $hay_obs='1';
                $observaciones=$row['observaciones'];
            }

            if($row['tipo']=='M'){                
                $pdf->SetFont('Arial',$ti_fu,$tamfuecon);
                $pdf->SetXY($row['posini'],($nle-=6)); 
                $pdf->Write(0,$row['concepto']);
            }

            $pdf->SetFont('Arial',$ti_fu,$tamfuecon);
            $pdf->SetXY($row['posini'], $nle); 
            $pdf->Write(0,$row['concepto']); 


            $pdf->SetFont('Arial','B',$tamfuecon);
            $pdf->SetXY((88), $nle); 
            $pdf->Write(0,$row['valor']); 
/*
            $pdf->SetFont('Arial','B',$tamfuecon);
            $pdf->SetXY((121), $nle); 
            $pdf->Write(0,$row['unidad_medida']);
*/

/*
            if($row['concepto']=='ACIDO URICO'){
                $sexo=' HOMBRE';
            }else{
                $sexo='';
            }
*/
            switch ($row['concepto']) {
                case 'ACIDO URICO':
                    $sexo=' HOMBRE';
                    break;

                case 'GAMAGLUTAMIL TRANSPEPTIDASA (GGT)':
                    $sexo=' HOMBRE';
                    break;

                default:
                    $sexo='';
                    break;
            }

            $pdf->SetFont('Arial',$ti_fu, $tamfuecon);
            $pdf->SetXY((143), $nle); 
            $pdf->Write(0,utf8_decode($row['valor_refe']).$sexo);

            $nle+=4;

        }
    }
    if($hay_obs=='1'){
        $nle+=2;
        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(26, $nle); 
        $pdf->Write(0,'OBSERVACIONES'); 

        $nle+=5;
        $pdf->SetFont('Arial','', 9);
        $pdf->SetXY(26, $nle); 
        $pdf->Write(0,$observaciones); 
    } 

 
// firmas

    $row_last=(270-$nle)-13;

//echo $row_last;

    $nle+=$row_last;

    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F'";
 
//echo $sql;
     $pdf->Image('../imagenes/firma.gif',150,250,40,0);
     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {


            $pdf->SetFont('Arial',$row['tipfue'], $row['tamfue']);
            $pdf->SetXY($row['posini'], $nle); 
            $pdf->Write(0,$row['concepto']); 

            $nle+=4;
        }
    }
    $pdf->Output();
}
 

?>