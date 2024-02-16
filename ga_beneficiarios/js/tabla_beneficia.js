
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
			var table = $("#dt_beneficia").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_beneficiario"},
					{"data" : "desc_giro"},
					{"data" : "desc_sucursal"},
					{"data" : "nombre"},
					{"data" : "telefono_fijo"},
					{"data" : "telefono_movil"},
					{"data" : "direccion"},
					
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_beneficia tbody", table);
			obtener_id_eliminar("#dt_beneficia tbody", table);
		}
// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idbeneficiario").val( data.id_beneficiario );				
				$("#frmedit #fi_giro").val( data.fk_id_giro);
				$("#frmedit #fi_nombre").val( data.nombre);
				$("#frmedit #fi_tfijo").val( data.telefono_fijo);
				$("#frmedit #fi_tmovil").val( data.telefono_movil);
				$("#frmedit #fi_direccion").val( data.direccion);
				$("#frmedit #fi_mail").val( data.mail);
				$("#frmedit #fi_falta").val( data.fecha_registro);
				$("#frmedit #fi_factualiza").val( data.fecha_actualizacion);
				$("#frmedit #fi_estado").val( data.estado);
				console.log(data);


			});
		}

// eliminndo usuarios
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_beneficiario = $("#frmEliminarbeneficiario #idbeneficiario").val(data.id_beneficiario);
				beneficiario =$("#frmEliminarbeneficiario #beneficiario").val(data.id_beneficiario);
				 nombre =$("#frmEliminarbeneficiario #nombre").val(data.nombre);
				opcion = $("#frmEliminarbeneficiario #opcion").val("eliminar");
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
