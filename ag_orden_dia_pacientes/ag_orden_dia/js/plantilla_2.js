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

        var in_fac = $("#in_fac").val()
        var in_est = $("#in_est").val()
        var perfil = $("#perfil").val()

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
                    url:"./plantilla_2/insertarRegistros.php?in_fac="+in_fac+"&in_est="+in_est,
                   type: 'POST',
                   data:{datas:JSON.stringify(arregloDatos)},
                   dataType: "json",
                    success: function(datas){
                        if(datas == 1)
                        {
                            Swal.fire({
                            title: 'El estudio ya esta registrado!',
                            text: "Click en continuar!",
                            type: 'info',
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
                        }else
                        {
                          if(perfil == 1)
                          {
                              Swal.fire({
                                title: 'Registro Guardado con exito',
                                text: "Click en continuar!",
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'No',
                                confirmButtonText: 'Imprimir'
                              }).then((result) => {
                                if (result.value)
                                {
                                  window.open('./reports/print_result_p2.php?numero_factura='+$('#folio').text().trim()+'&studio='+$('#studio').text().trim(), '_blank')
                                  location.reload()
                                }else
                                {
                                  location.reload()
                                }
                              })
                          }else
                          {
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
                          }

                        }

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
