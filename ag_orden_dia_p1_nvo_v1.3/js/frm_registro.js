$(document).ready(function(){
    
    var tabla=$('#t_plantilla2').DataTable( {
        "searching": false,
        "lengthChange": false,
        "bPaginate": false,
        "autoWidth" : true,
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
    } );

    get_data(tabla);
    update(tabla);

    reloadPage();
    
});
    

function update(tabla){
    $(document).on('click','#btn_update',function(){
        var data = tabla
        .rows()
        .data();
    
    var arregloDatos=[];
    // data.forEach(function(element,index) {
    //     console.log("elemento",element)   ;
    // });

    var counter=1;
    for(var i=0;i<data.length;i++){
        if(data[i][2].length>0){
            var objecto={
                orden:data[i][0],
                tipo:'P',
                concepto:data[i][2],

                resultado:$('#fi_resultado'+counter).val(),
                verificado:$('#fi_verificado'+counter).val(),
                unidad_medida:$('#fi_medida'+counter).val(),
                valor_refe:$('#fi_refe'+counter).val(),
                tamfue:data[i][7],
                tipfue:data[i][8],
                posini:data[i][9],

                observaciones:$('#observaciones').val(),
                id_factura:$('#folio').text().trim(),
                id_studio:$('#studio').text().trim()

            };
            arregloDatos.push(objecto);
            counter++;
        }
    }


    console.log("datos a actualizar",arregloDatos);

    swal({
        title: '¿Actualizar Registros?',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Si!',
        type: 'info',
        preConfirm: function() {
                return new Promise(function(resolve, reject) {
                        setTimeout(function() {
                            $.ajax({
                                url:"./services/update_rows.php",
                               type: 'POST',
                               data:{datas:JSON.stringify(arregloDatos)},
                               dataType: "json",
                                success: function(datas){
                                    resolve();
                                },
                                   error:function(xhr, status, error){
                                       console.log(xhr.responseText);
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
             
            swal({
                title: '<i>Registros Actualizados Correctamente</i>',
                type: 'success',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<a onclick="refreshPage();" id="btn_reload" class="fa fa-thumbs-up"></a> Ok!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    
                    '<a id="btn_cancelar" style="color:white;text-color:white;" target="_blank" href="./reports/print_result.php?numero_factura='+$('#folio').text().trim()+'&studio='+$('#studio').text().trim()+'" onclick="refreshPage();"><span id="btn_reload" style="color:white;text-color:white;" class="glyphicon glyphicon-print"></span> Imprimir</a>',
                    
                
                cancelButtonAriaLabel: 'Thumbs down',
                });
        });


    });

} // fin de actualizar





function get_data(tabla){

    $('#btn_guardar').click(function(e){
        var data = tabla
        .rows()
        .data();
    
    var arregloDatos=[];
    // data.forEach(function(element,index) {
    //     console.log("elemento",element)   ;
    // });

    var counter=1;
    for(var i=0;i<data.length;i++){
        if(data[i][2].length>0){
            var objecto={
                orden:data[i][0],
                tipo:'P',
                concepto:data[i][2],

                resultado:$('#fi_resultado'+counter).val(),
                verificado:$('#fi_verificado'+counter).val(),
                
                
                unidad_medida:$('#fi_medida'+counter).val(),
                valor_refe:$('#fi_refe'+counter).val(),
                tamfue:data[i][7],
                tipfue:data[i][8],
                posini:data[i][9],

                observaciones:$('#observaciones').val(),
                id_factura:$('#folio').text().trim(),
                id_studio:$('#studio').text().trim()

            };
            arregloDatos.push(objecto);
            counter++;
        }
    }


    

    swal({
        title: '¿Guardar?',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Si!',
        type: 'info',
        preConfirm: function() {
                return new Promise(function(resolve, reject) {
                        setTimeout(function() {
                            $.ajax({
                                url:"./formularios/insertarRegistros.php",
                               type: 'POST',
                               data:{datas:JSON.stringify(arregloDatos)},
                               dataType: "json",
                                success: function(datas){
                                    resolve();
                                },
                                   error:function(xhr, status, error){
                                       console.log(xhr.responseText);
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
             
            swal({
                title: '<i>Registro Guardado Correctamente</i>',
                type: 'success',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<a onclick="refreshPage();" id="btn_reload" class="fa fa-thumbs-up"></a> Ok!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    
                    '<a id="btn_cancelar" style="color:white;text-color:white;" target="_blank" href="./reports/print_result.php?numero_factura='+$('#folio').text().trim()+'&studio='+$('#studio').text().trim()+'" onclick="refreshPage();"><span id="btn_reload" style="color:white;text-color:white;" class="glyphicon glyphicon-print"></span> Imprimir</a>',
                    
                
                cancelButtonAriaLabel: 'Thumbs down',
                });
        });


    });

}

    function reloadPage(){
        $('#btn_cancelar').click(function(e){
            console.log("click");
            refreshPage();
        });
    }

    
    function refreshPage(){
        //window.location.href = "http://localhost/sysarcaweb/ag_orden_dia/tabla_agenda.php";
        location.reload(true);
    }   
    


    
    