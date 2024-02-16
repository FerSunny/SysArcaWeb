$(document).ready(function() {

    //$('select').select2();
    listClientes();
    listmedicos();
    listProducts();

    var t = $('#data_facturacion').DataTable({
        "searching": false,
        "lengthChange": false,
        "language": {
            "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty": "No existen productos",
            "emptyTable": "No existen productos",
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ productos",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    addProduct(t);
    deleteProduct();
    recalculateButton();
    saveBill();
    reloadPage();
    updateBill();
    newClient();
    //trigerMedic();

});

function listClientes() {

    var data_result;

    $(".js-data-example-ajax").select2({
        ajax: {
            type: "GET",
            url: "./ajax/autocomplete/clientes.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                console.log("Imprimiendo valores")
                console.log(data)
                data_result = data;
                console.log("arreglo recibido", data);
                params.page = params.page || 1;

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.value,
                            id: item.id_cliente
                        }
                    }),
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1
        // templateResult: formatRepo, // omitted for brevity, see the source of this page
        // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    }).on('change', function(e) {
        var str = $("#s2id_search_code .select2-choice span").text();
        var idselect = $('#nombre_cliente').val();

        for (var i = 0; i < data_result.length; i++) {
            if (data_result[i].id_cliente == idselect) {
                $('#tel1').val(data_result[i].telefono_fijo);
                $('#mail').val(data_result[i].mail);
                $('#correo').val(data_result[i].correo);
                $('#colonia').val(data_result[i].colonia);
                $('#cp').val(data_result[i].cp);
                $('#calle').val(data_result[i].calle);
                $('#numero_exterior').val(data_result[i].numero_exterior);
                $('#celular').val(data_result[i].telefono_movil);
                break;
            }
        }
    }).on('select', function(e) {
        console.log("select");
    });
}

function listmedicos() {

    var data_result;

    $(".js-data-example-ajax-m").select2({
        ajax: {
            type: "GET",
            url: "./ajax/autocomplete/medicos.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                console.log("Imprimiendo valores medico")
                console.log(data)
                data_result = data;
                console.log("arreglo recibido medico", data);
                params.page = params.page || 1;

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.value,
                            id: item.id_medico
                        }
                    }),
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1
        // templateResult: formatRepo, // omitted for brevity, see the source of this page
        // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    }).on('change', function(e) {
        var str = $("#s2id_search_code .select2-choice span").text();
        var idselect = $('#nombre_medico').val();

     /*
        for (var i = 0; i < data_result.length; i++) {
            if (data_result[i].id_cliente == idselect) {
                $('#tel1').val(data_result[i].telefono_fijo);
                $('#mail').val(data_result[i].mail);
                break;
            }
        }
    */
    }).on('select', function(e) {
        console.log("select");
    });
}

