
		$(document).on("ready", function(){
			listar();

		});


		var listar = function(){
				$("#cuadro2").slideUp("slow");
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar_concepto.php"
				},
				"columns":[
					{"data" : "fecha"},
					{"data" : "hora"},
					{"data" : "medico"},
					{"data" : "planeado"},
					{"data" : "hora_visita"}, 
					{"data" : "desc_visita"},
					{"data" : "participaciones"},
					{"data" : "publicidad"},
					{"data" : "ordenes_fi"},
					{"data" : "ordenes_ff"},
					{"data" : "quejas"},
					{"data" : "sugerencias"},
					{"data" : "observaciones"},
					{"data" : "mail_resultados"},
					{"data" : "e_mail"}
				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_cliente tbody", table);
			obtener_id_eliminar("#dt_cliente tbody", table);
		}
/*
		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_estudio = $("#frmedit #idusuario ").val( data.id_estudio ),
						id_estudio = $("#frmedit #edit1").val( data.id_estudio ),
						iniciales = $("#frmedit #edit2").val( data.iniciales),
						desc_estudio=$("#frmedit #edit3").val(data.desc_estudio),
						fk_id_tipo_estudio = $("#frmedit #edit4").val( data.fk_id_tipo_estudio ),
						urgente = $("#frmedit #edit5").val( data.urgente ),
						tiempo_entrega= $("#frmedit #edit6").val( data.tiempo_entrega),
						fk_id_comision= $("#frmedit #edit7").val( data.fk_id_comision ),
						observaciones = $("#frmedit #edit8").val( data.observaciones ),
						per_perfil = $("#frmedit #edit9").val( data.per_perfil),
						costo = $("#frmedit #edit10").val( data.costo ),
						fk_id_descuento = $("#frmedit #edit11").val( data.fk_id_descuento),
						fk_id_promosion = $("#frmedit #edit12").val( data.fk_id_promosion),
						fk_id_indicaciones = $("#frmedit #edit13").val( data.fk_id_indicaciones),
						fk_id_muestra = $("#frmedit #edit14").val( data.fk_id_muestra),
						fk_id_muestra_1 = $("#frmedit #edit14_1").val( data.fk_id_muestra_1),
						fk_id_muestra_2 = $("#frmedit #edit14_2").val( data.fk_id_muestra_2),
						fk_id_muestra_3 = $("#frmedit #edit14_3").val( data.fk_id_muestra_3),
						fk_id_muestra_4 = $("#frmedit #edit14_4").val( data.fk_id_muestra_4),
						estatus=$("#frmedit #edit15").val(data.estatus),
						opcion = $("#frmedit #opcion").val("modificar");
						console.log(data);

			});
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_estudio = $("#frmEliminarUsuario #idusuario").val( data.id_estudio );
				 id_estudio =$("#frmEliminarUsuario #usuario").val(data.id_estudio);
				 desc_estudio=$("#frmEliminarUsuario #desc").val(data.desc_estudio);
				opcion = $("#frmEliminarUsuario #opcion").val("eliminar");
				console.log(data);
			});
		}
*/
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
