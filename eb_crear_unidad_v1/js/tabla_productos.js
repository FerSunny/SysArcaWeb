
		$(document).on("ready", function(){
			listar();
    $.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_productos").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar_productos.php"
				},
				"columns":[
					{"data" : "fk_id_producto"},
          {"data" : "cod_producto"},
					{"data" : "desc_producto"},
					{"data" : "existencias"},
          {"data" : "cantidad"},        
					{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"}
         // {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"}
				],
				"language": idioma_espanol
			});
      agregar("#dt_productos tbody", table)
	    editar("#dt_productos tbody", table)
      eliminar("#dt_productos tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_productos  #dc").val(data.fk_id_detalle)
        $("#form_productos  #dep").val(data.fk_id_detalle)
        $("#form_productos").modal("show")

    });
}

/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_productos").on('submit', function (e) 
  {

 //   console,log('antes')
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar_producto.php",                    
          data: $("#form_productos").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_productos").reset();//se borran los datos del formulario cuando se recarga
                swal('datos agregados correctamente')
                console.log(data)
              }else
              if (data == 1062)
              {
                console.log(data)
                swal('El producto ya fue registrado')
              }
              else
              {
                swal('Error en MySQL, Error numero:  '+ data)
                console.log(data)
              }
            }
          });          
  });



var editar = function(tbody, table) {
    $(tbody).on("click", "button.editar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_editar").modal("show")
        $("#frmedit  label").attr('class','active')
        $("#frmedit  #dc").val(data.id_solicitud)
        $("#frmedit  #codigo").val(data.id_solicitud)
        $("#frmedit  #cantidad").val(data.cantidad)
        $("#frmedit  #producto").val(data.fk_id_producto)

       
    });
}

$("#frmedit").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/editar_producto.php",                    
          data: $("#frmedit").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if( data== 1 )
              {
                var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                swal('datos agregados correctamente')
                console.log(data)
             }else
              if (data == 1062)
              {
                console.log(data)
                swal('El producto ya fue registrado')
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
           $.post("./controladores/eliminar_producto.php", {'id_solicitud' : data.id_solicitud}  , function(data,status)
          {
            swalWithBootstrapButtons(
            'Eliminado!',
            'La información ha sido eliminada',
            'success'
          )
            console.log(data)
            var table = $('#dt_productos').DataTable(); // accede de nuevo a la DataTable.
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


