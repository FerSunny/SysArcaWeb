
		$(document).ready(function(){

			$('select').select2();
			listClientes();


			listProducts();

								var t=$('#data_facturacion').DataTable( {
									"searching": false,
									"lengthChange": false,
									"language": {
										"info":"Mostrando _START_ a _END_ de _TOTAL_ productos",
										"infoEmpty":      "No existen productos",
										"emptyTable":     "No existen productos",
										"search":         "Buscar:",
										"lengthMenu":     "Mostrar _MENU_ productos",
										"paginate": {
											"next":       "Siguiente",
											"previous":   "Anterior"
										},
									}
								} );

			addProduct(t);
			deleteProduct();
			recalculateButton();
			saveBill();
			reloadPage();
			updateBill();
			newClient();
			//trigerMedic();

		});

		function listClientes(){

			 var data_result;

		$(".js-data-example-ajax").select2({
  ajax: {
		type    : "GET",
	 url: "./ajax/autocomplete/clientes.php",
	dataType: 'json',
	delay: 250,
	data: function (params) {
	  return {
		q: params.term, // search term
		page: params.page
	  };
	},
	processResults: function (data, params) {
	  // parse the results into the format expected by Select2
	  // since we are using custom formatting functions we do not need to
	  // alter the remote JSON data, except to indicate that infinite
	  // scrolling can be used
			data_result=data;
			console.log("arreglo recibido",data);
	  params.page = params.page || 1;

	  return {
		results: $.map(data, function (item) {
					return {
						text: item.value,
						id: item.id_cliente
					}
				}),
		pagination: {
		  more: (params.page * 30) < data.total_count
		}
	  };
	},
	cache: true
  },
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 1
  // templateResult: formatRepo, // omitted for brevity, see the source of this page
  // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
}).on('change', function (e) {
	var str = $("#s2id_search_code .select2-choice span").text();
		var idselect=$('#nombre_cliente').val();
		
		for (var i=0;i<data_result.length;i++){
			if(data_result[i].id_cliente==idselect){
				$('#tel1').val(data_result[i].telefono_fijo);
				$('#mail').val(data_result[i].mail);
				break;
			}
		}

	//this.value
}).on('select', function (e) {
	console.log("select");

});
	}

		function listProducts(){
				var table=$('#data_productos').DataTable({
					processing: true,
			serverSide: false,
			lengthMenu: [10, 25, 50],
			select: true,
						"language": {
							"info":"Mostrando _START_ a _END_ de _TOTAL_ productos",
							"infoEmpty":      "No existen productos",
							"emptyTable":     "No existen productos",
							"search":         "Buscar:",
							"lengthMenu":     "Mostrar _MENU_ productos",
							"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
						},
						},

					"ajax":{
						"url":"./ajax/productos_factura.php?action=ajax",
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
						{"data":"id_estudio"},
						{"data":"desc_estudio"},
						{
							render: function (data, type, full, meta){
					return '<input type="number" min="1" value="1">';
					}
						},
						{"data":"costo"},
						{
						 render:function(data,type,row){
							 return '<button  id="add"  type="button" class="btn btn-info btn-md"><span  class="glyphicon glyphicon-plus"></span></button>'
					 }
				 }

			 ],
			 columnDefs: [
				 {
						 orderable: false,
						 targets: [2]
				 }],
				 order: [[2, 'asc']]
			});

	}

	function addProduct(t){
		$('#data_productos tbody').on( 'click', '#add ', function () {
			var data =$('#data_productos').DataTable().row( $(this).parents('tr') ).data();
				
			var row = $(this).parents('tr');
			var cantidad_producto = row.find("td:nth-child(3)").children().val();
			var id_estudio=data.id_estudio;

				//var t = $('#data_facturacion').DataTable();
				//t.searching=false;


				t.row.add( [
						id_estudio,
						cantidad_producto,
						data.desc_estudio,
						data.costo*cantidad_producto,
						'<button id="btnRemove_product" type="button" class="btn btn-danger btn-md"><span id="btnRemove" class="glyphicon glyphicon-remove"></span></button>'
				] ).draw( false );

			calculateTotalPrice();

		});
	}

	function deleteProduct(){
		var table = $('#data_facturacion').DataTable();
		$('#data_facturacion tbody').on( 'click', '#btnRemove_product', function () {
				
		var data =$('#data_facturacion').DataTable().row( $(this).parents('tr') ).data();




		table
		.row( $(this).parents('tr') )
		.remove()
		.draw();

		calculateTotalPrice();

		});
	}


