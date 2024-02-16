
    $(document).on("ready", function(){
      listar();
    $.fn.dataTable.ext.errMode = 'none';
    });

// listar datos en la tabla de perfiles
    var listar = function(){
        $("#cuadro1").slideDown("slow");
      var table = $("#dt_unidad_m").DataTable({
        "destroy":true,
        "sRowSelect": "multi",
        "ajax":{
          "method":"POST",
          "url": "listar.php"
        },
        "columns":[
          {"data" : "id_unidad"},
          {"data" : "unidad_medida"},
          {"data" : "abreviatura"},
          {"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
          {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"}
        ],
        "language": idioma_espanol
      });
      agregar("#dt_unidad_m tbody", table)
      editar("#dt_unidad_m tbody", table)
      eliminar("#dt_unidad_m tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_unidad  #dc").val(data.fk_id_cliente)
        $("#form_unidad  #ca").val(data.id_categoria)
        $("#form_unidad").modal("show")

    });
}

/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_unidad").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_unidad").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
  
                var table = $('#dt_unidad_m').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_unidad").reset();
                swal(data)
                console.log(data)
            }
          });          
  });




var editar = function(tbody, table) {
    $(tbody).on("click", "button.editar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_editar").modal("show")

        $("#frmedit  label").attr('class','active')
        $("#frmedit  #dc").val(data.fk_id_cliente)
        $("#frmedit  #ca").val(data.id_unidad)
        $("#frmedit  #unidad").val(data.unidad_medida)
        $("#frmedit  #abrev").val(data.abreviatura)       
    });
}

$("#frmedit").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/editar.php",                    
          data: $("#frmedit").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if( data== 1 )
              {
                var table = $('#dt_unidad_m').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                swal('datos agregados correctamente')
                console.log(data)
              }else
              if(data == 1062)
              {
                swal('El nombre de la unidad ya existe')
              }
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
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
           $.post("./controladores/eliminar.php", {'id_unidad' : data.id_unidad}  , function(data,status)
          {
            swalWithBootstrapButtons(
            'Eliminado!',
            'La información ha sido eliminada',
            'success'
          )
            console.log(data)
            var table = $('#dt_unidad_m').DataTable(); // accede de nuevo a la DataTable.
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


    /* Idioma para el DataTable */
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


