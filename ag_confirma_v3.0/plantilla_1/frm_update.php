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

    $stmt = $conexion->prepare("SELECT fa.fecha_factura, 
            CASE
            WHEN vmedico IS NULL OR vmedico = '' THEN
            CONCAT(me.nombre,' ',me.a_paterno,' ',a_materno) 
            ELSE
            fa.vmedico
            END medico 
            FROM so_factura fa
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
    <title>Plantilla 1</title>
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
                                FROM cr_plantilla_1_re p2
                                WHERE p2.fk_id_factura =".$_GET['factura']." AND p2.fk_id_estudio = ".$_GET['estudio']."   AND tipo = 'P'
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
                        <td>
                            <input class="form-control" type="text" required name="fn_medida<?php echo $i?>" id="fi_medida" maxlength="70" size="20" placeholder="Escriba el valor" value="<?php echo trim($unidad_medida);?>"/>
                          </td>
                          <td>
                            <input class="form-control" type="text" required name="fn_refe<?php echo $i?>" id="fi_refe" maxlength="30" size="20" placeholder="Escriba el valor" value="<?php echo trim($valor_refe); ?>"/>
                          </td>
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
                <button id="btn_update" type="button" class="btn btn-success">Guardar</button>
            <?php }  ?>
        </div>
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


    $("#btn_update").click(function()
    {
        var arregloDatos=[];
        var counter=1;

        $('#t_plantilla2 tbody tr').each(function ()
        {
            var td0= $(this).find('td').eq(0).html()
            var td1= $(this).find('td').eq(1).html()
            var td2= $(this).find('td').eq(2).html()
            var td3= $(this).find('#fi_resultado').val()
            var td4= $(this).find('#fi_verificado').val()
            var td5= $(this).find('#fi_medida').val()
            var td6= $(this).find('#fi_refe').val()
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
                      url:"./actualizar.php",
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
    });


    function res()
    {
        var trs=$("#t_plantilla2 tbody tr").length;
        tiempo = 100*trs

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


                      }else
                      {
                        Swal.fire('Error en MySQL, Error #'+data)
                      }

                }
            });
        Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: tiempo
        }).then((result) =>
        {
            if(result.dismiss === Swal.DismissReason.timer)
            {
                location.reload()
            }
        })

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




