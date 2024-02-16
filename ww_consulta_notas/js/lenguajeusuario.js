
		$(document).on("ready", function(){
			listar();
			//guardar();
			//eliminar();
		});

		var listar = function(){
			var table = $("#dt_cliente").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{ "data": "desc_sucursal" },
					{ "data": "idnota" },
					{ "data": "fechafactura" },
					{ "data": "nombrecliente" },
					{ "data" : "anios"},
					{ "data": "estudio" },
					{ "data": "medico" },
					{ "data": "afectacomision" },
					{ "data": "imp_total"},
					{ "data": "observaciones"},
					{ "data": "valido"},
					{
						render:function(data,type,row)
						{
							var perfil = row['perfil']
							var validado = row['validado']
			// se incluyo el perfil 46 y 33, solicitado por
			// mariela enriquez, 23marzo2022-
			//
							if(perfil == 1 || perfil == 12 || perfil == 36 || perfil == 42 || perfil == 45 || perfil == 33 || perfil == 46)
							{
								if (validado  == 1){
									return "<button class='view btn btn-danger'><i class='fas fa-file-pdf'></i></button>"
								}else{
									return "<button disabled class='view btn btn-danger'><i class='fas fa-file-pdf'></i></button>"
								}
							}else
							{
								return "<button disabled class='view btn btn-danger'><i class='fas fa-file-pdf'></i></button>"
							}

						}
					},
					{
						render: function(data,type,row)
						{
							var perfil = row['perfil']
							if(perfil == 1 || perfil == 12 || perfil == 42 || perfil == 45 || perfil == 46 || perfil == 33)
							{
								return "<button class='note btn btn-info'><i class='fas fa-sticky-note'></i></button>"

							}else
							{
								return ""
							}
						}
					}

				],
				"language": idioma_espanol
			});
			view_pdf("#dt_cliente tbody", table);
			view_note("#dt_cliente tbody", table);
		}


		var view_pdf = function(tbody, table){
			$(tbody).on("click", "button.view", function(){
				var data = table.row( $(this).parents("tr") ).data();
					var plantilla = data.fk_id_plantilla
					var factura = data.idnota
					var estudio = data.fk_id_estudio
					switch(plantilla)
					{
						case '1':
										//window.open('./reports/plantilla_1.php?numero_factura='+factura+'&studio='+estudio, '_blank');
										window.open('../ag_confirma_v3.0/reports/print_plantilla_1.php?numero_factura='+factura+'&studio='+estudio, '_blank');
							break;
						case '2':
										window.open('./reports/plantilla_2.php?numero_factura='+factura+'&studio='+estudio, '_blank');
							break;
						case '3':
										window.open('./reports/plantilla_3.php?numero_factura='+factura+'&studio='+estudio, '_blank');
							break;
						case '4':
										window.open('./reports/plantilla_4.php?numero_factura='+factura+'&studio='+estudio, '_blank');
							break;
						case '5':
										window.open('./reports/plantilla_5.php?numero_factura='+factura+'&studio='+estudio, '_blank');
							break;
						case '6':
									alert('En desarrollo')
							break;
						case '7':
										window.open('./reports/plantilla_7.php?numero_factura='+factura+'&studio='+estudio, '_blank');
							break;
					}
			});
		}

		var view_note = function(tbody, table){
			$(tbody).on("click", "button.note", function(){
				var data = table.row( $(this).parents("tr") ).data();
					var nota = data.idnota
				window.open('../so_factura/reports/factura.php?numero_factura='+nota, '_blank');


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
