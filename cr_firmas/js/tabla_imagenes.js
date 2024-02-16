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
			var table = $("#dt_imagenes").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar_imagenes.php"
				},
				"columns":[
					{"data" : "id_firma"},
					{"data" : "desc_servicio"},
					{"data" : "desc_area"},
					{"data" : "usuario"},
					{"data" : "nombre"},
					{"data" : "ruta_firma"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary btn-md' data-toggle='modal' data-target='#modalEditar'><i class='fa fa-eye'></i></button>"},
					//{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEliminar'><i class='fa fa-pencil-square-o'></i></button>"}

				],
				"language": idioma_espanol
			});

			obtener_data_editar("#dt_imagenes tbody", table);
			obtener_id_eliminar("#dt_imagenes tbody", table);
		}
// editamos estado civil
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_imagen = $("#frmedit #idimagen").val( data.id_firma)
					   desc_imagen = $("#frmedit #edit1").val( data.usuario)
					   desc_estudio = $("#frmedit #fi_desc_estudio").val( data.nombre)
						//nombre = $("#frmedit #fi_nombre").val( data.nombre)
						document.getElementById("fi_imagen").src = "img_firmas/"+data.fk_id_usuario+"/"+data.nombre
						opcion = $("#frmedit #opcion").val("modificar")
						console.log(data)

			});
		}

// eliminndo la comision
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_imagen = $("#frmEliminarzona #idimagen").val( data.id_firma);
				 desc_nombre =$("#frmEliminarzona #zona").val(data.nombre);
				opcion = $("#frmEliminarzona #opcion").val("eliminar");
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
