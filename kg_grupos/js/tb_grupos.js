
		$(document).on("ready", function(){
			listar();
    $.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
		var listar = function(){
                $("#cuadro1").slideDown("slow");
			var table = $("#dt_grupo").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "clave_grupo"},
					{"data" : "desc_grupo"},
					{"data" : "estado"},
          {"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
          {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md'><i class='fas fa-trash-alt'></i></button>"}

				],
				"language": idioma_espanol
			});

            agregar("#dt_grupo tbody", table)
            editar("#dt_grupo tbody", table)
            eliminar("#dt_grupo tbody", table)
      //agregar("#dt_productos tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_grupo  #dc").val(data.fk_id_cliente)
        $("#form_grupo  #pro").val(data.id_grupo)
        $("#form_grupo").modal("show")

    });
}


/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_grupo").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_grupo").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {             
              if(data==1)
              {
                var table = $('#dt_grupo').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_grupo").reset();
                swal('Datos agregados correctamente')
                console.log(data)
              }

             
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }

              if(data==1062)
              {
                var table = $('#dt_grupo').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_grupo").reset();
                swal('La clave de grupo ya existe en la base de datos')
                console.log(data)
              }

            }
          });          
  });

function focus_btn()
{
  $("input#codigo.form-control").focus();
}




var editar = function(tbody, table) {
    $(tbody).on("click", "button.editar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#grupo").modal("show")

        $("#frm-edit label").attr("class","active")
        $("#frm-edit #id_grupo").val(data.id_grupo)
        $("#frm-edit #clave_grupo").val(data.clave_grupo)
        $("#frm-edit #desc_grupo").val(data.desc_grupo)
        $("#frm-edit #estado").val(data.estado)


   
       
    });
}

$("#frm-edit").on('submit', function (e) 
    {
      e.preventDefault()
        $.ajax({
            type: "POST",                 
            url: "controladores/editar.php",                    
            data: $("#frm-edit").serialize(),
            beforeSend: function(){
            },
            success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_grupo').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                Swal.fire("Agregados correctamente")
                console.log(data)
              }
              else
              {
                Swal.fire('Error en MySQL, Error numero:  '+ data)
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
        text: "No podras revertir esta accion!",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No, Cancelar!',
        confirmButtonText: 'Si, Eliminarlo!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
           $.post("./controladores/eliminar.php", {'id_grupo' : data.id_grupo}  , function(data,status)
          {
            swalWithBootstrapButtons(
            'Eliminado!',
            'La informacion ha sido eliminada',
            'success'
          )
            console.log(data)
            var table = $('#dt_grupo').DataTable(); // accede de nuevo a la DataTable.
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


