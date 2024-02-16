$(document).on("ready", function() {
    $.fn.dataTable.ext.errMode = 'none';
    listar();
    busquedaPersonalizada();
});

$("#btn_listar").on("click", function() {
    listar();
});

// listar datos en la tabla de medicos
var listar = function() {
        $("#cuadro1").slideDown("slow");
        var table = $("#dt_resultados").DataTable({
            "aTargets": [ "_all" ],
            "destroy": true,
            "sRowSelect": "multi",
            "ajax": {
                "method": "POST",
                "url": "listar.php"
            },
            "columns": [
                { "data": "fk_id_estudio" },
                { "data": "fk_id_factura" },
                { "data": "desc_sucursal" },
                { "data": "nombre_paciente" },
                { "data": "desc_estudio" },
                { "data": "fecha_factura" },
                { "defaultContent": "<button type='button' class='print btn btn-danger' style='background-color: #DF0101 !important;'><i class='fas fa-file-pdf'></i></button>" },
                {
                    render: function(data,type,row)
                    {
                        var valid = row['validado']

                        if(valid == 0)
                        {
                            return "<button type='button' class='valid btn btn-success'><i class='fas fa-check'></i></button>"
                        }else
                        {
                            return ""
                        }

                    }
                },
                { "defaultContent": "<button type='button' class='window btn btn-primary'><i class='fas fa-edit'></button>"}
            ],
            "language": idioma_espanol
        });

        print("#dt_resultados tbody", table);
        validar("#dt_resultados tbody", table);
        modificar("#dt_resultados tbody", table);
    }
 //Impresion de resultados

 var print = function(tbody, table) {
    $(tbody).on("click", "button.print", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        var factura = data.fk_id_factura
        var estudio = data.fk_id_estudio
        var plantilla = data.fk_id_plantilla

        if(plantilla == 1)
        {
        window.open('./reports/print_plantilla_1.php?numero_factura='+factura+'&studio='+estudio, '_blank');
        }else
        if(plantilla == 2)
        {
            window.open('./reports/print_plantilla_2.php?numero_factura='+factura+'&studio='+estudio, '_blank');

        }else
        {
            alert("no existe esa plantilla")
        }
    });
}

 var validar = function(tbody, table) {
    $(tbody).on("click", "button.valid", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        var factura = data.fk_id_factura
        var estudio = data.fk_id_estudio
        var plantilla = data.fk_id_plantilla
        if(plantilla == 1)
        {
            $.post("./validar/validar_plantilla_1.php", {'factura' : factura, 'estudio' : estudio} ,function(data, status){
                if(data == 1)
                {
                    var table = $("#dt_resultados").DataTable()
                    table.ajax.reload()
                    Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Validando datos, espere porfavor',
                              showConfirmButton: false,
                              timer: 1000
                            })
                    //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
                }else
                {
                    Swal.fire('Error MySQL Codigo: ' + data)
                }
            });
        }else
        if(plantilla == 2)
        {
            $.post("./validar/validar_plantilla_2.php", {'factura' : factura, 'estudio' : estudio} ,function(data, status){
                if(data == 1)
                {
                    var table = $("#dt_resultados").DataTable()
                    table.ajax.reload()
                    Swal.fire({
                              position: 'top-end',
                              type: 'success',
                              title: 'Validando datos, espere porfavor',
                              showConfirmButton: false,
                              timer: 1000
                    })
                    //window.opener.document.location="../ag_orden_dia_p1_nvo/tabla_agenda.php";
                }else
                {
                    Swal.fire('Error MySQL Codigo: ' + data)
                }
            });
        }else
        {
            alert("no existe esa plantilla")
        }
    });
}


var modificar = function(tbody, table) {
    $(tbody).on("click", "button.window", function() {

    var data = table.row($(this).parents("tr")).data();
    
    if(data.fk_id_plantilla == 1)
    {
        window.open('./plantilla_1/frm_update.php?cliente='+data.fk_id_cliente+'&factura='+data.fk_id_factura+'&estudio='+data.fk_id_estudio, '_blank');
    }else
    {
        window.open('./plantilla_2/frm_update.php?cliente='+data.fk_id_cliente+'&factura='+data.fk_id_factura+'&estudio='+data.fk_id_estudio, '_blank');
    }

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

/*
 *Funcion que al ejecutar el boton de busqueda crea un JSON con los parametros a buscar
 * 
 */
var busquedaPersonalizada = function() {
    $("#btnFilter").click(function() {
        search("dt_clientes", "clientes");

    });

}