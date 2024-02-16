$(document).on("ready", function() {
    listar();
    busquedaPersonalizada();
});

$("#btn_listar").on("click", function() {
    listar();
});

// listar datos en la tabla de medicos
var listar = function() {
        $("#cuadro1").slideDown("slow");
        var table = $("#dt_clientes").DataTable({
            "destroy": true,
            "sRowSelect": "multi",
            "ajax": {
                "method": "POST",
                "url": "listar.php"
            },
            "columns": [
                { "data": "id_cliente" },
                { "data": "nombre" },
                { "data": "a_paterno" },
                { "data": "a_materno" },
                { "data": "edad" },
                { "data": "desc_sexo" },
                { "data": "desc_estado_civil" },
                { "data": "telefono_fijo" },
                { "data": "telefono_movil" },
                { "defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>" },
                { "defaultContent": "<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>" }
            ],
            "language": idioma_espanol
        });


        obtener_data_editar("#dt_clientes tbody", table);
        obtener_id_eliminar("#dt_clientes tbody", table);
    }
    // editamos clientes
var obtener_data_editar = function(tbody, table) {
    $(tbody).on("click", "button.editar", function() {
        var data = table.row($(this).parents("tr")).data();
        $("#frmedit #idcliente").val(data.id_cliente);
        $("#frmedit #fi_id_cliente").val(data.id_cliente);
        $("#frmedit #fi_rfc").val(data.rfc);
        $("#frmedit #fi_nombre").val(data.nombre);
        $("#frmedit #fi_apaterno").val(data.a_paterno);
        $("#frmedit #fi_amaterno").val(data.a_materno);

        $("#frmedit #fi_anios").val(data.anios);
        $("#frmedit #fi_meses").val(data.meses);
        $("#frmedit #fi_dias").val(data.dias);
        $("#frmedit #fi_sexo").val(data.fk_id_sexo);
        $("#frmedit #fi_estado_civil").val(data.fk_id_estado_civil);
        $("#frmedit #fi_ocupacion").val(data.fk_id_ocupacion);
        $("#frmedit #fi_tfijo").val(data.telefono_fijo);
        $("#frmedit #fi_movil").val(data.telefono_movil);
        $("#frmedit #fi_mail").val(data.mail);
        $("#frmedit #fi_Estado_fed").val(data.fk_id_estado);
        $("#frmedit #fi_municipio").val(data.fk_id_municipio);
        $("#frmedit #fi_Localidad").val(data.fk_id_localidad);
        $("#frmedit #fi_colonia").val(data.colonia);
        $("#frmedit #fi_cp").val(data.cp);
        $("#frmedit #fi_calle").val(data.calle);
        $("#frmedit #fi_numero").val(data.numero_exterior);
        $("#frmedit #fi_falta").val(data.fecha_registro);
        //$("#frmedit #fi_factualiza").val( data.fecha_actuaizacion);
        $("#frmedit #fi_estado").val(data.activo);

        console.log(data);


    });
}

// eliminndo mwdicos
var obtener_id_eliminar = function(tbody, table) {
    $(tbody).on("click", "button.eliminar", function() {
        var data = table.row($(this).parents("tr")).data();
        var id_cliente = $("#frmEliminarclientes #idcliente").val(data.id_cliente);
        cliente = $("#frmEliminarclientes #cliente").val(data.id_cliente);
        nombre = $("#frmEliminarclientes #nombre").val(data.nombre + ' ' + data.a_paterno + ' ' + data.a_materno);
        opcion = $("#frmEliminarclientes #opcion").val("eliminar");
        console.log(data);
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

/*
 *Funcion que al ejecutar el boton de busqueda crea un JSON con los parametros a buscar
 * 
 */
var busquedaPersonalizada = function() {
    $("#btnFilter").click(function() {
        search("dt_clientes", "clientes_h");

    });

}