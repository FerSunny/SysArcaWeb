
        $(document).on("ready", function(){
            listar()
            listar2()
      $.fn.dataTable.ext.errMode = 'none';
        });

// listar datos en la tabla de perfiles
        var listar = function(){
                $("#cuadro1").slideDown("slow");
            var table = $("#dt_historial").DataTable({
                "destroy":true,
                "sRowSelect": "multi",
                "ajax":{
                    "method":"POST",
                    "url": "listar.php"
                },
                "columns":[
                    {"data" : "id_detalle"},
                    {"data" : "empresa"},
                    {"data" : "desc_sucursal"},
                    {"data" : "usuario"},
                    {"data" : "importe_total"},
                    {"data" : "fecha_registro"},
                    {"defaultContent": "<button type='button' class='view btn btn-info btn-md'><i class='far fa-eye'></i></button>"},
                    {"defaultContent":"<button type='button' class='print btn btn-danger btn-md'><i class='fas fa-file-pdf'></i></button>"}
                ],
                "language": idioma_espanol
            });
      view("#dt_historial tbody", table)
      print("#dt_historial tbody", table)
        
}
var view= function(tbody, table) {
    $(tbody).on("click", "button.view", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        var id_detalle = data.id_detalle
        window.open("./detalles/tabla_detalles.php?val=" + id_detalle,'_blank')

    });
}

var print= function(tbody, table) {
    $(tbody).on("click", "button.print", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        var id_detalle = data.id_detalle
        window.open("./reports/reporte_proveedor.php?val=" + id_detalle,'_blank')
    
    });
}


var listar2 = function(){
                $("#cuadro1").slideDown("slow");
            var table = $("#dt_detalles").DataTable({
                "destroy":true,
                "sRowSelect": "multi",
                "ajax":{
                    "method":"POST",
                    "url": "./listar.php?val="+$("#id_detalle").val()
                },
                "columns":[
                    {"data" : "cod_producto"},
                    {"data" : "producto"},
                    {"data" : "cantidad"},
                    {"data" : "razon_social"},
                    {"data" : "costo_pza"},
                    {"data" : "fecha_registro"}
                ],
                "language": idioma_espanol

            });
      view("#dt_historial tbody", table)
      print("#dt_historial tbody", table)
        
}

    /* Idioma para el DataTable */
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


