<?php 
  session_start();
  include("../../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  //include("../../includes/barra.php");
  $data=json_decode($_POST['datas'],true);
 
  if(isset($data['v_id'])){
    $id_factura = $data['v_id'];
    $fk_id_estudio = $data['v_fk_id_estudio'];

    $consulta="
    SELECT fa.id_factura,
      dp.`fk_id_estudio`,
      es.`desc_estudio` AS estudio,
      CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
      CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
      fa.`fecha_factura` AS fecha,
      CONCAT(cl.anios,'a',cl.meses,'m',cl.dias,'d') edad 
    FROM so_factura fa
         LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
         LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico),
         so_detalle_factura df, 
         km_perfil_detalle dp,
         km_estudios es
    WHERE fa.`id_factura` = ".$id_factura."
      AND fa.`id_factura` = df.`id_factura`
      AND df.`fk_id_estudio`= dp.`fk_id_perfil`
      AND dp.`fk_id_estudio` = es.`id_estudio`
      AND dp.`fk_id_estudio`= ".$fk_id_estudio."

    UNION

                SELECT df.id_factura,
  pq.fk_id_estudio,
  es.desc_estudio AS estudio,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
  CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
  fa.`fecha_factura` AS fecha,
  CONCAT(cl.anios,'a',cl.meses,'m',cl.dias,'d') edad 
FROM km_paquetes pq
     LEFT OUTER JOIN km_estudios es ON (es.id_estudio = pq.fk_id_estudio),
     so_detalle_factura df,
     so_factura fa
     LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente) 
     LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico) 
WHERE  pq.id_paquete = df.fk_id_estudio
   AND df.id_factura = fa.id_factura
   AND df.`id_factura` = ".$id_factura." AND pq.`fk_id_estudio`= ".$fk_id_estudio."
                UNION
                SELECT  df.id_factura,
                      df.`fk_id_estudio`,
                      es.desc_estudio AS estudio,
                      CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
                      CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
                      fa.`fecha_factura` AS fecha,
                      CONCAT(cl.anios,'a',cl.meses,'m',cl.dias,'d') edad
                    FROM so_detalle_factura df
                    LEFT OUTER JOIN so_factura fa ON (fa.`id_factura`=df.`id_factura`)
                    LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
                    LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
                    LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
                    WHERE df.`id_factura` = ".$id_factura." AND df.`fk_id_estudio`= ".$fk_id_estudio;
                     
