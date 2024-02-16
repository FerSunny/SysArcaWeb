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
    es.desc_estudio AS estudio,
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
 

     if ($result = mysqli_query($con, $sql)) {
     
 
        while($row = $result->fetch_assoc())
        {

            //Javier modifica aqui  las coordenadas, SETXY es donde tienes que moverle
            // la primera pociones es el eje Y y la segunda posicion el eje X

            // columna izquierda

            // $paciente=$fila['paciente'];
            // $medico=$fila['medico'];
            // $fecha=$fila['fecha'];
            // $edad=$fila['edad'];
            // $estudio=$fila['estudio'];
            // $id_estudio=$fila['fk_id_estudio'];
            //Etiqueta Paciente
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(26, 50); 
            $pdf->Write(0,'PACIENTE:');            

            //spliteo del nombre para quitar a_paterno a_materno
            $splitNombre=explode(" ", $row['paciente']);
            $stringNombre=" ";
            for($j=0;$j<count($splitNombre);$j++){
                if($splitNombre[$j]=='a_paterno' || $splitNombre[$j]=='a_materno'){
                    $splitNombre[$j]='';
                }else{
                    $stringNombre=$stringNombre." ".$splitNombre[$j];
                }
                
            }
            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(46, 50); 
            $pdf->Write(0,strtoupper($stringNombre));  

            //Etiqueta Medico
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(116, 50); 
            $pdf->Write(0,'DR.(A):');   

            //Medico
            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(130, 50); 
            $pdf->Write(0,strtoupper($row['medico']));


            //=========================================================OTRA LINEA

            //Etiqueta Folio
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(26, 55); 
            $pdf->Write(0,'FOLIO:');            

            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(46, 55); 
            $pdf->Write(0,$numero_factura);  


            //Etiqueta Fecha
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(116, 55); 
            $pdf->Write(0,'FECHA:');            
            
            //Fecha
            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(130, 55); 
            setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
            $pdf->Write(0,date("F j, Y, g:i a"));

            //=======================================================>

            //Etiqueta Estudio
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(26, 60); 
            $pdf->Write(0,'ESTUDIO:');  

            // Estudio
            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(46, 60); 
            $pdf->Write(0,$row['estudio']);  

            //Etiqueta Edad
            $pdf->SetFont('Arial','B', 9);
            $pdf->SetXY(116, 60); 
            $pdf->Write(0,'EDAD:');    
            
            //Edad
            $pdf->SetFont('Arial','', 9);
            $pdf->SetXY(130, 60); 
            $pdf->Write(0,strtoupper($row['edad']));

        //================================================================>
        
        
            // Estudio
            //$pdf->SetFont('Arial','B', 14);
            //$pdf->SetXY(64, 80); 
            //$pdf->Write(0,strtoupper($row['estudio']));  

            //Etiqueta Edad
            //$pdf->SetFont('Arial','B', 11);
            //$pdf->SetXY(25, 95); 
            //$pdf->Write(0,'RESULTADO:');    
        }

    }

    //$sql="select concepto,valor,verificado,observaciones from cr_plantilla_2_re
    //where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;

    $sql="(select orden,concepto,valor,verificado,observaciones from cr_plantilla_2_re
    where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.") UNION
(SELECT p2.orden,p2.`concepto`,null,null,null FROM cr_plantilla_2 p2
WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo <> 'P') ORDER BY orden";
 
//echo $sql;

    $observaciones="";
     if ($result = mysqli_query($con, $sql)) {
     
        $row_suma=80;
        while($row = $result->fetch_assoc())
        {
            if ($row['observaciones']<>null){
                $observaciones=$row['observaciones'];
            }
            if($row['concepto']<>'0'){
            $pdf->SetFont('Arial','', 12);
            $pdf->SetXY(46, $row_suma); 
            $pdf->Write(0,strtoupper($row['concepto'])) ; 
        }


            $pdf->SetFont('Arial','B', 13);
            $pdf->SetXY(126, $row_suma); 
            $pdf->Write(0,' '.strtoupper($row['valor']).' '); 
            
            if(strlen($row['verificado'])>0){
                $pdf->SetFont('Arial','B', 13);
                $pdf->SetXY(166, $row_suma); 
                $pdf->Write(0,' '.strtoupper($row['verificado']).' ');  
            }


            $row_suma+=5;

        }
    }

    $pdf->SetFont('Arial','B', 9);
    $pdf->SetXY(26, 230); 
    $pdf->Write(0,'OBSERVACIONES'); 

    $pdf->SetFont('Arial','', 9);
    $pdf->SetXY(26, 235); 
    $pdf->Write(0,strtoupper($observaciones)); 


    //$pdf->SetFont('Arial','B', 9);
    //$pdf->SetXY(26, 250); 
    //$pdf->Write(0,'RESULTADO VERIFICADO *');     

    //$pdf->SetFont('Arial','B', 9);
    //$pdf->SetXY(26, 260); 
    //$pdf->Write(0,'VALIDO: Q.F.B. BARRANCO GARCIA MARCO ANTONIO CED. PROF. 1779615');     

    


    
    // $sql="select cantidad,
    // desc_estudio,
    // precio_venta,
    // km_indicaciones.desc_indicaciones 
    // from so_detalle_factura
    // inner join km_estudios on km_estudios.id_estudio=so_detalle_factura.fk_id_estudio
    // INNER JOIN km_indicaciones ON km_indicaciones.id_indicaciones =  km_estudios.fk_id_indicaciones 
    // where id_factura=".$numero_factura;
    // //Y,X
    // $linea_estudios=110;
    // if ($resultadoEstudios = mysqli_query($con, $sql)) {
    //     while($row = $resultadoEstudios->fetch_assoc())
    //     {
    //         $pdf->SetFont('Arial','', 12);
    //         $pdf->SetXY(18,$linea_estudios);
    //         $pdf->Write(0,$row['cantidad']);


    //         $pdf->SetFont('Arial','', 12);
    //         $pdf->SetXY(30,$linea_estudios);
    //         $pdf->Write(0,substr($row['desc_estudio'],0,48));

    //         $pdf->SetFont('Arial','', 12);
    //         $pdf->SetXY(178,$linea_estudios);
    //         $concat='$'.$row['precio_venta'];
    //         $pdf->Write(0,$concat);


    //         $linea_estudios=$linea_estudios+6;
    //         $pdf->SetFont('Arial','B', 9);
    //         $pdf->SetXY(30,$linea_estudios);
    //         $pdf->Write(0,'Indicaciones: '.substr($row['desc_indicaciones'],0,48));



    //         $linea_estudios=$linea_estudios+14;
    //     }
    // }   


    $pdf->Output();
}
 

?>