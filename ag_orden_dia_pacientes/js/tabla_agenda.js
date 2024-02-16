$(document).ready(function(){
  listar()
});

var listar = function() {
          var tabla = $("#dt_agenda").DataTable({
            "aTargets": [ "_all" ],
            "destroy": true,
            "sRowSelect": "multi",
            "ajax": {
                "method": "POST",
                "url": "listar.php"
            },
            "columns": [
                { "data" : "id_factura"}, 
                { "data" : "nombre"},
                { "data" : "fecha_factura"},
                { "defaultContent": "<button type='button' class='view btn btn-info'><i class='fas fa-eye'></i></button>"}
            ],

            "language": idioma_espanol
        });


        view_estudios("#dt_agenda tbody", tabla);
    }


/* Obtenemos datos para ver usuario */
var view_estudios = function(tbody, table) {
    $(tbody).on("click", "button.view", function() {
        var data = table.row($(this).parents("tr")).data();
        var factura = data.id_factura
        var cliente = data.id_cliente

        window.open('./ag_orden_dia/tabla_agenda.php?factura='+factura+'&paciente='+cliente, '_blank');
        //window.open('./ag_orden_dia/tabla_agenda.php?factura='+factura+'&paciente='+cliente, '_blank');

    });
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
    "sLoadingRecords": "Cargando...",
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


