<?php 
  session_start();
    include("../../controladores/conex.php");
    date_default_timezone_set('America/Mexico_City');
  
    $cliente = $_GET['cliente'];
    $factura = $_GET['factura'];
    $fk_estudio = $_GET['estudio'];

    $query1="SELECT CONCAT(nombre,a_paterno,a_materno) nombre,anios 
             FROM so_clientes
             WHERE id_cliente = $cliente";
                     
    $result1 = $conexion->query($query1);
    $row1 = mysqli_fetch_array($result1);
    $paciente = $row1['nombre'];
    $edad = $row1['anios'];

   $query2="SELECT fa.fk_id_medico,fa.fecha_factura, CONCAT(me.nombre,' ',me.a_paterno,' ',a_materno) medico FROM    so_factura fa
            LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
            WHERE id_factura = $factura";
                     
    $result2 = $conexion->query($query2);
    $row2 = mysqli_fetch_array($result2);
    $medico = $row2['medico'];
    $fecha = $row2['fecha_factura'];
 
    $query3="SELECT desc_estudio FROM km_estudios WHERE id_estudio = $fk_estudio";
                     
    $result3 = $conexion->query($query3);
    $row3 = mysqli_fetch_array($result3);
    $estudio = $row3['desc_estudio'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap 4.1 14/03/2019-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- DataTable 1.10.19 14/03/2019-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.css"/>
    
    <!-- FontAwesome 5 14/03/2019-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
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
            <div class="card-body table-responsive">
                <h4 class="card-title">Captura de resultados</h4>
                <input type="hidden" name="id_factura" id="id_factura" value="<?php echo $_GET['factura']; ?>">
                <input type="hidden" name="id_estudio" id="id_estudio" value="<?php echo $_GET['estudio']; ?>">
                    <table style="width:100%;" id="t_plantilla2"  class="display" cellspacing="1" width="100%" >
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Tipo</th>
                                <th>Concepto</th>
                                <th>Resultado</th>
                                <th>Verificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query="SELECT  p2.orden,
                                          p2.tipo,
                                          p2.concepto
                                        FROM cr_plantilla_2 p2
                                        WHERE fk_id_estudio = ".$_GET['estudio']." AND estado ='A' AND tipo='P'
                                        ORDER BY orden";
                                $resultado = mysqli_query($conexion, $query);

                                if(!$resultado)
                                {
                                    die("Error");
                                    echo '<script> alert("No hay plantilla para este estudio")</script>';
                                }

                                $i=0;            
                                while($fila=mysqli_fetch_array($resultado))
                                {
                                    $orden = $fila['orden'];
                                    $tipo = $fila['tipo'];
                                    $concepto = $fila['concepto'];

                                    if(strlen($fila['concepto'])>0 && $tipo=='P')
                                    {
                                        $i++;
                                    }
      
                            ?>
                            <?php if(strlen($concepto)>0  && $tipo=='P'){?>
                            <tr>
                                <td><?php echo $orden?></td> 
                                <td><?php echo $tipo ?></td>
                                <td><?php echo trim($concepto); ?></td>
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
                                    <input style="color:red;font-weight: bold;" class="form-control" type="text" required name="fn_verificado" id="fi_verificado" maxlength="3" size="3" placeholder="*"/>
                                </td>
                            </tr>
                            <?php 
                                    } 
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <h3>
                            <span class="badge badge-secondary">Observaciones</span>
                        </h3>
                        <textarea class="form-control" id="observaciones" rows="1" maxlength="80" size="80" ></textarea>
                    </div>
                    <?php 
                        if($i>0)
                        { ?>
                        <button id="btn_guardar" type="button" class="btn btn-success" onclick="res()">
                            Guardar
                        </button>              
                    <?php 
                        }  
                    ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="../../media/js/jquery-1.12.3.js"></script>

    <!-- Bootstrap 4.1 14/03/2019-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <!-- DataTable 1.10.19 14/03/2019-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

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
                console.log(data)
            var dataTable = $('#t_plantilla2').DataTable();
            var dataForTable = dataTable
            .rows()
            .data();
            console.log(dataForTable.length)
            for (var i=0;i<dataForTable.length;i++){
                switch(data.array_datos[i]){
                    case "P O S I T I V O":
                        $('#fi_estado'+(i+1)).val('P O S I T I V O').change();
                        break;
                    case "N E G A T I V O":
                        $('#fi_estado'+(i+1)).val('N E G A T I V O').change();
                        break;
                    case "A":
                        $('#fi_estado'+(i+1)).val('A').change();
                    break;
                    case "B":
                        $('#fi_estado'+(i+1)).val('B').change();
                    break;
                    case "AB":
                        $('#fi_estado'+(i+1)).val('AB').change();
                    break;
                    case "O":
                        $('#fi_estado'+(i+1)).val('O').change();
                    break;
                }

                $('#fi_verificado').val(data.array_verificados[i]);

            }
             $('#observaciones').val(data.comentarios);
             $('#btn_update').text("Actualizar");

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
            var td3= $(this).find('select').val()
            var td4= $(this).find('#fi_verificado').val()
            var observaciones = $("#observaciones").val()
            var factura = $("#id_factura").val()
            var estudio = $("#id_estudio").val()

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
        
            $.ajax({
                type: "POST",                 
                url: "./actualizar.php",                    
                data: parametros,
                beforeSend: function(){
                },
                success: function(data)            
                {
                console.log(data)
                location.reload();
                }
            });  
        
        });
    }


    var tabla=$('#t_plantilla2').DataTable({
        "searching": false,
        "lengthChange": false,
        "bPaginate": false,
        "autoWidth" : false,
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
    });
</script>
</body>
</html>