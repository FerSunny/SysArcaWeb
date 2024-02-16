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


    $stmt = $conexion->prepare("SELECT
          fa.fecha_factura,
          CASE
            WHEN vmedico is null OR vmedico = '' then
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- DataTable 1.10.19 14/03/2019-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/><!-- Font Awesome -->
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <link rel="stylesheet" type="text/css" href="../../media/alert/dist/sweetalert2.css">

  </head>
  <body background="../../../imagenes/logo_arca_sys_web.jpg">
  <?php
		include("../../../includes/barra.php");
	?>
  <div class="container">
      <div class="card">
        <h4 class="card-header">Edición de resultados</h4>
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
		<input type="hidden" name="idfactura" id="idfactura" value="<?php echo $id_factura; ?>">
		<input type="hidden" name="idestudio" id="idestudio" value="<?php echo $fk_id_estudio; ?>">
        <table id="tb_plantilla2" class="table table-bordered table-hover" cellspacing="1" width="100%">
            <thead>
              <tr>
                <th> Orden </th>
                <th> Tipo </th>
                <th> Concepto </th>
                <th> Resultado </th>
                <th> Verificado </th>
              </tr>
            </thead>
            <tbody>
                        <?php
                          $query="SELECT  p2.orden,
                                          p2.tipo,
                                          p2.concepto
                                    FROM cr_plantilla_2 p2
                                  WHERE fk_id_estudio = ".$id_estudio." AND estado ='A' AND tipo='P'
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



                if(strlen($fila['concepto'])>0 && $tipo=='P'){

                  $i++;
                }

              ?>

                      <?php if(strlen($concepto)>0  && $tipo=='P'){?>
                        <tr>
                          <td><?php echo $orden?></td>
                          <td><?php echo $tipo ?></td>
                          <td>  <?php echo trim($concepto); ?> </td>
                          <td>
                            <select class="form-control" id="fi_estado<?php echo $i?>" name="fn_estado">
                                    <option value="P O S I T I V O">Positivo</option>
                                    <option value="N E G A T I V O">Negativo</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                  </select>
                          </td>
                          <td>
                            <input style="color:red;font-weight: bold;" class="form-control" type="text" required name="fn_verificado<?php echo $i?>" id="fi_verificado<?php echo $i?>" maxlength="3" size="3" placeholder="*"/>
                          </td>
                        </tr>
                      <?php?>
            <?php } }?>
            </tbody>
          </table>

          <div class="form-group">
            <h3><span class="badge badge-secondary">Observaciones</span></h3>
            <textarea class="form-control" id="observaciones" rows="1" maxlength="300" size="300" ></textarea>
          </div>

          <?php if($i>0){ ?>
            <button type="button" class="btn btn-success" id="btn_update">Guardar</button>
          <?php }  ?>


          <button id="btn_cancelar" type="button" class="btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>

<!--
  <script src="../../media/js/jquery-1.12.3.js"></script>
-->
  <script src="../../media/alert/dist/sweetalert2.js"></script>
  <!-- JQuery -->
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
  <!-- DataTable 1.10.19 14/03/2019-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
  <script>

  $( "#btn_update" ).click(function(){
    var arregloDatos=[];
    var counter=1;

    $('#tb_plantilla2 tbody tr').each(function ()
    {
        var td0= $(this).find('td').eq(0).html()
        var td1= $(this).find('td').eq(1).html()
        var td2= $(this).find('td').eq(2).html()
        var td3= $(this).find('select').val()
        var td4= $(this).find('#fi_verificado'+counter).val()
        var observaciones = $("#observaciones").val()
        var factura = $("#idfactura").val()
        var estudio = $("#idestudio").val()

        var parametros =
        {
            'td0' : td0,
            'td1' : td1,
            'td2' : td2,
            'td3' : td3,
            'td4' : td4,
            'observaciones' : observaciones,
            'factura' : factura,
            'estudio' : estudio
        }

        arregloDatos.push(parametros);
        counter++;
    });

    console.log(arregloDatos)

      Swal.fire({
        title: 'Editar estudio!',
        text: "Click en si para continuar!",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value)
        {
         setTimeout(function() {
              $.ajax({
                url:"./plantilla_2/actualizar.php",
                type: 'POST',
                data:{datas:JSON.stringify(arregloDatos)},
                dataType: "json",
                  success: function(datas){
                      console.log(datas)
                      Swal.fire({
                          title: 'El estudio fue editado correctamente!',
                          text: "Click en continuar!",
                          type: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          cancelButtonText: 'No',
                          confirmButtonText: 'Continuar'
                        }).then((result) => {
                          if (result.value)
                          {
                            location.reload()
                          }else
                          {
                            //console.log(data)
                            location.reload()
                          }
                        })
                  },
                  error:function(xhr, status, error){
                  console.log(xhr.responseText);
                  swal(
                          'Oops...',
                          'Error del servidor',
                          xhr.responseText
                   )
                 }
              }) //fin del ajax
            }, 300)
          }else
        {
          location.reload()
        }
      })

  })


  </script>
</body>
</html>
