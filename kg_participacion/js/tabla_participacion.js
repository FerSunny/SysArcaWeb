
		$(document).on("ready", function(){
			listar();
			guardar();
			eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		var guardar = function(){
			$("#form").on("click", function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				console.log(frm)
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm
				}).done( function( info ){
					console.log(info);
					var json_Info = JSON.parse( info );
					console.log(json_info);
					mostrar_mensaje( json_info );
					limpiar_datos();
					listar();
				});
			});
		}

		var eliminar = function(){
			$("#eliminar-usuario").on("click", function(){
				var id_us = $("#frmEliminarUsuario #idusuario").val(),
					opcion = $("#frmEliminarUsuario #opcion").val();
				$.ajax({
					method:"POST",
					url: "guardar.php",
					data: {"idusuario": id_usr  , "opcion": opcion}
				}).done( function( info ){
					console.log(json_info);
					var json_info=JSON.parse(info);
					mostrar_mensaje(json_info);

					limpiar_datos();
					listar();
				});
			});
		}

		

		var limpiar_datos = function(){
			$("#opcion").val("registrar");
			$("#idusuario").val("");
			$("#nombre").val("").focus();
			$("#apellidos").val("");
			$("#dni").val("");
		}

		var listar = function(){
				$("#cuadro2").slideUp("slow");
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data":"id_comision"},
					{"data":"desc_comision"},
					{"data":"porcentaje"},
					{"data":"estado"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_cliente tbody", table);
			obtener_id_eliminar("#dt_cliente tbody", table);
		}

		var agregar_nuevo_usuario = function(){
			limpiar_datos();
			$("#cuadro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_usr = $("#frmedit #idusuario ").val( data.id_usr ),
						id_usr = $("#frmedit #edit1").val( data.id_usr ),
						fk_sucursal = $("#frmedit #edit2").val( data.fk_sucursal),
						  pass= $("#frmedit #edit3").val( data.pass ),
							activo= $("#frmedit #edit4").val( data.activo ),
						nombre = $("#frmedit #edit5").val( data.nombre ),
						a_paterno = $("#frmedit #edit6").val( data.a_paterno ),
						a_materno = $("#frmedit #edit7").val( data.a_materno ),
						telefono_fijo = $("#frmedit #edit8").val( data.telefono_fijo ),
						telefono_movil = $("#frmedit #edit9").val( data.telefono_movil ),
						direccion = $("#frmedit #edit10").val( data.direccion ),
						mail = $("#frmedit #edit11").val( data.mail ),
						opcion = $("#frmedit #opcion").val("modificar");
						console.log(data);

			});
		}

		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_usr = $("#frmEliminarUsuario #idusuario").val( data.id_usr );
				 id_usr =$("#frmEliminarUsuario #usuario").val(data.id_usr);
				opcion = $("#frmEliminarUsuario #opcion").val("eliminar");
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