function calculateTotalPrice(){
	var dataTable = $('#data_facturacion').DataTable();
	var dataForTable = dataTable
	.rows()
	.data();

	var jsonData=[];

	for (var i=0;i<dataForTable.length;i++){
		var temp={
			id:dataForTable[i][0],
			cantidad:dataForTable[i][1]
		}
		jsonData.push(temp);
	}
	var jsonContainer={
		ids:jsonData,
		descuento:$.trim($("#descuento").val()),
		incremento:$.trim($("#incremento").val()),
		acuenta:$.trim($("#acuenta").val()),
		accion:$('#factory_id').attr('value')!=undefined?$('#factory_id').attr('value'):""
	};


	$.ajax({
		 url:"./ajax/calculatePrice.php",
	 type: 'POST',
		 data:{datas:JSON.stringify(jsonContainer)},
		 async:false,
		 dataType: "JSON",
		 success: function(data){
			console.log("calculoPrecioRecibido",data);

			 $('#subtotal').text('$'+data.subtotal);
			 $('#subtotalDescuento').text('$'+data.descuento);
			 $('#subtotalIncremento').text('$'+data.incremento);
			 $('#total').text('$'+data.total);
			 $('#saldo').text('$'+formatNumber(parseFloat(data.saldo)));

			 if(parseFloat(data.saldo)<0){
				 swal(
					 'Oops...',
					 'El saldo no puede ser negativo',
					 ''
				 );
				 //$("#descuento").val('');
				 //$("#incremento").val('');
				 //$("#acuenta").val('');
				 //calculateTotalPrice();
			 }

			 for (var i=0;i<dataForTable.length;i++){
				dataForTable[i][3] = parseFloat(data.array_descuentos[i]);
				dataTable.row(i).data(dataForTable[i]).draw();
				
			}


		 },error:function(xhr, status, error){
				 console.log(xhr.responseText);
			 }
	 }); //FIN AJAX

}

function recalculateButton(){
	$('#recalculate').click(function(e){
		calculateTotalPrice();
	});
}


