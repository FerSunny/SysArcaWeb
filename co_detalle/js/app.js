 $(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';
    listar();
})

var listar = function()
{
    var folio = $("#folio").val()
    var table = $("#dt_detalle").DataTable({
                "destroy":true,
                "sRowSelect": "multi",
                "ajax":{
                    "method":"POST",
                    "url": "listar.php?val="+folio
                },
                "columns":[
                    {"data" : "folio_factura"},
                    {"data" : "fk_id_factura"},
                    {"data" : "paciente"},
                    {"data" : "importe"},
                    {"data" : "inicio"},
                    {"data" : "final"},
                    {"defaultContent":"<button type='button' class='view btn btn-info btn-md' data-toggle='modal' data-target='#modalEliminar'><i class='fas fa-eye'></i></button>"}
                ],
                "language": idioma_espanol
            });
    //view("#dt_detalle tbody", table)
        
}

var view= function(tbody, table) {
    $(tbody).on("click", "button.view", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        window.open("../co_detalle/tabla_detalle?val="+data.folio_factura, "_blank")
    });
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