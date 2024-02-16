$(document).ready(function() {
    listar();
    $.fn.dataTable.ext.errMode = 'none';
});

$("#btn-modal").click(function(e)
{
    $("#add-modal").modal("show")
})

$("#add-form").submit(function (e) 
  {
      e.preventDefault()
      var f = $(this);
      var formData = new FormData(document.getElementById("add-form"));
      formData.append("dato", "valor");
      $.ajax({                
      url: "datos_ajax/guardar.php",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(){
      },
      success: function(data)            
        {
            swal(data)
            $("#dt_carrucel").DataTable().ajax.reload()
        }
      });          
  });


var listar = function() {
    var table = $("#dt_carrucel").DataTable({
        "destroy": true,
        "sRowSelect": "multi",
        "ajax": {
            "method": "POST",
            "url": "listar.php"
        },
        "columns": [
            { "data": "id_carrucel" },
            { "data": "ruta_img" },
            { "data" : "titulo"},
            { "data" : "subtitulo"},
            { "data": "fecha_registro" },
            {
                 render: function (data,type,row) {
                        return '<img src="'+row['ruta_img']+'" width="70px" id="img_view" style="cursor: pointer;">' 
                    }
            },
            { "defaultContent" : "<button type='button' id='edit' class='btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
            {
                render: function(data,type,row)
                {
                    if(row['estado'] == 'A')
                    {
                        return "<i class='fas fa-toggle-on' id='deactivate' style='font-size:3em; color:green; cursor:pointer;'></i>"
                    }else
                    {
                        return "<i class='fas fa-toggle-off' id='active' style='font-size:3em; color:red; cursor:pointer;'></i>"
                    }
                }
            }
        ],
        "language": idioma_espanol
    });
    full_imagen("#dt_carrucel tbody",table)
    editar("#dt_carrucel tbody",table)
    deactivate("#dt_carrucel tbody",table)
    active("#dt_carrucel tbody",table)
}

var full_imagen = function(tbody, table)
{
    $(tbody).on("click","img#img_view", function()
    {
        var data = table.row($(this).parents("tr")).data();
        console.log(data)
        $("#image-modal").modal("show")
        document.getElementById("img_bd").innerHTML = '<img src="'+data.ruta_img+'" alt="" width="100%">';
    });
}

var editar = function(tbody, table)
{
    $(tbody).on("click", "button#edit", function()
    {
        var data = table.row($(this).parents("tr")).data();
        console.log(data)
        $("#edit-form .md-form label").attr("class","active")
        $("#edit-form #id").val(data.id_carrucel)
        $("#edit-form #ruta").val(data.ruta_img)
        $("#edit-modal").modal("show")
    });
}

$("#edit-form").submit(function (e) 
{
    e.preventDefault()
    var f = $(this);
    var formData = new FormData(document.getElementById("edit-form"));
    formData.append("dato", "valor");
    $.ajax({                
    url: "datos_ajax/editar.php",
    type: "post",
    dataType: "html",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function(){
    },
    success: function(data)            
      {
        location.reload()
      }
    });          
});

var deactivate= function(tbody, table) {
    $(tbody).on("click", "i#deactivate", function() {
        var datas = table.row($(this).parents("tr")).data();

        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons({
            title: 'Estas segur@?',
            text: "Se desactivara la imagen",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, Cancelar!',
            confirmButtonText: 'Si, desactivarla!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post("datos_ajax/eliminar.php", {'id' : datas.id_carrucel}  , function(data,status)
                {
                    swalWithBootstrapButtons(
                    'Eliminado!',
                    'La imagen ha sido desactivada',
                    'success'
                         )
                      console.log(data)
                });

                var table = $('#dt_carrucel').DataTable(); // accede de nuevo a la DataTable.
                var data = table
                .rows()
                .data();

                if(data.length == 0)
                {
                    location.reload()
                }else
                {
                    table.ajax.reload();
                }
            

            } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelado',
                        'Los archivos estan seguros :)',
                        'error'
                    )
                }
            })

        });
}

var active = function(tbody, table) {
    $(tbody).on("click", "i#active", function() {
        var datas = table.row($(this).parents("tr")).data();

        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons({
            title: 'Estas segur@?',
            text: "La imagen se va a activar",
            type: 'info',
            showCancelButton: true,
            cancelButtonText: 'No, Cancelar!',
            confirmButtonText: 'Si, Activarla!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post("datos_ajax/activar.php", {'id' : datas.id_carrucel}  , function(data,status)
                {
                    swalWithBootstrapButtons(
                    'Activada!',
                    'La imagen ha sido activarla',
                    'success'
                         )
                      console.log(data)
                });

                var table = $('#dt_carrucel').DataTable(); // accede de nuevo a la DataTable.
                var data = table
                .rows()
                .data();

                if(data.length == 0)
                {
                    location.reload()
                }else
                {
                    table.ajax.reload();
                }
            

            } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelado',
                        'Los archivos estan seguros :)',
                        'error'
                    )
                }
            })

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
    "sLoadingRecords": "Cargando...",
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