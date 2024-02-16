
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
			var table = $("#dt_plantilla_cvo").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "id_valor"},
					{"data" : "orden"},
					{"data" : "desc_estudio"},
					{"data" : "tipo"},
					{"data" : "concepto"},
					//{"data" : "sensibilidad"},
					//{"data" : "vr_maximo"},
					//{"data" : "unidad_medida"},
					
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_plantilla_cvo tbody", table);
			obtener_id_eliminar("#dt_plantilla_cvo tbody", table);
		}

// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #idvalor").val( data.id_valor );
				$("#frmedit #fi_orden").val( data.orden);
				$("#frmedit #fi_estudio").val( data.fk_id_estudio);
				$("#frmedit #fi_tipo").val( data.tipo);			
				$("#frmedit #fi_concepto").val( data.concepto);
				$("#frmedit #fi_posini").val( data.posini);
				$("#frmedit #fi_tamfue").val( data.tamfue);
				$("#frmedit #fi_tipfue").val( data.tipfue);
				$("#frmedit #fi_estado").val( data.estado);
				
				console.log(data);


			});
		}

// eliminndo 
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_valor = $("#frmEliminarvalor #idvalor").val(data.id_valor);
				valor =$("#frmEliminarvalor #valor").val(data.id_valor);
				 nombre =$("#frmEliminarvalor #nombre").val(data.concepto);
				opcion = $("#frmEliminarvalor #opcion").val("eliminar");
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
