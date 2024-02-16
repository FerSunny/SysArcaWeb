        $(document).on("ready", function(){
            listar();
            $.fn.dataTable.ext.errMode = 'none';
        });


// listar datos en la tabla de comisiones
        var listar = function(){
                $("#cuadro1").slideDown("slow");
            var table = $("#dt_imagenes").DataTable({
                "destroy":true,
                "sRowSelect": "multi",
                "ajax":{
                    "method":"POST",
                    "url": "listar_imagenes.php"
                },
                "columns":[
                    {"data" : "id_imagen"},
                    {"data" : "fk_id_factura"},
                    {"data" : "paciente"},
                    {"data" : "desc_estudio"},
                    {
                      "render": function (data,type,row) {
                        return '<img src="./'+row['ruta']+row['nombre']+'" width="100px" class="img_view" style="cursor: pointer;">'
                      }
                    },
                    {"data" : "ruta"},
                   // {"defaultContent": "<button type='button' class='editar btn btn-warning btn-md' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"},
                    {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar'><i class='fas fa-trash-alt'></i></button>"}

                ],
                "language": idioma_espanol
            });

            obtener_data_editar("#dt_imagenes tbody", table);
            eliminar("#dt_imagenes tbody", table);
            full_imagen("#dt_imagenes tbody",table)
        }


        //Agregar Imagen

        $("#frm_add_img").on('submit', function (e)
          {
             e.preventDefault();
              var f = $(this);
              var formData = new FormData(document.getElementById("frm_add_img"));
              formData.append("dato", "valor");

              $.ajax({
                url: "./controladores/registro_imagenes.php",
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

                    Swal.fire(data)
                    var table = $("#dt_imagenes").DataTable()
                    table.ajax.reload()
                  }
                });
          });


// Editar
        var obtener_data_editar = function(tbody, table){
            $("#frmedit  label").attr('class','active')
            $(tbody).on("click", "button.editar", function(){
                var data = table.row( $(this).parents("tr") ).data();
                var id_imagen = $("#frmedit #idimagen").val( data.id_imagen)
                       desc_imagen = $("#frmedit #edit1").val( data.fk_id_factura)
                       desc_estudio = $("#frmedit #fn_desc_estudio").val( data.desc_estudio)
                        nombre = $("#frmedit #fn_archivo").val( data.nombre)
                        //document.getElementById("fi_imagen").src = "img_rx/"+data.fk_id_factura+"/"+data.nombre
                        opcion = $("#frmedit #opcion").val("modificar")
                        console.log(data)

            });
        }

        //Agregar Imagen

        $("#frmedit").on('submit', function (e)
          {
             e.preventDefault();
              var f = $(this);
              var formData = new FormData(document.getElementById("frmedit"));
              formData.append("dato", "valor");
              console.log(formData)

              $.ajax({
                url: "./controladores/actualizar_imagenes.php",
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
                    Swal.fire(data)
                    var table = $("#dt_imagenes").DataTable()
                    table.ajax.reload()
                  }
                });
          });



/* Obtenemos los datos de un paciente */
var eliminar= function(tbody, table) {
        $(tbody).on("click", "button.eliminar", function() {
            var data = table.row($(this).parents("tr")).data();

            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Estas segur@?',
                text: "No podras revertir esta acción",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'No, Cancelar!',
                confirmButtonText: 'Si, Eliminarlo!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                     $.post("./controladores/eliminar_imagenes.php", {'id_imagen' : data.id_imagen}  , function(data,status)
                    {
                        swalWithBootstrapButtons(
                        'Eliminado!',
                        'La información ha sido eliminada',
                        'success'
                    )
                        console.log(data)
                        var table = $('#dt_imagenes').DataTable(); // accede de nuevo a la DataTable.
                                table.ajax.reload(); // linea 106 del error de la consola

                    });
                    
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



        function full_imagen(tbody,tabla) {
            $(tbody).on("click", ".img_view", function()
            {

                var data =$('#dt_imagenes').DataTable().row( $(this).parents('tr') ).data();
                $("#md_imagen").modal("show")
                document.getElementById("img_bd").innerHTML = '<img src="./'+data.ruta+data.nombre+'" alt="" width="100%">';
            })
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
