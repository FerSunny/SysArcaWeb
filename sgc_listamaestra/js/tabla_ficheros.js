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
			//console.log('antes del listar')
				$("#cuadro1").slideDown("slow");
			var table = $("#dt_imagenes").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar_ficheros.php"
				},
				"columns":[
					{"data" : "fk_id_doc"},
					{"data" : "id_imagen"},
					{"data" : "iniciales"},
					{"data" : "fecha_publicacion"},
					{"data" : "nombre"},
					{"data" : "ruta"},
					{"data" : "tipo"},
					{"data" : "ver"},
					{"data" : "revision"},
					{"data" : "estado"},
					{"data" : "ini_usu_est"},
					{"data" : "fecha_status"},

// boton de descargar
					{
						render:function(data,type,row){
							var estatus = row['estatus']
							if(estatus == "D" || estatus == "E"){
								//console.log('entro a D')
								return "<button disabled type='button' class='editar btn btn-danger btn-md'><i class='fa fa-ban'></i> </button>"	
							}
							else{
								//console.log('No entro a D')
								return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='../sgc_listamaestra/controladores/descargar_file.php?fk_id_doc="+row['fk_id_doc']+"&id_imagen="+row['id_imagen']+"&ruta="+row['ruta']+"&nombre="+row['nombre']+"&tipo="+row['tipo']+"&ver="+row['ver']+"' class='btn btn-success btn-md' role='button'><i class='fa fa-download'></i></a>"+
									"</form-group>";	
									//target='_blank'
									table.ajax.reload();
								}
						}
									
					},
// Boton de cargar
					{
						render:function(data,type,row){
							var estatus = row['estatus']

							if(estatus == 'D'){
								return "<form-group style='text-align:center;'>"+
											"<button type='button' class='editar btn btn-success btn-md' role='button' data-toggle='modal' data-target='#modalEditar'><i class='fa fa-upload'></i></button>"
											"</form-group>";
							}else{
								return "<form-group style='text-align:center;'>"+
											"<button type='button' disabled class='editar btn btn-danger btn-md' data-toggle='modal' data-target='#modalEditar'><i class='fa fa-ban'></i></button>"
											"</form-group>";
							}
							
						}
					},	

					{
						render:function(data,type,row){
									return "<form-group style='text-align:center;'>"+
									"<a id='printer' target='_blank' href='../ag_orden_dia_rad/reports/print_imagen_zoom.php?numero_factura="+row['fk_id_factura']+"&studio="+row['id_imagen']+"' class='btn btn-dark btn-md' role='button'><i class='fa fa-eye' style='color: red;'></i></a>"+
									"</form-group>";	
									}
					}

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
				var codigo = $("#frmedit #codigo").val( data.id_imagen)
					id_imagen = $("#frmedit #id_imagen").val( data.id_imagen)
					   	nombre = $("#frmedit #nombre").val( data.nombre)
						version = $("#frmedit #version").val( data.ver)
						id_doc = $("#frmedit #id_doc").val( data.fk_id_doc)

						console.log(data)

			});
		}

// eliminndo la comision
		var obtener_id_eliminar = function(tbody, table){
			$(tbody).on("click", "button.eliminar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var id_imagen = $("#frmEliminarzona #idimagen").val( data.id_imagen);
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
