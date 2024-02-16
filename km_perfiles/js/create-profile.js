$(document).ready(function(){    
    listEstudies();

    var t=$('#table_estudios').DataTable( {
        "searching": false,
        "lengthChange": false,
        "language": {
            "info":"Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty":      "No existen productos",
            "emptyTable":     "No existen productos",
            "search":         "Buscar:",
            "lengthMenu":     "Mostrar _MENU_ productos",
            "paginate": {
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    } );

    addEstudio(t);
    deleteEstudie();
    saveProfile();
    updateProfile();
    reloadPage();
});
            
            
function listEstudies(){
    console.log("entro en listEstudies");
    var table=$('#data_estudios').DataTable({
        processing: true,
        serverSide: false,
        lengthMenu: [10, 25, 50],
        select: true,
        "language": {
            "info":"Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty":      "No existen productos",
            "emptyTable":     "No existen productos",
            "search":         "Buscar:",
            "lengthMenu":     "Mostrar _MENU_ productos",
            "paginate": {
             "next":       "Siguiente",
             "previous":   "Anterior"
            },
        },
        "ajax":{
            "url":"../km_perfiles/api/get_studies.php",
            "type": "GET"
        // 	success: function(response) {
        // 		console.log(response);
        //
        // },
        // error:function(xhr, status, error){
        // 	console.log("click");
        // 	console.log(xhr.responseText);
        // }
        },
            "columns":[
                {"data":"id_estudio"},
                {"data":"desc_estudio"},
                {
                    render: function (data, type, full, meta){
            return '<input type="number"  value="1">';
            }
                },
                {"data":"costo"},
                {
                    render:function(data,type,row){
                        return '<button  id="add"  type="button" class="btn btn-info btn-md"><span  class="glyphicon glyphicon-plus"></span></button>'
                }
            }

        ],
        columnDefs: [
            {
                    orderable: false,
                    targets: [2]
            }],
            order: [[2, 'asc']]
    });
   
}

            
function addEstudio(t){
    $('#data_estudios tbody').on( 'click', '#add ', function () {
            var data =$('#data_estudios').DataTable().row( $(this).parents('tr') ).data();
            console.log(data);
            var row = $(this).parents('tr');
        var cantidad_producto = row.find("td:nth-child(3)").children().val();
            var id_estudio=data.id_estudio;

            //var t = $('#data_facturacion').DataTable();
            //t.searching=false;


            t.row.add( [
                id_estudio,
                data.desc_estudio,
                cantidad_producto,
                data.costo*cantidad_producto,
                    '<button id="btnRemove_estudio" type="button" class="btn btn-danger btn-md"><span  class="glyphicon glyphicon-remove"></span></button>'
            ] ).draw( false );

            calculateTotalPrice();

    });
}
            
function deleteEstudie(){
    var table = $('#table_estudios').DataTable();
    $('#table_estudios tbody').on( 'click', '#btnRemove_estudio', function () {
    var data =$('#table_estudios').DataTable().row( $(this).parents('tr') ).data();
    table
    .row( $(this).parents('tr') )
    .remove()
    .draw();
    calculateTotalPrice();
        

    });
}
            
            
function calculateTotalPrice(){
    var dataTable = $('#table_estudios').DataTable();
    var data = dataTable
    .rows()
    .data();

    var jsonData=[];

    for (var i=0;i<data.length;i++){
        var temp={
            id:data[i][0],
            cantidad:data[i][2]
        }
        jsonData.push(temp);
    }
    var jsonContainer={
        ids:jsonData
    };
    console.log(JSON.stringify(jsonContainer));

    $.ajax({
            url:"../km_perfiles/api/get_calculate_price.php",
        type: 'POST',
            data:{datas:JSON.stringify(jsonContainer)},
            async:false,
            dataType: "JSON",
            success: function(data){
                $('#costo').val(data.subtotal);
            },error:function(xhr, status, error){
                    console.log(xhr.responseText);
            }
        }); //FIN AJAX

}
            
    
            
            
function saveProfile(){
    $('#btnSaveProfile').click(function(e){
        var dataTable = $('#table_estudios').DataTable();
        var data = dataTable
        .rows()
        .data();


        if(data.length==0){
            swal({
                            title: 'Ingrese un estudio como mínimo',
                            html: $('<div>')
                                    .addClass('some-class')
                                    .text('Intente de nuevo.'),
                            animation: false,
                            customClass: 'animated tada'
                    });
        }else{
            $("#form-profile").validate({
                rules: {
                    iniciales: "required",
                    urgente: "required",
                    tiempo_entrega: "required",
                    costo:"required",
                    fk_id_comision:"required",
                    fk_id_descuento:"required",
                    fk_id_promosion:"required",
                    estado:"required",
                    desc_perfil:"required"
                },
                messages: {
                    iniciales: "Ingrese una inicial",
                    urgente: "Seleccione una opción",
                    tiempo_entrega:"Ingrese el tiempo de entrega",
                    costo:"Ingrese un costo",
                    fk_id_comision:"Seleccione una opción",
                    fk_id_descuento:"Seleccione una opción",
                    fk_id_promosion:"Seleccione una opción",
                    estado:"Seleccione una opción",
                    desc_perfil:"Ingrese una descripción"
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

                if($('#form-profile').valid()){
                    var jsonToInsert={};
                    var jsonData=[];

                    for (var i=0;i<data.length;i++){
                        var temp={
                            id:data[i][0],
                            cantidad:data[i][2],
                            precio_venta:data[i][3]
                        };
                        jsonData.push(temp);
                    }
                    var jsonContainer={
                        ids:jsonData
                    };
                    console.log(JSON.stringify(jsonContainer));

                    

                        if($('#costo').val()>0){

                            jsonToInsert.iniciales=$('#iniciales').val();
                            jsonToInsert.urgente=$('#urgente').val();
                            jsonToInsert.tiempo_entrega=$('#tiempo_entrega').val();
                            jsonToInsert.costo=$('#costo').val();
                            jsonToInsert.fk_id_comision=$('#fk_id_comision').val();
                            jsonToInsert.fk_id_descuento=$('#fk_id_descuento').val();
                            jsonToInsert.fk_id_promosion=$('#fk_id_promosion').val()
                            jsonToInsert.estado=$('#estado').val();
                            jsonToInsert.desc_perfil=$('#desc_perfil').val();
                            jsonToInsert.observaciones=$('#observaciones').val();

                        jsonToInsert.estudios=jsonData;
    
                        console.log(jsonToInsert);
                        swal({
                            title: '¿Guardar Perfil?',
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            cancelButtonText: 'No',
                            confirmButtonText: 'Si,guardar!',
                            type: 'info',
                            preConfirm: function() {
                                    return new Promise(function(resolve, reject) {
                                            setTimeout(function() {
                                                $.ajax({
                                                    url:"../km_perfiles/api/post_save_profile.php",
                                                    type: 'POST',
                                                    data:{datas:JSON.stringify(jsonToInsert)},
                                                    dataType: "json",
                                                    success: function(datas){
                                                        console.log("entro en success");
                                                        resolve();
                                                            dataTable
                                                                .clear()
                                                                .draw();
                                                         $('#form-profile')[0].reset();
                                                       
                                                    },
                                                        error:function(xhr, status, error){
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
                                            type: 'success',
                                            title: 'Perfil Guardado Correctamente!',
                                    })
                            });
                        }else{
                        swal(
                            'Oops...',
                            'El saldo no puede ser negativo',
                            ''
                        );
                        }            

        }//fin validacion del formulario
        else{
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
            
            
            
             
            

function updateProfile(){
    $('#btnupdateperfil').click(function(e){
        var factory_id=$('#factory_id').attr('value')
        var dataTable = $('#table_estudios').DataTable();
        var data = dataTable
        .rows()
        .data();


        if(data.length==0){
            swal({
                            title: 'Ingrese un estudio como mínimo',
                            html: $('<div>')
                                    .addClass('some-class')
                                    .text('Intente de nuevo.'),
                            animation: false,
                            customClass: 'animated tada'
                    });
        }else{
            $("#form-profile").validate({
                rules: {
                    iniciales: "required",
                    urgente: "required",
                    tiempo_entrega: "required",
                    costo:"required",
                    fk_id_comision:"required",
                    fk_id_descuento:"required",
                    fk_id_promosion:"required",
                    estado:"required",
                    desc_perfil:"required"
                },
                messages: {
                    iniciales: "Ingrese una inicial",
                    urgente: "Seleccione una opción",
                    tiempo_entrega:"Ingrese el tiempo de entrega",
                    costo:"Ingrese un costo",
                    fk_id_comision:"Seleccione una opción",
                    fk_id_descuento:"Seleccione una opción",
                    fk_id_promosion:"Seleccione una opción",
                    estado:"Seleccione una opción",
                    desc_perfil:"Ingrese una descripción"
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

                if($('#form-profile').valid()){
                    var jsonToInsert={};
                    var jsonData=[];

                    for (var i=0;i<data.length;i++){
                        var temp={
                            id:data[i][0],
                            cantidad:data[i][2],
                            precio_venta:data[i][3]
                        };
                        jsonData.push(temp);
                    }
                    var jsonContainer={
                        ids:jsonData
                    };
                    console.log(JSON.stringify(jsonContainer));

                    

                        if($('#costo').val()>0){

                            jsonToInsert.iniciales=$('#iniciales').val();
                            jsonToInsert.urgente=$('#urgente').val();
                            jsonToInsert.tiempo_entrega=$('#tiempo_entrega').val();
                            jsonToInsert.costo=$('#costo').val();
                            jsonToInsert.fk_id_comision=$('#fk_id_comision').val();
                            jsonToInsert.fk_id_descuento=$('#fk_id_descuento').val();
                            jsonToInsert.fk_id_promosion=$('#fk_id_promosion').val()
                            jsonToInsert.estado=$('#estado').val();
                            jsonToInsert.desc_perfil=$('#desc_perfil').val();
                            jsonToInsert.observaciones=$('#observaciones').val();
                            jsonToInsert.id_perfil=factory_id;

                        jsonToInsert.estudios=jsonData;
    
                        console.log(jsonToInsert);
                        swal({
                            title: 'Actualizar Perfil?',
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            cancelButtonText: 'No',
                            confirmButtonText: 'Si,actualizar!',
                            type: 'info',
                            preConfirm: function() {
                                    return new Promise(function(resolve, reject) {
                                            setTimeout(function() {
                                                $.ajax({
                                                    url:"../km_perfiles/api/post_edit_profile.php",
                                                    type: 'POST',
                                                    data:{datas:JSON.stringify(jsonToInsert)},
                                                    dataType: "json",
                                                    success: function(datas){
                                                        console.log("entro en success");
                                                        resolve();
                                                            dataTable
                                                                .clear()
                                                                .draw();
                                                         $('#form-profile')[0].reset();
                                                       
                                                    },
                                                        error:function(xhr, status, error){
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
                                    title: 'Perfil Actualizado Correctamente!',
                                    timer: 1000
                                  }).then(
                                    function () {},
                                    function (dismiss) {
                                      if (dismiss === 'timer') {
                                              $('#btnClose').click();
                                      }
                                    }
                                  )
                            });
                        }else{
                        swal(
                            'Oops...',
                            'El saldo no puede ser negativo',
                            ''
                        );
                        }            

        }//fin validacion del formulario
        else{
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

function reloadPage(){
    $('#btnClose').click(function(e){
                location.reload(true);
    });
}            

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}