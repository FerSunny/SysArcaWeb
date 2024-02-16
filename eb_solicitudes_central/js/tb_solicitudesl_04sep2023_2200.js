        $(document).on("ready", function(){
            $.fn.dataTable.ext.errMode = 'none';
            listar();
            //guardar();
            //eliminar();

              $('[data-toggle="tooltip"]').tooltip();
        });

        $("#btn_listar").on("click", function(){
            listar();
        });


// listar datos en la tabla de comisiones
        var listar = function(){
                $("#cuadro1").slideDown("slow");
            var table = $("#dt_lista").DataTable({
                "destroy":true,
                "sRowSelect": "multi",
                "ajax":{
                    "method":"POST",
                    "url": "listar.php"
                },
                "columns":[
                    {"data" : "id_detalle"},
                    {"data" :"desc_sucursal"},
                    {"data" : "nombre"},
                    {"data" : "proveedor"},
                    {"data" : "fecha_registro"},
                    {
                        render: function( data, type, row, meta )
                        {
                            if(row['estatus'] == 'C')
                            {
                                return '<span class="badge badge-danger">Creada</span>'
                            }else
                            if(row['estatus'] == 'P')
                            {
                                return '<span class="badge badge-warning">En Proceso</span>'
                            }else
                            if(row['estatus'] == 'E')
                            {
                                return '<span class="badge badge-success">Enviado</span>'
                            }else
                            if(row['estatus'] == 'R')
                            {
                                return '<span class="badge badge-info">Recibido</span>'
                            }else
                            if(row['estatus'] == 'I')
                            {
                                return '<span class="badge badge-light">Terminado</span>'
                            }else
                            if(row['estatus'] == 'L'){
                                return '<span class="badge badge-dark">Cancelado</span>'
                            }
                            else
                            {
                                return "Error"
                            }
                        }
                    },
                    {
                        render: function( data, type, row, meta )
                        {
                            if(row['estatus'] == 'C')
                            {
                                return "<button type='button' class='view btn btn-info'><i class='fa fa-eye'></i></button>"
                            }else
                            if(row['estatus'] == 'P')
                            {
                                return "<button type='button' class='view btn btn-info'><i class='fa fa-eye'></i></button>"
                            }else
                            {
                                return "<button type='button' class='view btn btn-info' disabled><i class='fa fa-eye'></i></button>"
                            }
                        }
                    },
                    {
                        render: function( data, type, row, meta )
                        {
                            if(row['tipo'] == 1)
                            {
                                return ""
                            }else
                            {
                                if(row['estatus'] == 'C')
                                {
                                    return "<button type='button' class='process btn btn-success' data-toggle='tooltip' title='Hooray!' disabled><i class='fa fa-check'></i></button>"
                                }else
                                if(row['estatus'] == 'P')
                                {
                                    return "<button type='button' class='process btn btn-success'><i class='fa fa-check'></i></button>"
                                }else
                                if(row['estatus'] == 'E')
                                {
                                    return "<button type='button' class='process btn btn-success' disabled><i class='fas fa-door-closed'></i></button>"
                                }else
                                if(row['estatus'] == 'R')
                                {
                                    return "<button type='button' class='process btn btn-success' disabled><i class='fa fa-check'></i></i></button>"
                                }else
                                if(row['estatus'] == 'I')
                                {
                                    return "<button type='button' class='process btn btn-success' disabled><i class='fa fa-check'></i></i></button>"
                                }
                            }
                        }
                    },
                    {
                        render: function( data, type, row, meta )
                        {
                            if(row['tipo'] == 1)
                            {

                                if(row['estatus'] == 'C')
                                {
                                    return "<button type='button' class='print_central btn btn-dark'><i class='fa fa-print'></i></button>"
                                }else
                                if(row['estatus'] == 'P')
                                {
                                    return "<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }else
                                if(row['estatus'] == 'E')
                                {
                                    return"<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }else
                                if(row['estatus'] == 'R')
                                {
                                    return"<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }else
                                if(row['estatus'] == 'I')
                                {
                                    return"<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"
                                }

                            }else
                            {
                                if(row['estatus'] == 'C')
                                {
                                    return "<button type='button' class='print btn btn-dark'><i class='fa fa-print'></i></button>"
                                }else
                                if(row['estatus'] == 'P')
                                {
                                    return "<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }else
                                if(row['estatus'] == 'E')
                                {
                                    return"<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }else
                                if(row['estatus'] == 'R')
                                {
                                    return"<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }else
                                if(row['estatus'] == 'I')
                                {
                                    return "<button type='button' class='print btn btn-dark' disabled><i class='fa fa-print'></i></button>"

                                }
                            }
                        }
                    },
                    {
                        render: function( data, type, row, meta )
                        {
                            if(row['tipo'] == 1)
                            {

                                if(row['estatus'] == 'C')
                                {
                                    return "<button type='button' class='delete btn btn-danger'><i class='fas fa-trash-alt'></i></button>"
                                }else
                                {
                                    return "<button type='button' class='print btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>"

                                }

                            }else
                            {
                                if(row['estatus'] == 'C')
                                {
                                    return "<button type='button' class='delete btn btn-danger'><i class='fas fa-trash-alt'></i></button>"
                                }else
                                {
                                    return "<button type='button' class='print btn btn-danger' disabled><i class='fas fa-trash-alt'></i></button>"

                                }
                            }
                        }
                    }
                ],

                "language": idioma_espanol
            });

            view_solicitudes("#dt_lista tbody", table);
            proceso_solicitudes("#dt_lista tbody", table);
            print_solicitudes("#dt_lista tbody", table);
            print_central("#dt_lista tbody", table);
            eliminar("#dt_lista tbody", table)
        }
        // editamos estado civil
        var view_solicitudes = function(tbody, table){
            $(tbody).on("click", "button.view", function(){
                var data = table.row( $(this).parents("tr") ).data();
                $("#modal_view").modal("show")
                var id_detalle = data.id_detalle
                detail_solicitudes(id_detalle)

            });
        }


        var proceso_solicitudes = function(tbody, table){
            $(tbody).on("click", "button.process", function(){
                var data = table.row( $(this).parents("tr") ).data();
                var tipo = 1;
                var id_detalle = data.id_detalle
                var es = 'E';

                $.post("./controladores/actualizar_estatus.php", { 'tipo' : tipo,'fk_id_detalle' : id_detalle, 'estatus' : es } ,function(data, status){
                    console.log(data)

                    if(data == 1)
                    {
                        var table = $("#dt_lista").DataTable()
                        table.ajax.reload()
                            console.log("1" + data)
                    }else
                    {
                        Swal.fire('Ocurrio un error: ' + data)
                            console.log("2" + data)
                    }

                });

                $.post("./controladores/actualizar_almacen.php", {'fk_id_detalle' : id_detalle} ,function(data, status){
                        console.log(data)
                    Swal.fire(data)
                });

            });
        }


// eliminndo la comision
        var print_solicitudes = function(tbody, table){
            $(tbody).on("click", "button.print", function(){
                var data = table.row( $(this).parents("tr") ).data();
                var tipo = 1;
                var id_detalle = data.id_detalle
                var es = 'P';

                $.post("./controladores/actualizar_estatus.php", { 'tipo' : tipo,'fk_id_detalle' : id_detalle, 'estatus' : es } ,function(data, status){
                    console.log(data)
                    if(data == 1)
                    {
                        var table = $("#dt_lista").DataTable()
                        table.ajax.reload()
                        window.open("./reports/reporte_unidad.php?val=" + id_detalle,'_blank')
                            console.log(data);
                    }else
                    {
                        Swal.fire('Ocurrio un error: ' + data)
                            console.log(data);
                    }

                });


                //var token = encodeURIComponent(window.btoa(iduser));
                //window.open("./generar_factura/solicitud_pdf.php?val="+token,'_blank')
            });
        }

        var print_central = function(tbody, table){
            $(tbody).on("click", "button.print_central", function(){
                var data = table.row( $(this).parents("tr") ).data();
                var id_detalle = data.id_detalle
                window.open("./reports/reporte_proveedor.php?val=" + id_detalle,'_blank')
            });
        }

        function eliminar(tbody, table){
                    $(tbody).on( 'click', '.delete ', function () {
                    var data = table.row( $(this).parents("tr") ).data();

                        var id = data.id_detalle;
                        swal({
                            title: '¿Eliminar Registro?',
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            cancelButtonText: 'No',
                            confirmButtonText: 'Si!',
                            type: 'info',
                            preConfirm: function() {
                                    return new Promise(function(resolve, reject) {
                                            setTimeout(function() {
                                             $.post("controladores/eliminar_solicitud.php",{"id":id, "listar" : 1}, function(data){
                                                 swal(data)
                                                 console.log(data)
                                             })
                                             var table = $('#dt_lista').DataTable(); // accede de nuevo a la DataTable.
                             table.ajax.reload();
                                            }, 300)
                                    })
                            },
                            allowOutsideClick: false
                            }).then(function(datoReturn) {
                                swal("El registro no se elimino");
                            });

                    });
                }



        function detail_solicitudes(id_detalle)
        {
            tabla = $('#de_sol').dataTable(
                {
                    "aProcessing" : true, //Activamos el procesamiento de datatables
                    "aServerSide" : false, //Paginacion y filtrado realizados por el servidor
                    dom: 'Bfrtip', //Definimos los elementos del control tabla
                    "ajax":
                          {
                            url : "./forms/listar.php?id="+id_detalle,
                            type : "get",
                            dataType : "json",
                            error: function(e)
                            {

                            }
                          },
                    "bDestroy" : true,
                    "iDisplayLength": 5, //Paginacion
                    "order": [[0, "desc"]] //Ordernar (columna, orden)
                })
        }

        function add_almacen(id,sol){


            $.post("controladores/buscar_productos.php",{"id": id, "sol":sol}, function(data){
                datos = jQuery.parseJSON(data);
                var fk_id_sucursal = datos[0].fk_id_sucursal
                var idsolicitud = datos[0].id_solicitud
                var idproducto = datos[0].fk_id_producto
                var idproveedor = datos[0].fk_id_proveedor
                var cantidad = datos[0].cantidad
                var fk_id_detalle = datos[0].fk_id_detalle
                var costo = datos[0].costo_total

                $.post("./controladores/productos_central.php",{ 'fk_id_sucursal' : fk_id_sucursal, 'idsolicitud' : idsolicitud, 'idproducto' : idproducto, 'idproveedor' : idproveedor, 'cantidad' : cantidad, 'costo' : costo}  , function(data, status){
                        if(data == 1)
                        {
                                console.log(data)
                                var table = $("#de_sol").DataTable()
                                table.ajax.reload();

                                var datos = table
                                        .rows()
                                        .data();

                                if(datos.length <= 1)
                                {
                                    console.log("Desactivar botones")
                                    var tipo = 2;
                                    var es = 'I'
                                    $.post("./controladores/actualizar_estatus.php", { 'tipo' : tipo,'fk_id_detalle' : fk_id_detalle, 'estatus' : es } ,function(data, status){
                                        console.log(datos)
                                        var table = $("#dt_lista").DataTable()
                                        table.ajax.reload()
                                    });

                                }else
                                {
                                    Swal.fire({
                                        position: 'top-end',
                                        type: 'success',
                                        title: 'Actualizando Almacen',
                                        showConfirmButton: false,
                                    timer: 1500
                                    })
                                    console.log(datos)
                                }
                        }else
                        {
                            Swal.fire('Ocurrio un error')
                            console.log(datos)
                        }
                });
            })
        }

        var table = $('#example').DataTable();

        $('#de_sol tbody').on( 'click', 'tr', function () {
            var d = table.row( this ).data();

            console.log(d)
        } );


        function view_productos(id,sol){
                $.post("controladores/buscar_productos.php",{"id": id, "sol":sol}, function(data){
                    datos = jQuery.parseJSON(data);
                    console.log(datos);
                    console.log(datos[0].desc_producto);
                    $("#frm_editp #edit_product").modal("show")
                    $("#frm_editp  label").attr('class','active')
                    $("#frm_editp #id_solicitud").val(datos[0].id_solicitud)
                    $("#frm_editp #iddetalle").val(datos[0].fk_id_detalle)
                    $("#frm_editp #producto").val(datos[0].desc_producto)
                    $("#frm_editp #proveedor").val(datos[0].razon_social)
                    $("#frm_editp #cantidad").val(datos[0].cantidad)
                    $("#frm_editp #costo").val(datos[0].costo_total)
                })
        }


    $("#frm_editp").on('submit', function(e)
    {
        e.preventDefault()
            $.ajax({
                type: "POST",
                url: "./controladores/actualizar_cantidad.php",
                data: $("#frm_editp").serialize(),
                beforeSend: function(){
                },
                success: function(data)
                {
                    if(data == 1)
                    {
                        var table = $("#de_sol").DataTable()
                        table.ajax.reload();
                        Swal.fire('Solicitud modificada')
                    }else
                    {
                        Swal.fire('Error Mysql, Error #' + data)
                    }

                }
          });

    })

    function delete_solcitud(id,sol){
        console.log(id)
        console.log(sol)
        swal({
            title: '¿Eliminar Registro?',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Si!',
            type: 'info',
            preConfirm: function() {
                    return new Promise(function(resolve, reject) {
                            setTimeout(function() {
                             $.post("controladores/eliminar_solicitud.php",{"id":sol, "listar" : 2}, function(data){
                                 swal(data)
                                 console.log(data)
                             })
                             var table = $('#de_sol').DataTable(); // accede de nuevo a la DataTable.
                             table.ajax.reload();
                            }, 300)
                    })
            },
            allowOutsideClick: false
            }).then(function(datoReturn) {
                swal("El registro no se elimino");
            });
    }



    function reload_table()
    {

        location.reload()
    }



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
