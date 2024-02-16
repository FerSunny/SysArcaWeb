<?php
date_default_timezone_set('America/Mexico_City');
//setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
header('Content-Type: text/html; charset=ISO-8859-1');
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
    
    $sql="
    SELECT df.id_factura,
       SUBSTR(es.desc_estudio,1,32) AS estudio,
       SUBSTR(es.desc_estudio,33,100) AS estudio1, 
       es.desc_estudio AS estudio2,
       CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
    CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
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
    CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
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
 
    $tfe=11;
    $nle=50; // numero de linea inicial del encabezado

    $pdf->Image('../imagenes/logo_arca.png',15,5,140,0);
    $pdf->Image('../imagenes/pacal.jpg',160,5,40,0);

    $pdf->SetTextColor(26,35,126);
    $pdf->SetFont('Arial','B',15);
    $pdf->SetXY(47,33); 
    $pdf->Write(0,'UNIDAD CENTRAL ARCA TULYEHUALCO'); 

    $pdf->SetFont('Arial','',15);
    $pdf->SetXY(47,35); 
    $pdf->Write(0,'__________________________________________________________________________');

    $pdf->SetTextColor(0,0,0);

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
            $pdf->Write(0,utf8_decode($row['edad']));

        //====================================== TITULO DEL ESTUDIO==========================>
            $nle+=22;
            // centrar el titulo
            $r=90/2;
            $t=strlen($row['estudio2'])/2;
            $p=$r-$t; 
//echo $r.' '.$t.' '.$p;
            // Estudio
            $pdf->SetTextColor(26,35,126);
            $pdf->SetFont('Arial','B', 14);
            $pdf->SetXY(($p+18), $nle); 
            $pdf->Write(0,strtoupper($row['estudio2']));
            $pdf->SetTextColor(0,0,0);

        //================================================================>
        // Encabezados

            $nle+=13;
//echo '-'.$row['estudio2'].'-';
            switch ($studio) {
                case '130': //ANTIGENO ESPECIFICO DE PROSTATA
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

                case '535': //TRIGLICERIDOS
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

                case '476': //PERFIL TIROIDEO BASICO I
                        $nle+=21;
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

                case '260': //ELECTROLITOS SERICOS ( 3 ) 
                        $nle+=21;
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



//LPAD(valor ,12,' ') -- CONCAT(valor,'  ',unidad_medida,verificado) as 
    $sql="(select valor as valor_solo,tipo,orden,concepto,concat(LPAD(trim(valor),15,' '),' ',unidad_medida,verificado) as valor,concat(unidad_medida,verificado) as unidad_medida,verificado,observaciones,CASE
    WHEN fk_id_estudio = 274 THEN
        CONCAT(valor_refe) 
    ELSE
        CONCAT(valor_refe,' ',unidad_medida)
    END AS valor_refe,tamfue,posini,tipfue FROM cr_plantilla_1_re
    where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.") 
    UNION
(SELECT null,p2.tipo,p2.orden,p2.concepto,null,null,null,null,CASE
	WHEN fk_id_estudio = 274 THEN
		CONCAT(valor_refe)
	ELSE
		CONCAT(valor_refe,' ',unidad_medida)
END AS valor_refe, tamfue,posini,tipfue FROM cr_plantilla_1 p2
WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo IN ('V','T','B','M')) ORDER BY orden";
 
//echo $sql;

//echo '1'.$nle;
    $observaciones="";
    $ti_fu='';
    $hay_obs='0';
    $tamfuecon='12';
     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
//echo '2'.$nle;
            $tamfuecon=$row['tamfue'];

            if (strlen($row['observaciones'])>0){
                $hay_obs='1';
                $observaciones=$row['observaciones'];
            }


            if($row['tipo']=='M'){                
                $pdf->SetFont('Arial',$ti_fu,$tamfuecon);
                $pdf->SetXY($row['posini'],($nle-=5)); 
                $pdf->Write(0,$row['concepto']);
            }

            if($row['tipo']=='P' && strlen($row['valor_solo'])==0 and $studio=='274'){
                $nle+=1;
                $nle-=1;
            }else{
                    $pdf->SetFont('Arial',$ti_fu,$tamfuecon);
                    $pdf->SetXY($row['posini'], $nle); 
                    $pdf->Write(0,$row['concepto']); 


                    $pdf->SetFont('Arial','B',$tamfuecon);
                    $pdf->SetXY((88), $nle); 
                    $pdf->Write(0,$row['valor']); 

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
                    $pdf->SetXY((141), $nle); 
                    $pdf->Write(0,utf8_decode($row['valor_refe']).$sexo);

                    $nle+=4;
                  } //fin
        }
    }
    if($hay_obs=='1'){
        $nle+=2;
        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(26, $nle); 
        $pdf->Write(0,'OBSERVACIONES'); 

        $nle+=5;
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(26, $nle); 
        $pdf->Write(0,substr($observaciones,0,86)); 

        $nle+=4;
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(26, $nle); 
        $pdf->Write(0,substr($observaciones,87,85));

        $nle+=4;
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(26, $nle); 
        $pdf->Write(0,substr($observaciones,172,85)); 
    } 

 
// firmas

    $row_last=(260-$nle)-13;

//echo $row_last;

    $nle+=$row_last;

    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F'";
 
//echo $sql;
     $pdf->Image('../imagenes/firma.gif',150,235,40,0);

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {


            $pdf->SetFont('Arial',$row['tipfue'], $row['tamfue']);
            $pdf->SetXY($row['posini'], $nle); 
            $pdf->Write(0,$row['concepto']); 

            $nle+=4;
        }

    $pdf->SetFont('Arial','',15);
    $pdf->SetXY(47,259); 
    $pdf->Write(0,'__________________________________________________________________________');

    $pdf->SetTextColor(26,35,126); 
    $pdf->SetFont('Arial','B',16);
    $pdf->SetXY(65,268); 
    $pdf->Write(0,'www.laboratoriosarca.com.mx');

    $pdf->Image('../imagenes/whatsapp.jpg',10,272,7,0);
    $pdf->SetTextColor(27,94,32); 
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(16,276); 
    $pdf->Write(0,'55 3121 0700');
    $pdf->SetTextColor(0,0,0); 

    $pdf->Image('../imagenes/telefono.jpg',50,272,7,0);
    $pdf->SetTextColor(230,81,0); 
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(56,276); 
    $pdf->Write(0,'ACATEL: 216 141 44');
    $pdf->SetTextColor(0,0,0);

    $pdf->Image('../imagenes/email.jpg',105,272,7,0);
    $pdf->SetTextColor(26,35,126); 
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(110,276); 
    $pdf->Write(0,'atencion.cliente@laboratoriosarca.com.mx');
    $pdf->SetTextColor(0,0,0);

    }
    $pdf->Output();
}
 

?>