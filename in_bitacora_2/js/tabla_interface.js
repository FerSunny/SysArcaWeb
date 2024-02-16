
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de medicos
		var listar = function(){
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_medicos").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_interface"},
					{"data" : "fk_id_usuario"},
					{"data" : "fecha_registro"},
					{"data" : "fecha_proceso"},
					{"data" : "fk_id_factura"},
					{"data" : "desc_estudio"},
					{"data" : "estado_proceso"}
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_medicos tbody", table);
			obtener_id_eliminar("#dt_medicos tbody", table);
		}
// editamos medicos
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idmedico").val( data.id_medico );
				$("#frmedit #fi_id_medico").val( data.id_medico);
				$("#frmedit #fi_zona").val( data.fk_id_zona);
				$("#frmedit #fi_nombre").val( data.nombre);
				$("#frmedit #fi_apaterno").val( data.a_paterno);
				$("#frmedit #fi_amaterno").val( data.a_materno);
				$("#frmedit #fi_rfc").val( data.rfc);
				$("#frmedit #fi_sexo").val( data.fk_id_sexo);
				$("#frmedit #fi_especialidad").val( data.fk_id_especialidad);
				$("#frmedit #fi_estado_fed").val( data.fk_id_estado);
				$("#frmedit #fi_municipio").val( data.fk_id_municipio);
				$("#frmedit #fi_localidad").val( data.fk_id_localidad);
				$("#frmedit #fi_colonia").val( data.colonia);
				$("#frmedit #fi_cp").val( data.cp);
				$("#frmedit #fi_calle").val( data.calle);
				$("#frmedit #fi_numero").val( data.numero_exterior);
				$("#frmedit #fi_referencia").val( data.referencia);
				$("#frmedit #fi_tfijo").val( data.telefono_fijo);
				$("#frmedit #fi_movil").val( data.telefono_movil);
				$("#frmedit #fi_mail").val( data.e_mail);
				$("#frmedit #fi_horario").val( data.horario);
				$("#frmedit #fi_cbanco").val( data.cuenta_banco);
				$("#frmedit #fi_adscrito").val( data.adscrito);
				$("#frmedit #fi_falta").val( data.fecha_registro);
				//$("#frmedit #fi_factualiza").val( data.fecha_actuaizacion);
				$("#frmedit #fi_estado").val( data.estado);
				$("#frmedit #fi_sucursal").val( data.fk_id_sucursal);
				
				console.log(data);


			});
		}

// eliminndo mwdicos
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_ocupacion = $("#frmEliminarmedico #idmedico").val( data.id_medico);
				medico =$("#frmEliminarmedico #medico").val(data.id_medico);
				 nombre =$("#frmEliminarmedico #nombre").val(data.nombre);
				opcion = $("#frmEliminarmedico #opcion").val("eliminar");
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
