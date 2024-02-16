$(document).ready(function(){
    
    var tabla=$('#tb_plantilla2').DataTable( {
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
            { "width": "180px", "targets": 4 }
          ],
    } );

    get_data(tabla);
    update(tabla);
    reloadPage();
    
});
    


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
                    resultado:$('#fi_estado'+counter+' option:selected').val(),
                    verificado:$('#fi_verificado'+counter).val(),
                    observaciones:$('#observaciones').val(),
                    id_factura:$('#folio').text().trim(),
                    id_studio:$('#studio').text().trim()

                };
                arregloDatos.push(objecto);
                counter++;
            }
        }
        Swal.fire({
          title: '¿Guardar?',
          text: "Click en si para continuar!",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'No',
          confirmButtonText: 'Si'
        }).then((result) => {
          if (result.value) 
          {
            setTimeout(function() {
                $.ajax({
                    url:"./plantilla_2/insertarRegistros.php",
                   type: 'POST',
                   data:{datas:JSON.stringify(arregloDatos)},
                   dataType: "json",
                    success: function(datas){
                        Swal.fire({
                          title: 'Registro Guardado con exito',
                          text: "Click en continuar!",
                          type: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          cancelButtonText: 'No',
                          confirmButtonText: 'Continuar'
                        }).then((result) => {
                          if (result.value) 
                          {
                            //window.open('./reports/print_result_p2.php?numero_factura='+$('#folio').text().trim()+'&studio='+$('#studio').text().trim(), '_blank')
                            location.reload()
                          }else
                          {
                            location.reload()
                          }
                        })
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
          }else
          {
            location.reload()
          }
        })


    });

}

    function reloadPage(){
        $('#btn_cancelar').click(function(e){
            refreshPage();
        });
    }

    
    function refreshPage(){
        location.reload(true);
    }   


    
function update(tabla){
    $(document).on('click','#btn_update',function(){
        var data = tabla
        .rows()
        .data();
    
    var arregloDatos=[];
  

    var counter=1;
    for(var i=0;i<data.length;i++){
        if(data[i][2].length>0){
            var objecto={
                orden:data[i][0],
                tipo:'P',
                concepto:data[i][2],
                verificado:$('#fi_verificado'+counter).val(),
                resultado:$('#fi_estado'+counter+' option:selected').val(),
                
                unidad_medida:data[i][5],
                valor_refe:data[i][6],
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
                                url:"./plantilla_2/update_rows.php",
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
                    
                    '<a id="btn_cancelar" style="color:white;text-color:white;" target="_blank" href="./reports/print_result_p2.php?numero_factura='+$('#folio').text().trim()+'&studio='+$('#studio').text().trim()+'" onclick="refreshPage();"><span id="btn_reload" style="color:white;text-color:white;" class="glyphicon glyphicon-print"></span> Imprimir</a>',
                    
                
                cancelButtonAriaLabel: 'Thumbs down',
                });

                $('#btn_cancelar').text('Salir');
        });


    });

} // fin de actualizar





    
    