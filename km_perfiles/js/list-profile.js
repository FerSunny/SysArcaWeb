$(document).ready(function(){
 
    listProfiles();
    event_edit_profile();
    deleteProfile();

});


function getProfiles(){
    $.ajax({
        url:"../km_perfiles/api/get_profiles.php",
    type: 'GET',
        async:false,
        success: function(data){
                    console.log(data);
                 
        },error:function(xhr, status, error){
                console.log(xhr.responseText);
                 
            }
    }); //FIN AJAX
}



function listProfiles(){
    console.log("hola");
        var table=$('#table_profile_medic').DataTable({
            processing: true,
            serverSide: false,
            lengthMenu: [10, 25, 50],
            select: true,
            "language": {
                "info":"Mostrando _START_ a _END_ de _TOTAL_ perfiles",
                "infoEmpty":      "No existen perfiles",
                "emptyTable":     "No existen perfiles",
                "search":         "Buscar:",
                "lengthMenu":     "Mostrar _MENU_ perfiles",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
            },
            "ajax":{
                "url":"../km_perfiles/api/get_profiles.php",
                 "type": "GET",
             	/*success: function(response) {
                     console.log("respuesta success");
       		console.log(response);
            
         },
            error:function(xhr, status, error){
            	console.log("click");
             	console.log(xhr.responseText);
             }*/
        },
            "columns":[
                {"data":"id_perfil"},
                {"data":"iniciales"},
                {"data":"desc_perfil"},
                {"data":"costo"},
                {
                 render:function(data,type,row){
                     return "<form-group style='text-align:center;'>"+
                    "<button  id='edit_profile'  type='button' class='btn btn-info btn-sm'><span  class='fa fa-pencil fa-1x'></span></button>"+
                    //"<button  id='delete_profile'  type='button' class='btn btn-danger btn-sm' style='margin-left:10px;'><span  class='fa fa-times fa-1x'></span></button>"+
                    "</form-group>";
                    }
                }

            ],
            columnDefs: [
                {
                    orderable: false,
                    targets: [1]
                },
                { width: 60, targets: 4 },
                { width: 15, targets: 1 },
                { width: 15, targets: 0 }
            ],
             order: [[1, 'asc']]
    });

}

function deleteProfile(){

    $('#table_profile_medic tbody').on( 'click', '#delete_profile ', function () {
            var data =$('#table_profile_medic').DataTable().row( $(this).parents('tr') ).data();

            console.log(data);
            console.log("id_perfil ",data.id_perfil);
            var id_perfil=data.id_perfil;


            swal({
                    title: '¿Eliminar perfil?',
                    text: "El registro será borrado",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Si, eliminar!",
                    cancelButtonText: "No, cancelar!",
                    confirmButtonColor: "#EF5350",
                    type: 'warning',
                    preConfirm: function() {
                            return new Promise(function(resolve, reject) {
                                    setTimeout(function() {
                                        $.ajax({
                                            url:"../km_perfiles/api/post_delete_profile.php",
                                        type: 'POST',
                                            data:{'id_perfil':id_perfil},
                                            async:false,
                                            dataType: "JSON",
                                            success: function(data){
                                                        console.log(data);
                                                        $('#table_profile_medic').DataTable().ajax.reload();
                                                        resolve()
                                            },error:function(xhr, status, error){
                                                    console.log(xhr.responseText);
                                                        $('#table_profile_medic').DataTable().ajax.reload();
                                                        swal({
                                                                    title: '!Error de servidor',
                                                                    html: $('<div>')
                                                                            .addClass('some-class')
                                                                            .text('Intenta de nuevo.'),
                                                                    animation: false,
                                                                    customClass: 'animated tada'
                                                            });
                                                }
                                        }); //FIN AJAX
                                    }, 300)
                            }) //fin  promise
                    },allowOutsideClick: false
                    }).then(function(email) {
                            swal({
                                    type: 'success',
                                    title: 'Perfil Eliminado!',
                            })
                    });



         });
}


function event_edit_profile(){
    $('#table_profile_medic tbody').on( 'click', '#edit_profile ', function () {
        var data =$('#table_profile_medic').DataTable().row( $(this).parents('tr') ).data();
        updateProfile(data);
    });
}



function updateProfile(data_parameter){
    var obj={
        id_perfil:data_parameter.id_perfil
    };

    $.ajax({
        url:'./edit_profile.php',
        data:{datas:JSON.stringify(obj)},
        type: 'POST',
        success:function(data){
            $('.container').empty();
            $(".container").append(data);

            //load javascript
            var s = document.createElement("script");
                s.type = "text/javascript";
                s.src = "js/create-profile.js";
                $("head").append(s);


                //load javascript
                //var s = document.createElement("script");
                  //  s.type = "text/javascript";
                   // s.src = "js/jquery.validate.min.js";
                   // $("head").append(s);

                //calculateTotalPrice();

        },
        error:function(xhr, status, error){
            console.log("click");
            console.log(xhr.responseText);
        }
    });
}