function saveBill(){
	$('#btnSaveBill').click(function(e){
		var dataTable = $('#data_facturacion').DataTable();
		var data = dataTable
		.rows()
		.data();


		if(data.length==0){
			swal({
						 title: 'Ingrese un estudio como mínimo',
						 html: $('<div>')
								 .addClass('some-class')
								 .text('Intente de nuevo.'),
						 animation: false,
						 customClass: 'animated tada'
				 });
		}else{
			$("#form-factura").validate({
				rules: {
					nombre_cliente: "required",
					tel1: "required",
					mail: "required",
					vendedor:"required",
					fecha:"required",
					fechaentrega:"required",
					fi_medico:"required",
					fi_comision:"required",
					diagnostico:"required"
					
				},
				messages: {
					nombre_cliente: "Ingrese el nombre del cliente",
					tel1: "Ingrese un número telefonico válido",
								mail:"Ingrese un correo válido",
								vendedor:"Seleccione un vendedor",
								fecha:"Ingrese una fecha válida",
								fechaentrega:"Ingrese una fecha y hora válida",
								fi_medico:"Seleccione un médico",
								fi_comision:"Seleccione una comisión",
								diagnostico:"Ingrese un diagnóstico",
								medico_aux:"Ingrese el nombre del médico auxiliar"
				},

				submitHandler: function(form) {
					//form.submit();
								console.log("formulario valido");
				},
					highlight: function(element) {
					$(element).css('background', '#ffdddd');
					},
					unhighlight: function(element) {
					$(element).css('background', '#ffffff');
					}
			});

			if($('#form-factura').valid()){
				var splitDate=$('#fecha').val().split("/");
				var newfecha=splitDate[2]+"-"+splitDate[1]+"-"+splitDate[0];
				if(new Date(newfecha) <=new Date($('#fechaentrega').val())){

					var jsonToInsert={};
					var jsonData=[];

					for (var i=0;i<data.length;i++){
						var temp={
							id:data[i][0],
							cantidad:data[i][1],
							precio_venta:data[i][3]
						};
						jsonData.push(temp);
					}
					var jsonContainer={
						ids:jsonData,
						descuento:$.trim($("#descuento").val()),
						incremento:$.trim($("#incremento").val()),
						acuenta:$.trim($("#acuenta").val()),
						accion:$('#factory_id').attr('value')!=undefined?$('#factory_id').attr('value'):""
					};


					$.ajax({
						 url:"./ajax/calculatePrice.php",
					 type: 'POST',
						 data:{datas:JSON.stringify(jsonContainer)},
						 async:false,
						 dataType: "JSON",
						 success: function(data){
							 jsonToInsert.subtotal=data.subtotal;

							 jsonToInsert.total=data.total;
							 jsonToInsert.saldo=data.saldo;

						 },error:function(xhr, status, error){
								 console.log(xhr.responseText);
							 }
					 }); //FIN AJAX

					 if(jsonToInsert.saldo>=0){
						var descuento=$.trim($('#descuento').val());
						jsonToInsert.descuento=descuento.length>0?$('#descuento').val():0;
						var incremento=$.trim($('#incremento').val());
						jsonToInsert.incremento=incremento.length>0?$('#incremento').val():0;
						var acuenta=$.trim($('#acuenta').val());
						jsonToInsert.acuenta=acuenta.length>0?$('#acuenta').val():0;
						jsonToInsert.id_cliente=$('#nombre_cliente').val();
						jsonToInsert.id_usuario=$('#id_vendedor').val();
						jsonToInsert.id_medico=$('#fi_medico').val();
						jsonToInsert.pago=$('#condiciones').val();
						jsonToInsert.afecta_comision=$('#fi_comision').val();
						jsonToInsert.diagnostico=$('#diagnostico').val();
						
						jsonToInsert.mail=$('#mail').val();
						var p1 = parseInt($('input:checkbox[name=box_medico]:checked').val())
						var p2 = parseInt($('input:checkbox[name=box_paciente]:checked').val())
						if(p1 == 1)
						{
							var val_m = 1
							jsonToInsert.e_medico=val_m
						}else
						{
							var val_m = 0
							jsonToInsert.e_medico=val_m
						}

						if(p2 == 1)
						{
							var val_p = 1
							jsonToInsert.e_paciente=val_p
						}else
						{
							var val_p = 0
							jsonToInsert.e_paciente=val_p
						}
						//jsonToInsert.email=$('#email-fac').val();
						
						jsonToInsert.estado_factura=$('#estadoFactura').val();
						jsonToInsert.observaciones=$('#observaciones').val();
						if($('#medico_aux').val()!==undefined)
							jsonToInsert.medico_aux=$('#medico_aux').val().length==0?"":$('#medico_aux').val();
   
   
						var splitFecha=$('#fechaentrega').val();
						var stringSplit=splitFecha.split("T");
   
						jsonToInsert.fechaEntrega=stringSplit[0]+" "+stringSplit[1];
						jsonToInsert.estudios=jsonData;
   

						var generateId=0;
						swal({
							title: '¿Guardar Factura?',
							showCancelButton: true,
							showLoaderOnConfirm: true,
							cancelButtonText: 'No',
							confirmButtonText: 'Si,generar!',
							type: 'info',
							preConfirm: function() {
									return new Promise(function(resolve, reject) {
											setTimeout(function() {
												$.ajax({
													url:"./ajax/insertBill.php",
												   type: 'POST',
												   data:{datas:JSON.stringify(jsonToInsert)},
												   dataType: "json",
													success: function(datas){

														
														generateId=datas.id;
														
														$('#nombre_cliente').val('').trigger('change');
														$('#tel1').val('');
														$('#mail').val('');
														$('#id_vendedor').val('').trigger('change');
														$('#fi_medico').val('').trigger('change');;


														//$('#fi_medico').prop('selectedIndex', 0);
														$('#condiciones').val('').trigger('change');
														$('#fi_comision').val('').trigger('change');
														$('#diagnostico').val('')
														//$('#estadoFactura').val('');
														$('#observaciones').val('');
														$('#fechaentrega').val('');
														$('#acuenta').val('');
   
														$('#subtotal').text('$0');
														$('#subtotalDescuento').text('$0');
														$('#subtotalIncremento').text('$0');
														$('#total').text('$0');
														$('#saldo').text('$0');
														$('#descuento').val('');
														$('#incremento').val('');
														$('#acuenta').val('');
														$('#box_medico').val('');
														$('#box_paciente').val('');
														$('#containerMedicoAuxiliar').empty();
														resolve();
															dataTable
																.clear()
																.draw();
														$('#form-factura')[0].reset();
														$('#fi_medico').prop('selectedIndex',0);
													

													},
													   error:function(xhr, status, error){
														   console.log("click");
														   console.log(xhr.responseText);
														   $('#subtotal').text('$0');
														   $('#subtotalDescuento').text('$0');
														   $('#subtotalIncremento').text('$0');
														   $('#total').text('$0');
														   $('#saldo').text('$0')
   
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
									console.log("datoReturn",datoReturn);
									swal({
										title: '<i>Reporte Generado Correctamente</i>',
										type: 'success',
										showCloseButton: true,
										showCancelButton: true,
										focusConfirm: false,
										confirmButtonText:
										  '<i class="fa fa-thumbs-up"></i> Ok!',
										confirmButtonAriaLabel: 'Thumbs up, great!',
										cancelButtonText:
											
											'<a style="color:white;text-color:white;" target="_blank" href="./reports/factura.php?numero_factura='+generateId+'" onclick="openTikets('+generateId+');"><span style="color:white;text-color:white;" class="glyphicon glyphicon-print"></span> Imprimir</a>',
										
										cancelButtonAriaLabel: 'Thumbs down',
									  })
							});
					 }else{
						swal(
							'Oops...',
							'El saldo no puede ser negativo',
							''
						);
					 }

					 
				}else {
					swal({
							type: 'error',
							title: 'La fecha y hora deben ser mayor a la fecha actual!',
					});
				}
			

		}//fin validacion del formulario
		else{
				swal({
							 title: 'Ingrese todos los datos',
							 html: $('<div>')
									 .addClass('some-class')
									 .text('Intente de nuevo.'),
							 animation: false,
							 customClass: 'animated tada'
					 });
		}


		}


	});
}



	function validateDate(callback){
		var retorno="";
		$.ajax({
			 url:"./ajax/validate_datetime.php",
				type: 'POST',
			 data:{fechaentrega:$('#fechaentrega').val()},
			 async:true,
			 dataType: "text",
			 success: function(data){
				 callback(data);

			 },error:function(xhr, status, error){
					 console.log(xhr.responseText);
				 }
		 }); //FIN AJAX
	}

	function reloadPage(){
		$('#btnClose').click(function(e){
					location.reload(true);
		});
	}

	function updateBill(){

		$('#btnUpdateBill').click(function(e){
			var factory_id=$('#factory_id').attr('value')
			var dataTable = $('#data_facturacion').DataTable();
			var data = dataTable
			.rows()
			.data();


			if(data.length==0){
				swal({
					 title: 'Ingrese un estudio como mínimo',
					 html: $('<div>')
							 .addClass('some-class')
							 .text('Intente de nuevo.'),
					 animation: false,
					 customClass: 'animated tada'
					 });
			}else{
				$("#form-factura").validate({
			rules: {
				nombre_cliente: "required",
				tel1: "required",
				mail: "required",
							vendedor:"required",
							fecha:"required",
							fechaentrega:"required",
							fi_medico:"required",
							fi_comision:"required",
							diagnostico:"required"
			},
			messages: {
				nombre_cliente: "Ingrese el nombre del cliente",
				tel1: "Ingrese un número telefonico válido",
							email:"Ingrese un correo válido",
							vendedor:"Seleccione un vendedor",
							fecha:"Ingrese una fecha válida",
							fechaentrega:"Ingrese una fecha y hora válida",
							fi_medico:"Seleccione un médico",
							fi_comision:"Seleccione una comisión",
							diagnostico:"Ingrese un diagnóstico",
							medico_aux:"Seleccione un médico"
			},

			submitHandler: function(form) {
			},
				highlight: function(element) {
				$(element).css('background', '#ffdddd');
				},
				unhighlight: function(element) {
				$(element).css('background', '#ffffff');
				}
		});

		if($('#form-factura').valid()){
			var splitDate=$('#fecha').val().split("/");
			
			var newfecha=$.trim("20"+splitDate[2])+"-"+$.trim(splitDate[1])+"-"+splitDate[0]+" 1:00:00";
			
			if(new Date(newfecha) <=new Date($('#fechaentrega').val())){
						var jsonToInsert={};
						var jsonData=[];

						for (var i=0;i<data.length;i++){
							var temp={
								id:data[i][0],
								cantidad:data[i][1],
								precio_venta:data[i][3]
							};
							jsonData.push(temp);
						}
						var jsonContainer={
							ids:jsonData,
							descuento:$.trim($("#descuento").val()),
							incremento:$.trim($("#incremento").val()),
							acuenta:$.trim($("#acuenta").val()),
							accion:$('#factory_id').attr('value')!=undefined?$('#factory_id').attr('value'):""
						};
						console.log(JSON.stringify(jsonContainer));

						$.ajax({
							 url:"./ajax/calculatePrice.php",
						 type: 'POST',
							 data:{datas:JSON.stringify(jsonContainer)},
							 async:false,
							 dataType: "JSON",
							 success: function(data){
								 jsonToInsert.subtotal=data.subtotal;

								 jsonToInsert.total=data.total;
								 jsonToInsert.saldo=data.saldo;

							 },error:function(xhr, status, error){
									 console.log(xhr.responseText);
								 }
						 }); //FIN AJAX

						 if(jsonToInsert.saldo>=0){
							jsonToInsert.descuento=$('#descuento').val()>0?$('#descuento').val():0;
							jsonToInsert.incremento=$('#incremento').val()>0?$('#incremento').val():0;
							jsonToInsert.acuenta=$('#acuenta').val().length>0?$('#acuenta').val():0;
							jsonToInsert.id_cliente=$('#nombre_cliente').val();
							jsonToInsert.id_usuario=$('#id_vendedor').val();
							jsonToInsert.id_medico=$('#fi_medico').val();
							jsonToInsert.pago=$('#condiciones').val();
							jsonToInsert.afecta_comision=$('#fi_comision').val();
							jsonToInsert.diagnostico=$('#diagnostico').val()
							jsonToInsert.estado_factura=$('#estadoFactura').val();
							jsonToInsert.observaciones=$('#observaciones').val();
							jsonToInsert.factory_id=factory_id;
							jsonToInsert.medico_aux=$('#medico_aux').val()==undefined?"":$('#medico_aux').val();
   						//Email paciente
	   					var p1 = parseInt($('input:checkbox[name=box_medico]:checked').val())
							var p2 = parseInt($('input:checkbox[name=box_paciente]:checked').val())
							if(p1 == 1)
							{
								var val_m = 1
								jsonToInsert.e_medico=val_m
							}else
							{
								var val_m = 0
								jsonToInsert.e_medico=val_m
							}

							if(p2 == 1)
							{
								var val_p = 1
								jsonToInsert.e_paciente=val_p
							}else
							{
								var val_p = 0
								jsonToInsert.e_paciente=val_p
							}
							var splitFecha=$('#fechaentrega').val();
							var stringSplit=splitFecha.split("T");
   
							jsonToInsert.fechaEntrega=stringSplit[0]+" "+stringSplit[1];
							jsonToInsert.estudios=jsonData;
   
							console.log("JSONTOINSERT",jsonToInsert);
							
							swal({
								title: '¿Actualizar Factura?',
								text: "Se actualizara toda la información!",
								showCancelButton: true,
								showLoaderOnConfirm: true,
								cancelButtonText: 'No',
								confirmButtonText: 'Si,Actualizar!',
								type: 'info',	
								preConfirm: function() {
										return new Promise(function(resolve, reject) {
												setTimeout(function() {
													$.ajax({
														url:"./ajax/editar_facturacion.php",
													   type: 'POST',
													   data:{datas:JSON.stringify(jsonToInsert)},
													   dataType: "json",
														success: function(datas){
															console.log("entro en success");
															resolve();
																dataTable
																	.clear()
																	.draw();
   
															$('#nombre_cliente').val('');
															$('#tel1').val('');
															$('#mail').val('');
															$('#id_vendedor').val('');
															$('#fi_medico').val('');
															$('#condiciones').val('');
															$('#fi_comision').val('');
															$('#diagnostico').val('')
															//$('#estadoFactura').val('');
															$('#observaciones').val('');
															$('#fechaentrega').val('');
   
															$('#subtotal').text('$0');
															$('#subtotalDescuento').text('$0');
															$('#subtotalIncremento').text('$0');
															$('#total').text('$0');
															$('#saldo').text('$0');
														},
														   error:function(xhr, status, error){
															   console.log("click");
															   console.log(xhr.responseText);
   
																swal(
																	'Oops...',
																	'Error del servidor',
																	'error'
																)
														   }
													}) //fin del ajax
												}, 300)
										})
								},
								allowOutsideClick: false
								}).then(function(email) {
   
											
									 swal({
										title: '<i>Factura Actualizada Correctamente!</i>',
										type: 'success',
										showCloseButton: true,
										showCancelButton: true,
										focusConfirm: false,
										confirmButtonText:
											'<i class="fa fa-thumbs-up"></i> Ok!',
										confirmButtonAriaLabel: $('#btnClose').click(),
										cancelButtonText:
										 '<a role="button" class="btn btn-info" target="_blank" href="./reports/factura.php?numero_factura='+factory_id+'" onclick="openTikets('+factory_id+');"><span class="glyphicon glyphicon-print"></span> Imprimir</a>',
											
										cancelButtonAriaLabel: $('#btnClose').click(),
									 });
								});
						 }else{
							swal(
								'Oops...',
								'El saldo no puede ser negativo',
								''
							);
						 }
						 
					}else {
						swal({
								type: 'error',
								title: 'La fecha y hora deben ser mayor a la fecha actual!',
						});
					}
				

			}//fin validacion del formulario
			else{
					swal({
								 title: 'Ingrese todos los datos',
								 html: $('<div>')
										 .addClass('some-class')
										 .text('Intente de nuevo.'),
								 animation: false,
								 customClass: 'animated tada'
						 });
			}


			}


		});
	}

function formatNumber (num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function newClient(){
	$('#btn_create_client').click(function(e){
		
		$("#fm_create_cliente").validate({
			rules: {
				fn_nombre: "required",
				fi_apaterno: "required",
				fi_amaterno: "required",
				fi_anios:"required",
				fi_meses:"required",
				fi_dias:"required",
				fi_sexo:"required",
				fi_movil:"required",
				//fi_estado_civil:"required",
				//fi_rfc:"required",
				//fi_ocupacion:"required",
				//fi_tfijo:"required",
				//fi_mail:"required",
				//fi_Estado:"required",
				//fi_municipio:"required",
				//fi_Localidad:"required",
				fi_colonia:"required",
				fi_cp:"required",
				fi_calle:"required",
				fi_numero:"required",
				fi_falta:"required",
				estado_reg:"required"
			},
			messages: {
				fn_nombre: "Ingrese un nombre",
				fi_apaterno: "Ingrese el apellido paterno",
				fi_amaterno: "Ingrese el apellido materno",
				fi_anios:"Ingrese los anio",
				fi_meses:"Ingrese los meses",
				fi_dias:"Ingrese los dias",
				fi_sexo:"Seleccione un sexo",
				fi_movil:"Ingrese un número movil",
				//fi_estado_civil:"Seleccione un estado civil",
				//fi_rfc:"Ingrese el rfc",
				//fi_ocupacion:"Seleccione una ocupación",
				//fi_tfijo:"Ingrese un número telefonico",
				//fi_mail:"Ingrese un correo",
				//fi_Estado:"Seleccione un estado",
				//fi_municipio:"Seleccione un municipio",
				//fi_Localidad:"Seleccione una localidad",
				fi_colonia:"Seleccione una colonia",
				fi_cp:"Ingrese el código postal",
				fi_calle:"Ingrese una calle",
				fi_numero:"Ingrese el número",
				fi_falta:"",
				estado_reg:"Seleccione un estatus"
				
			},

			submitHandler: function(form) {
				//form.submit();
							console.log("formulario valido");
			},
				highlight: function(element) {
				$(element).css('background', '#ffdddd');
				},
				unhighlight: function(element) {
				$(element).css('background', '#ffffff');
				}
		});

		if($('#fm_create_cliente').valid()){
			
			jsonToInsert={
				fn_nombre:$('#fn_nombre').val(),
				fn_apaterno: $('#fi_apaterno').val(),
				fn_amaterno: $('#fi_amaterno').val(),

				fn_anios:$('#fi_anios').val(),
				fn_meses:$('#fi_meses').val(),	
				fn_dias:$('#fi_dias').val(),

				fn_sexo:$('#fi_sexo').val(),
				fn_estado_civil:$('#fi_estado_civil').val(),
				fn_rfc:$('#fi_rfc').val(),
				fn_ocupacion:$('#fi_ocupacion').val(),
				fn_tfijo:$('#fi_tfijo').val(),
				fn_movil:$('#fi_movil').val(),
				fn_mail:$('#fi_mail').val(),
				fn_Estado:$('#fi_Estado').val(),
				fn_municipio:$('#fi_municipio').val(),
				fn_Localidad:$('#fi_Localidad').val(),
				fn_colonia:$('#fi_colonia').val(),
				fn_cp:$('#fi_cp').val(),
				fn_calle:$('#fi_calle').val(),
				fn_numero:$('#fi_numero').val(),
				fn_falta:$('#fi_falta').val(),
				estado_reg:$('#estado_reg').val()
			};
			console.log("jsontoInsert ",jsonToInsert);
			$.ajax({
				url:"./ajax/registro_cliente.php",
			   type: 'POST',
			   data:{datas:JSON.stringify(jsonToInsert)},
			   dataType: "json",
				success: function(datas){
					$('#fm_create_cliente')[0].reset();
					$("#modalClientes").modal('hide');
					$.notify({
						title: '<strong>Registro Guardado!</strong>',
						message: 'Se registro al cliente correctamente'
					},{
						type: 'success',
						timer: 800
					},{
						animate: {
							enter: 'animated flipInY',
							exit: 'animated flipOutX'
						}
					}
				);
					
				},
				error:function(xhr, status, error){
					console.log("error");
					console.log(xhr.responseText);
				}
			});
		}
});
} //Fin de la funcion newCliente


function openTikets(id){
	window.open("reports/tikets.php?numero_factura="+id, '_blank');
}


//se te paso encerar una llave

/*
Esta funciones la que detectaba el cambio del medico y agregaba un elemento, con descomentarla ya esta
function trigerMedic(){
	$( "#fi_medico" ).change(function() {
		console.log($("#fi_medico option:selected").text());
		console.log("hola");

		if($("#fi_medico option:selected").text()=='Medico Sin Registro'){
			$('#containerMedicoAuxiliar').append('<div class="form-group row">'+			
				'<label  class="col-md-1 control-label">Médico</label>'+
					'<div class="col-md-4">'+
						'<input type="text" class="form-control col-md-1" id="medico_aux" name="medico_aux" placeholder="Nombre del médico auxiliar" required>'+
						'</div>'+
						'</div>');
		}else{

			$('#containerMedicoAuxiliar').empty();
		}
	  });
*/
