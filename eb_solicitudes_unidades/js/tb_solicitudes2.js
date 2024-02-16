		$(document).on("ready", function(){
			$.fn.dataTable.ext.errMode = 'none';
			listar();
			//guardar();
			//eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de comisiones
		var listar = function(){
			var table = $("#dt_lista").DataTable({
				"destroy":true,
				"sRowSelect": "multi",
				"ajax":{
					"method":"POST",
					"url": "listar2.php"
				},
				"columns":[
					{"data" : "id_detalle"},
					{"data" : "desc_sucursal"},
					{"data" : "nombre"},
					{
						render: function( data, type, row, meta )
						{
							if(row['estatus'] == 'C')
							{
								return '<span class="badge badge-danger">Creada</span>'
							}else
							if(row['estatus'] == 'P')
							{
								return '<span class="badge badge-warning">En Proceso</span>'
							}else
							if(row['estatus'] == 'E')
							{
								return '<span class="badge badge-success">Enviado</span>'
							}else
							if(row['estatus'] == 'R')
							{
								return '<span class="badge badge-info">Recibido</span>'
							}else
							if(row['estatus'] == 'I')
							{
								return '<span class="badge badge-light">Ingresado</span>'
							}else
							{
								return ""
							}

						}
					},
					{"data": "fecha_registro"},
					{
						render: function( data, type, row, meta )
						{

							if(row['estatus'] == 'C')
							{
								return "<button type='button' class='btn btn-danger' disabled><i class='fas fa-clipboard-list'></i></button>"
							}else
							if(row['estatus'] == 'P')
							{
								return "<button type='button' class='btn' style='background-color: #DF7401 !important;' disabled><i class='fas fa-people-carry'></i></button>"
							}else
							if(row['estatus'] == 'E')
							{
								return "<button type='button' class='receive btn' style='background-color: #DF7401 !important;'><i class='fas fa-cubes'></i></button>"
							}else
							if(row['estatus'] == 'R')
							{
								return "<button type='button' class='view btn btn-info'><i class='fa fa-eye'></i></button>"
							}else
							if(row['estatus'] == 'I')
							{
								return "<button type='button' class='view btn btn-info' disabled><i class='fa fa-eye'></i></button>"
							}
							else
							{
								return ""
							}
						}
					}
				],
				"language": idioma_espanol
			});
			receive_solicitudes("#dt_lista tbody", table);
			view_solicitudes("#dt_lista tbody", table);
		}


		var receive_solicitudes = function(tbody, table){
			$(tbody).on("click", "button.receive", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var tipo = 1;
				var id_detalle = data.id_detalle
				var es = 'R'
				$.post("./controladores/actualizar_estatus.php", { 'tipo' : tipo, 'fk_id_detalle' : id_detalle, 'estatus' : es } ,function(data, status){
				 console.log(data)

				 var table = $("#dt_lista").DataTable()
				 table.ajax.reload()
				});

			});
		}


		var view_solicitudes = function(tbody, table){
			$(tbody).on("click", "button.view", function(){
				var data = table.row( $(this).parents("tr") ).data();
				$("#modal_view").modal("show")
				var id_detalle = data.id_detalle
				detail_solicitudes(id_detalle)

			});
		}


		function detail_solicitudes(id_detalle)
		{
			tabla = $('#de_sol').dataTable(
					{
							"aProcessing" : true, //Activamos el procesamiento de datatables
							"aServerSide" : false, //Paginacion y filtrado realizados por el servidor
							dom: 'Bfrtip', //Definimos los elementos del control tabla
							"ajax":
										{
											url : "./forms/listar.php?id="+id_detalle,
											type : "get",
											dataType : "json",
											error: function(e)
											{

											}
										},
							"bDestroy" : true,
							"iDisplayLength": 5, //Paginacion
							"order": [[0, "desc"]] //Ordernar (columna, orden)
					})
		}

		function add_almacen(id,sol){


			$.post("controladores/buscar_productos.php",{"id": id, "sol":sol}, function(data){
				datos = jQuery.parseJSON(data);
				var fk_id_sucursal = datos[0].fk_id_sucursal
				var idsolicitud = datos[0].id_solicitud
				var idproducto = datos[0].fk_id_producto
				var idproveedor = datos[0].fk_id_proveedor
				var cantidad = datos[0].cantidad
				var fk_id_detalle = datos[0].fk_id_detalle
				var costo = datos[0].costo_total

				$.post("./controladores/productos_unidades.php",{ 'fk_id_sucursal' : fk_id_sucursal, 'idsolicitud' : idsolicitud, 'idproducto' : idproducto, 'idproveedor' : idproveedor, 'cantidad' : cantidad, 'costo' : costo}  , function(data, status){
						if(data == 1)
						{
								console.log(data)
								var table = $("#de_sol").DataTable()
								table.ajax.reload();

								var datos = table
										.rows()
										.data();

								if(datos.length <= 1)
								{
									console.log("Desactivar botones")
									var tipo = 2;
									var es = 'I'
									$.post("./controladores/actualizar_estatus.php", { 'tipo' : tipo,'fk_id_detalle' : fk_id_detalle, 'estatus' : es } ,function(data, status){
										console.log(datos)
										var table = $("#dt_lista").DataTable()
										table.ajax.reload()
									});

								}else
								{
									Swal.fire({
										position: 'top-end',
										type: 'success',
										title: 'Actualizando Almacen',
										showConfirmButton: false,
									timer: 1500
									})
									console.log(datos)
								}
						}else
						{
							Swal.fire('Ocurrio un error')
							console.log(datos)
						}
				});
			})
		}

		var aa = function(tbody, table){
			$(tbody).on("click", "button.add", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var fk_id_sucursal = data.fk_id_sucursal
				var idsolicitud = data.id_solicitud
				var idproducto = data.fk_id_producto
				var idproveedor = data.fk_id_proveedor
				var cantidad = data.cantidad
				var fk_id_detalle = data.fk_id_detalle


				  $.post("./controladores/productos_unidades.php",{ 'fk_id_sucursal' : fk_id_sucursal, 'idsolicitud' : idsolicitud, 'idproducto' : idproducto, 'idproveedor' : idproveedor, 'cantidad' : cantidad }  , function(data, status){
				     if(data == 1)
				     {
				     	var table = $("#de_sol").DataTable()
				     	table.ajax.reload();

						var data = table
							    .rows()
							    .data();

						if(data.length <= 1)
						{
							var tipo = 2;
							var es = 'I'
							$.post("./controladores/actualizar_estatus.php", { 'tipo' : tipo,'fk_id_detalle' : fk_id_detalle, 'estatus' : es } ,function(data, status){
				 				console.log(data)
				 				var table = $("#dt_lista").DataTable()
				 				table.ajax.reload()
				 				location.reload()
							});
							//
						}else
						{
							Swal.fire({
							  position: 'top-end',
							  type: 'success',
							  title: 'Actualizando Almacen',
							  showConfirmButton: false,
							  timer: 1500
							})
						}
				     }else
				     {
				     	Swal.fire('Ocurrio un error')
				     }
				  });
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
