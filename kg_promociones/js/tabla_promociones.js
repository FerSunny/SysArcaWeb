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
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_promociones").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_promocion"},
					{"data" : "desc_promocion"},
					{"data" : "porcentaje"},
					{"data" : "fecha_inicio"},
					{"data" : "fecha_final"},
					{"data" : "lunes"},
					{"data" : "martes"},
					{"data" : "miercoles"},
					{"data" : "jueves"},
					{"data" : "viernes"},
					{"data" : "sabado"},
					{"data" : "domingo"},
					{"data" : "estado"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_promociones tbody", table);
			obtener_id_eliminar("#dt_promociones tbody", table);
		}
// editamos comision
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idpromocion ").val( data.id_promocion);
				$("#frmedit #edit1").val( data.desc_promocion);
				$("#frmedit #edit3").val( data.porcentaje);
				$("#frmedit #edit4").val( data.fecha_inicio );
				$("#frmedit #edit5").val( data.fecha_final );
				$("#frmedit #fi_lunes").val( data.lunes );
				$("#frmedit #fi_martes").val( data.martes );
				$("#frmedit #fi_miercoles").val( data.miercoles );
				$("#frmedit #fi_jueves").val( data.jueves );
				$("#frmedit #fi_viernes").val( data.viernes );
				$("#frmedit #fi_sabado").val( data.sabado );
				$("#frmedit #fi_domingo").val( data.domingo );

				$("#frmedit #fi_tul").val( data.tuly );
				$("#frmedit #fi_tu2").val( data.tuly2 );
				$("#frmedit #fi_gre").val( data.greg );
				$("#frmedit #fi_xoc").val( data.xochi );
				$("#frmedit #fi_san").val( data.sant );
				$("#frmedit #fi_pab").val( data.pablo);
				$("#frmedit #fi_ped").val( data.pedro );
				$("#frmedit #fi_tec").val( data.teco );
				$("#frmedit #fi_tet").val( data.tete );
				$("#frmedit #fi_tla").val( data.tla );
				$("#frmedit #fi_mil").val( data.mil );

				$("#frmedit #opcion").val("modificar");

				console.log(data);
				//var id_promocion = $("#frmedit #idpromocion ").val( data.id_promocion),
				//	   desc_promocion = $("#frmedit #edit1").val( data.desc_promocion ),
				//	   porcentaje = $("#frmedit #edit3").val( data.porcentaje),
				//	   fecha_inicio = $("#frmedit #edit4").val( data.fecha_inicio ),
				//	   fecha_final = $("#frmedit #edit5").val( data.fecha_final ),
				//	   lunes=$("#frmedit #lunes").val( data.lunes ),
				//	   martes=$("#frmedit #domingo").val( data.domingo),
				//		estado = $("#frmedit #edit2").val( data.estado),
				//		opcion = $("#frmedit #opcion").val("modificar");
				//		console.log(data);

			});
		}

// eliminndo la comision
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_promocion = $("#frmEliminarPromocion #idpromocion").val( data.id_promocion );
				 desc_promocion =$("#frmEliminarPromocion #promocion").val(data.desc_promocion);
				opcion = $("#frmEliminarPromocion #opcion").val("eliminar");
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
