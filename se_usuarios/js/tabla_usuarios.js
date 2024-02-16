
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
			var table = $("#dt_usuarios").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "activo"},
					{"data" : "id_usr"},
					{"data" : "desc_sucursal"},
					{"data" : "desc_perfil"},
					{"data" : "desc_servicio"},
					{"data" : "nombre"},
					{"data" : "a_paterno"},
					{"data" : "a_materno"},
					{"data" : "telefono_movil"},
					
					{"defaultContent": "<button type='button' class='editar btn btn-primary btn-md' data-toggle='modal' data-target='#modalEditar'><i class='fas fa-pen'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar' ><i class='fas fa-trash-alt'></i></button>"}
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_usuarios tbody", table);
			obtener_id_eliminar("#dt_usuarios tbody", table);
		}
// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idusuario").val( data.id_usuario );
				$("#frmedit #fi_id_usr").val( data.id_usr);
				$("#frmedit #fi_sucursal").val( data.fk_id_sucursal);
				$("#frmedit #fi_pass").val( data.pass);			
				$("#frmedit #fi_estado").val( data.activo);
				$("#frmedit #fi_perfil").val( data.fk_id_perfil);
				$("#frmedit #fi_nombre").val( data.nombre);
				$("#frmedit #fi_apaterno").val( data.a_paterno);
				$("#frmedit #fi_amaterno").val( data.a_materno);
				$("#frmedit #fi_iniciales").val( data.iniciales);
				$("#frmedit #fi_tfijo").val( data.telefono_fijo);
				$("#frmedit #fi_tmovil").val( data.telefono_movil);
				$("#frmedit #fi_direccion").val( data.direccion);
				$("#frmedit #fi_mail").val( data.mail);
				$("#frmedit #fi_falta").val( data.fecha_registro);
				$("#frmedit #fi_factualiza").val( data.fecha_actualizacion);
				$("#frmedit #fi_entra").val( data.entra);
				$("#frmedit #fi_salida").val( data.salida);
				$("#frmedit #fi_entra_s").val( data.entra_s);
				$("#frmedit #fi_salida_s").val( data.salida_s);
				$("#frmedit #fi_entra_d").val( data.entra_d);
				$("#frmedit #fi_salida_d").val( data.salida_d);
				$("#frmedit #fi_entra_f").val( data.entra_f);
				$("#frmedit #fi_salida_f").val( data.salida_f);
				$("#frmedit #fi_user").val(data.usr_conex);
				
				console.log(data);


			});
		}

// eliminndo usuarios
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_usuario = $("#frmEliminarusuario #idusuario").val(data.id_usuario);
				usuario =$("#frmEliminarusuario #usuario").val(data.id_usuario);
				 nombre =$("#frmEliminarusuario #nombre").val(data.id_usr);
				opcion = $("#frmEliminarusuario #opcion").val("eliminar");
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
