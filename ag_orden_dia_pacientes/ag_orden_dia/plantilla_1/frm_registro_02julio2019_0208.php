<?php 
  session_start();
  include("../../../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  //include("../../includes/barra.php");
  $data=json_decode($_POST['datas'],true);
 
  if(isset($data['v_id'])){
    $id_factura = $data['v_id'];
    $fk_id_estudio = $data['v_fk_id_estudio'];

    $stmt = $conexion->prepare("SELECT id_estudio,desc_estudio FROM km_estudios WHERE id_estudio = ?");

    $stmt->bind_param('i', $fk_id_estudio);
    $stmt->execute();
    $stmt->bind_result($id_estudio,$estudio);
    $stmt->fetch();
    $stmt->close();


    $stmt = $conexion->prepare("SELECT fa.fecha_factura, 
    CASE	
    	WHEN vmedico is null then
			CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno)
        ELSE
        	vmedico
    end as medico,

    CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,cl.anios FROM    so_factura fa
            LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
            LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
            WHERE id_factura = ?");

    $stmt->bind_param('i', $id_factura);
    $stmt->execute();
    $stmt->bind_result($fecha,$medico,$paciente,$edad);
    $stmt->fetch();
    $stmt->close();
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Registro Resultados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.3/css/mdb.min.css" rel="stylesheet">
    <!-- DataTable 1.10.19 14/03/2019-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    
    <link rel="stylesheet" type="text/css" href="../../media/alert/dist/sweetalert2.css">



  </head>
  <body background="../../imagenes/logo_arca_sys_web.jpg">
  <?php
		include("../../../includes/barra.php");
	?>

    <style>
    #tam_fuentes{
      display:none;
    }
  </style>
  <div class="container">
      <div class="card">
        <h4 class="card-header">Registro de resultados</h4>
        <input type="hidden" name="perfil" id="perfil" value="<?php echo $_SESSION['fk_id_sucursal']; ?>">
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

        <table id="tb_plantilla1" class="table table-bordered table-hover" cellspacing="1" width="100%">
            <thead>
              <tr>
                <th> Orden </th>
                <th> Tipo </th>
                <th> Concepto </th>
                <th> Resultado </th>
                <th> Verificado </th>
                <th> Unidad Medida </th>
                <th> Valor Referencia </th>
                <th id="tam_fuentes"> TaFu </th>
                <th id="tam_fuentes"> TiFu </th>
                <th id="tam_fuentes"> PosIni </th>
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
                            <input class="form-control" type="text" required name="fn_resultado<?php echo $i?>" id="fi_resultado<?php echo $i?>" maxlength="20" size="20" placeholder="Escriba el valor" value="<?php if($id_estudio == '274' or $id_estudio == '963' or $id_estudio == '988' or $id_estudio == '1029'){
                            switch ($concepto) {
                                case 'DENSIDAD':
                                    $default_v='1.030';
                                    break;
                                case 'pH': 
                                    $default_v='5';
                                    break;
                                case 'LEUCOCITOS': 
                                    $default_v='Negativo';
                                    break;
                                case 'NITRITOS': 
                                    $default_v='Negativo';
                                    break;
                                case 'PROTEINAS': 
                                    $default_v='Negativo';
                                    break;
                                case 'GLUCOSA': 
                                    $default_v='Negativo';
                                    break;
                                case 'CUERPOS CETONICO': 
                                    $default_v='Negativo';
                                    break;
                                case 'UROBILINOGENO': 
                                    $default_v='Negativo';
                                    break;
                                case 'BILIRRUBINAS': 
                                    $default_v='Negativo';
                                    break;
                                case 'SANGRE': 
                                    $default_v='Negativo';
                                    break;
                                case 'COLOR': 
                                    $default_v='Voguel I';
                                    break;
                                case 'OLOR': 
                                    $default_v='Suigeneris';
                                    break;
                                case 'ASPECTO': 
                                    $default_v='Turbio';
                                    break;
                                case 'SEDIMENTO': 
                                    $default_v='Abundante';
                                    break;
                                case 'CELULAS EPITELIALES': 
                                    $default_v='(+)';
                                    break;
                                case 'BACTERIAS': 
                                    $default_v='(++)';
                                    break;
                                case 'LEUCOCITOS ': 
                                    $default_v='0-1';
                                    break;
                                case 'ERITROCITOS': 
                                    $default_v='No observables';
                                    break;
                                case 'FILAMENTO MUCOIDE': 
                                    $default_v='No observables';
                                    break;
                                case 'CELULAS RENALES':
                                      $default_v='No observables';
                                    break;
                                default:
                                    $default_v='';
                                    break;
                              }
                              echo $default_v;
                               }else 
                              {
                                echo '';
                              } 
                          ?>" />
                          </td>

                          <td>
                            <input style="color:red;font-weight: bold;" class="form-control" type="text" required name="fn_verificado<?php echo $i?>" id="fi_verificado<?php echo $i?>" maxlength="1" size="1" placeholder="*"/>
                          </td>

                          <td>
                            <?php
                              if($_SESSION['fk_id_sucursal'] == 1)
                              {
                            ?>
                            <input class="form-control" type="text" required name="fn_medida<?php echo $i?>" id="fi_medida<?php echo $i?>" maxlength="70" size="20" placeholder="Escriba el valor" value="<?php echo trim($unidad_medida);?>"/>
                            <?php   
                              }else
                              {
                            ?>
                            <input class="form-control" type="text" required name="fn_medida<?php echo $i?>" id="fi_medida<?php echo $i?>" maxlength="70" size="20" placeholder="Escriba el valor" value="<?php echo trim($unidad_medida);?>" readonly />
                            <?php 
                              }
                            ?>
                          </td>
                          <td>
                            <?php
                              if($_SESSION['fk_id_sucursal'] == 1)
                              {
                            ?>
                            <input class="form-control" type="text" required name="fn_refe<?php echo $i?>" id="fi_refe<?php echo $i?>" maxlength="30" size="20" placeholder="Escriba el valor" value="<?php echo trim($valor_refe); ?>"/>
                            <?php   
                              }else
                              {
                            ?>
                            <input class="form-control" type="text" required name="fn_refe<?php echo $i?>" id="fi_refe<?php echo $i?>" maxlength="30" size="20" placeholder="Escriba el valor" value="<?php echo trim($valor_refe); ?>" readonly/>
                            <?php 
                              }
                            ?>
                          </td>
                          <td id="tam_fuentes"> <?php echo $tamfue?> </td>
                          <td id="tam_fuentes"> <?php echo $tipfue?> </td>
                          <td id="tam_fuentes"> <?php echo $posini?> </td>
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

  <!-- Bootstrap tooltips -->
  <script src="../../media/alert/dist/sweetalert2.js"></script>

  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.3/js/mdb.min.js"></script>

  <!-- DataTable 1.10.19 14/03/2019-->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script></body>
</html>




