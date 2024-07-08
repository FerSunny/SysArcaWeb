
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
			var table = $("#dt_plantilla_usg").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data" : "nom_usuario"},
					{"data" : "id_plantilla"},
					{"data" : "nombre_plantilla"},
					{"data" : "desc_estudio"},
				
					{"data" : "desc_corta"},
				
					{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
					{"defaultContent":"<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"},

					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<a id='printer' target='_blank' href='./reports/print_result.php?numero_factura="+row['id_plantilla']+"&studio="+row['fk_id_estudio']+"' class='btn btn-warning btn-md' role='button'><span  class='fa fa-print'></span></a>"+
							"</form-group>";
							},
					},

				],
				"language": idioma_espanol
			});


			obtener_data_editar("#dt_plantilla_usg tbody", table);
			obtener_id_eliminar("#dt_plantilla_usg tbody", table);
		}

// editamos perfiles
		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#frmedit #fi_medico").val( data.fk_id_medico);
				$("#frmedit #fi_id_plantilla").val( data.id_plantilla );
				$("#frmedit #fi_nombre").val( data.nombre_plantilla );
				$("#frmedit #fi_estudio").val( data.fk_id_estudio);
				$("#frmedit #fi_titulo_desc").val( data.titulo_desc);
				$("#frmedit #fi_descripcion").val( data.descripcion);
				$("#frmedit #fi_titulo_conc").val( data.titulo_conc);
				$("#frmedit #fi_conclusion").val( data.conclusion);	
				$("#frmedit #fi_titulo_obse").val( data.titulo_obse);		
				$("#frmedit #fi_observaciones").val( data.observaciones);
				$("#frmedit #fi_firma").val( data.firma);;
				$("#frmedit #fi_estado").val( data.estado);
				
				console.log(data);


			});
		}

// eliminndo 
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_valor = $("#frmEliminarvalor #idvalor").val(data.id_plantilla);
				valor =$("#frmEliminarvalor #valor").val(data.id_plantilla);
				nombre =$("#frmEliminarvalor #nombre").val(data.nombre_plantilla);
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
