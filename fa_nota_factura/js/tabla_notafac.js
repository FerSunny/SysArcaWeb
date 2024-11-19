
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
				$("#cuadro2").slideUp("slow");
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_notafac").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{ "data": "desc_corta" },
					{ "data": "nota" },
					{ "data": "fecha" },
					{ "data": "nombre" },
					{ "data": "importe" },
					{ "data": "numero_factura" },
					{ "data": "fecha_factura_sat" },
					{ "data": "id_usr" },
					{ "data": "desc_grupo" },
					{ "data": "desc_corta_ss" },
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"}
					//{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});



			obtener_data_editar("#dt_notafac tbody", table);
			obtener_id_eliminar("#dt_notafac tbody", table);
		}
// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #fi_nota").val( data.nota);
				$("#frmedit #fi_fecha").val( data.fecha);
				$("#frmedit #fi_importe").val( data.importe);
				$("#frmedit #fi_nombre").val( data.nombre);		
				$("#frmedit #fi_numero_factura").val( data.numero_factura);
				$("#frmedit #fi_grupo").val( data.grupo);
				$("#frmedit #fi_sucursal").val( data.fk_id_sucursal_sat);
				$("#frmedit #fi_fecha_factura").val( data.fecha_factura_sat);
				$("#frmedit #fi_estado").val( data.estado);
				
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
