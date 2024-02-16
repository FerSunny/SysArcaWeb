
		
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});


// listar datos en la tabla de comisiones
		var listar = function(){
				// $("#cuadro2").slideUp("slow");
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_gasto").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_gasto"},
					{"data" : "desc_clasifica"},
					{"data" : "desc_tipo_gasto"},
					{"data" : "desc_gasto"},
					{"data" : "estado"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_gasto tbody", table);
			obtener_id_eliminar("#dt_gasto tbody", table);
		}
// editamos comision
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_gasto = $("#frmedit #idgasto ").val( data.id_gsto),
					   desc_gasto = $("#frmedit #gasto").val( data.desc_gasto ),

					   fk_id_clasifica = $("#frmedit #fi_clasifica").val( data.fk_id_clasifica);
					   fk_id_tipo_gasto = $("#frmedit #fi_tipo").val( data.fk_id_tipo_gasto);

						estado = $("#frmedit #estado").val( data.estado),
						opcion = $("#frmedit #opcion").val("modificar");
						console.log(data);

			});
		}

// eliminndo gasto
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_gasto= $("#frmEliminarGasto #idgasto").val( data.id_gasto );
				 desc_gasto =$("#frmEliminarGasto #gasto").val(data.desc_gasto);
				opcion = $("#frmEliminarGasto #opcion").val("eliminar");
				console.log(data);
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
