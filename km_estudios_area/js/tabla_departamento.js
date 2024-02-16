
		$(document).on("ready", function(){
			listar();
    $.fn.dataTable.ext.errMode = 'none';
		});

// listar datos en la tabla de perfiles
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_departamento").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_estudio"},
          {"data" : "desc_estudio"},
          {
            render: function( data, type, row, meta )
            {
              if(row['areas'] == '0')
              {
                return '<span class="badge badge-danger">No</span>'
              }else
              {
                return '<span class="badge badge-success">Si</span>'
              }

            }
          },
          {
            render: function( data, type, row, meta )
            {
              if(row['origen'] == '0')
              {
                return '<span class="badge badge-danger">Pendiente</span>'
              }else
              {
                return '<span class="badge badge-success">Asignado</span>'
              }

            }
          },
          {
            render:function(data,type,row){
              estatus=row['origen'];
              if (estatus == '0' ){
                  return  "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"               
              }else{
                  return "<button type='button' disabled class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"
              }
            }
          },

          {
            render:function(data,type,row){
              estatus=row['origen'];
              if (estatus == '1' ){
                  return "<form-group style='text-align:center;'>"+
                  "<a id='productos' target='_blank' href='./tabla_productos.php?fk_id_estudio_ori="+row['id_estudio']+"' class='btn btn-info btn-md' role='button'><i class='fas fa-shopping-basket' style='color: white;'></i></a>"+
                  "</form-group>";               
              }else{
                  return "<button type='button' disabled class='productos btn btn-info btn-md'><i class='fas fa-shopping-basket'></i></button>"
              }
            }
          }     
					//{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md'><i class='fas fa-edit'></i></button>"},
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"},
          //{"defaultContent":"<button type='button' class='enviar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"}

				],
				"language": idioma_espanol
			});
      agregar("#dt_departamento tbody", table)
	    editar("#dt_departamento tbody", table)
      eliminar("#dt_departamento tbody", table)
     // productos("#dt_departamento tbody", table)
      enviar("#dt_departamento tbody", table)
        
}
var agregar= function(tbody, table) {
    $(tbody).on("click", "button.agregar", function() 
    {
        var data = table.row($(this).parents("tr")).data();
        $("#form_depto  #dc").val(data.fk_id_cliente)
        $("#form_depto  #dep").val(data.id_departamento)
        $("#form_depto").modal("show")

    });
}

/* Agregamos una nueva clasificacion  para q no se recargue la pagina */
$("#form_depto").on('submit', function (e) 
  {
      e.preventDefault()
      $.ajax({
          type: "POST",                 
          url: "controladores/agregar.php",                    
          data: $("#form_depto").serialize(),
          beforeSend: function(){
          },
          success: function(data)            
            {
              if(data==1)
              {
                var table = $('#dt_departamento').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                document.getElementById("form_depto").reset();//se borran los datos del formulario cuando se recarga
                swal('datos agregados correctamente')
                console.log(data)
              }else
              if (data == 2)
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
        $("#frmedit  #codigo").val(data.id_estudio)
        $("#frmedit  #origen").val(data.fk_id_estudio_ori)

       
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
                var table = $('#dt_departamento').DataTable(); // accede de nuevo a la DataTable.
                table.ajax.reload(); // Recarga el  DataTable
                swal('Estudio padre asignado correctamente')
                console.log(data)
             }else
              if (data == 2)
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
           $.post("./controladores/eliminar.php", {'id_detalle' : data.id_detalle}  , function(data,status)
          {
            swalWithBootstrapButtons(
            'Eliminado!',
            'La información ha sido eliminada',
            'success'
          )
            console.log(data)
            var table = $('#dt_departamento').DataTable(); // accede de nuevo a la DataTable.
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

var enviar= function(tbody, table) {
  $(tbody).on("click", "button.enviar", function() {
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
      confirmButtonText: 'Si, Enviarla!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
         $.post("./controladores/enviar.php", {'id_detalle' : data.id_detalle}  , function(data,status)
        {
          swalWithBootstrapButtons(
          'Enviada!',
          'La información ha sido Enviada',
          'success'
        )
          console.log(data)
          var table = $('#dt_departamento').DataTable(); // accede de nuevo a la DataTable.
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


