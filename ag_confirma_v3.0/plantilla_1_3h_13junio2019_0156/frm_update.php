<?php 
  session_start();
    include("../../controladores/conex.php");
    date_default_timezone_set('America/Mexico_City');
  
    $cliente = $_GET['cliente'];
    $factura = $_GET['factura'];
    $fk_estudio = $_GET['estudio'];

    $stmt = $conexion->prepare("SELECT desc_estudio FROM km_estudios WHERE id_estudio = ?");

    $stmt->bind_param('i', $fk_estudio);
    $stmt->execute();
    $stmt->bind_result($estudio);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conexion->prepare("SELECT CONCAT(nombre,' ',a_paterno,' ',a_materno) nombre,anios FROM so_clientes WHERE id_cliente = ?");

    $stmt->bind_param('i', $cliente);
    $stmt->execute();
    $stmt->bind_result($paciente,$edad);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conexion->prepare("SELECT fa.fecha_factura, CONCAT(me.nombre,' ',me.a_paterno,' ',a_materno) medico FROM    so_factura fa
            LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
            WHERE id_factura = ?");

    $stmt->bind_param('i', $factura);
    $stmt->execute();
    $stmt->bind_result($fecha,$medico);
    $stmt->fetch();
    $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Plantilla 1 Curva 3H</title>
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
    <link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">

</head>
<body background="../../imagenes/logo_arca_sys_web.jpg">
<?php
include("../../includes/barra.php");
?>
<div class="container">
    <div class="card">
        <h4 class="card-header">Validacion de resultados</h4>
        <div class="card-body">
          <!-- <h4 class="card-title">Special title treatment</h4> -->
            <h1 class="text-justify"><?php echo $estudio; ?></h1>
            <label id="studio" style="visibility:hidden;"><?php //echo $id_estudio ?></label>
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
                      <label id="folio"><?php echo $factura; ?></label>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- fin card-->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Captura de resultados</h4>
            <input type="hidden" name="id_factura" id="id_factura" value="<?php echo $_GET['factura']; ?>">
            <input type="hidden" name="id_estudio" id="id_estudio" value="<?php echo $_GET['estudio']; ?>">
            <table id="t_plantilla2" class="table table-bordered table-hover" cellspacing="1" width="100%">
                <thead>
                  <tr>
                    <th> Orden </th>
                    <th> Tipo </th>
                    <th> Concepto </th>
                    <th> Resultado </th>
                    <th> Verificado </th>
                    <th> Unidad Medida </th>
                    <th> Valor Referencia </th>
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
                                WHERE fk_id_estudio = ".$_GET['estudio']." AND estado ='A' AND tipo = 'P'
                                ORDER BY orden";
                                $resultado = mysqli_query($conexion, $query);

                        if(!$resultado)
                        {
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
                            if(strlen($fila['concepto'])>0 && $tipo=='P')
                            {
                            $i++;
                            }
      
                    ?>
                    
                    <tr>
                        <td><?php echo $orden?></td> 
                        <td><?php echo $tipo ?></td>
                        <td><?php echo trim($concepto); ?> </td>
                        <td>
                            <?php 
                                if($concepto=='Volumen Corpuscular Medio (VCM)' OR $concepto=='Conc Media de Hemoglobina (CMH)' OR $concepto=='Conc Media de Hemoglobina Corpuscular (CMHC)')
                                {
                             ?>
                            <input class="form-control" type="text" required name="fn_resultado<?php echo $i?>" id="fi_resultado" maxlength="20" size="20" placeholder="Escriba el valor" readonly/>
                            <?php
                                }else
                                {?>
                                <input class="form-control" type="text" required name="fn_resultado<?php echo $i?>" id="fi_resultado" maxlength="20" size="20" placeholder="Escriba el valor"/>
                            <?php 
                                } 
                            ?>
                        </td>
                        <td>
                            <input style="color:red;font-weight: bold;" class="form-control" type="text" required name="fn_verificado<?php echo $i?>" id="fi_verificado" maxlength="1" size="1" placeholder="*"/>
                        </td>

                        <td> <?php echo trim($unidad_medida); ?> </td>
                        <td> <?php echo trim($valor_refe); ?> </td>
                    </tr>
                      <!--
                      <?php?>
                      -->
                    <?php 
                            
                        }
                    ?>
                </tbody>
            </table>
            <div class="form-group">
                <h3><span class="badge badge-secondary">Observaciones</span></h3>
                <textarea class="form-control" id="observaciones" rows="1"></textarea>
            </div>

            <?php if($i>0){ ?>
                <button id="btn_guardar" type="button" class="btn btn-success" onclick="res()">Guardar</button>   
            <?php }  ?>
        </div>
    </div>
    <div id="chart_div">
        
      </div> 
</div>
<script src="../../media/js/jquery-1.12.3.js"></script>
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

<!-- Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    $(document).ready(function(){
        var factura = $("#id_factura").val()
        var estudio = $("#id_estudio").val()

        var parametros = 
        {
            'id_factura' : factura,
            'id_estudio' : estudio
        }

        $.ajax({
            url:'./consulta_plantilla.php',
            data:parametros,
            type: 'POST',
            success:function(data)
            {
                console.log('data')
                var dataTable = $('#t_plantilla2').DataTable();
                var dataForTable = dataTable
                .rows()
                .data();
                for (var i=0;i<dataForTable.length;i++){
                    dataForTable[i][3]=dataForTable[i][3].substring(0,dataForTable[i][3].length-1)+'value="'+data.array_datos[i]+'">';
                    dataForTable[i][4] =dataForTable[i][4].substring(0,dataForTable[i][4].length-1)+'value="'+data.array_verificados[i]+'">';
                    dataTable.row(i).data(dataForTable[i]).draw();  
                }
                $('#observaciones').val(data.comentarios);
               
            }
        });

    });


    function res()
    {
        $('#t_plantilla2 tbody tr').each(function () 
        {
            var td0= $(this).find('td').eq(0).html()
            var td1= $(this).find('td').eq(1).html()
            var td2= $(this).find('td').eq(2).html()
            var td3= $(this).find('#fi_resultado').val()
            var td4= $(this).find('#fi_verificado').val()
            var td5 = $(this).find('td').eq(5).html()
            var td6 = $(this).find('td').eq(6).html()
            var factura = $("#id_factura").val()
            var estudio = $("#id_estudio").val()
            var observaciones = $("#observaciones").val()
            var parametros = 
            {
                'td0' : td0,
                'td1' : td1,
                'td2' : td2,
                'td3' : td3,
                'td4' : td4,
                'td5' : td5,
                'td6' : td6,
                'observaciones' : observaciones,
                'factura' : factura,
                'estudio' : estudio
            }

            $.ajax({
                type: "POST",                 
                url: "./actualizar.php",                    
                data: parametros,
                beforeSend: function(){
                },
                success: function(data)            
                {
                      if(data == 1)
                      {
                        Swal.fire({
                              title: 'Guardando datos',
                              text: "Click continuar",
                              type: 'success',
                              confirmButtonText: 'Continuar'
                            }).then((result) => {
                              if (result.value) {
                                grafica()
                              }
                            })
                      }else
                      {               
                        Swal.fire('Error en MySQL, Error #'+data)
                      }

                }
            });  
        
        });
    }

    function grafica()
    {
        var factura = $("#id_factura").val()
        var estudio = $("#id_estudio").val()
        $.post("./datos_graficas.php", {'factura' : factura, 'estudio' : estudio},function(data, status){
            //data = jQuery.parseJSON(data);
            console.log(data.array_concepto)
            console.log(data.array_valor)
            var t1 = data.array_concepto[0]
            var v1 = parseFloat(data.array_valor[0])
            var t2 = data.array_concepto[1]
            var v2 = parseFloat(data.array_valor[1])
            var t3 = data.array_concepto[2]
            var v3 = parseFloat(data.array_valor[2])
            var t4 = data.array_concepto[3]
            var v4 = parseFloat(data.array_valor[3])
            var t5 = data.array_concepto[4]
            var v5 = parseFloat(data.array_valor[4])
            google.charts.load('current', {'packages':['corechart']});

            //Puede cambiar segun el tipo de grafica
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

              var data = google.visualization.arrayToDataTable([
                  ['hora','Referencia', 'Glucosa'],
                  [t1,71.0,v1,],
                  [t2,114.0,v2,],
                  [t3,99.0,v3,],
                  [t4,93.0,v4,],
                  [t5,69.0,v5,],
                ]);

              var options = {
                  title: 'Toma de muestras',
                  subtitle: 'in millions of dollars (USD)',
                width: 900,
                height: 500,
                axes: {
                  x: {
                    0: {side: 'top'}
                  }
                }
              };

              var chart_div = document.getElementById('chart_div');
              var chart =  new google.visualization.LineChart(chart_div);

              google.visualization.events.addListener(chart, 'ready', function () {
                  //chart_div.innerHTML = '<img class="img_google" src="' + chart.getImageURI() + '" class="img-responsive">';
                 //console.log(chart.getImageURI())
                 //$("#base64").val(chart.getImageURI())
                 var parametros = 
                 {
                    'factura' : factura,
                    'estudio' : estudio,
                    'base64' : chart.getImageURI()
                 }
                 $.ajax({
                    type: "POST",                 
                    url: "./guardar_img.php",                    
                    data: parametros,
                    beforeSend: function(){
                    },
                    success: function(data)            
                    {
                        console.log(data)
                          if(data == 1)
                          {
                            Swal.fire({
                              title: 'Grafica Creada Correctamente',
                              text: "Click continuar",
                              type: 'success',
                              confirmButtonText: 'Continuar'
                            }).then((result) => {
                              if (result.value) {
                                location.reload()
                                //console.log(data)
                                //grafica()
                                //window.open('','_parent',''); 
                                //window.close(); 

                              }
                            })
                            //
                          }else
                          {               
                            Swal.fire('Ocurrio un error')
                          }
                    }
                });
              });

              chart.draw(data, options);
            }
            
        }); 
    }

    var tabla=$('#t_plantilla2').DataTable( {
        "searching": false,
        "lengthChange": false,
        "bPaginate": false,
        "autoWidth" : true,
        "language": {
            "info":"",
            "infoEmpty":      "No existen productos",
            "emptyTable":     "No existen productos",
            "search":         "Buscar:",
            "lengthMenu":     "",
            
        },
        "columnDefs": [
            { "width": "150px", "targets": 0 },
            { "width": "160px", "targets": 1 },
            { "width": "210px", "targets": 2 },
            { "width": "250px", "targets": 3 },
            { "width": "150px", "targets": 4 }//,
            //{ "width": "210px", "targets": 5 },
            //{ "width": "150px", "targets": 6 },
            //{ "width": "210px", "targets": 7 }
          ],
    } );
</script>
</body>
</html>




