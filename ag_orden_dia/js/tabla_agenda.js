
		$(document).ready(function(){
			
			listar();
			//guardar();
			//eliminar();
	//		getData();
			register();
		});

		function getData(){
			var table = $('#dt_agenda').DataTable();
			$('#dt_agenda tbody').on( 'click', '#editar', function () {
					
					 var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
					 console.log("data",data);
	
	
			});
		}

		function register(){
			$('#dt_agenda tbody').on( 'click', '#register ', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				console.log("data",data);
				if(data.Registrado=='Si'){
					swal({
						type: 'info',
						title: 'Este Registro ya fue capturado',
					})	
				}else{
					var obj={
						v_id:data.id_factura,
						v_fk_id_estudio:data.fk_id_estudio
					};
					// var obj={
					// 	v_id:1727,
					// 	v_fk_id_estudio:485
					// };
					$.ajax({
						url:'./formularios/frm_registro.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/frm_registro.js";
								$("head").append(s);
		
							// 	var nombre_cliente=$('#nombre_cliente').val();
							// 	$('#tel1').val(data_parameter.telefono_fijo);
							// 	$('#mail').val(data_parameter.mail);
		
							// 	//load javascript
							// 	var s = document.createElement("script");
							// 		s.type = "text/javascript";
							// 		s.src = "js/jquery.validate.min.js";
							// 		$("head").append(s);
		
							// 	calculateTotalPrice();
		
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}
			});
		}


		$("#btn_listar").on("click", function(){
			listar();
		});

// listar datos en la tabla de perfiles
		function listar(){
			var table=$('#dt_agenda').DataTable({
				processing: true,
				serverSide: false,
				lengthMenu: [10, 25, 50],
				select: true,
				"ajax":{
					"url":"listar.php",
					"type": "POST",
				// 	success: function(response) {
				// 		console.log(response);
				
				// },
				// error:function(xhr, status, error){
				// 	console.log("click");
				// 	console.log(xhr.responseText);
				// }
				},
				"columns":[
					{"data" : "id_factura"},
					{"data" : "estado"},
					{"data" : "fecha_factura"},
					{"data" : "hora_entrega"},
					{"data" : "sucursal"},
					{"data" : "paciente"},
					{"data" : "estudio"},
					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<button  id='register'  type='button' class='btn btn-success btn-md'><span  class='fa fa-file-text'></span></button>"+
							"</form-group>";
							},
					},
					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<button  id='edit'  type='button' class='btn btn-info btn-md'><span  class='fa fa-pencil fa-1x'></span></button>"+
							"</form-group>";
							},
					},
					{
						render:function(data,type,row){
							return "<form-group style='text-align:center;'>"+
							"<a id='printer' target='_blank' href='./reports/print_result.php?numero_factura="+row['id_factura']+"&studio="+row['estudio']+"' class='btn btn-warning btn-md' role='button'><span  class='fa fa-print'></span></a>"+
							"</form-group>";
							},
					}

				 ],
				 "language": {
					"info":"Mostrando _START_ a _END_ de _TOTAL_ registros",
					"infoEmpty":      "No existen registros",
					"emptyTable":     "No existen registros",
					"search":         "Buscar:",
					"lengthMenu":     "Mostrar _MENU_ registros",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},
				},
		 		columnDefs: [
			 	{
					 orderable: false,
					 targets: [2]
			 	}],
			 	order: [[2, 'asc']]
			});

			// var table = $("#dt_agenda").DataTable({
				
			// 	"sRowSelect": "multi",
			// 	"ajax":{
			// 		"method":"POST",
			// 		"url": "/ag_orden_dia/listar.php"
			// 	},
			// 	"columns":[
			// 		{"data" : "id_factura"},
			// 		{"data" : "estado"},
			// 		{"data" : "fecha_factura"},
			// 		{"data" : "hora_entrega"},
			// 		{"data" : "sucursal"},
			// 		{"data" : "paciente"},
			// 		{"data" : "estudio"},
			// 		//{"data" : "unidad_medida"},
					
			// 		{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
			// 		{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>.<i class='fa fa-pencil-square-o'></i></button>"},
			// 		//{"defaultContent": "<button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}
			// 	],
			// 	"language": idioma_espanol
			// });


			// obtener_data_editar("#dt_agenda tbody", table);
			// obtener_id_eliminar("#dt_agenda tbody", table);
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
				$("#frmedit #fi_valor_referencia").val( data.valor_referencia);
				$("#frmedit #fi_estado").val( data.estado);
				
				console.log(data);


			});
		}

// eliminndo usuarios
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
