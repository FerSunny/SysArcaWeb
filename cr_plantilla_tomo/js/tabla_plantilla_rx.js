
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de perfiles
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_plantilla_rx").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "nom_usuario"},
					{"data" : "id_plantilla"},
					{"data" : "nombre_plantilla"},
					{"data" : "desc_estudio"},

					{"data" : "desc_corta"},

					{"defaultContent": "<button type='button' class='editar btn btn-warning btn-md' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-edit'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar'><i class='fas fa-trash-alt'></i></button>"},



					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<a id='printer' target='_blank' href='./reports/print_result.php?numero_factura="+row['id_plantilla']+"&studio="+row['fk_id_estudio']+"' class='btn btn-dark btn-md' role='button'><i class='fas fa-print' style='color: white;'></i></a>"+
							"</form-group>";
							},
					},

				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_plantilla_rx tbody", table);
			eliminar("#dt_plantilla_rx tbody", table);
		}

// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit label").attr("class","active");
				$("#frmedit #fi_medico").val( data.fk_id_medico)
				$("#frmedit #fi_id_plantilla").val( data.id_plantilla )
				$("#frmedit #fi_nombre").val( data.nombre_plantilla )
				$("#frmedit #fi_estudio").val( data.fk_id_estudio)
				$("#frmedit #fi_titulo_desc").val( data.titulo_desc)
				$("#frmedit #fi_descripcion").val( data.descripcion)
				$("#frmedit #fi_titulo_conc").val( data.titulo_conc)
				$("#frmedit #fi_conclusion").val( data.conclusion)
				$("#frmedit #fi_titulo_obse").val( data.titulo_obse)
				$("#frmedit #fi_observaciones").val( data.observaciones)
				$("#frmedit #fi_firma").val( data.firma)
				$("#frmedit #fi_estado").val( data.estado)

				console.log(data)


			});
		}

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
           $.post("./controladores/eliminar.php", {'id_plantilla' : data.id_plantilla}  , function(data,status)
          {
            swalWithBootstrapButtons(
            'Eliminado!',
            'La información ha sido eliminada',
            'success'
          )
            console.log(data)
            var table = $('#dt_plantilla_rx').DataTable(); // accede de nuevo a la DataTable.
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
