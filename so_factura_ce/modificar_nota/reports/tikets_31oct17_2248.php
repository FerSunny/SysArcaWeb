<?php
date_default_timezone_set('America/Mexico_City');
 //Agregamos la libreria FPDF
 require('../../fpdf/fpdf.php');
 require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
 require_once('../reports/barcode.inc.php'); 

 
 
$numero_factura=$_GET['numero_factura'];

if (isset($_GET["numero_factura"])) {

    new barCodeGenrator($numero_factura,1,'../reports/codes/'.$numero_factura.'.gif', 160, 50, true);
 $pdf = new FPDF(); //Creamos un objeto de la librería
 $pdf->AddPage('L','ticket'); //Agregamos una Pagina
   $pdf->SetFont('Arial','B',16); //Establecemos tipo de fuente, negrita y tamaño 16


    //$row['id_medico']
    $sql="SELECT fa.fecha_factura, 
    su.desc_sucursal,
    substring(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,23) nombre,
    case 
      when cl.anios > 0 then
        CONCAT(cl.anios,' A&os')
      when cl.dias > 0 then
        concat(cl.dias,' Dias')
      when cl.meses > 0 then
        concat(cl.meses,' Meses')
    end as edad,
    substring(es.desc_estudio,1,35) as desc_estudio,
    substring(mu.desc_muestra,1,15) as muestra0,
    mu1.desc_muestra as muestra1,
    mu2.desc_muestra as muestra2,
    mu3.desc_muestra as muestra3,
    mu4.desc_muestra as muestra4
    FROM so_factura fa
    LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
    LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
    LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
    LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
    LEFT OUTER JOIN km_muestras mu ON (mu.id_muestra = es.fk_id_muestra)
    LEFT OUTER JOIN km_muestras mu1 ON (mu1.id_muestra = es.fk_id_muestra_1)
    LEFT OUTER JOIN km_muestras mu2 ON (mu2.id_muestra = es.fk_id_muestra_2)
    LEFT OUTER JOIN km_muestras mu3 ON (mu3.id_muestra = es.fk_id_muestra_3)
    LEFT OUTER JOIN km_muestras mu4 ON (mu4.id_muestra = es.fk_id_muestra_4)
    WHERE fa.id_factura=".$numero_factura;
 //echo $sql;
    
    $tamanioFuente=16;
    $row_fecha=2;
    $row_nombre_edad=2;
    $row_fila=5;
    $counter_tickets=0;
    $separador=7;

    //Nombre
     $pdf->SetFont('Arial','', $tamanioFuente);
     $pdf->SetXY(10,10);

     $today = date('d/m/y');
     $sucursal;
     $nombre;
     $edad;
     $descripcion;


     if ($result = mysqli_query($con, $sql)) {
     
        while($row = $result->fetch_assoc())
        {

            //Javier modifica aqui  las coordenadas, SETXY es donde tienes que moverle
            // la primera pociones es el eje Y y la segunda posicion el eje X
          //  echo $row['nombre'];

          $muestras=array();


          $nombre=$row['nombre'];
          $edad=$row['edad'];
          $descripcion=$row['desc_estudio'];
          $sucursal=$row['desc_sucursal'];
          
          if(strtoupper($row['muestra0'])!='SIN MUESTRA' && !empty($row['muestra0'])){
            array_push($muestras, $row['muestra0']);
          }

          if(strtoupper($row['muestra1'])!='SIN MUESTRA' && !empty($row['muestra1'])){
            array_push($muestras, $row['muestra1']);
          }

          if(strtoupper($row['muestra2'])!='SIN MUESTRA' && !empty($row['muestra2'])){
            array_push($muestras, $row['muestra2']);
          }

          if(strtoupper($row['muestra3'])!='SIN MUESTRA' && !empty($row['muestra3'])){
            array_push($muestras, $row['muestra3']);
          }

          if(strtoupper($row['muestra4'])!='SIN MUESTRA' && !empty($row['muestra4'])){
            array_push($muestras, $row['muestra4']);
          }



          for ($i = 0; $i < count($muestras); $i++) {
            
              $pdf->SetFont('Arial','',$tamanioFuente);
              
              //fecha
              $pdf->SetXY($row_fecha, $row_fila); 
              $pdf->Write(0,strtoupper($today));  
              $row_fecha+=25;
    
              //sucursal
              $pdf->SetXY($row_fecha, $row_fila); 
              $pdf->Write(0,strtoupper($sucursal));  
              
  
              $row_fila+=$separador;
              //Nombre
              $pdf->SetFont('Arial','',13);
              $pdf->SetXY($row_nombre_edad,$row_fila); 
              $pdf->Write(0,strtoupper($nombre));
              
              $row_fila+=$separador;
              //edad
              $pdf->SetFont('Arial','', $tamanioFuente);
              $pdf->SetXY($row_nombre_edad, $row_fila); 
              $pdf->Write(0,strtoupper($edad));
  
              $row_fila+=$separador;
              //descripcion del estudio
              $pdf->SetFont('Arial','', 10);
              $pdf->SetXY($row_nombre_edad, $row_fila); 
              $pdf->Write(0,strtoupper($descripcion));
  
              $row_fila+=$separador;
              //muestra
              $pdf->SetFont('Arial','',10);
              $pdf->SetXY($row_nombre_edad, $row_fila); 
              $pdf->Write(0,strtoupper($muestras[$i]));
  
              //folio
               $row_fila+=2;
              // $pdf->SetFont('Arial','B',$tamanioFuente);
              // $pdf->SetXY($row_nombre_edad, $row_fila); 
              // $pdf->Write(0,strtoupper($numero_factura));
  
  
              //barcode('codigos/'.$numero_factura.'.png', $numero_factura, 20, 'horizontal', 'code128', true);
              
              $pdf->Image('../reports/codes/'.$numero_factura.'.gif',$row_nombre_edad+12,$row_fila,70,0);
  
  
  
              // $row_fecha+=60;
              // $row_nombre_edad+=60;
  
              $row_fila=5;
              $row_fecha=2;
              $row_nombre_edad=2;
              $counter_tickets++;

              // if($counter_tickets==7){
                 $pdf->AddPage('L','ticket'); //Agregamos una Pagina
              //   $row_fecha=26;
              //   $row_nombre_edad=26;
              //   $row_fila=19;
              // }
          }











        }


        

        
            

    }

    
    $pdf->Output();
}
 

?>