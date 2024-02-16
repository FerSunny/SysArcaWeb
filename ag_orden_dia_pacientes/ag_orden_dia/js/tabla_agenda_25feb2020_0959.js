		$(document).ready(function(){
			listar();
			//guardar();
			//eliminar();
	//		getData();
			register_p1()
			register_p1_3h()
			register_p1_5h()
			register_p2()
			register_p3()
			editRegister_p1()
			editRegister_p1_3h()
			editRegister_p1_5h()
			editRegister_p2()
			editRegister_p3()
			deleteRow_p1()
			deleteRow_p2()
			deleteRow_p3()

		});

function deleteRow(){
			$('#dt_agenda tbody').on( 'click', '#delete ', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				

				swal({
					title: '¿Eliminar Registro?',
					showCancelButton: true,
					showLoaderOnConfirm: true,
					cancelButtonText: 'No',
					confirmButtonText: 'Si!',
					type: 'info',
					preConfirm: function() {
							return new Promise(function(resolve, reject) {
									setTimeout(function() {
										$.ajax({
											url:"./services/delete_row.php",
										   type: 'POST',
										   data:{datas:JSON.stringify({"id_factura":data.id_factura,"id_studio":data.fk_id_estudio})},
										   dataType: "json",
											success: function(datas){
												$('#dt_agenda').DataTable().ajax.reload();
												resolve();
											},
											   error:function(xhr, status, error){
												   console.log(xhr.responseText);
													swal(
														'Oops...',
														'Error del servidor',
														xhr.responseText
													)
											   }
										}) //fin del ajax
									}, 300)
							})
					},
					allowOutsideClick: false
					}).then(function(datoReturn) {
						swal({
							title: '<i>Se elimino el registro correctamente</i>',
							type: 'success',
							showCloseButton: true,
							showCancelButton: true,
							focusConfirm: false,
							confirmButtonText:
								'<a  class="fa fa-thumbs-up"></a> Ok!',
							confirmButtonAriaLabel: 'Thumbs up, great!',
							});
			
					});
			
			});	
		}

		function getData(){
			var table = $('#dt_agenda').DataTable();
			$('#dt_agenda tbody').on( 'click', '#editar', function () {
					
					 var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
					 console.log("data",data);
	
	
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
					"url":"listar.php?factura="+$("#factura_get").val(),
					"type": "POST",
				},
				"columns":[
					{"data" : "num_plnatilla"},
					{"data" : "id_factura"},
					{"data" : "fecha_factura"},
					{"data" : "sucursal"},
					//{"data" : "paciente"},
					{"data" : "estudio"},
					{"data" : "Registrado"},
					{"data" : "fecha_registro"},
                    {"data" : "num_imp"},
                    {"data" : "fecha_impresion"},
					{
						render:function(data,type,row)
						{
							var plantilla = row['num_plnatilla']
							var estudio = row['fk_id_estudio']
							var perfil=row['perfil']

							if(perfil == 1 || perfil == 11 || perfil == 13)
							{
								if(plantilla == 'P1')
								{
									if(estudio == 235)
									{
										return "<button  id='register_p1_3h'  type='button' class='btn btn-success btn-md'><i class='fas fa-file-alt'></i></button>"
									}else
									if(estudio == 236)
									{
										return "<button  id='register_p1_5h'  type='button' class='btn btn-success btn-md'><i class='fas fa-file-alt'></i></button>"
									}else
									{
										return "<button  id='register_p1'  type='button' class='btn btn-success btn-md'><i class='fas fa-file-alt'></i></button>"
									}
								}else
								if(plantilla == 'P2')
								{
									return "<button  id='register_p2'  type='button' class='btn btn-success btn-md'><i class='fas fa-file-alt'></i></button>"
								}else
								if(plantilla == 'P3')
								{
									return "<button  id='register_p3'  type='button' class='btn btn-success btn-md'><i class='fas fa-file-alt'></i></button>"
								}else
								{
									return "Error"
								}
							}else
							{
							    return "<button  id='out'  type='button' class='btn btn-secondary btn-md'><i class='fas fa-hand-paper'></i></button>"								
							}
						},
					},
					{
						render:function(data,type,row){
				            var perfil;
							var perfil=row['perfil']
							var plantilla = row['num_plnatilla']
							var estudio = row['fk_id_estudio']
							if(perfil==1)
							{
								if(plantilla == 'P1')
								{
									if(estudio == 235)
									{
										return "<button  id='edit_p1_3h'  type='button' class='btn btn-warning btn-md'><i class='fas fa-pencil-alt'></i></button>"									}else
									if(estudio == 236)
									{
										return "<button  id='edit_p1_5h'  type='button' class='btn btn-warning btn-md'><i class='fas fa-pencil-alt'></i></button>"
									}else
									{
										return "<button  id='edit_p1'  type='button' class='btn btn-warning btn-md'><i class='fas fa-pencil-alt'></i></button>"
									}
									
								}else
								if(plantilla == 'P2')
								{
									return "<button  id='edit_p2'  type='button' class='btn btn-warning btn-md'><i class='fas fa-pencil-alt'></i></button>"
								}else
								if(plantilla == 'P3')
								{
									return "<button  id='edit_p3'  type='button' class='btn btn-warning btn-md'><i class='fas fa-pencil-alt'></i></button>"
								}else
								{
									return "Error"
								}
    							
							}else{
							    return "<button  id='out'  type='button' class='btn btn-secondary btn-md'><i class='fas fa-hand-paper'></i></button>"						    
							}
							},
					},
					{
						render:function(data,type,row){
							var perfil=row['perfil']
							var plantilla = row['num_plnatilla']
							if(perfil==1)
							{
								if(plantilla == 'P1')
								{
									return "<button id='delete_p1' class='btn btn-danger btn-md' role='button'><i class='fas fa-trash-alt'></i></button>"
								}else
								if(plantilla == 'P2')
								{
									return "<button id='delete_p2' class='btn btn-danger btn-md' role='button'><i class='fas fa-trash-alt'></i></button>"
 
								}else
								if(plantilla == 'P3')
								{
									return "<button id='delete_p3' class='btn btn-danger btn-md' role='button'><i class='fas fa-trash-alt'></i></button>"
								}else
								{
									return "Error"
								}
							}else{
							    return "<button id='out' class='btn btn-secondary btn-md' role='button'><i class='fas fa-hand-paper'></i></button>"
							}
							},
					},
					{
						render:function(data,type,row)
						{
							var plantilla = row['num_plnatilla']
							var resta = row['resta']
							var perfil=row['perfil']
							if(resta == 0)
							{
								if(perfil == 1 || perfil == 11 || perfil == 13)
								{
									if(plantilla == 'P1')
									{
										return "<button id='printer'  class='btn btn-dark btn-md' role='button'><i class='fas fa-print'></i></button>";
									}else
									if(plantilla == 'P2')
									{
										return "<button id='printer'  class='btn btn-dark btn-md' role='button'><i class='fas fa-print'></i></button>";
									}else
									if(plantilla == 'P3')
									{
										return "<button id='printer'  class='btn btn-dark btn-md' role='button'><i class='fas fa-print'></i></button>";
									}else
									{
										return "No existe"
									}
								}else
								{
									return "<button id='out' class='btn btn-secondary btn-md' role='button'><i class='fas fa-hand-paper'></i></button>"
	
								}
							}else
							{
								return "<button type='button' class='btn btn-info'><i class='fas fa-hand-holding-usd'></i></button>"
							}
							
							
						},
					},
					//{"defaultContent":""}
					{
						render:function(data,type,row)
						{
							var email_medico = row['email_medico']
							var resta = row['resta']
							var perfil=row['perfil']

							if(perfil == 1 || perfil == 11)
							{
								if(email_medico == 1)
								{
									if(resta == 0)
									{
										return "<button type='button' id='e_medico' class='btn btn-primary btn-md'><i class='fas fa-paper-plane'></i></button>"
									}else
									{
										return "<button type='button' class='btn btn-info'><i class='fas fa-hand-holding-usd'></i></button>"
									}
								}else
								{
									return ""
								}
							}else
							{
								return "<button id='out' class='btn btn-secondary btn-md' role='button'><i class='fas fa-hand-paper'></i></button>"
							}
							
						}
					},
					{
						render:function(data,type,row)
						{
							var email_paciente = row['email_paciente']
							var resta = row['resta']
							var perfil=row['perfil']

							if(perfil == 1 || perfil == 11)
							{
								if(email_paciente == 1)
								{
									if(resta == 0)
									{
									return "<button type='button' id='e_paciente' class='btn btn-primary btn-md'><i class='fas fa-paper-plane'></i></button>"
									}else
									{
										return "<button type='button' class='btn btn-info'><i class='fas fa-hand-holding-usd'></i></button>"
									}
								}else
								{
									return ''
								}
							}else
							{
								return "<button id='out' class='btn btn-secondary btn-md' role='button'><i class='fas fa-hand-paper'></i></button>"			
							}							
						}
					},
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
			printer("#dt_agenda tbody", table);
			email_medico("#dt_agenda tbody", table);
			email_paciente("#dt_agenda tbody", table);
		}
		

	//Registro de Datos P1
		function register_p1(){
			$('#dt_agenda tbody').on( 'click', '#register_p1 ', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				console.log("data" + data);
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
					$.ajax({
						url:'./plantilla_1/frm_registro.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_1.js";
								$("head").append(s);
	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}
			});
		}

		//Registro Curvas de tolerancia
		function register_p1_3h(){
			$('#dt_agenda tbody').on( 'click', '#register_p1_3h', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				console.log("data" + data);
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
					$.ajax({
						url:'./plantilla_1_curva_3h/frm_registro.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_1.js";
								$("head").append(s);
	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}
			});
		}


		//Agregar datos Curva de toleancia
		function register_p1_5h(){
			$('#dt_agenda tbody').on( 'click', '#register_p1_5h ', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				console.log("data" + data);
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
					$.ajax({
						url:'./plantilla_1_curva_5h/frm_registro.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_1.js";
								$("head").append(s);
	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}
			});
		}

		//Registro de datos p2
		function register_p2(){
			$('#dt_agenda tbody').on( 'click', '#register_p2', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
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
						url:'./plantilla_2/frm_registro.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_2.js";
								$("head").append(s);
		
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}
			});
		}

		//Registro de Datos p3
		function register_p3(){
			$('#dt_agenda tbody').on( 'click', '#register_p3', function () {
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
					$.ajax({
						url:'./plantilla_3/frm_registro.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_3.js";
								$("head").append(s);
	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}
			});
		}


		//Editar Registros P1
		function editRegister_p1(){
			$('#dt_agenda tbody').on( 'click', '#edit_p1', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				
				if(data.Registrado=='Si'){
					var obj={
						v_id:data.id_factura,
						v_fk_id_estudio:data.fk_id_estudio
					};
					
					$.ajax({
						url:'./plantilla_1/frm_registro_update.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_1.js";
								$("head").append(s);

							$('#btn_guardar').attr('id','btn_update');
							
							$.ajax({
								url:'./plantilla_1/get_data_for_update.php',

								data:{datas:JSON.stringify({'id_factura':obj.v_id,'id_estudio':obj.v_fk_id_estudio})},
								//data:{datas:JSON.stringify({'id_factura':obj.v_id})},
								type: 'POST',
								success:function(data){
									var dataTable = $('#tb_plantilla1').DataTable();
									var dataForTable = dataTable
									.rows()
									.data();
									
									for (var i=0;i<dataForTable.length;i++){
										dataForTable[i][3]=dataForTable[i][3].substring(0,dataForTable[i][3].length-1)+'value="'+data.array_datos[i]+'">';
										dataForTable[i][4] =dataForTable[i][4].substring(0,dataForTable[i][4].length-1)+'value="'+data.array_verificados[i]+'">';
										dataTable.row(i).data(dataForTable[i]).draw();	
									}
									$('#observaciones').val(data.comentarios);
								}
							});

	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}else{
					swal({
						type: 'info',
						title: 'Es necesario registrar primero',
					})
				}
			});
		}

		//Editar Registros Curva de tolerancia
		function editRegister_p1_3h(){
			$('#dt_agenda tbody').on( 'click', '#edit_p1_3h', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				
				if(data.Registrado=='Si'){
					var obj={
						v_id:data.id_factura,
						v_fk_id_estudio:data.fk_id_estudio
					};
					
					$.ajax({
						url:'./plantilla_1_curva_3h/frm_registro_update.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_1.js";
								$("head").append(s);

							$('#btn_guardar').attr('id','btn_update');
							
							$.ajax({
								url:'./plantilla_1/get_data_for_update.php',

								data:{datas:JSON.stringify({'id_factura':obj.v_id,'id_estudio':obj.v_fk_id_estudio})},
								//data:{datas:JSON.stringify({'id_factura':obj.v_id})},
								type: 'POST',
								success:function(data){
									var dataTable = $('#tb_plantilla1').DataTable();
									var dataForTable = dataTable
									.rows()
									.data();
									
									for (var i=0;i<dataForTable.length;i++){
										dataForTable[i][3]=dataForTable[i][3].substring(0,dataForTable[i][3].length-1)+'value="'+data.array_datos[i]+'">';
										dataForTable[i][4] =dataForTable[i][4].substring(0,dataForTable[i][4].length-1)+'value="'+data.array_verificados[i]+'">';
										dataTable.row(i).data(dataForTable[i]).draw();	
									}
									$('#observaciones').val(data.comentarios);
								}
							});

	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}else{
					swal({
						type: 'info',
						title: 'Es necesario registrar primero',
					})
				}
			});
		}

		//Editar Registros P1
		function editRegister_p1_5h(){
			$('#dt_agenda tbody').on( 'click', '#edit_p1_5h', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				
				if(data.Registrado=='Si'){
					var obj={
						v_id:data.id_factura,
						v_fk_id_estudio:data.fk_id_estudio
					};
					
					$.ajax({
						url:'./plantilla_1_curva_5h/frm_registro_update.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_1.js";
								$("head").append(s);

							$('#btn_guardar').attr('id','btn_update');
							
							$.ajax({
								url:'./plantilla_1/get_data_for_update.php',

								data:{datas:JSON.stringify({'id_factura':obj.v_id,'id_estudio':obj.v_fk_id_estudio})},
								//data:{datas:JSON.stringify({'id_factura':obj.v_id})},
								type: 'POST',
								success:function(data){
									var dataTable = $('#tb_plantilla1').DataTable();
									var dataForTable = dataTable
									.rows()
									.data();
									
									for (var i=0;i<dataForTable.length;i++){
										dataForTable[i][3]=dataForTable[i][3].substring(0,dataForTable[i][3].length-1)+'value="'+data.array_datos[i]+'">';
										dataForTable[i][4] =dataForTable[i][4].substring(0,dataForTable[i][4].length-1)+'value="'+data.array_verificados[i]+'">';
										dataTable.row(i).data(dataForTable[i]).draw();	
									}
									$('#observaciones').val(data.comentarios);
								}
							});

	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}else{
					swal({
						type: 'info',
						title: 'Es necesario registrar primero',
					})
				}
			});
		}


		//Editar Registros P2
		function editRegister_p2(){
				$('#dt_agenda tbody').on( 'click', '#edit_p2', function () {
					var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
					
					if(data.Registrado=='Si'){
						var obj={
							v_id:data.id_factura,
							v_fk_id_estudio:data.fk_id_estudio
						};
						
						$.ajax({
							url:'./plantilla_2/frm_registro_update.php',
							data:{datas:JSON.stringify(obj)},
							type: 'POST',
							success:function(data){
								$('.container').empty();
								$("#styloRemove").attr("disabled", "disabled");
								$(".container").append(data);
			
								//load javascript
								var s = document.createElement("script");
									s.type = "text/javascript";
									s.src = "./js/plantilla_2.js";
									$("head").append(s);
	
								$('#btn_guardar').attr('id','btn_update');
																
								$.ajax({
									url:'./plantilla_2/get_data_for_update.php',
									data:{datas:JSON.stringify({'id_factura':obj.v_id,'id_estudio':obj.v_fk_id_estudio})},
									type: 'POST',
									success:function(data){
										
										var dataTable = $('#tb_plantilla2').DataTable();
										var dataForTable = dataTable
										.rows()
										.data();
										
										for (var i=0;i<dataForTable.length;i++){
											switch(data.array_datos[i].replace(/\s/g,"")){
												case "POSITIVO":
													$('#fi_estado'+(i+1)).val('P O S I T I V O').change();
													break;
												case "NEGATIVO":
													$('#fi_estado'+(i+1)).val('N E G A T I V O').change();
													break;
												case "A":
													$('#fi_estado'+(i+1)).val('A').change();
												break;

												case "B":
													$('#fi_estado'+(i+1)).val('B').change();
												break;
												case "AB":
													$('#fi_estado'+(i+1)).val('AB').change();
												break;
												case "O":
													$('#fi_estado'+(i+1)).val('O').change();
												break;
											}

											$('#fi_verificado'+(i+1)).val(data.array_verificados[i]);

										}
										 $('#observaciones').val(data.comentarios);
										 $('#btn_update').text("Actualizar");
									}
								});
	
		
							},
							error:function(xhr, status, error){
								console.log("click");
								console.log(xhr.responseText);
							}
						});
					}else{
						swal({
							type: 'info',
							title: 'Es necesario registrar primero',
						})
					}
				});
			}

		//Editar Registro P3
		function editRegister_p3(){
			$('#dt_agenda tbody').on( 'click', '#edit_p3', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				
				if(data.Registrado=='Si'){
					var obj={
						v_id:data.id_factura,
						v_fk_id_estudio:data.fk_id_estudio
					};
					
					$.ajax({
						url:'./plantilla_3/frm_registro_update.php',
						data:{datas:JSON.stringify(obj)},
						type: 'POST',
						success:function(data){
							$('.container').empty();
							$("#styloRemove").attr("disabled", "disabled");
							$(".container").append(data);
		
							//load javascript
							var s = document.createElement("script");
								s.type = "text/javascript";
								s.src = "./js/plantilla_3.js";
								$("head").append(s);

							$('#btn_guardar').attr('id','btn_update');
							
							$.ajax({
								url:'./plantilla_3/get_data_for_update.php',

								data:{datas:JSON.stringify({'id_factura':obj.v_id,'id_estudio':obj.v_fk_id_estudio})},
								//data:{datas:JSON.stringify({'id_factura':obj.v_id})},
								type: 'POST',
								success:function(data){
									var dataTable = $('#tb_plantilla3').DataTable();
									var dataForTable = dataTable
									.rows()
									.data();
									
									for (var i=0;i<dataForTable.length;i++){
										dataForTable[i][3]=dataForTable[i][3].substring(0,dataForTable[i][3].length-1)+'value="'+data.array_datos[i]+'">';
										//dataForTable[i][4] =dataForTable[i][4].substring(0,dataForTable[i][4].length-1)+'value="'+data.array_verificados[i]+'">';
										dataTable.row(i).data(dataForTable[i]).draw();	
									}
									$('#observaciones').val(data.comentarios);
								}
							});

	
						},
						error:function(xhr, status, error){
							console.log("click");
							console.log(xhr.responseText);
						}
					});
				}else{
					swal({
						type: 'info',
						title: 'Es necesario registrar primero',
					})
				}
			});
		}

		//Eliminar Registro P1
		function deleteRow_p1(){
			$('#dt_agenda tbody').on( 'click', '#delete_p1', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				if(data.Registrado=='Si')
				{
					Swal.fire({
					  title: 'Eliminar registro?',
					  text: "Click en si para eliminar!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  cancelButtonText: 'No',
					  confirmButtonText: 'Si'
					}).then((result) => {
					  if (result.value) {
					  	setTimeout(function() {
							$.ajax({
								url:"./plantilla_1/delete_row.php",
							   type: 'POST',
							   data:{datas:JSON.stringify({"id_factura":data.id_factura,"id_studio":data.fk_id_estudio})},
							   dataType: "json",
								success: function(datas){
									swal({
									title: '<i>Se elimino el registro correctamente</i>',
									type: 'success',
									showCloseButton: true,
									showCancelButton: true,
									focusConfirm: false,
									confirmButtonText:
										'<a  class="fa fa-thumbs-up"></a> Ok!',
									confirmButtonAriaLabel: 'Thumbs up, great!',
									});
									$('#dt_agenda').DataTable().ajax.reload();
									console.log(data)
									
								},
								   error:function(xhr, status, error){
									   console.log(xhr.responseText);
										swal(
											'Oops...',
											'Error del servidor',
											xhr.responseText
										)
								   }
							}) //fin del ajax
						}, 300)
					  }
					})	
				}else
				{
					swal({
						type: 'info',
						title: 'No hay registros para borrar',
					})
				}
						
			});	
		}

		//Eliminar Registro p2
		function deleteRow_p2(){
			$('#dt_agenda tbody').on( 'click', '#delete_p2', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();
				if(data.Registrado=='Si')
				{
					Swal.fire({
					  title: 'Eliminar registro?',
					  text: "Click en si para eliminar!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  cancelButtonText: 'No',
					  confirmButtonText: 'Si'
					}).then((result) => {
					  if (result.value) {
					  	setTimeout(function() {
							$.ajax({
								url:"./plantilla_2/delete_row.php",
							   type: 'POST',
							   data:{datas:JSON.stringify({"id_factura":data.id_factura,"id_studio":data.fk_id_estudio})},
							   dataType: "json",
								success: function(datas){
									swal({
									title: '<i>Se elimino el registro correctamente</i>',
									type: 'success',
									showCloseButton: true,
									showCancelButton: true,
									focusConfirm: false,
									confirmButtonText:
										'<a  class="fa fa-thumbs-up"></a> Ok!',
									confirmButtonAriaLabel: 'Thumbs up, great!',
									});
									$('#dt_agenda').DataTable().ajax.reload();
									console.log(data)
								},
								   error:function(xhr, status, error){
									   console.log(xhr.responseText);
										swal(
											'Oops...',
											'Error del servidor',
											xhr.responseText
										)
								   }
							}) //fin del ajax
						}, 300)
					  }
					})
				}else
				{
					swal({
						type: 'info',
						title: 'No hay registros para borrar',
					})
				}
			});	
		}

		//Eliminar Registro P3
		function deleteRow_p3(){
			$('#dt_agenda tbody').on( 'click', '#delete_p3', function () {
				var data =$('#dt_agenda').DataTable().row( $(this).parents('tr') ).data();

				if(data.Registrado=='Si')
				{
					Swal.fire({
					  title: 'Eliminar registro?',
					  text: "Click en si para eliminar!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  cancelButtonText: 'No',
					  confirmButtonText: 'Si'
					}).then((result) => {
					  if (result.value) {
	  					setTimeout(function() {
							$.ajax({
								url:"./plantilla_3/delete_row.php",
							   type: 'POST',
							   data:{datas:JSON.stringify({"id_factura":data.id_factura,"id_studio":data.fk_id_estudio})},
							   dataType: "json",
								success: function(datas){
									swal({
									title: '<i>Se elimino el registro correctamente</i>',
									type: 'success',
									showCloseButton: true,
									showCancelButton: true,
									focusConfirm: false,
									confirmButtonText:
										'<a  class="fa fa-thumbs-up"></a> Ok!',
									confirmButtonAriaLabel: 'Thumbs up, great!',
									});
									$('#dt_agenda').DataTable().ajax.reload();
									console.log(data)
								},
								   error:function(xhr, status, error){
									   console.log(xhr.responseText);
										swal(
											'Oops...',
											'Error del servidor',
											xhr.responseText
										)
								   }
							}) //fin del ajax
						}, 300)
					  }
					})	
				}else
				{
					swal({
						type: 'info',
						title: 'No hay registros para borrar',
					})
				}
				
		
			});	
		}

		var printer = function(tbody, table){
			$(tbody).on("click", "button#printer", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var plantilla = data.num_plnatilla
				var fac = data.id_factura
				var est = data.fk_id_estudio

				if(plantilla == 'P1')
				{
					$.post("./services/validar_p1.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log(data)

					    data = jQuery.parseJSON(data);
					    if(data.val == 0)
					    {
					    	swal({
									type: 'info',
									title: 'Es necesario registrar primero',
								})
					    	//Swal.fire('El estudio no ha sido registrado')
					    }else
					    if(data.val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(data.val == 2)
					    {
					    	if(est == 235 || est == 236)
					    	{
					    		window.open('./reports/print_result_p1_curva.php?numero_factura='+fac+'&studio='+est, '_blank');
					    	}else
					    	{
					    		window.open('./reports/print_result_p1.php?numero_factura='+fac+'&studio='+est, '_blank');
					    	}
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
				}else
				if(plantilla == 'P2')
				{
					$.post("./services/validar_p2.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log(data)

					    data = jQuery.parseJSON(data);
					    if(data.val == 0)
					    {
					    	swal({
									type: 'info',
									title: 'Es necesario registrar primero',
								})
					    	
					    }else
					    if(data.val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }else
					    if(data.val == 2)
					    {
					    
					    	window.open('./reports/print_result_p2.php?numero_factura='+fac+'&studio='+est, '_blank');
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
				}else
				if(plantilla == 'P3')
				{
					$.post("./services/validar_p3.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log(data)

					    data = jQuery.parseJSON(data);
					    if(data.val == 0)
					    {
					    	swal({
									type: 'info',
									title: 'Es necesario registrar primero',
								})
					    }else
					    if(data.val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }else
					    if(data.val == 2)
					    {
					    
					    	window.open('./reports/print_result_p3.php?numero_factura='+fac+'&studio='+est, '_blank');
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
				}
				
				  
			});
		}

		var email_medico = function(tbody, table){
			$(tbody).on("click", "button#e_medico", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var plantilla = data.num_plnatilla
				var fac = data.id_factura
				var est = data.fk_id_estudio
				var enviar = 1
				var e_medico = data.email_medico
				var e_paciente = data.email_paciente
				var registro = data.Registrado
				if(registro == 'Si')
				{
					if(plantilla == 'P1')
					{
						$.post("./services/validar_p1.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	if(est == 235 || est == 236)
					    	{
					    		$.post("./reports/result_email_p1_curva.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    	}else
					    	{
						    	$.post("./reports/result_email_p1.php",{'numero_factura': fac, 'studio' : est },function(data, status){
								    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
									    console.log('Se envio email: ' + data)
									    if(data == 1)
									    {
									    	Swal.fire('Mensaje enviado')
									    }else
									    {
									    	Swal.fire('Error al enviar ensaje: ' + data)
									    }
									  });
								  });
						    }
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					if(plantilla == 'P2')
					{
						$.post("./services/validar_p2.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	$.post("./reports/result_email_p2.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					if(plantilla == 'P3')
					{
						$.post("./services/validar_p3.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	$.post("./reports/result_email_p3.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					{
						Swal.fire('Ocurrio un error')
					}

				}else
				{
					swal({
								type: 'info',
								title: 'Es necesario registrar primero',
					})
				}
  
			});
		}

		var email_paciente = function(tbody, table){
			$(tbody).on("click", "button#e_paciente", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var plantilla = data.num_plnatilla
				var fac = data.id_factura
				var est = data.fk_id_estudio
				var enviar = 2
				var e_medico = data.email_medico
				var e_paciente = data.email_paciente
				var registro = data.Registrado
				if(registro == 'Si')
				{
					if(plantilla == 'P1')
					{
						$.post("./services/validar_p1.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	if(est == 235 || est == 236)
					    	{
					    		$.post("./reports/result_email_p1_curva.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    	}else
					    	{
					    		$.post("./reports/result_email_p1.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });	
					    	}
					    	
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					if(plantilla == 'P2')
					{
						$.post("./services/validar_p2.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	$.post("./reports/result_email_p2.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					if(plantilla == 'P3')
					{
						$.post("./services/validar_p3.php",{'factura': fac, 'estudio' : est },function(data, status){
					    console.log('Validado: ' + data)

					    data = jQuery.parseJSON(data);
					    val = data.val
					    if(val == 1)
					    {
					    	swal({
									type: 'info',
									title: 'El estudio no ha sido validado',
								})
					    }
					    else
					    if(val == 2)
					    {
					    	$.post("./reports/result_email_p3.php",{'numero_factura': fac, 'studio' : est },function(data, status){
							    $.post("./services/send_mail.php",{'numero_factura': fac, 'studio' : est, 'enviar' : enviar},function(data, status){
								    console.log('Se envio email: ' + data)
								    if(data == 1)
								    {
								    	Swal.fire('Mensaje enviado')
								    }else
								    {
								    	Swal.fire('Error al enviar ensaje: ' + data)
								    }
								  });
							  });
					    }else
					    {
					    	Swal.fire('Ocurrio un error')
					    }
					  });
					}else
					{
						Swal.fire('Ocurrio un error')
					}

				}else
				{
					swal({
								type: 'info',
								title: 'Es necesario registrar primero',
					})
				}
			});
		}
		
	$(".clikc_btn").on('click', function()
	{
		alert("Validar resultado")
	});

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