//echo $consulta;
              $ejecutar=mysqli_query($conexion, $consulta);

              if($fila = mysqli_fetch_array($ejecutar)){
                $paciente=$fila['paciente'];

                
                $splitPaciente = explode(" ", $paciente);
                $stringPaciente="";
                for($i=0;$i<count($splitPaciente);$i++){
                  if($splitPaciente[$i]!='a_paterno' && $splitPaciente[$i]!='a_materno'){
                    $stringPaciente=$stringPaciente.' '.$splitPaciente[$i];
                  }
                }
                $paciente=$stringPaciente;

                $medico=$fila['medico'];
                $fecha=$fila['fecha'];
                $edad=$fila['edad'];
                $estudio=$fila['estudio'];
                $id_estudio=$fila['fk_id_estudio'];
              }

  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Buttons DataTables -->



  </head>
  <body background="../../imagenes/logo_arca_sys_web.jpg">
  <?php
		include("../../includes/barra.php");
	?>
  <div class="container">
      <div class="card">
        <h4 class="card-header">Registro de resultados</h4>
        <div class="card-body">
          <!-- <h4 class="card-title">Special title treatment</h4> -->
          <h1 class="text-justify"><?php echo $estudio; ?></h1>
          <label id="studio" style="visibility:hidden;"><?php echo $id_estudio ?></label>
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="font-weight-bold">Paciente</label>
                  <label ><?php echo strtoupper($paciente); ?></label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="font-weight-bold">Dr(a):</label>
                  <label ><?php echo strtoupper($medico); ?></label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="font-weight-bold">Fecha</label>
                  <label ><?php echo $fecha; ?></label>
                </div>
              </div>
          </div>

          <div class="row">
              

              <div class="col-md-6">
                <div class="form-group">
                  <label class="font-weight-bold ">Edad</label>
                  <label ><?php echo $edad; ?></label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label  class="font-weight-bold">Folio</label>
                  <label id="folio"><?php echo $id_factura; ?></label>
                </div>
              </div>
          </div>
        </div>
      </div> <!-- fin card-->

      <div class="card">
      <div class="card-body">
        <h4 class="card-title">Captura de resultados</h4>

        <table style="width:100%;" id="t_plantilla2"  class="display" cellspacing="0" width="100%" >
            <thead>
              <tr>
                <th> Orden </th>
                <th> Tipo </th>
                <th> Concepto </th>
                <th> Resultado </th>
                <th> Verificado </th>
                <th> Unidad Medida </th>
                <th> Valor Referencia </th>
                <th> TaFu </th>
                <th> TiFu </th>
                <th> PosIni </th>
              </tr>
            </thead>
            <tbody>
                        <?php
                          $query="SELECT  p2.orden,
                                          p2.tipo,
                                          p2.concepto,
                                          p2.unidad_medida,
                                          p2.valor_refe,
                                          p2.tamfue,
                                          p2.tipfue,
                                          p2.posini
                                    FROM cr_plantilla_1 p2
                                  WHERE fk_id_estudio = ".$id_estudio." AND estado ='A' AND tipo = 'P'
                                ORDER BY orden";
                                $resultado = mysqli_query($conexion, $query);

                              if(!$resultado){
                                  die("Error");
                                  echo '<script> alert("No hay plantilla para este estudio")</script>';
                              }

                              $i=0;            
              while($fila=mysqli_fetch_array($resultado)){
                $orden = $fila['orden'];
                $tipo = $fila['tipo'];
                $concepto = $fila['concepto'];
                $valor_refe = $fila['valor_refe'];
                $unidad_medida = $fila['unidad_medida'];
                $tamfue = $fila['tamfue'];
                $tipfue = $fila['tipfue'];
                $posini = $fila['posini'];

                if(strlen($fila['concepto'])>0 && $tipo=='P'){
                  
                  $i++;
                }
      
              ?>
                     
                        <?php if(strlen($fila['concepto'])>0 && $tipo=='P'){?> 
                        <tr>
                          <td><?php echo $orden?></td> 
                          <td><?php echo $tipo ?></td>
                          <td><?php echo trim($concepto); ?> </td>
                          <td>
                            <input class="form-control" type="text" required name="fn_resultado<?php echo $i?>" id="fi_resultado<?php echo $i?>" maxlength="20" size="20" placeholder="Escriba el valor"/>
                          </td>

                          <td>
                            <input style="color:red;font-weight: bold;" class="form-control" type="text" required name="fn_verificado<?php echo $i?>" id="fi_verificado<?php echo $i?>" maxlength="1" size="1" placeholder="*"/>
                          </td>

                          <td> <?php echo trim($unidad_medida); ?> </td>
                          <td> <?php echo trim($valor_refe); ?> </td>
                          <td> <?php echo $tamfue?> </td>
                          <td> <?php echo $tipfue?> </td>
                          <td> <?php echo $posini?> </td>
                        </tr>
                      <!--
                      <?php?>
                      -->
            <?php } }?>
            </tbody>
          </table>

          <div class="form-group">
            <h3><span class="badge badge-secondary">Observaciones</span></h3>
            <textarea class="form-control" id="observaciones" rows="1"></textarea>
          </div>

          <?php if($i>0){ ?>
            <button id="btn_guardar" type="button" class="btn btn-success">Guardar</button>              
          <?php }  ?>


          <button id="btn_cancelar" type="button" class="btn btn-danger">Cancelar</button>
      </div>
    </div>



  </div>

  </body>
</html>




