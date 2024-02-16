		$(document).ready(function(){
			//load(1);
			//_createTable();
			listBills();
			deleteBill();

			validateUpdateBill();
		});

	

	

		function listBills(){
				var table=$('#data_facturas').DataTable({
						processing: true,
            serverSide: false,
            lengthMenu: [10, 25, 50],
            select: true,
					"language": {
						"info":"Mostrando _START_ a _END_ de _TOTAL_ facturas",
						"infoEmpty":      "No existen facturas",
						"emptyTable":     "No existen facturas",
						"search":         "Buscar:",
						"lengthMenu":     "Mostrar _MENU_ facturas",
						"paginate": {
							"next":       "Siguiente",
							"previous":   "Anterior"
						},
					},
					"ajax":{
						"url":"./ajax/buscar_facturas.php?action=ajax",
					 	"type": "GET"
					// 	success: function(response) {
	      	// 		console.log(response);
					//
			    // },
					// error:function(xhr, status, error){
					// 	console.log("click");
					// 	console.log(xhr.responseText);
					// }
				},
					"columns":[
						{"data":"id_factura"},
						{"data":"numero_factura"},
						{"data":"fecha_factura"},
						{
	                render: function ( data, type, row ) {
										var a_paterno=row.a_paterno=="a_paterno"?"":row.a_paterno;
										var a_materno=row.a_materno=="a_materno"?"":row.a_materno;
	                   return row.nombre+" "+a_paterno+" "+a_materno;
	                },
	                targets: 3,
	                visible: true,
	                searchable: true
	          },
						{"data":"diagnostico"},
						{"data":"telefono_fijo"},
						{
						 render: function(data, type, row) {
							  var htm="<td>";
								switch(row.estado_factura){
									case "1":
											htm+="<span class='label label-info'>Elaborada</span>";
										break;
									case "2":
										htm+="<span class='label label-primary'>Terminada</span>";
										break;
									case "3":
										htm+="<span class='label label-success'>Entregada</span>";
									break;
									case "4":
										htm+="<span class='label label-warning'>Impresa</span>";
									break;
									case "5":
										htm+="<span class='label label-danger'>Eliminada</span>";
									break;
								}
								 htm+="</td>"
									return htm;
							},
					},
						{"data":"imp_total"},
						{
						 render:function(data,type,row){
							 return "<form-group style='text-align:center;'>"+
                     "<button  id='edit'  type='button' class='btn btn-info btn-sm'><span  class='fa fa-pencil fa-1x'></span></button>"+
                     "<button  id='delete_factura'  type='button' class='btn btn-danger btn-sm' style='margin-left:10px;'><span  class='fa fa-times fa-1x'></span></button>"+
                     "</form-group>";
					 }
				 }

			 ],
			 columnDefs: [
				 {
						 orderable: false,
						 targets: [5]
				 },
			 { width: 80, targets: 8 },
			  { width: 15, targets: 1 },
				{ width: 15, targets: 0 }
		 ],
				 order: [[2, 'asc']]
			});

	}

	function deleteBill(){
			console.log("instanciando una vez");
			$('#data_facturas tbody').on( 'click', '#delete_factura ', function () {
					var data =$('#data_facturas').DataTable().row( $(this).parents('tr') ).data();

					console.log(data);
					console.log("factura ",data.numero_factura);
					var numero_factura=data.id_factura;


							swal({
									title: '¿Eliminar factura?',
									text: "El registro será borrado",
									showCancelButton: true,
									showLoaderOnConfirm: true,
									confirmButtonText: "Si, eliminar!",
									cancelButtonText: "No, cancelar!",
									confirmButtonColor: "#EF5350",
									type: 'warning',
									preConfirm: function() {
											return new Promise(function(resolve, reject) {
													setTimeout(function() {
															 $.ajax({
																	url:"./ajax/deleteBill.php",
																type: 'POST',
																	data:{'numero_factura':numero_factura},
																	async:false,
																	dataType: "JSON",
																	success: function(data){
																				console.log(data);
																			 $('.datatable-generated').DataTable().ajax.reload();
																			 resolve()
																	},error:function(xhr, status, error){
																			console.log(xhr.responseText);
																			 $('.datatable-generated').DataTable().ajax.reload();
																			 swal({
																							title: '!Error de servidor',
																							html: $('<div>')
																									.addClass('some-class')
																									.text('Intenta de nuevo.'),
																							animation: false,
																							customClass: 'animated tada'
																					});
																		}
																}); //FIN AJAX
														}, 300)
											}) //fin  promise
									},allowOutsideClick: false
									}).then(function(email) {
											swal({
													type: 'success',
													title: 'Factura Eliminada!',
											})
									});



				 });
		}


		function validateUpdateBill(){
			$('#data_facturas tbody').on( 'click', '#edit ', function () {
					var data =$('#data_facturas').DataTable().row( $(this).parents('tr') ).data();

					if(data.estado_factura>=2 && data.estado_factura<=4){
						var datas=data;
									swal({
									  title: 'Ingrese la contraseña de autorización',
									  input: 'password',
									  showCancelButton: true,
									  confirmButtonText: 'Verificar',
									  showLoaderOnConfirm: true,
									  preConfirm: function (pass) {
									    return new Promise(function (resolve, reject) {
									      setTimeout(function() {
													$.ajax({
														 url:"./ajax/validate_password.php",
													 type: 'POST',
														 data:{'password':pass},
														 async:false,
														 dataType: "JSON",
														 success: function(data){
																	 console.log(data);
																	resolve()
																	updateFactura(datas);

														 },error:function(xhr, status, error){
																 console.log(xhr.responseText);
																	swal({
																				 title: '!Contraseña Inválida',
																				 html: $('<div>')
																						 .addClass('some-class')
																						 .text('Intente de nuevo o póngase en contacto con el administrador.'),
																				 animation: false,
																				 customClass: 'animated tada'
																		 });
															 }
													 }); //FIN AJAX

									      }, 2000)
									    })
									  },
									  allowOutsideClick: false
									}).then(function (email) {

									})
			}else{
				console.log("entro en el else");
				updateFactura(data);
			}

					console.log(data);




			});
		}


		function updateFactura(data_parameter){
			console.log("prrrrr");
			var obj={
				id_factura:data_parameter.id_factura,
				numero_factura:data_parameter.numero_factura
			};



			$.ajax({
				url:'./editar_factura.php',
				data:{datas:JSON.stringify(obj)},
				type: 'POST',
				success:function(data){
					$('.container').empty();
					$(".container").append(data);

					//load javascript
					var s = document.createElement("script");
						s.type = "text/javascript";
						s.src = "js/nueva_factura.js";
						$("head").append(s);

						var nombre_cliente=$('#nombre_cliente').val();
						$('#tel1').val(data_parameter.telefono_fijo);
						$('#mail').val(data_parameter.mail);

						//load javascript
						var s = document.createElement("script");
							s.type = "text/javascript";
							s.src = "js/jquery.validate.min.js";
							$("head").append(s);

						calculateTotalPrice();

				},
				error:function(xhr, status, error){
					console.log("click");
					console.log(xhr.responseText);
				}
			});
		}






