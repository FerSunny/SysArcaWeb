$(document).ready(function(){
    //$.fn.dataTable.ext.errMode = 'none';
folio()
productos()
var t=$('#dt_sol').DataTable( {
    processing: true,
    serverSide: false,
    displayLength: 25,
    select: false,
    paging:   false,
    "pagingType": "false",
    "searching": false,
    "lengthChange": "false",
    "language": {
        "info":"Mostrando _START_ a _END_ de _TOTAL_ productos",
        "infoEmpty":      "No existen productos",
        "emptyTable":     "No existen productos",
        "search":         "Buscar:",
        "lengthMenu":     "Mostrar _MENU_ productos",
        "paginate": {
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
    }
    } );
add_producto(t)
});

function folio()
{
    $.post("./datos_ajax/folio.php", function(data, status){
        $("#folio").val(data);
    });
}

function  productos(){
          var tabla = $("#dt_pro").DataTable({

            "ajax": {
                "method": "POST",
                "url": "listar.php"
            },
            "columns": [
                {"data" : "id_proveedor"},
                {"data" : "cod_producto"},
                {"data" : "producto"},
                {"data" : "desc_producto"},
                {"data" : "razon_social"},
                {"data" : "minimo"},
                {"data" : "maximo"},
                {"data" : "existencias"},
                {"data" : "costo_real"},
                {"defaultContent": '<input type="number" name="cant" id="cant" class="form-control" value="1">'},
                {"defaultContent" : "<button type='button' class='add btn btn-primary btn-md' data-toggle='modal' data-target='#modalEditar'><i class='fa fa-plus-circle'></button>"}
                ],
                 "language": idioma_espanol
            });
          //add_producto("#dt_pro tbody", tabla)
    }

 function add_producto(t) {
    $("#dt_pro tbody").on("click", ".add", function()
    {
        var id = $("#proveedor").val()
        var text = $('#proveedor option:selected').html()
        var data =$('#dt_pro').DataTable().row( $(this).parents('tr') ).data();
        var row = $(this).parents('tr');
        var cantidad_producto = row.find("td:nth-child(10)").children().val();
        var total = parseFloat(data.costo_producto*cantidad_producto)

        if(id == 0)
        {
            var id_proveedor = data.id_proveedor
            var proveedor = data.razon_social
        }else
        {
            id_proveedor = id
            proveedor = text
        }

        t.row.add( [
                id_proveedor,
                data.id_producto,
                data.cod_producto,
                data.desc_producto,
                proveedor,
                cantidad_producto,
                data.costo_real,
                parseFloat(total),
                "<button class='btn btn-danger btn-sm' onclick='remover_f(this)'><i  class='fa fa-times-circle delete_b'></i></button></td>"
        ] ).draw( false );
        sumar_precio()
    })
}


function guardar()
{
    var dataTable = $('#dt_sol').DataTable();
    var data = dataTable
    .rows()
    .data();
    var trs=$("#dt_sol tbody tr").length;

    if(data.length==0){
            swal({
                 title: 'Debe ingresar un producto como minimo',
                 html: $('<div>')
                         .addClass('some-class')
                         .text('Intente de nuevo.'),
                 animation: false,
                 customClass: 'animated tada'
                });
        }else
        {
            var parametros =
            {
                'imp_total' : $("#btn_importe").val()
            }


            $.ajax({
              type: "POST",
              data: parametros,
              url: "./datos_ajax/guardar_detalle.php",
              beforeSend: function(){
              },
              success: function(data)
                {
                  console.log(data)

                }
            });


            $('#dt_sol tbody tr').each(function ()
            {
            var td0 = $(this).find('td').eq(0).html();
            var td1 = $(this).find('td').eq(1).html();
            var td2 = $(this).find('td').eq(2).html();
            var td5 = $(this).find('td').eq(5).html();
            var td6 = $(this).find('td').eq(6).html();
            var td7 = $(this).find('td').eq(7).html();
            var folio = $("#folio").val()

            var parametros =
                {
                    'td0' : td0,
                    'td1' : td1,
                    'td2' : td2,
                    'td5' : td5,
                    'td6' : td6,
                    'td7' : td7,
                    'folio' : folio
                }



                $.ajax({
                  type: "POST",
                  url: "./datos_ajax/guardar_solicitud.php",
                  data: parametros,
                  beforeSend: function(){
                  },
                  success: function(data)
                    {
                        console.log(data)
                    }
                  });

           });
        }
    /**/

     $("#dt_sol tbody tr").remove();
     $("#btn_importe").val('0.00')

    dataTable
    .clear()
    .draw();

    folio()
}

function sumar_precio()
{
      var filas=document.querySelectorAll("#dt_sol tbody tr");

    var total=0;

    // recorremos cada una de las filas
    filas.forEach(function(e) {

        // obtenemos las columnas de cada fila
        var columnas=e.querySelectorAll("td");

        // obtenemos los valores de la cantidad y importe
        var cantidad=parseFloat(columnas[5].textContent);
        var importe=parseFloat(columnas[6].textContent);

        // mostramos el total por fila
        columnas[7].textContent=(cantidad*importe).toFixed(2);

        total+=cantidad*importe;
    });
    // mostramos la suma total
    //var filas=document.querySelectorAll("#tb_fac tfoot .ttotal .total");
    $("#btn_importe").val(total.toFixed(2))
    //$("#t_totalp").val(total.toFixed(2))
    //filas[5].textContent=total.toFixed(2);
 }

function remover_f(r)
{
    var trs=$("#dt_sol tbody tr").length;
    if(trs <= 1)
    {
        location.reload()
    }else
    {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("dt_sol").deleteRow(i);
    }
    sumar_precio()
    //cambio()
}

var idioma_espanol = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