function listProducts() {
    var table = $('#data_productos').DataTable({
        processing: true,
        serverSide: false,
        lengthMenu: [10, 25, 50],
        select: true,
        "language": {
            "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty": "No existen productos",
            "emptyTable": "No existen productos",
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ productos",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },

        "ajax": {
            "url": "./ajax/productos_factura.php?action=ajax",
            "type": "GET"
            //  success: function(response) {
            //      console.log(response);
            //
            // },
            // error:function(xhr, status, error){
            //  console.log("click");
            //  console.log(xhr.responseText);
            // }
        },
        "columns": [
            { "data": "id_estudio" },
            { "data": "desc_estudio" },
            {
                render: function(data, type, full, meta) {
                    return '<input type="number" min="1" value="1">';
                }
            },
            { "data": "costo" },
            {
                render: function(data, type, row) {
                    return '<button  id="add"  type="button" class="btn btn-info btn-md"><span  class="glyphicon glyphicon-plus"></span></button>'
                }
            }

        ],
        columnDefs: [{
            orderable: false,
            targets: [2]
        }],
        order: [
            [2, 'asc']
        ]
    });

}

function addProduct(t) {
    $('#data_productos tbody').on('click', '#add ', function() {
        var data = $('#data_productos').DataTable().row($(this).parents('tr')).data();

        var row = $(this).parents('tr');
        var cantidad_producto = row.find("td:nth-child(3)").children().val();
        var id_estudio = data.id_estudio;

        //var t = $('#data_facturacion').DataTable();
        //t.searching=false;


        t.row.add([
            id_estudio,
            cantidad_producto,
            data.desc_estudio,
            data.costo * cantidad_producto,
            '<button id="btnRemove_product" type="button" class="btn btn-danger btn-md"><span id="btnRemove" class="glyphicon glyphicon-remove"></span></button>'
        ]).draw(false);

        calculateTotalPrice();

    });
}

function deleteProduct() {
    var table = $('#data_facturacion').DataTable();
    $('#data_facturacion tbody').on('click', '#btnRemove_product', function() {

        var data = $('#data_facturacion').DataTable().row($(this).parents('tr')).data();




        table
            .row($(this).parents('tr'))
            .remove()
            .draw();

        calculateTotalPrice();

    });
}


function calculateTotalPrice() {
    var dataTable = $('#data_facturacion').DataTable();
    var dataForTable = dataTable
        .rows()
        .data();

    var jsonData = [];

    for (var i = 0; i < dataForTable.length; i++) {
        var temp = {
            id: dataForTable[i][0],
            cantidad: dataForTable[i][1]
        }
        jsonData.push(temp);
    }
    var jsonContainer = {
        ids: jsonData,
        descuento: $.trim($("#descuento").val()),
        incremento: $.trim($("#incremento").val()),
        acuenta: $.trim($("#acuenta").val()),
        accion: $('#factory_id').attr('value') != undefined ? $('#factory_id').attr('value') : ""
    };
    //Version 3.4.2 aplicada 17dic2020 jap
    // validar con contraseña el descuento  
    console.log($.trim($("#descuento").val())); 
    if ( $.trim($("#descuento").val())  > '0'){
        console.log('hay descuento  ren. 220' );
        //let recarga;
        swal({
            title: 'Ingrese la contraseña de autorización',
            input: 'password',
            showCancelButton: true,
            confirmButtonText: 'Verificar',
            showLoaderOnConfirm: true,
            preConfirm: function (pass) {
                return new Promise(function (resolve, reject) {
                   setTimeout(function() {
                            $.ajax({
                                url:"./ajax/validate_password.php",
                                type: 'POST',
                                data:{'password':pass},
                                async:false,
                                dataType: "JSON",
                                success: function(data){
                                            console.log(data);
                                            console.log('fue correcta');
                                            resolve()
                                            //updateFactura(datas);

                                            // recalcula el precio
                                            $.ajax({
                                                url: "./ajax/calculatePrice.php",
                                                type: 'POST',
                                                data: { datas: JSON.stringify(jsonContainer) },
                                                async: false,
                                                dataType: "JSON",
                                                success: function(data) {
                                                    console.log("calculoPrecioRecibido4", data);

                                                    $('#subtotal').text('$' + data.subtotal);
                                                    $('#subtotalDescuento').text('$' + data.descuento);
                                                    $('#subtotalIncremento').text('$' + data.incremento);
                                                    $('#total').text('$' + data.total);
                                                    $('#saldo').text('$' + formatNumber(parseFloat(data.saldo)));

                                                    if (parseFloat(data.saldo) < 0) {
                                                        swal(
                                                            'Oops...',
                                                            'El saldo no puede ser negativo',
                                                            ''
                                                        );
                                                        //$("#descuento").val('');
                                                        //$("#incremento").val('');
                                                        //$("#acuenta").val('');
                                                        //calculateTotalPrice();
                                                    }

                                                    for (var i = 0; i < dataForTable.length; i++) {
                                                        dataForTable[i][3] = parseFloat(data.array_descuentos[i]);
                                                        dataTable.row(i).data(dataForTable[i]).draw();

                                                    }
                                                    console.log('termino de calcular');

                                                },
                                                error: function(xhr, status, error) {
                                                    console.log(xhr.responseText);
                                                }
                                            }); //FIN AJAX
                                            // termina de recalcular el precio

                                },error:function(xhr, status, error){
                                        console.log(xhr.responseText);
                                            swal({
                                                        title: '!Contraseña Inválida',
                                                        html: $('<div>')
                                                                .addClass('some-class')
                                                                .text('Intente de nuevo o póngase en contacto con el administrador.'),
                                                        animation: false,
                                                        customClass: 'animated tada'
                                                        
                                                });
                                    }
                            }); //FIN AJAX
                            console.log('salio del ajax');
                            //clearTimeout(recarga);
                   }, 2000);
                    console.log('salidio del timer');
                })
            },
            allowOutsideClick: false
        })//.then(function (recalculateButton) {
       // })

    }else{
            console.log('no hay descuento Pos. 222' );
            // recalcula el precio

            $.ajax({
                url: "./ajax/calculatePrice.php",
                type: 'POST',
                data: { datas: JSON.stringify(jsonContainer) },
                async: false,
                dataType: "JSON",
                success: function(data) {
                    console.log("calculoPrecioRecibido3", data);

                    $('#subtotal').text('$' + data.subtotal);
                    $('#subtotalDescuento').text('$' + data.descuento);
                    $('#subtotalIncremento').text('$' + data.incremento);
                    $('#total').text('$' + data.total);
                    $('#saldo').text('$' + formatNumber(parseFloat(data.saldo)));

                    if (parseFloat(data.saldo) < 0) {
                        swal(
                            'Oops...',
                            'El saldo no puede ser negativo',
                            ''
                        );
                        //$("#descuento").val('');
                        //$("#incremento").val('');
                        //$("#acuenta").val('');
                        //calculateTotalPrice();
                    }

                    for (var i = 0; i < dataForTable.length; i++) {
                        dataForTable[i][3] = parseFloat(data.array_descuentos[i]);
                        dataTable.row(i).data(dataForTable[i]).draw();

                    }


                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            }); //FIN AJAX
        

         }
    // termina de recalcular el precio    
}

function recalculateButton() {
    $('#recalculate').click(function(e) {
        calculateTotalPrice();
    });
}


function saveBill() {
    $('#btnSaveBill').click(function(e) {
        var dataTable = $('#data_facturacion').DataTable();
        var data = dataTable
            .rows()
            .data();


        if (data.length == 0) {
            swal({
                title: 'Ingrese un estudio como mínimo',
                html: $('<div>')
                    .addClass('some-class')
                    .text('Intente de nuevo.'),
                animation: false,
                customClass: 'animated tada'
            });
        } else {
            $("#form-factura").validate({
                rules: {
                    nombre_cliente: "required",
                    tel1: "required",
                    mail: "required",
                    vendedor: "required",
                    fecha: "required",
                    fechaentrega: "required",
                    fi_medico: "required",
                    fi_comision: "required",
                    diagnostico: "required"

                },
                messages: {
                    nombre_cliente: "Ingrese el nombre del cliente",
                    tel1: "Ingrese un número telefonico válido",
                    mail: "Ingrese un correo válido",
                    vendedor: "Seleccione un vendedor",
                    fecha: "Ingrese una fecha válida",
                    fechaentrega: "Ingrese una fecha y hora válida",
                    fi_medico: "Seleccione un médico",
                    fi_comision: "Seleccione una comisión",
                    diagnostico: "Ingrese un diagnóstico",
                    medico_aux: "Ingrese el nombre del médico auxiliar"
                },

                submitHandler: function(form) {
                    //form.submit();
                    console.log("formulario valido");
                },
                highlight: function(element) {
                    $(element).css('background', '#ffdddd');
                },
                unhighlight: function(element) {
                    $(element).css('background', '#ffffff');
                }
            });

            if ($('#form-factura').valid()) {
                var splitDate = $('#fecha').val().split("/");
                var newfecha = splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0];
                if (new Date(newfecha) <= new Date($('#fechaentrega').val())) {

                    var jsonToInsert = {};
                    var jsonData = [];

                    for (var i = 0; i < data.length; i++) {
                        var temp = {
                            id: data[i][0],
                            cantidad: data[i][1],
                            precio_venta: data[i][3]
                        };
                        jsonData.push(temp);
                    }
                    var jsonContainer = {
                        ids: jsonData,
                        descuento: $.trim($("#descuento").val()),
                        incremento: $.trim($("#incremento").val()),
                        acuenta: $.trim($("#acuenta").val()),
                        accion: $('#factory_id').attr('value') != undefined ? $('#factory_id').attr('value') : ""
                    };


                    $.ajax({
                        url: "./ajax/calculatePrice.php",
                        type: 'POST',
                        data: { datas: JSON.stringify(jsonContainer) },
                        async: false,
                        dataType: "JSON",
                        success: function(data) {
                            jsonToInsert.subtotal = data.subtotal;

                            jsonToInsert.total = data.total;
                            jsonToInsert.saldo = data.saldo;

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    }); //FIN AJAX

                    if (jsonToInsert.saldo >= 0) {
                        var descuento = $.trim($('#descuento').val());
                        jsonToInsert.descuento = descuento.length > 0 ? $('#descuento').val() : 0;
                        var incremento = $.trim($('#incremento').val());
                        jsonToInsert.incremento = incremento.length > 0 ? $('#incremento').val() : 0;
                        var acuenta = $.trim($('#acuenta').val());
                        jsonToInsert.acuenta = acuenta.length > 0 ? $('#acuenta').val() : 0;
                        jsonToInsert.id_cliente = $('#nombre_cliente').val();
                        jsonToInsert.id_usuario = $('#id_vendedor').val();
                        jsonToInsert.id_medico = $('#fi_medico').val();
                        jsonToInsert.pago = $('#condiciones').val();
                        jsonToInsert.afecta_comision = $('#fi_comision').val();
                        jsonToInsert.diagnostico = $('#diagnostico').val();
                        jsonToInsert.idfacturacion = $('#idfacturacion').val();

                        jsonToInsert.mail = $('#mail').val();
                        jsonToInsert.correo = $('#correo').val();
                        jsonToInsert.colonia = $('#colonia').val();
                        jsonToInsert.cp = $('#cp').val();
                        jsonToInsert.calle = $('#calle').val();
                        jsonToInsert.numero_exterior = $('#numero_exterior').val();
                        jsonToInsert.tel1 = $('#tel1').val();
                        jsonToInsert.celular = $('#celular').val();
                        jsonToInsert.numturno = $('#numturno').val();

                        //jsonToInsert.urgente_p = $('#urgente_p').val();
                        //jsonToInsert.pendiente_p = $('#pendiente_p').val();

                        var p1 = parseInt($('input:checkbox[name=box_medico]:checked').val())
                        var p2 = parseInt($('input:checkbox[name=box_paciente]:checked').val())
                        var p3 = parseInt($('input:checkbox[name=req_factura]:checked').val())
                        var p4 = parseInt($('input:checkbox[name=acepta_p]:checked').val())

                        var p5 = parseInt($('input:checkbox[name=urgente_p]:checked').val())
                        var p6 = parseInt($('input:checkbox[name=pendiente_p]:checked').val())

                        if (p1 == 1) {
                            var val_m = 1
                            jsonToInsert.e_medico = val_m
                        } else {
                            var val_m = 0
                            jsonToInsert.e_medico = val_m
                        }

                        if (p2 == 1) {
                            var val_p = 1
                            jsonToInsert.e_paciente = val_p
                        } else {
                            var val_p = 0
                            jsonToInsert.e_paciente = val_p
                        }

                        if (p3 == 1) {
                            var val_f = 1
                            jsonToInsert.r_factura = val_f
                        } else {
                            var val_f = 0
                            jsonToInsert.r_factura = val_f
                        }

                        if (p4 == 1) {
                            var val_pu = 1
                            jsonToInsert.acepta_p = val_pu
                        } else {
                            var val_pu = 0
                            jsonToInsert.acepta_p = val_pu
                        }

                        if (p5 == 1) {
                            var val_urge = 1
                            jsonToInsert.urgente_p = val_urge
                        } else {
                            var val_urge = 0
                            jsonToInsert.urgente_p = val_urge
                        }

                        if (p6 == 1) {
                            var val_pen = 1
                            jsonToInsert.pendiente_p = val_pen
                        } else {
                            var val_pen = 0
                            jsonToInsert.pendiente_p = val_pen
                        }


                        //jsonToInsert.email=$('#email-fac').val();

                        jsonToInsert.estado_factura = $('#estadoFactura').val();
                        jsonToInsert.observaciones = $('#observaciones').val();
                        if ($('#medico_aux').val() !== undefined)
                            jsonToInsert.medico_aux = $('#medico_aux').val().length == 0 ? "" : $('#medico_aux').val();


                        var splitFecha = $('#fechaentrega').val();
                        var stringSplit = splitFecha.split("T");

                        jsonToInsert.fechaEntrega = stringSplit[0] + " " + stringSplit[1];
                        jsonToInsert.estudios = jsonData;


                        var generateId = 0;
                        swal({
                            title: '¿Guardar Factura?',
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            cancelButtonText: 'No',
                            confirmButtonText: 'Si,generar!',
                            type: 'info',
                            preConfirm: function() {
                                return new Promise(function(resolve, reject) {
                                    setTimeout(function() {
                                        $.ajax({
                                            url: "./ajax/insertBill.php",
                                            type: 'POST',
                                            data: { datas: JSON.stringify(jsonToInsert) },
                                            dataType: "json",
                                            success: function(datas) {


                                                generateId = datas.id;

                                                $('#nombre_cliente').val('')
                                                $('#tel1').val('');
                                                $('#mail').val('');
                                                $('#correo').val('');
                                                $('#colonia').val('');
                                                $('#cp').val('');
                                                $('#calle').val('');
                                                $('#numero_exterior').val('');
                                                //$('#id_vendedor').val('').trigger('change');
                                                $('#fi_medico').val('').trigger('change');;


                                                //$('#fi_medico').prop('selectedIndex', 0);
                                                $('#condiciones').val('').trigger('change');
                                                $('#fi_comision').val('').trigger('change');
                                                $('#diagnostico').val('')
                                                //$('#estadoFactura').val('');
                                                $('#observaciones').val('');
                                                $('#fechaentrega').val('');
                                                $('#acuenta').val('');

                                                $('#subtotal').text('$0');
                                                $('#subtotalDescuento').text('$0');
                                                $('#subtotalIncremento').text('$0');
                                                $('#total').text('$0');
                                                $('#saldo').text('$0');
                                                $('#descuento').val('');
                                                $('#incremento').val('');
                                                $('#acuenta').val('');
                                                $('#box_medico').val('');
                                                $('#box_paciente').val('');

                                                $('#urgente_p').val('');
                                                $('#pendiente_p').val('');

                                                $('#idfacturacion').val('');
                                                $('#containerMedicoAuxiliar').empty();
                                                resolve();
                                                dataTable
                                                    .clear()
                                                    .draw();
                                                $('#form-factura')[0].reset();
                                                $('#fi_medico').prop('selectedIndex', 0);


                                            },
                                            error: function(xhr, status, error) {
                                                console.log("click");
                                                console.log(xhr.responseText);
                                                $('#subtotal').text('$0');
                                                $('#subtotalDescuento').text('$0');
                                                $('#subtotalIncremento').text('$0');
                                                $('#total').text('$0');
                                                $('#saldo').text('$0')

                                                swal(
                                                    'Oops...',
                                                    'Error del servidor',
                                                    xhr.responseText
                                                )
                                            }
                                        }) //fin del ajax
                                    }, 300)
                                })
                            },
                            allowOutsideClick: false
                        }).then(function(datoReturn) {
                            console.log("datoReturn", datoReturn);
                            swal({
                                title: '<i>Reporte Generado Correctamente</i>',
                                type: 'success',
                                showCloseButton: true,
                                showCancelButton: true,
                                focusConfirm: false,
                                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
                                confirmButtonAriaLabel: 'Thumbs up, great!',
                                cancelButtonText:
                                '<a style="color:white;text-color:white;" target="_blank" href="./reports/factura.php?numero_factura=' + generateId + '" onclick="openTikets(' + generateId  + ');"><span style="color:white;text-color:white;" class="glyphicon glyphicon-print"></span> Imprimir</a>',
                                cancelButtonAriaLabel: 'Thumbs down',
                            })
                        });
                    } else {
                        swal(
                            'Oops...',
                            'El saldo no puede ser negativo',
                            ''
                        );
                    }


                } else {
                    swal({
                        type: 'error',
                        title: 'La fecha y hora deben ser mayor a la fecha actual!',
                    });
                }


            } //fin validacion del formulario
            else {
                swal({
                    title: 'Ingrese todos los datos',
                    html: $('<div>')
                        .addClass('some-class')
                        .text('Intente de nuevo.'),
                    animation: false,
                    customClass: 'animated tada'
                });
            }


        }


    });
}



function validateDate(callback) {
    var retorno = "";
    $.ajax({
        url: "./ajax/validate_datetime.php",
        type: 'POST',
        data: { fechaentrega: $('#fechaentrega').val() },
        async: true,
        dataType: "text",
        success: function(data) {
            callback(data);

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    }); //FIN AJAX
}

function reloadPage() {
    $('#btnClose').click(function(e) {
        location.reload(true);
    });
}

function updateBill() {

    $('#btnUpdateBill').click(function(e) {
        var factory_id = $('#factory_id').attr('value')
        var dataTable = $('#data_facturacion').DataTable();
        var data = dataTable
            .rows()
            .data();


        if (data.length == 0) {
            swal({
                title: 'Ingrese un estudio como mínimo',
                html: $('<div>')
                    .addClass('some-class')
                    .text('Intente de nuevo.'),
                animation: false,
                customClass: 'animated tada'
            });
        } else {
            $("#form-factura").validate({
                rules: {
                    nombre_cliente: "required",
                    tel1: "required",
                    mail: "required",
                    vendedor: "required",
                    fecha: "required",
                    fechaentrega: "required",
                    fi_medico: "required",
                    fi_comision: "required",
                    diagnostico: "required"
                },
                messages: {
                    nombre_cliente: "Ingrese el nombre del cliente",
                    tel1: "Ingrese un número telefonico válido",
                    email: "Ingrese un correo válido",
                    vendedor: "Seleccione un vendedor",
                    fecha: "Ingrese una fecha válida",
                    fechaentrega: "Ingrese una fecha y hora válida",
                    fi_medico: "Seleccione un médico",
                    fi_comision: "Seleccione una comisión",
                    diagnostico: "Ingrese un diagnóstico",
                    medico_aux: "Seleccione un médico"
                },

                submitHandler: function(form) {},
                highlight: function(element) {
                    $(element).css('background', '#ffdddd');
                },
                unhighlight: function(element) {
                    $(element).css('background', '#ffffff');
                }
            });

            if ($('#form-factura').valid()) {
                var splitDate = $('#fecha').val().split("/");

                var newfecha = $.trim("20" + splitDate[2]) + "-" + $.trim(splitDate[1]) + "-" + splitDate[0] + " 1:00:00";

                if (new Date(newfecha) <= new Date($('#fechaentrega').val())) {
                    var jsonToInsert = {};
                    var jsonData = [];

                    for (var i = 0; i < data.length; i++) {
                        var temp = {
                            id: data[i][0],
                            cantidad: data[i][1],
                            precio_venta: data[i][3]
                        };
                        jsonData.push(temp);
                    }
                    var jsonContainer = {
                        ids: jsonData,
                        descuento: $.trim($("#descuento").val()),
                        incremento: $.trim($("#incremento").val()),
                        acuenta: $.trim($("#acuenta").val()),
                        accion: $('#factory_id').attr('value') != undefined ? $('#factory_id').attr('value') : ""
                    };
                    console.log(JSON.stringify(jsonContainer));

                    $.ajax({
                        url: "./ajax/calculatePrice.php",
                        type: 'POST',
                        data: { datas: JSON.stringify(jsonContainer) },
                        async: false,
                        dataType: "JSON",
                        success: function(data) {
                            jsonToInsert.subtotal = data.subtotal;

                            jsonToInsert.total = data.total;
                            jsonToInsert.saldo = data.saldo;

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    }); //FIN AJAX

                    if (jsonToInsert.saldo >= 0) {
                        jsonToInsert.descuento = $('#descuento').val() > 0 ? $('#descuento').val() : 0;
                        jsonToInsert.incremento = $('#incremento').val() > 0 ? $('#incremento').val() : 0;
                        jsonToInsert.acuenta = $('#acuenta').val().length > 0 ? $('#acuenta').val() : 0;
                        jsonToInsert.id_cliente = $('#nombre_cliente').val();
                        jsonToInsert.id_usuario = $('#id_vendedor').val();
                        jsonToInsert.id_medico = $('#fi_medico').val();
                        jsonToInsert.pago = $('#condiciones').val();
                        jsonToInsert.afecta_comision = $('#fi_comision').val();
                        jsonToInsert.diagnostico = $('#diagnostico').val()
                        jsonToInsert.estado_factura = $('#estadoFactura').val();
                        jsonToInsert.observaciones = $('#observaciones').val();
                        jsonToInsert.factory_id = factory_id;
                        jsonToInsert.medico_aux = $('#medico_aux').val() == undefined ? "" : $('#medico_aux').val();
                        //Email paciente
                        var p1 = parseInt($('input:checkbox[name=box_medico]:checked').val())
                        var p2 = parseInt($('input:checkbox[name=box_paciente]:checked').val())
                        var p3 = parseInt($('input:checkbox[name=req_factura]:checked').val())
                        var p4 = parseInt($('input:checkbox[name=acepta_p]:checked').val())

                        var p5 = parseInt($('input:checkbox[name=urgente_p]:checked').val())
                        var p6 = parseInt($('input:checkbox[name=pendiente_p]:checked').val())

                        if (p1 == 1) {
                            var val_m = 1
                            jsonToInsert.e_medico = val_m
                        } else {
                            var val_m = 0
                            jsonToInsert.e_medico = val_m
                        }

                        if (p2 == 1) {
                            var val_p = 1
                            jsonToInsert.e_paciente = val_p
                        } else {
                            var val_p = 0
                            jsonToInsert.e_paciente = val_p
                        }

                        if (p3 == 1) {
                            var val_f = 1
                            jsonToInsert.r_factura = val_f
                        } else {
                            var val_f = 0
                            jsonToInsert.r_factura = val_f
                        }


                        if (p4 == 1) {
                            var val_pu = 1
                            jsonToInsert.acepta_p = val_pu
                        } else {
                            var val_pu = 0
                            jsonToInsert.acepta_p = val_pu
                        }
                        

                        if (p5 == 1) {
                            var val_urge = 1
                            jsonToInsert.urgente_p = val_urge
                        } else {
                            var val_urge = 0
                            jsonToInsert.urgente_p = val_urge
                        }

                        if (p6 == 1) {
                            var val_pen = 1
                            jsonToInsert.pendiente_p = val_pen
                        } else {
                            var val_pen = 0
                            jsonToInsert.pendiente_p = val_pen
                        }

                        
                        var splitFecha = $('#fechaentrega').val();
                        var stringSplit = splitFecha.split("T");

                        jsonToInsert.fechaEntrega = stringSplit[0] + " " + stringSplit[1];
                        jsonToInsert.estudios = jsonData;

                        console.log("JSONTOINSERT", jsonToInsert);

                        swal({
                            title: '¿Actualizar Factura?',
                            text: "Se actualizara toda la información!",
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            cancelButtonText: 'No',
                            confirmButtonText: 'Si,Actualizar!',
                            type: 'info',
                            preConfirm: function() {
                                return new Promise(function(resolve, reject) {
                                    setTimeout(function() {
                                        $.ajax({
                                            url: "./ajax/editar_facturacion.php",
                                            type: 'POST',
                                            data: { datas: JSON.stringify(jsonToInsert) },
                                            dataType: "json",
                                            success: function(datas) {
                                                console.log("entro en success");
                                                resolve();
                                                dataTable
                                                    .clear()
                                                    .draw();

                                                $('#nombre_cliente').val('');
                                                $('#tel1').val('');
                                                $('#mail').val('');
                                                $('#correo').val('');
                                                $('#colonia').val('');
                                                $('#cp').val('');
                                                $('#calle').val('');
                                                $('#numero_exterior').val('');
                                                $('#id_vendedor').val('');
                                                $('#fi_medico').val('');
                                                $('#condiciones').val('');
                                                $('#fi_comision').val('');
                                                $('#diagnostico').val('')
                                                //$('#estadoFactura').val('');
                                                $('#observaciones').val('');
                                                $('#fechaentrega').val('');

                                                $('#subtotal').text('$0');
                                                $('#subtotalDescuento').text('$0');
                                                $('#subtotalIncremento').text('$0');
                                                $('#total').text('$0');
                                                $('#saldo').text('$0');
                                            },
                                            error: function(xhr, status, error) {
                                                console.log("click");
                                                console.log(xhr.responseText);

                                                swal(
                                                    'Oops...',
                                                    'Error del servidor',
                                                    'error'
                                                )
                                            }
                                        }) //fin del ajax
                                    }, 300)
                                })
                            },
                            allowOutsideClick: false
                        }).then(function(email) {


                            swal({
                                title: '<i>Factura Actualizada Correctamente!</i>',
                                type: 'success',
                                showCloseButton: true,
                                showCancelButton: true,
                                focusConfirm: false,
                                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
                                confirmButtonAriaLabel: $('#btnClose').click(),
                                cancelButtonText: '<a role="button" class="btn btn-info" target="_blank" href="./reports/factura.php?numero_factura=' + factory_id + '" onclick="openTikets(' + factory_id + ');"><span class="glyphicon glyphicon-print"></span> Imprimir</a>',

                                cancelButtonAriaLabel: $('#btnClose').click(),
                            });
                        });
                    } else {
                        swal(
                            'Oops...',
                            'El saldo no puede ser negativo',
                            ''
                        );
                    }

                } else {
                    swal({
                        type: 'error',
                        title: 'La fecha y hora deben ser mayor a la fecha actual!',
                    });
                }


            } //fin validacion del formulario
            else {
                swal({
                    title: 'Ingrese todos los datos',
                    html: $('<div>')
                        .addClass('some-class')
                        .text('Intente de nuevo.'),
                    animation: false,
                    customClass: 'animated tada'
                });
            }


        }


    });
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function newClient() {
    $('#btn_create_client').click(function(e) {

        $("#fm_create_cliente").validate({
            rules: {
                fn_nombre: "required",
                fi_apaterno: "required",
                fi_amaterno: "required",
                fi_anios: "required",
                fi_meses: "required",
                fi_dias: "required",
                fi_sexo: "required",
                fi_movil: "required",
                //fi_estado_civil:"required",
                //fi_rfc:"required",
                //fi_ocupacion:"required",
                //fi_tfijo:"required",
                //fi_mail:"required",
                //fi_Estado:"required",
                //fi_municipio:"required",
                //fi_Localidad:"required",
                fi_colonia: "required",
                fi_cp: "required",
                fi_calle: "required",
                fi_numero: "required",
                fi_falta: "required",
                estado_reg: "required",
                fecha_nac: "required"
            },
            messages: {
                fn_nombre: "Ingrese un nombre",
                fi_apaterno: "Ingrese el apellido paterno",
                fi_amaterno: "Ingrese el apellido materno",
                fi_anios: "Ingrese los anio",
                fi_meses: "Ingrese los meses",
                fi_dias: "Ingrese los dias",
                fi_sexo: "Seleccione un sexo",
                fi_movil: "Ingrese un número movil",
                //fi_estado_civil:"Seleccione un estado civil",
                //fi_rfc:"Ingrese el rfc",
                //fi_ocupacion:"Seleccione una ocupación",
                //fi_tfijo:"Ingrese un número telefonico",
                //fi_mail:"Ingrese un correo",
                //fi_Estado:"Seleccione un estado",
                //fi_municipio:"Seleccione un municipio",
                //fi_Localidad:"Seleccione una localidad",
                fi_colonia: "Seleccione una colonia",
                fi_cp: "Ingrese el código postal",
                fi_calle: "Ingrese una calle",
                fi_numero: "Ingrese el número",
                fi_falta: "",
                estado_reg: "Seleccione un estatus",
                fecha_nac: "Seleccione una fecha"

            },

            submitHandler: function(form) {
                //form.submit();
                console.log("formulario valido");
            },
            highlight: function(element) {
                $(element).css('background', '#ffdddd');
            },
            unhighlight: function(element) {
                $(element).css('background', '#ffffff');
            }
        });

        if ($('#fm_create_cliente').valid()) {
            var ck = parseInt($('input:checkbox[name=ap]:checked').val())

            if(ck==1){ap=1}else{ap=0}
            jsonToInsert = {
                fn_nombre: $('#fn_nombre').val(),
                fn_apaterno: $('#fi_apaterno').val(),
                fn_amaterno: $('#fi_amaterno').val(),

                fn_anios: $('#fi_anios').val(),
                fn_meses: $('#fi_meses').val(),
                fn_dias: $('#fi_dias').val(),

                fn_sexo: $('#fi_sexo').val(),
                fn_estado_civil: $('#fi_estado_civil').val(),
                fn_rfc: $('#fi_rfc').val(),
                fn_ocupacion: $('#fi_ocupacion').val(),
                fn_tfijo: $('#fi_tfijo').val(),
                fn_movil: $('#fi_movil').val(),
                fn_mail: $('#fi_mail').val(),
                /*
                fn_Estado: $('#fi_Estado').val(),
                fn_municipio: $('#fi_municipio').val(),
                fn_Localidad: $('#fi_Localidad').val(),
                */
                fn_Estado: $('#edo').val(),
                fn_municipio: $('#muni').val(),
                fn_Localidad: $('#loca').val(),


                fn_colonia: $('#fi_colonia').val(),
                fn_cp: $('#fi_cp').val(),
                fn_calle: $('#fi_calle').val(),
                fn_numero: $('#fi_numero').val(),
                fn_falta: $('#fi_falta').val(),
                estado_reg: $('#estado_reg').val(),
                fn_fecha_nac: $('#fecha_nac').val(),
                box:ap
            };
            console.log("jsontoInsert ", jsonToInsert);
            $.ajax({
                url: "./ajax/registro_cliente.php",
                type: 'POST',
                data: { datas: JSON.stringify(jsonToInsert) },
                dataType: "json",
                success: function(datas) {
                    $('#fm_create_cliente')[0].reset();
                    $("#modalClientes").modal('hide');
                    auto_select(datas)
                    $.notify({
                        title: '<strong>Registro Guardado!</strong>',
                        message: 'Se registro al cliente correctamente'
                    }, {
                        type: 'success',
                        timer: 800
                    }, {
                        animate: {
                            enter: 'animated flipInY',
                            exit: 'animated flipOutX'
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.log("error");
                    console.log(xhr.responseText);
                }
            });
        }
    });
} //Fin de la funcion newCliente


function auto_select(datas)
{
    var id = datas.id
    $('#nombre_cliente').empty();
    $.post("ajax/autocomplete/buscar_cliente.php",{"id": id},function(data)
    {
        data = jQuery.parseJSON(data);
        console.log("1: "+data[0].id_cliente)
        console.log("2: "+data[0].telefono_fijo)
        console.log("3: "+data[0].anios)
        $("#nombre_cliente").append('<option value="'+data[0].id_cliente+'">'+data[0].nombre+' '+data[0].a_paterno+' '+data[0].a_materno+'</option>')
        $("#tel1").val("5559684827")
        $("#mail").val(data[0].anios)
        $("#correo").val(data[0].correo)
        $("#colonia").val(data[0].colonia)
        $("#cp").val(data[0].cp)
        $("#calle").val(data[0].calle)
        $("#numero_exterior").val(data[0].numero_exterior)
    })
     
}

//ACUERDO DE PUBLICIDAD
function openTikets(id) {
    window.open("reports/tikets.php?numero_factura=" + id, '_blank');
    var p4 = parseInt($('input:checkbox[name=acepta_p]:checked').val())

    if(p4 == 1) 
    {
        window.open("publicidad/acuerdo.php?factura=" + id, '_blank');
    }else
    {
                     
       
    }

    $("input[name=box_medico][value='1']").prop("checked",false);
    $("input[name=box_paciente][value='1']").prop("checked",false);
    $("input[name=req_factura][value='1']").prop("checked",false);
    $("input[name=acepta_p][value='1']").prop("checked",false);

    location.reload()
    
}


    $("#req_factura").change(function(){
        if( $('#req_factura').is(':checked') ) {
        $("#modal-factura").modal("show")
        }else {

        }
    })

    $("#fac-cancelar").click(function(){
          $("#modal-factura").modal("hide")
            $("input[name=req_factura][value='1']").prop("checked",false);
    })

    $("#form-factura").on('submit', function (e)
    {
        e.preventDefault()
        $.ajax({
          type: "POST",
          url: "ajax/agregar_factura.php",
          data: $("#form-factura").serialize(),
          beforeSend: function(){
          },
          success: function(data)
          {
            if(data.ok == '1')
            {
              document.getElementById("form-factura").reset();
              swal('Datos agregados correctamente')
                          $("#modal-factura").modal("hide")
              console.log(data)
              $("#idfacturacion").val(data.id)
            }
            else
            {
              swal('Error en MySQL, Error numero:  '+ data.codigo)
              console.log(data.codigo)
            }
          }
        })
    })

// Inicio Nueva rutina para calculo de la edad
// rutina para leer la fecha en ALTAS
function CalcularEdad()
{
   // var fecha=document.getElementById("user_date").value;
    var fecha = $("#fm_create_cliente #fecha_nac").val();
    //var fecha= curp2date(rfc);

console.log(fecha)
    //var fecha ='1965-06-19'

    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        $("#fm_create_cliente #fi_anios").val(edad)
        $("#fm_create_cliente #fi_meses").val(meses)
        $("#fm_create_cliente #fi_dias").val(dias)
        //document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
    }else{
        alert('Error en el formato de la fecha');   
        //document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}

// validar que la fecha tenga el formato correcto
function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
 
    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");
        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }
    return false;
}

function isValidDate(day,month,year)
{
    var dteDate;
     month=month-1;
    dteDate=new Date(year,month,day);
     return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}
//se te paso encerar una llave

//se te paso encerar una llave

/*
Esta funciones la que detectaba el cambio del medico y agregaba un elemento, con descomentarla ya esta
function trigerMedic(){
    $( "#fi_medico" ).change(function() {
        console.log($("#fi_medico option:selected").text());
        console.log("hola");

        if($("#fi_medico option:selected").text()=='Medico Sin Registro'){
            $('#containerMedicoAuxiliar').append('<div class="form-group row">'+            
                '<label  class="col-md-1 control-label">Médico</label>'+
                    '<div class="col-md-4">'+
                        '<input type="text" class="form-control col-md-1" id="medico_aux" name="medico_aux" placeholder="Nombre del médico auxiliar" required>'+
                        '</div>'+
                        '</div>');
        }else{

            $('#containerMedicoAuxiliar').empty();
        }
      });
*/

// tomar el evento de municipios
        $("#modalClientes select[name=edo]").change(function()
        {

                select = $('#modalClientes select[name=edo]').val();
                //alert(select)
                //Si form es 1 viene del form para agregar
                var parametros =
                {
                    "id_estado" : select
                }
                $.ajax({
                    type: "POST",
                    url: "../select/select_estado.php?val=1",
                    data:parametros ,
                    beforeSend: function(){
                    },
                    success: function(data)
                        {
                            $("#modalClientes #muni").html(data);
                            $('select').selectpicker('refresh');
                            //$("#res").load(" #resultado");
                            console.log(data)
                        }
                });
        });

// tomar el evento de localidades
        $("#modalClientes select[name=muni]").change(function()
        {
                select1 = $('#modalClientes select[name=muni]').val();
                select2 = $('#modalClientes select[name=edo]').val();
                //alert(select)
                //Si form es 1 viene del form para agregar
                var parametros =
                {
                    "id_municipio" : select1,
                    "id_estado" : select2

                }
                $.ajax({
                    type: "POST",
                    url: "../select/select_estado.php?val=2",
                    data:parametros ,
                    beforeSend: function(){
                    },
                    success: function(data)
                        {
                            $("#modalClientes #loca").html(data);
                            $('select').selectpicker('refresh');
                            //$("#res").load(" #resultado");
                            console.log(data)
                        }
                });
        });
