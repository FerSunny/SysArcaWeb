    $(document).on("ready", function(){
      listar();
    });

    $("#btn_listar").on("click", function(){
        listar();
    });

    //listar datos en la tabla de pagos mensuales
    var listar = function(){
          $("#cuadro1").slideDown("slow");
        var table = $("#dt_pagomen").DataTable({
            "destroy":true,
            "sRowSelect": "multi",
            "ajax":{
                "method":"POST",
                "url": "listar.php"
            },
            "columns":[
                {"data": "desc_sucursal"},
                //Esta corresponde al año
                {"data": "p_anio"},
                //Esta corresponde al mes
                {"data": "p_mes"},
                {"data": "pago_efectivo"},
                {"data": "pago_tarjeta"},
                //ese es el nombre del atributo
                {"data": "imp_total"}
                //no va{"defaultContent": "<button type='button' class='editar btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa pencil-square-o'></i></button>"},
                //no va {"defaultContent": "<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar'> <i class='fa fa-transh-o'></i></button> "}
            ],
            "languaje": idioma_espanol
        });

/////////////////////////////////////////////////////////////Todo este codigo ya no iria
    
        //obtener_data_editar("#dt_pagomen tbody", table);
        //obtener_id_eliminar("#dt_pagomen tbody", table);
    }
    //editamos un pago mensual
    

    
    //elimando un pago mensual
   


        var idioma_espanol = {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }