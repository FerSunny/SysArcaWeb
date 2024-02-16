
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		var listar = function(){
				//$("#cuadro2").slideUp("slow");
				//$("#cuadro1").slideDown("slow");
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar_existe_mes.php"
				},
				"columns":[
					{ "data": "desc_sucursal" },
					{ "data": "anio" },
					{ "data": "mes_nombre" },
					{ "data": "minfecha" },
					{ "data": "maxfecha" },
					//{ "data": "saldo" },
					//{ "data": "efectivo" },
					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<a id='printer' target='_blank' href='./reports/print_existe_mes.php?mes="+row['mes']+"&anio="+row['anio']+"' class='btn btn-warning btn-md' role='button'><span  class='fa fa-print'></span></a>"+
							"</form-group>";
							}
					}
				],
				"language": idioma_espanol
			});

			//obtener_data_editar("#dt_cliente tbody", table);
			//obtener_id_eliminar("#dt_cliente tbody", table);
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
