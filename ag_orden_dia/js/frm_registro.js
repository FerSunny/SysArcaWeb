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
            { "width": "180px", "targets": 4 }
          ],
    } );

    get_data(tabla);

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
    console.log("datos a guardar ",arregloDatos);

    

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
    


    
    