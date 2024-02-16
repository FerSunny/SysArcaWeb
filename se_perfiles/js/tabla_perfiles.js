
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
			var table = $("#dt_perfiles").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_perfil"},
					{"data" : "desc_perfil"},
					{"data" : "desc_modulo"},
					{"data" : "per_lectura"},
					{"data" : "per_escritura"},
					{"data" : "per_borrar"},
					{"data" : "per_actualizar"},
					{"data" : "estado"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_perfiles tbody", table);
			obtener_id_eliminar("#dt_perfiles tbody", table);
		}
// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idperfil").val( data.id_perfil );
				$("#frmedit #fi_id_perfil").val( data.id_perfil);
				$("#frmedit #fi_nombre").val( data.desc_perfil);
				$("#frmedit #fi_modulo").val( data.fk_id_modulo);			
				$("#frmedit #fi_lectura").val( data.per_lectura);
				$("#frmedit #fi_escritura").val( data.per_escritura);
				$("#frmedit #fi_borra").val( data.per_borrar);
				$("#frmedit #fi_actualizar").val( data.per_actualizar);
				$("#frmedit #fi_falta").val( data.fecha_registro);
				//$("#frmedit #fi_factualiza").val( data.fecha_actuaizacion);
				$("#frmedit #fi_estado").val( data.estado);
				
				console.log(data);


			});
		}

// eliminndo mwdicos
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_perfil = $("#frmEliminarperfil #idperfil").val(data.id_perfil);
				perfil =$("#frmEliminarperfil #perfil").val(data.id_perfil);
				 nombre =$("#frmEliminarperfil #nombre").val(data.desc_perfil);
				opcion = $("#frmEliminarperfil #opcion").val("eliminar");
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
